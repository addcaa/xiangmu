<?php

namespace App\Http\Controllers;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    public function index(){
        // echo "11";

        return view('blog/index');
    }
    public function email(){
        // $email=request()->input('email');
        // dd($email);
        // $subject=subject('验证码啊');
        $code=rand(111111,999999);
        $fail=Mail::send('blog.email',['data'=>$code],function($message){
            $message->to(request()->input('email'))->subject('验证码啊');
        });
        // $email=[
        //     'code'=>$code,
        //     'email'=>request()->input('email')
        // ];
        // // session(['email'=>$email]);
        // if($fail!==false){
        //     return ['code'=>1,'font'=>"发送成功"];
        // }

        // Mail::send('blog.email',['data'=>$code], function($message) use ($email) {
        //     $message->to($email)->subject('验证码啊');
        // });
    }
}
