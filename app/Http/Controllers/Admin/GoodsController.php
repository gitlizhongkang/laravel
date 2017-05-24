<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attributes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Norms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;

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
            $normsValue['data'] = $data[$id]['norms_value'];
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




    public function add()
    {

    }

}
