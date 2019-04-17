<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUsersPost;
use function GuzzleHttp\json_encode;
// use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *首页
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('user/index');
    }

    /**
     * Show the form for creating a new resource.
     *  添加
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('User/create');
    }

    /**
     * Store a newly created resource in storage.
     *  添加执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersPost $request){
        // echo "添加执行";
        $post=$request->all();
        // dd($cookies);
        $post['img']=$this->upload($request,'img');
        // dd($post);
        //过滤字段
        $post['user_pwd']=encrypt($post['user_pwd']);
        unset($post['_token']);
        unset($post['user_pawd']);
        // dd($post);
        $res=DB::table('user')->insert($post);
        if($res){
            return redirect('User/show')->with('status', '添加成功');
        }else{
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *  展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
        $user_name=request()->input('user_name');
        // dd($user_name);
        // echo "展示";
        $where=[];
        if($user_name??""){
            $where[]=['user_name','like',"%$user_name%"];
        }
        $arr=DB::table('user')->where($where)->paginate(3);
        // dd($arr);
        return view('User/show',['arr'=>$arr],['user_name'=>$user_name]);
    }

    /**
     * Show the form for editing the specified resource.
     *  修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        // echo 111
        $user_id=$_GET['user_id'];
        $where=[
            'user_id'=>$user_id
        ];
        $arr=DB::table('user')->where($where)->first();
        // dd($arr);die;
        return view('User/edit',['arr'=>$arr]);
    }

    /**
     * Update the specified resource in storage.
     *  修改执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsersPost $request){
        $user_id=$_POST['user_id'];
        // dd($user_id);die;
        $post=$request->all();
        $post['img']=$this->upload($request,'img');
        // dd($post);
        //过滤字段
        unset($post['_token']);
        // $post['user_pwd']=encrypt($post['user_pwd']);
        // dd($post);die;
        $where=[
            'user_id'=>$user_id,
        ];
        $res=DB::table('user')->where($where)->update($post);
        // dd($res);
        if($res){
            return redirect('User/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *  删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $user_id=$request->input('user_id');
        // dd($user_id);
        $res=DB::table('user')->where('user_id',$user_id)->delete();
        $arr=[
            'font'=>"删除成功",
            'code'=>1,
        ];
        echo json_encode($arr);
    }
    /**文件上传 */
    public function upload(Request $request,$img){
        if ($request->hasFile($img) && $request->file($img)->isValid()) {
            $photo = $request->file($img);
            $store_result = $photo->store('uploads/'.date('Ymd'));
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    public function setCookie(){
        // cookie('test', '哈哈哈哈', 60);
        $value = request()->cookie('key','哈哈哈');
    }

    public function getCookie(){
        echo request()->cookie('key');
    }
}
