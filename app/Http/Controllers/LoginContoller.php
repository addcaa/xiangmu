<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginContoller extends Controller
{
    /**登录 */
    public function login(){
        return view('login/login');
    }
    /**登录 */
    public function user(){
        $data=request()->all();
        // dd($data);die;
        $where=[
            'email'=>$data['email']
        ];
        unset($data['_token']);
        $arr=DB::table('user')->where($where)->first();
        // print_r($user);die;
        if($arr){
            if($data['password']==decrypt($arr->password)){
                // echo "dui";
                $user_id=$arr->id;
                $email=$arr->email;
                $info=[
                    'id'=> $user_id,
                    'email'=>$email
                ];
                // dd($user_id);
                session(['user'=>$info]);
                return redirect('/');
            }else{
                echo "密码错误";die;
            }
            // $a="12345678";
            // $pwd= encrypt ($a);
            // $pwd= decrypt ($pwd);
            // dd($pwd);

        }else{
            echo "账号不存在";die;
        }


        // dd($data);
    }
      /**注册 */
    public function register(){
        // $code=session('email.code');
        // dd($code);
        return view('login/register');
    }
    public function reg(){
        $data=request()->all();
        // dd($data);
        //638615
        $code=session('email.code');
        // dd($code);
        if($data['address']!=$code){
            return ['code'=>2,'font'=>"验证码不一致"];
        }
        // echo "11";
        $email=session('email.email');
        if($data['email']!==$email){
            return ['code'=>2,'font'=>"账号不一致"];
        }
        if($data['password']!=$data['pwd']){
            return ['code'=>2,'font'=>"密码不一致"];
        }
        // dd($code);
        $data['password']=encrypt($data['password']);

        // dd( $data['pwd']);
        unset($data['pwd']);
        unset($data['address']);
        // dd($data);
        $arr=DB::table('user')->insert($data);
        // dd($arr);
        if($arr){
            return ['code'=>1,'font'=>"注册成功"];
        }else{
            return ['code'=>2,'font'=>"注册失败"];
        }
    }
    /**邮件 */
    public function email(){
        $code=rand(111111,999999);
        $fail=Mail::send('login.email',['data'=>$code],function($message){
            $message->to(request()->input('email'))->subject('验证码啊');
        });
        $email=[
            'code'=>$code,
            'email'=>request()->input('email')
        ];
        session(['email'=>$email]);
        if($fail!==false){
            return ['code'=>1,'font'=>"发送成功"];
        }
    }
    public function tui(){
        request()->session()->flush();
        return redirect('/login/login');
    }
    /**个人首页 */
    public function users(){
        return view('login/users');
    }
    //收获地址
    public function add_address(){
        // $arr = DB::select('select * from address');
        $arr=DB::table('address')->get()->toArray();
         //dd($arr);
        if(!empty($arr)){
            foreach($arr as $k=>$v){

              //  $arr[$k]['province']=DB::table('area')->where(['id'=>$v->province])->value(['name']);
                $arr[$k]->province=DB::table('area')->where(['id'=>$v->province])->value('name');

                $arr[$k]->city=DB::table('area')->where(['id'=>$v->city])->value('name');
                $arr[$k]->area=DB::table('area')->where(['id'=>$v->area])->value('name');
            }
        }else{
            return false;
        }
        return view('login/add_address',['arr'=>$arr]);
    }
    /**新增地址 */
    public function address(){
        //三级联动
        $provinceInfo=$this->getAreaInfo(0);
        // dd($provinceInfo);

        return view('login/address',['provinceInfo'=>$provinceInfo]);
    }
    /**找到pid为0 意思找到顶级 */
    public function getAreaInfo($pid){
        $where=[
            'pid'=>$pid,
        ];
        $provinceInfo=DB::table('area')->where($where)->get();
        // dd($provinceInfo);
        return $provinceInfo;
    }
    /**查找省市 */
    public function getArea(){
        $id=request()->input('id');
        // dd($id);
        $areaInfo= $this->getAreaInfo($id);
        // dd($areaInfo);
        echo json_encode(['areaInfo'=>$areaInfo,'code'=>1]);
    }
    //**添加收货地址 */
    public function addressDo(){
        // echo 111;
        $data=request()->all();
        $data['id']=session('user.id');
        // dd($data);
        // $is_default=DB::table('address')->pluck('is_default');

        $where=[
            'id'=>session('user.id'),
        ];
        // dd($where);
        if($data['is_default']==1){
            // echo 111;die;
            $res=DB::table('address')->where($where)->update(['is_default'=>2]);
            $arr=DB::table('address')->where($where)->insert($data);
            return ['code'=>1,'msg'=>'保存成功'];
        }else{
            $res=DB::table('address')->where($where)->insert($data);
            return ['code'=>1,'msg'=>'保存成功'];
        }
    }
    //**我的订单 */
    public function order(){
        // echo 11;
        //查看全部
        $id=session('user.id');
        $where=[
            'id'=>$id
        ];
        $detail=DB::table('order_detail');
        $arr=DB::select("select * from `order_detail` inner join `ordere` on `order_detail`.`order_id` = `ordere`.`order_id` where `order_detail`.`id` = $id");
        // dd($arr)
        return view('login/order',['arr'=>$arr]);
    }
    // 待付款 代发货 已取消  已完成
    public function orders(){
        $type=request()->input('type');
        //dd($type);
        $id=session('user.id');

        // $arr=[];
        if($type==1){
            $where=[
                'id'=>$id,
                'is_dele'=>1
            ];
            $order_id=DB::table('ordere')->where($where)->pluck('order_id');
            $arr=DB::table('ordere')->join('order_detail','order_detail.order_id','=','ordere.order_id')->where(['order_id'=>2])->get();
            dd($arr);

        }else if($type==2){
            $where=[
                'id'=>$id,
                'is_dele'=>2
            ];
            $order_id=DB::table('ordere')->where($where)->pluck('order_id');
            $arr=DB::table('order_detail')->whereIn('order_id',$order_id)->get();
        }else if($type==3){
            $where=[
                'id'=>$id,
                'is_dele'=>3
            ];
            $order_id=DB::table('ordere')->where($where)->pluck('order_id');
            $arr=DB::table('order_detail')->whereIn('order_id',$order_id)->get();
            // dd($arr);
        }else{
            $where=[
                'id'=>$id,
                'is_dele'=>4
            ];
            $order_id=DB::table('ordere')->where($where)->pluck('order_id');
            $arr=DB::table('order_detail')->whereIn('order_id',$order_id)->get();
        }
        $adddiv=view('login/div',['arr'=>$arr]);
        $content=response($adddiv)->getContent();
        $res['info']=$content;
        // dd($arr);
        return $res;
    }
}

