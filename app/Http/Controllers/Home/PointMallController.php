<?php

namespace App\Http\Controllers\Home;

use  Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Session;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Home\GoodsController;


class PointMallController extends Controller

{
    /**
     *  积分商城首页
     */
    public function index()
    {
        $area=Input::get("point_area")?Input::get("point_area"):'';
        $category=Input::get("category")?Input::get("category"):'';
        $order=Input::get("order")?Input::get("order"):'';
        $where=[['is_point',1],['is_on_sale',1]];
        $between=[0,999999];
        if($area!=''){
            $between=explode("-",$area);
        }
        if($category!=''){
            $where[]=['category_name',"$category"];
        }
        $data['categoryInfo']=$this->totalCategory();
        $data['pointInfo']=$this->searchPointMall($where,$between,$order);
        $data['param']['area']=$area;
        $data['param']['category']=$category;
        $data['param']['order']=$order;
        return view("home/point-mall",['data'=>$data]);
    }
    /**
     *  积分商品详情页
     */
    public function info()
    {
        $goods_id=Input::get("goods_id");
        $goods=new GoodsController();
        //获取商品信息
        $data['goodsInfo'] = json_decode($goods->getGoodsInfo($goods_id), true);

        //获取商品规格信息
        $data['norms']= json_decode($goods->getGoodsNorms($goods_id), true);

        //获取商品的属性信息
        $data['goodsAttr'] = json_decode($goods->getGoodsAttr($goods_id), true);

        //获取商品的评论
        $data['comment'] = json_decode($goods->getGoodsComment($goods_id), true);

        //获取商品的图片
        $data['img'] = json_decode($goods->getGoodsImg($goods_id), true);

        return view('/home/goods',$data);

    }
    /**
     *  查找积分商品接口
     * @return json
     */
    public function searchPointMall($where,$between,$order)
    {
        $pointInfo=DB::table('goods')->select("goods_id as gId","goods_name as gName","goods_point as gPoint","goods_img as gImg")->where($where)->whereBetween('goods_point', $between)->orderBy('goods_point',$order)->paginate(2);
        return $pointInfo;
    }
    /**
     *  统计积分商品分类数量接口
     */
    public function totalCategory()
    {
        $categoryInfo=DB::table('goods')->select("category_name as cName",DB::raw('COUNT(category_id) as cCount'))->where([['is_point',1],['is_on_sale',1]])->groupBy("category_name")->get()->toArray();

        return $categoryInfo;
    }
}