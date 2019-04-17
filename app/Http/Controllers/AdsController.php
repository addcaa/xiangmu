<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdsPost;
use Illuminate\Support\Facades\Schema;
class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // echo 11;
        $ads=new \App\Ads;
        $where=[
            'a_show'=>1,
        ];
        $arr=$ads->where($where)->paginate(3);
        // dd($arr);
        return view('Ads/index',['arr'=>$arr]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        // echo 111;die;
        return view('Ads.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_do(StoreAdsPost $request){
        $post=request()->all();
        $post['a_img']=$this->upload($request,'a_img');
        unset($post['_token']);
        // dd($post);
        $ads = new \App\Ads;
        $arr=$ads->insert($post);
        // dd($arr);
        if($arr){
            return redirect('Ads/index');
        }else{
            return back()->withInput();
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
        $ads=new \App\Ads;
        $where=[
            'a_id'=>$id,
        ];
        $res=$ads->where($where)->first();
        // dd($res);
        return view('Ads/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdsPost $request){
        // dd($id);
        $a_id=request()->input('a_id');
        $post=request()->all();
        // dd($post);
        unset($post['_token']);
        $where=[
            'a_id'=>$a_id
        ];
        $ads = new \App\Ads;
        // $ads = new \App\Ads;
        $arr=$ads->where(['a_id'=>$a_id])->update($post);
        // dd($arr);
        if($arr){
            return redirect('Ads/index')->with('message','修改成功');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // dd($id);
        // Schema::table('ads', function ($table)
        //     { $table->softDeletes();
        // });
        $ads = new \App\Ads;
        $where=[
            'a_id'=>$id
        ];
        $res=$ads->where($where)->delete();
        // dd($res);
        if($res){
            return redirect('Ads/index')->with('message','删除成功');
        }else{
            return back()->withInput();
        }
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
}
