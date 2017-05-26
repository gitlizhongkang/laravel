<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

class OrderController extends Controller
{

    static function send($file,$email,$username,$key,$subject)
    {

        $info=[];
        $flag = Mail::send("$file",['name'=>$username,'key'=>$key],function($message) use($email,$subject){

            $message ->to($email)->subject($subject);
        });
        if($flag==null){
            $info['code']=1;
        }else{
            $info['code']=2;
        }
        return $info;
    }
}