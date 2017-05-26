<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attributes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\Norms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller
{

    /**
     * @brief 分类下拉
     * @return \Illuminate\Http\JsonResponse
     */
    public function category()
    {
        //从redis读取
        if(Redis::exists('dataCategory'))
        {
            $data = Redis::get('dataCategory');
            $dataCategory = unserialize($data);

            return response()->json($dataCategory);
        }

        //实例化表
        $db = new Category();
        $data = $db->findAll();

        //层及分类
        $dataCategory = $db->tree($data);


        //序列化写入内存
        $dealDataCategory = serialize($dataCategory);
        Redis::set('dataCategory', $dealDataCategory);


        return response()->json($dataCategory);
    }



    /**
     * @brief 品牌下拉
     * @return \Illuminate\Http\JsonResponse
     */
    public function brand()
    {
        //实例化表
        $db = new Brand();
        $dataBrand = $db->findAll();

        return response()->json($dataBrand);
    }



    /**
     * @brief 规格名称下拉
     * @return \Illuminate\Http\JsonResponse
     */
    public function normsName()
    {
        //从redis读取
        if(Redis::exists('dataNorms'))
        {
            $data = Redis::get('dataNorms');
            $data = unserialize($data);

            //循环获得规格名
            $normsName = [];
            foreach ($data as $key => $val)
            {
                $normsName[$key] = $val['norms_name'];
            }
            return response()->json($normsName);
        }

        //实例化表
        $db = new Norms();
        $data = $db->findAll();

        //循环获得规格名
        $normsName = [];
        foreach ($data as $val)
        {
            $normsName[$val['norms_id']] = $val['norms_name'];
        }


        //处理数据写入内存20分钟 避免短时间重复IO
        $dataNorms = [];
        foreach ($data as $key => $val)
        {
            $id = $val['norms_id'];
            unset($val['norms_id']);
            $val['norms_value'] = explode(',', $val['norms_value']);

            $dataNorms[$id] = $val;
        }
        //序列化存入$dataNorms[norms_id] = [norms_name,[norms_value]]
        $dataNorms = serialize($dataNorms);
        Redis::setex('dataNorms', 1200, $dataNorms);


        return response()->json($normsName);
    }

    /**
     * @brief 规格对应的值
     * @return \Illuminate\Http\JsonResponse
     */
    public function normsValue()
    {
        $id = Input::get('norms_id');

        //从redis读取
        if(Redis::exists('dataNorms'))
        {
            $data = Redis::get('dataNorms');
            $data = unserialize($data);
            $normsValue['norms_value'] = $data[$id]['norms_value'];
            $normsValue['norms_name'] = $data[$id]['norms_name'];
            $normsValue['code'] = 1;
            return response()->json($normsValue);
        }
        else
        {
            $normsValue['code'] = 0;
            return response()->json($normsValue);
        }
    }



    /**
     * @brief 生成sku规格信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSku()
    {
        $info = Input::get('info');

        //"1,黑|1,白|2,xl|2,xxl" => [[黑,白,黄],[xl,xxl],[棉,麻]]
        $info = explode('|', $info);
        foreach ($info as $key => $val)
        {
            $info[$key] = explode(',', $val);
        }
        $beforeDke = [];
        foreach ($info as $key => $val)
        {
            $beforeDke[$val[0]][] = $val[1];
        }

        //重置数组索引
        $beforeDke = array_values($beforeDke);

        return response()->json($this->dke($beforeDke));
    }

    /**
     * @brief 笛卡儿积
     * @param $beforeDke
     * @return array
     */
    public function dke($beforeDke)
    {
        $afterDke = [];
        //以数组第一个子数组为基础生成笛卡儿积形式数组
        foreach ($beforeDke[0] as $key =>$val)
        {
            $afterDke[$key][] = $val;
        }

        //循环将数组第一个子数组之后子数组填入基础数组
        $length = count($beforeDke);
        for ($i = 1; $i < $length; $i++ )
        {
            //循环将数组第$i个数组填入基础数组
            $map = [];
            foreach ($afterDke as $val)
            {
                foreach ($beforeDke[$i] as $v)
                {
                    $val[$i] = $v;
                    $map[] = $val;
                }
            }
            //重新生成填充过的基础数组
            $afterDke = $map;
        }

        return $afterDke;
    }

    /**
     * @brief sku图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function skuImg(Request $request)
    {
        $img = $this->upload($request);


        if (!$img)
        {
            return response()->json([
                'code' => 0,
                'msg'  => '图片选取失败，请重试'
            ]);
        }
        return response()->json([
            'code' => 1,
            'file' => 'uploads/' . $img['file']
        ]);
    }



    /**
     * @brief 属性类型下拉
     * @return \Illuminate\Http\JsonResponse
     */
    public function attributesType()
    {
        $id = Input::get('category_id');

        //实例化表
        $db = new Category();
        $data = $db->findTopCategory();

        //循环处理数据
        $dataCategoryTop = [];
        foreach ($data as $val)
        {
            $dataCategoryTop[$val['category_id']] = $val['category_name'];
        }


        return response()->json($dataCategoryTop);
    }

    /**
     * @brief 属性和属性值
     * @return \Illuminate\Http\JsonResponse
     */
    public function attributes()
    {
        $categoryId = Input::get('category_id');

        //实例化表
        $db = new Attributes();
        $dataAttribute = $db->findByCategoryId($categoryId);

        //属性值处理成数组
        foreach ($dataAttribute as &$val)
        {
            if (!empty($val['attr_value']))
            {
                $val['attr_value'] = explode(',', $val['attr_value']);
            }
        }


        return response()->json($dataAttribute);
    }




    /**
     * @brief 商品添加
     * @param Request $request
     * @return bool
     */
    public function add(Request $request)
    {
        $dataImg = $this->upload($request);
        $dataInfo = Input::get();
        extract($dataInfo);


        //验证
        /* $this->validate($request, [
             'title' => 'bail|required|unique:posts|max:255',
             'body.name' => 'bail|required',
         ]);*/


        /*
        * 商品入库
        */
        //处理分类信息
        $categoryInfo = explode('|', $category_info);
        $pos = strripos($categoryInfo[1], '-') !== false ? strripos($categoryInfo[1], '-') : -1;
        $categoryInfo[1] = substr($categoryInfo[1], $pos + 1);

        //处理品牌信息信息
        $brandInfo = explode('|', $brand_info);


        $dataGoods = [
            'goods_name'    => $goods_name,
            'goods_low_price' => $goods_low_price,
            'category_id'   => $categoryInfo[0],
            'category_name' => $categoryInfo[1],
            'brand_id'      => $brandInfo[0],
            'brand_name'    => $brandInfo[1],
            'goods_desc'    => $goods_desc,
            'goods_img'     => 'uploads/' . $dataImg['goods_img'],
            'is_on_sale'    => isset($is_on_sale) ? $is_on_sale : 0,
            'is_second'     => isset($is_second) ? $is_second : 0,
            'is_hot'        => isset($is_hot) ? $is_hot : 0,
            'is_point'      => isset($is_point) ? $is_point : 0
        ];
        //实例化表
        $db = new Goods();
        $bool = $db->add($dataGoods);

        //添加失败结束
        if (!$bool)
        {
            return [];
        }

        $id = $db->goods_id;
        //生成商品货号年月日分类id(3)品牌id(3)商品id(3)
        $goodsSn = date('ymd') . $this->substrInt($categoryInfo[0]) . $this->substrInt($brandInfo[0]) . $this->substrInt($id);

        $db->goods_sn = $goodsSn;
        $db->save();
        //清空连接
        $db = null;


        /*
         * 商品属性入库
         */
        $dataGoodsAttr = [];
        foreach ($attr_value as $key => $val)
        {
            $dataGoodsAttr[] = [
                'goods_id'   => $id,
                'attr_name'  => $key,
                'attr_value' => $val,
            ];
        }

        //入库
        $this->insertTable('goods_attr', $dataGoodsAttr);


        /*
         * 商品图片入库
         */
        $dataGoodsImg = [];
        foreach ($dataImg['img_url'] as $key =>$val)
        {
            $dataGoodsImg[$key]['goods_id'] = $id;
            $dataGoodsImg[$key]['img_url'] = 'uploads/' . $val;
            $dataGoodsImg[$key]['img_desc'] = $img_desc[$key];
        }

        //入库
        $this->insertTable('goods_img', $dataGoodsImg);



       /*
        * 商品规格入库
        */
        $dataGoodsNorms = [];
        foreach ($norms_value as $key => $val)
        {
            //如果是数据处理成字符串
            if (is_array($val))
            {
                $val = implode(',', $val);
            }

            $dataGoodsNorms[] = [
                'goods_id'    => $id,
                'norms_name'  => $key,
                'norms_value' => $val,
            ];
        }
        dd($dataGoodsNorms);

        //入库
        $this->insertTable('goods_norms', $dataGoodsNorms);


        /*
        * sku商品入库
        */
        $dataGoodsSku = [];
        foreach ($sku_norms as $key => $val)
        {
            //如果是数据处理成字符串
            if (is_array($val))
            {
                $val = implode(',', $val);
            }

            $dataGoodsSku[] = [
                'sku_sn' => $goodsSn . $this->substrInt($key),
                'goods_id' => $id,
                'goods_name' => $goods_name,
                'sku_num' => $sku_num[$key],
                'sku_norms' => $val,
                'sku_price' => $sku_price[$key],
                'sku_img' => $sku_img[$key],
            ];
        }

        //入库
        $this->insertTable('goods_sku', $dataGoodsSku);


        //跳转
        echo 1;
    }

    /**
     * @brief 批量入库 错误抛出异常
     * @param $table
     * @param $data
     * @return bool
     */
    protected function insertTable($table, $data)
    {
        //入库
        $bool = DB::table($table)->insert($data);
        //添加失败写入信息
        if (!$bool)
        {

        }

        return true;
    }

    /**
     * @brief 获取int数据后三位数据
     * @param $int
     * @return bool|string
     */
    protected function substrInt($int)
    {
        if (strlen($int) >= 3)
        {
            $int = substr($int, -3);
        }
        else
        {
            $length = 3 - strlen($int);
            $int = str_repeat('0', $length) . $int;
        }

        return $int;
    }


    /**
     * @brief 文件上传，单文件多文件都可以
     * @param Request $request
     * @return array
     */
    public function upload($request)
    {
        $path = [];
        $file = $request->file();
        //多个input标签
        foreach ($file as $key => $val)
        {
            //input标签是数组情况
            if (is_array($val))
            {
                $keyPath = [];
                foreach ($val as $v)
                {
                    $singlePath = $this->uploadSingle($v);
                    $keyPath[] = $singlePath;
                }
                $path[$key] = $keyPath;
            }
            else
            //input标签单个情况
            {
                $singlePath = $this->uploadSingle($val);
                $path[$key] = $singlePath;
            }
        }

        return $path;
    }

    /**
     * @brief 文件上传辅助,也可用于单文件上传(参数为$request->file())
     * @param Request $file
     * @return array|bool
     */
    public function uploadSingle($file)
    {
        //检测文件是否可用
        if ($file->isValid())
        {
            // 获取文件相关信息
            $ext = $file->getClientOriginalExtension();      // 扩展名
            $tempPath = $file->getRealPath();                //临时文件的绝对路径

            //检测文件格式
            $allowed_extensions = ["png", "jpg", "gif"];
            if (!in_array($ext, $allowed_extensions))
            {
                return false;
            }

            //使用uploads本地存储空间（目录）
            $filename = uniqid() . '.' . $ext;

            $datePath = date('Y-m-d');                                                   // 上传文件111
            $singlePath = $file->storeAs($datePath, $filename, 'uploads');                      // 上传文件111

            //$bool = Storage::disk('uploads')->put($filename, file_get_contents($tempPath));   // 上传文件222

            return $singlePath;
        }

        return false;
    }







}
/*Session::flash('alert-success', 'Foto uploaden gelukt');
return redirect('/profiel');*/
