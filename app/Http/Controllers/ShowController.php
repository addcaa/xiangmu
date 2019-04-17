<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class ShowController extends Controller{
    public function index(){
        $goods_name=request()->input('goods_name');
        $page=request()->input('page',1);
        // dd($goods_name);
        $where=[];
        if($goods_name??""){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $Showingex=$page.$goods_name;
        // dd($key);
        $arr=cache::get($Showingex);
        // var_dump($arr);
        if(!$arr){
            echo "没有缓存";
            if(empty($goods_name)){
                $arr=DB::table('goods')->paginate(3);
            }else{
                $arr=DB::table('goods')->where($where)->paginate(3);
            }
            Cache::put($Showingex,$arr,1);//键 值
        }else{
            echo "有缓存";
        }
        // var_dump($arr);die;
        return view('Show/index',['arr'=>$arr],['goods_name'=>$goods_name]);
    }
    public function login(){
        return view('Show/login');
    }
    public function submit(){
        $data=request()->all();
        // $passwor d=encrypt($data['password']);
        // dd(cache::has($key));
        unset($data['_token']);
        // dd($data);
        $where=[
            'email'=>$data['email']
        ];
        $arr=DB::table('user')->where($where)->first();
        // dd($arr->password);
        $Showsubmit=$data['email'].$data['password'];
        // // dd($key);
        $infp=cache::get($Showsubmit);
        if(!$infp){
            echo "没缓存";
            if($arr){
                if($data['password']==decrypt($arr->password)){
                    echo "登录成功";
                    cache::put($Showsubmit,$Showsubmit,10);
                }else{
                    echo "有误";
                }
                }else{
                    echo "账号有误";
            }
        }else{
            echo "登录成功有缓存";
        }

    }
    //**忘记密码 */
    public function wj(){
        return view('Show/wj');
    }
    public function do(){
        $name=request()->input('email');
        // dd($name);
        $arr=DB::table('user')->first();
        if($name==$arr->email){
            // echo     "对";
            $password=request()->input('password');
            // dd($password);
            $password=encrypt($password);
            $Showsubmit=$arr->email.$password;
            // dd($Showsubmit);
            $where=[
                'email'=>$name,
            ];
            $arr=DB::table('user')->where($where)->update(['password'=>$password]);
            // dd($arr);
            cache::put($Showsubmit,$Showsubmit,10);
           // return view('Show/do');
            if($arr){
                echo "修改成功";
            }
        }else{
            echo "没有账号";
        }
    }
}
?>
