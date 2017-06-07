<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Session;
use Illuminate\Support\Facades\Input;
use App\Models\music;


class MusicController extends Controller

{
    protected $musicModel;
    /**
     *  构造方法
     */
    public function __construct()
    {
        $this->musicModel=new Music();
    }

    /**
     *  早教音乐首页
     */
    public function index()
    {
        $params=[0=>'title',1=>'id'];
        $musicInfo=$this->musicModel->findMusic($params);
        return view("home/music",['musicInfo'=>$musicInfo]);
    }
    /**
     *  早教音乐单个页面
     */
    public function detail()
    {
        $where['id']=Input::get("id");
        $musicInfo=$this->musicModel->findMusic("*",$where);
        return view("home/music-detail",['musicInfo'=>$musicInfo[0]]);
    }
}