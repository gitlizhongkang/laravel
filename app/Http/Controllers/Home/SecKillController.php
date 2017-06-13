<?php

namespace App\Http\Controllers\Home;

use App\Models\District;
use App\Models\GoodsAttr;
use App\Models\GoodsComment;
use App\Models\GoodsImg;
use App\Models\GoodsNorms;
use App\Models\GoodsSecond;
use App\Models\GoodsSku;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class SecKillController extends Controller
{

    /**
     * @brief 秒杀商品展示页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function secList()
    {
        //获取商品信息
        $dataSec = $this->getSec();

        //赋值渲染
        return view('home.sec-list', ['dataSec' => $dataSec]);
    }


    /**
     * @brief 商品详情页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function secInfo()
    {
        $id = Input::get('goods_id');


        $goodsInfo = $this->getSec();
        //获取商品信息
        if (!isset($goodsInfo[$id]))    exit('秒杀已结束');
        $data['goodsInfo'] = $goodsInfo[$id];

        //获取商品规格信息
        $data['norms']= $this->getGoodsNorms($id);

        //获取商品的属性信息
        $data['goodsAttr'] = $this->getGoodsAttr($id);

        //获取商品的评论
        $data['comment'] = $this->getGoodsComment($id);

        //获取商品的图片
        $data['img'] = $this->getGoodsImg($id);
        //dd($data['img']);

        //服务器时间2018/07/08 18:45:13
        $data['now'] = date('Y-m-d H:i:s');


        return view('home.sec',$data);
    }


    /**
     * @brief 设置数据到内存到明天05点
     */
    public function setLeftTimeRedis($key, $data)
    {
        //序列化
        $data = serialize($data);
        //写入内存到明天5时截止
        $time = $this->getLeftTime();

        Redis::setex($key, $time, $data);
    }
    /**
     * @brief 获取当前时间到明天05点的秒数
     * @return int
     */
    public function getLeftTime()
    {
        $now = time();
        $tomorrow = Carbon::tomorrow()->timestamp + 18000;
        $time = $tomorrow - $now;

        return $time;
    }


    /**
     * @brief 3天内的秒杀商品
     * @return array|mixed
     */
    public function getSec()
    {
        //本天第一次之后读redis
        if(Redis::exists('d_dataSec'))
        {
            $dataSec = Redis::get('d_dataSec');
            $dataSec = unserialize($dataSec);

        }
        //本天第一次读数据库
        else
        {
            //只显示3天内的秒杀商品[今天5点开始到3天后5点结束]
            $carbon = Carbon::today()->addDays(3)->addHours(5);

            //start_time为索引
            $dataTempSec = GoodsSecond::select('goods_id','goods_sn', 'goods_name', 'original_price', 'second_price', 'brand_name', 'goods_desc', 'goods_img', 'start_time', 'end_time', 'num')
                ->where('start_time', '<=', $carbon)
                ->orderBy('start_time')
                ->get()
                ->toArray();

            //处理数据键值为每条数据的id
            $dataSec = [];
            foreach ($dataTempSec as $val)
            {
                $dataSec[$val['goods_id']] = $val;
            }

            //存入内存到明天5时
            $this->setLeftTimeRedis('d_dataSec', $dataSec);
        }

        //获取商品数据删除过时的
        $now = time();
        foreach ($dataSec as $key => $val)
        {
            if (strtotime($val['end_time']) < $now)
            {
                unset($dataSec[$key]);
            }
        }

        return $dataSec;
    }


    /**
     * @brief 获取单个商品选中的sku
     * @return mixed|string
     */
    public function getGoodsSku()
    {
        $id = Input::get()['goods_id'];
        $normsValue = Input::all()['norms_value'];


        //本天第一次之后读redis
        if(Redis::exists('d_dataSku'))
        {
            $data = Redis::get('d_dataSku');
            $data = unserialize($data);

            //此商品不存在
            if (!isset($data[$id.$normsValue]))
            {
                $dataSku = json_encode($this->getSku($id, $normsValue, $data));
            }
            else
            {
                return json_encode($data[$id.$normsValue]);
            }
        }
        else
        {
            $dataSku = json_encode($this->getSku($id, $normsValue));
        }

        return $dataSku;
    }
    protected function getSku($id, $normsValue, $data = null)
    {
        $dataSku = GoodsSku::where([['goods_id', $id], ['sku_norms', $normsValue]])
            ->first()
            ->toArray();

        $dataSku['total_second'] = $dataSku['second_num'];
        $data[$id.$normsValue] = $dataSku;

        //存入内存到明天5时
        $this->setLeftTimeRedis('d_dataSku', $data);

        return $dataSku;
    }



    /**
     * @brief 获取单个商品规格信息
     * @param $id
     * @return array|mixed
     */
    public function getGoodsNorms($id)
    {
        //本天第一次之后读redis
        if(Redis::exists('d_dataNorms'))
        {
            $data = Redis::get('d_dataNorms');
            $data = unserialize($data);

            //此商品不存在
            if (!isset($data[$id]))
            {
                $dataNorms = $this->getNorms($id, $data);
            }
            else
            {
                return $data[$id];
            }
        }
        //全部不存在
        else
        {
            $dataNorms = $this->getNorms($id);
        }


        return $dataNorms;
    }
    protected function getNorms($id, $data = null)
    {
        $dataNorms = GoodsNorms::where('goods_id', $id)
            ->get()
            ->toArray();

        foreach ($dataNorms as $key => $val)
        {
            $dataNorms[$key]['norms_value'] = explode(',', $val['norms_value']);
        }

        $data[$id] = $dataNorms;
        //存入内存到明天5时
        $this->setLeftTimeRedis('d_dataNorms', $data);

        return $dataNorms;
    }


    /**
     * @brief 获取单个商品属性信息
     * @param $id
     * @return array|mixed
     */
    public function getGoodsAttr($id)
    {
        //本天5点后第一次之后读redis
        if(Redis::exists('d_dataAttr'))
        {
            $data = Redis::get('d_dataAttr');
            $data = unserialize($data);

            //此商品不存在
            if (!isset($data[$id]))
            {
                $dataAttr = $this->getAttr($id, $data);
            }
            else
            {
                return $data[$id];
            }
        }
        //全部不存在
        else
        {
            $dataAttr = $this->getAttr($id);
        }


        return $dataAttr;
    }
    protected function getAttr($id, $data = null)
    {
        $dataAttr = GoodsAttr::where('goods_id',$id)
            ->get()
            ->toArray();

        foreach ($dataAttr as $key => $val)
        {
            $dataAttr[$key]['attr_value'] = explode(',', $val['attr_value']);
        }

        $data[$id] = $dataAttr;
        //存入内存到明天5时
        $this->setLeftTimeRedis('d_dataAttr', $data);

        return $dataAttr;
    }


    /**
     * @brief 获取单个商品图片信息
     * @param $id
     * @return array|mixed
     */
    public function getGoodsImg($id)
    {
        //本天5点后第一次之后读redis
        if(Redis::exists('d_dataImg'))
        {
            $data = Redis::get('d_dataImg');
            $data = unserialize($data);

            //此商品不存在
            if (!isset($data[$id]))
            {
                $dataImg = $this->getImg($id, $data);
            }
            else
            {
                return $data[$id];
            }
        }
        else
        {
            $dataImg = $this->getImg($id);
        }

        return $dataImg;
    }
    protected function getImg($id, $data = null)
    {
        $dataImg = GoodsImg::where('goods_id',$id)
            ->select('img_url')
            ->get()
            ->toArray();

        $data[$id] = $dataImg;
        //存入内存到明天5时
        $this->setLeftTimeRedis('d_dataImg', $data);

        return $dataImg;
    }


    /**
     * @brief 获取单个商品10条评价信息
     * @param $id
     * @return array|mixed
     */
    public function getGoodsComment($id)
    {
        //本天5点后第一次之后读redis
        if(Redis::exists('d_dataComment'))
        {
            $data = Redis::get('d_dataComment');
            $data = unserialize($data);

            //此商品不存在
            if (!isset($data[$id]))
            {
                $dataComment = $this->getComment($id, $data);
            }
            else
            {
                return $data[$id];
            }
        }
        else
        {
            $dataComment = $this->getComment($id);
        }


        return $dataComment;
    }
    protected function getComment($id, $data = null)
    {
        $dataComment = GoodsComment::where('goods_id',$id)
            ->orderBy('add_time')
            ->offset(0)
            ->limit(10)
            ->get()
            ->toArray();

        $data[$id] = $dataComment;
        //存入内存到明天5时
        $this->setLeftTimeRedis('d_dataComment', $data);

        return $dataComment;
    }


    /**
     * @brief 获取单个商品所有评价
     * @param $id
     * @return mixed
     */
    public function getGoodsComments($id)
    {
        return GoodsComment::where('goods_id',$id)->paginate(5);
    }
    //展示信息结束




    /**
     * @brief 抢购筛选
     */
    public function orderCheck()
    {
        $num = Input::get('num');
        $skuId = Input::get('sku_id');
        $goodsId = Input::get('goods_id');
        $norms = Input::get('norms');

        //如果数量大于1直接秒杀失败
        if ($num !== '1')
        {
            //sleep(5);
            return view('home.sec-error', ['id' => $goodsId]);
        }

        //商品出队列 同时入备份列
        $stockNum = Redis::rpoplpush('secKill'.$skuId, 'checkSafe'.$skuId);

        //出列失败
        if ($stockNum == null)
        {
            return view('home.sec-error', ['id' => $goodsId]);
        }

        return redirect()->action('Home\SecKillController@orderInfo', ['skuKey' => $goodsId.$norms]);
    }


    /**
     * 确认订单信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderInfo()
    {
        $skuKey = Input::get('skuKey');
        $uid = Session::get('uid');

        $dataSku = Redis::get('d_dataSku');
        $dataSku = unserialize($dataSku);
        $data['goods'] = $dataSku[$skuKey];

        $data['num'] = 1;
        $data['userAddress'] = UserAddress::where(['user_id' => $uid])->get()->toArray();
        $data['province'] = District::where('parent_id', 0)->get()->toArray();


        return view('/home/sec-order',$data);
    }


    /**
     * @brief生成订单
     * @return \Illuminate\Http\RedirectResponse
     */
    public function order()
    {
        $uid = Session::get('uid');
        $arr = Input::all();

        //开启事务
        DB::beginTransaction();

        //订单表
        $order = [
            'order_sn' => date("YmdHis",time()) . $uid . $arr['pay_type'],
            'user_id' => $uid,
            'consignee_tel' => $arr['address_tel'],
            'consignee_name' => $arr['address_name'],
            'consignee_address' => $arr['address'],
            'order_price' => $arr['order_price'],
            'pay_type' => $arr['pay_type'],
            'order_time' => time(),
            'status' => 1,
            'postscript' => $arr['postscript']
        ];
        $order_id = Order::insertGetId($order);

        //订单商品表
        $goods = [
            'sku_id' => $arr['sku_id'],
            'sku_sn' => $arr['sku_sn'],
            'goods_id' => $arr['goods_id'],
            'goods_name' => $arr['goods_name'],
            'sku_norms_value' => $arr['sku_norms_value'],
            'sku_img' => $arr['sku_img'],
            'sku_price' => $arr['sku_price'],
            'num' => $arr['num'],
            'order_id' => $order_id
        ];
        OrderGoods::insert($goods);

        //减内存库存
        $dataSku = Redis::get('d_dataSku');
        $dataSku = unserialize($dataSku);
        $key = $arr['goods_id'].$arr['sku_norms_value'];
        $dataSku[$key]['second_num']--;

        $this->setLeftTimeRedis('d_dataSku', $dataSku);
        //去备份链表库存
        Redis::rpop('checkSafe'.$arr['sku_id']);

        //事务提交
        DB::commit();
        DB::rollBack();


        $data['order_sn'] = $order['order_sn'];
        $data['type'] = null;

        return redirect()->action('Home\\OrderController@homeFinsh', $data);
    }

}
