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
    /**
     *  早教音乐首页
     */
    public function index()
    {
        $params=[0=>'title',1=>'id'];
        $musicInfo=Music::findMusic($params);
        var_dump($musicInfo);die;
        return view("home/music",['musicInfo'=>$musicInfo]);
    }
    /**
     *  早教音乐单个页面
     */
    public function detail()
    {
        $where['id']=Input::get("id");
        $musicInfo=Music::findMusic("*",$where);
       return view();
    }
}