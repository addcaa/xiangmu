<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreLinkPost;

use Illuminate\Http\Request;

class LinkController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // $links=[
        //     'l_id'=>1,
        //     'l_name'=>'张三',
        // ];
        // session(['links'=>$links]);
        // request()->session()->flush();
        // dd(session('links'));
        // echo 111;

        $l_URL=request()->input('l_URL');
        // dd($l_name);
        $where=[];
        if($l_URL??""){
            $where[]=['l_URL','like',"%$l_URL%"];
        }
        $link= new \App\Links;
        $arr=$link->where($where)->paginate(3);
        // dd($arr);
        return view('Link/index',['arr'=>$arr],['l_URL'=>$l_URL]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        return view('Link/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_do(StoreLinkPost $request){

        $post=request()->all();
        $post['l_img']=$this->upload($request,'l_img');
        unset($post['_token']);
        // dd($post);
        // $link = new \App\Link;
        $link = new \App\Links;
        $arr=$link->insert($post);
        // dd($arr);
        if($arr){
            return redirect('Link/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        // dd($id);
        $where=[
            'l_id'=>$id,
        ];

        $link= new \App\links;
        $arr=$link->where($where)->first();
        // dd($arr);
        return view('Link/edit',['arr'=>$arr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $post=request()->input();
        unset($post['_token']);
        // dd($post);
        $where=[
            'l_id'=>$post['l_id'],
        ];
        // if($post['l_img']==""){

        // }
        $post['l_img']=$this->upload($request,'l_img');

        $link= new \App\links;
        $res=$link->where($where)->update($post);
        // dd($res);
        if($res){
            return redirect('Link/index')->with('message','修改成功');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(){
        $l_id=request()->input('l_id');
        // dd($l_id);
        $where=[
            'l_id'=>$l_id,
        ];
        $link= new \App\links;
        $res=$link->where($where)->delete();
        // dd($res);
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
    /**唯一性 */
    public function only(){
        $l_URL=request()->input('l_URL');
        // dd($l_URL);
        $where=[
            'l_URL'=>$l_URL
        ];
        $link= new \App\links;
        $data=$link->where($where)->get();
        if($data){
            echo 'no';
        }else{
            echo 'ok';
        }
    }
}
