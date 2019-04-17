<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Log;
class GoodsController extends Controller{

    /**商品展示 */
    public function index(){
        $email=session('user.email');
        // session('');
        $goods_name=request()->input('goods_name');
        // dd($goods_name);
        //商品表
        if(empty($goods_name)){
            $goodsinfo=DB::table('goods')->get();
        }else{
            $goodsinfo=DB::table('goods')->where('goods_name','like',"%$goods_name%")->get();
            // dd($goodsinfo);
        }
        $count=DB::table('goods')->count();
        //分类品牌
        $brandinfo=DB::table('brand')->get();
        // dd($goodsinfo);
        return view('goods/index',['goodsinfo'=>$goodsinfo,'brandinfo'=>$brandinfo,'count'=>$count,'goods_name'=>$goods_name,'email'=>$email]);
    }

    /**商品详情*/
    public function proinfo($id){
        // dd($id);
        $whereinfo=[
            'goods_id'=>$id,
            'id'=>session('user.id')
        ];
        $res=DB::table('browse')->insert($whereinfo);
        // dd($res);
        $where=[
            'goods_id'=>$id,
        ];
        $goodsinfo=DB::table('goods')->where($where)->first();
        // dd($goodsinfo);
        $slider_img=DB::table('goods')->where($where)->value('slider_img');
        $slider_img=Explode('|',ltrim($slider_img,'|'));
        // dd($slider_img);
        // var_dump($slider_img);
        return view("goods/proinfo",['goodsinfo'=>$goodsinfo,'slider_img'=>$slider_img]);
    }

    /** 商品分类*/
    public function prolist(){
        $brand_id=request()->input('brand_id');
        // dd($brand_id);
        $type=request()->input('type');
        $where=[
            'brand_id'=>$brand_id,
            'is_show'=>1
        ];
        $goodswhere=[
            'is_show'=>1
        ];
        // dd($type);
        if(empty($brand_id)){
            $goodsinfo=DB::table('goods')->where($goodswhere)->get();
        }else{
            $goodsinfo=DB::table('goods')->where($where)->get();
        }


        // dd($goodsinfo);
        return view('goods/prolist',['goodsinfo'=>$goodsinfo]);
    }

    /**商品分类 */
    public function typeid(){
        $brand_id=request()->input('brand_id');
        $where=[
            'brand_id'=>$brand_id
        ];        // echo $brand_id;die;
        $type=request()->input('type');
        // echo $type;die;
        if(empty($brand_id)){
            $goodsinfo=DB::table('goods')->get();
        }
        if($type==1){
            // echo 1;die;
            $goodsinfo=DB::table('goods')->where($where,['goods_static'=>1])->get();
        }else if($type==2){
            //根据销售量排序
            //
            $goodsinfo=DB::table('goods')->where($where)->orderBy('goods_sales','desc')->get();
            // dd($goodsinfo);
        }else{
            //根据价格排序
            $goodsinfo=DB::table('goods')->where($where)->orderBy('goods_price','desc')->get();
            // dd($goodsinfo);
        }
        $adddiv=view('goods/div',['goodsInfo'=>$goodsinfo]);
        $content=response($adddiv)->getContent();
        $arr['info']=$content;
        // dd($arr);
        return $arr;

    }

    /**商品详情 加入购物车*/
    public function add(){
        // echo 111;
        if(session('user')==""){
            // return redirect('/Login/login');
            return ['code'=>2,'msg'=>'请先登录'];

        }else{
            $data=request()->all();
            // var_dump($data);die;
            $data['id']=session('user.id');
            // dd($data);
            $info=DB::table('car')->where(['goods_id'=>$data['goods_id'],'is_del'=>1])->first();
            if(empty($info)){
                $arr=DB::table('car')->insert($data);
                return ['code'=>1,'msg'=>'添加成功'];
            }
            // dd($info);
            $infowhere=[
                'goods_id'=>$info->goods_id,

            ];
            // dd($infowhere);
            if(!empty($info)){

                $buy_number=DB::table('car')->where($infowhere)->value('buy_number');
                $num=[
                    'buy_number'=>$buy_number+$data['buy_number'],

                ];
                $arr=DB::table('car')->where($infowhere)->update($num);
                return ['code'=>1,'msg'=>'添加成功'];
            }
        }
    }

    /**
     */
    public function car(){
        $where=[
            'id'=>session('user.id'),
            'is_del'=>1
        ];
        //查询条数
        $count = DB::table('car')->where($where)->join('goods', 'car.goods_id', '=', 'goods.goods_id')->count();
        // dd($count);

        $carInfo = DB::table('car')->where($where)->join('goods', 'car.goods_id', '=', 'goods.goods_id')->get();
        // dd($carInfo);
        return view('goods/car',['carInfo'=>$carInfo,'count'=>$count]);
    }
    //**购物车改变数量 */
    public function ace(){
        $goods_id=request()->input('goods_id');
        $buy_number=request()->input('buy_number');
        $user_id=session('user.id');
        // dd($buy_number);
        $unm=DB::table('car')->where(['goods_id'=>$goods_id,'id'=>$user_id])->value('buy_number');
        // dd($unm);

        $buywhere=[
            'buy_number'=>$buy_number,
        ];
        $info=DB::table('car')->where(['goods_id'=>$goods_id,'id'=>$user_id])->update($buywhere);
        // dd($info);
    }
    /**购物车获取总价 */
    public function gercarPrice(){
        $goods_id=request()->input('goods_id');
        $user_id=session('user.id');
        // dd($goods_id);

        // DB::connection()->enableQueryLog();  // 开启QueryLog
        $Info= DB::select('select sum(car.buy_number * goods.goods_price) as price from car join goods on car.goods_id=goods.goods_id where car.id='.$user_id.' and car.goods_id in( '.$goods_id.')');
        // dump(DB::getQueryLog());
        // $Info=implode(',',$Info);
        session(['info'=>$Info]);
        return $Info;
        // dd($Info);

    }
    //**收藏添加 */
    public function callect(){
        $goods_id=request()->input('goods_id');
        // dd($goods_id);
        $id=session('user.id');
        $info=[
            'goods_id'=>$goods_id,
            'id'=>$id
        ];
        // dd($info);
        $arr=DB::table('callect')->where($info)->first();
        // dd($arr);
        if(!empty($arr)){
            return  ['code'=>2,'font'=>'已有收藏'];
        }
        $res=DB::table('callect')->insert($info);
        return  ['code'=>1,'font'=>'收藏成功'];
    }
       /**收藏展示 */
    public function shoucang(){
        // $arr=array();
        $count=DB::table('callect')->count();
        // dd($count);
        $arr=DB::table('callect')->pluck('goods_id')->toArray();
        // $res=array_unique($arr);
        $info=DB::table('goods')->whereIn('goods_id',$arr)->get();
        return view('goods/shoucang',['info'=>$info,'count'=>$count]);
    }
    /**删除收藏 */
    public function shoucangdel(){
        $goods_id=request()->input('goods_id');
        // dd($goods_id);
        $where=[
            'goods_id'=>$goods_id,
            'id'=>session('user.id')
        ];
        // dd($where);
        $res=DB::table('callect')->where($where)->delete();
        // dd($res);
        if($res==1){
            return  ['code'=>1,'font'=>"取消成功"];
        }else{
            return  ['code'=>1,'font'=>"取消失败"];
        }
    }
    //**浏览记录 */
    public function browse(){
        // dd($count);
        $arr=DB::table('browse')->pluck('goods_id')->toArray();
        $count=DB::table('browse')->whereIn('goods_id',$arr)->count();
        // dd($info);

        // $res=array_unique($arr);
        $info=DB::table('goods')->whereIn('goods_id',$arr)->get();
        // dd($info);
        return view('goods/browse',['info'=>$info,'count'=>$count]);
    }
    //**删除浏览 */
    public function liul(){
        $goods_id=request()->input('goods_id');
        // dd($goods_id);
        $where=[
            'goods_id'=>$goods_id,
            'id'=>session('user.id')
        ];
        // dd($where);
        $res=DB::table('browse')->where($where)->delete();
        // dd($res);
        if($res==1){
            return  ['code'=>1,'font'=>"取消成功"];
        }else{
            return  ['code'=>1,'font'=>"取消失败"];
        }
    }
    /**去结算 */
    public function pay(){
        $goods_id=request()->input('goods_id');
        session(['goods_id'=>$goods_id]);
        if(empty($goods_id)){
            return  ['code'=>2,'font'=>"请选择一个商品"];
        }else{
            return  ['code'=>1,'font'=>"提交成功"];
        }
        return view('goods/pay');
    }
    public function pays(){
        $goods_id=session('goods_id');
        $user_id=session('user.id');
        $goodsinfo=DB::select('select * from car join goods on car.goods_id=goods.goods_id where car.id='.$user_id.' and car.goods_id in( '.$goods_id.') and is_del=1');
        $address=DB::table('address')->where(['is_default'=>1])->get();
        if(!empty($address)){
            foreach($address as $k=>$v){
                $address[$k]->province=DB::table('area')->where(['id'=>$v->province])->value('name');
                $address[$k]->city=DB::table('area')->where(['id'=>$v->city])->value('name');
                $address[$k]->area=DB::table('area')->where(['id'=>$v->area])->value('name');
            }
        }else{
            return false;
        }
        return view('goods/pays',['goodsinfo'=>$goodsinfo,'address'=>$address]);
    }
    /**订单表 */
    public function jiesuan(){
        // echo 111;
        $goods_id=request()->input('goods_id');
        $address_id=request()->input('address_id');
        $unt=request()->input('unt');
        // dd($unt);
        $id=session('user.id');
        // 订单号
        $rand=$this->rand();
        $data=[
            'order_no'=>$rand,
            'order_num'=>$unt,
            'id'=>$id
        ];
        // dd($data);
        $arr=DB::table('ordere')->insert($data);
        // dd($arr);
        if($arr!=true){
            return ['code'=>2,'font'=>"提交失败1"];
        }
        // //获取order当前id
        $ordere_id = DB::getPdo('ordere')->lastInsertId();
        // dd($ordere_id);
        // 商品添加
        if($ordere_id==0){
            return ['code'=>2,'font'=>"提交失败2"];
        }
        $goodsinfo=DB::select('select * from car join goods on car.goods_id=goods.goods_id where car.id='.$id.' and car.goods_id in( '.$goods_id.')');
        foreach($goodsinfo as $k=>$v){
            $info=[
                    'goods_id'=>$v->goods_id,
                    'id'=>$v->id,
                    'buy_num'=>$v->buy_number,
                    'goods_price'=>$v->goods_price,
                    'goods_img'=>$v->goods_img,
                    'goods_name'=>$v->goods_name,
                    'goods_name'=>$v->goods_name,
            ];
            $info['order_id']=$ordere_id;
            $info['id']=$id;

            $order_detail=DB::table('order_detail');
            $detailarr=$order_detail->insert($info);
            if($detailarr!=true){
                return ['code'=>2,'font'=>"提交失败3"];
            }
        }
        //地址添加
        $address=DB::table('address')->where(['address_id'=>$address_id])->get();
        foreach($address as $k=>$v){
            $addinfo=[
                'address_name'=>$v->address_name,
                'address_tel'=>$v->address_tel,
                'address_detail'=>$v->address_detail,
                'address_mail'=>$v->address_mail,
                'province'=>$v->province,
                'city'=>$v->city,
                'area'=>$v->area,

            ];
            $addinfo['id']=$id;
            $addinfo['order_id']=$ordere_id;
            // var_dump($addinfo);
            $order=DB::table('order_address');
            $addarr=$order->insert($addinfo);
            if($addarr!=true){
                return ['code'=>2,'font'=>"提交失败4"];
            }
        }
        // dd($detailInfo);
        foreach($goodsinfo as $k=>$v){
            $where=[
                'goods_id'=>$v->goods_id
            ];
            $detaires=DB::table('goods')->where($where)->update(['goods_num'=>$v->goods_num-$v->buy_number]);
        }
        foreach($goodsinfo as $k=>$v){
            $where=[
                'goods_id'=>$v->goods_id,
                'id'=>session('user.id')
            ];
            $car=DB::table('car')->where(['goods_id'=>$goods_id])->update(['is_del'=>2]);
        }
        if($arr=='true'&&$detailarr=='true'&&$addarr=='true'){
            session(['ordere_id'=>$ordere_id]);
            return ['code'=>1,'font'=>"提交成功"];
        }else{
            return ['code'=>2,'font'=>"提交失败6"];
        }

    }
    //订单号
    public function rand(){
        return rand(11111,99999);
    }
    //**订单提交成功 */
    public function success(){
        $order_id=session('ordere_id');
        $arr=DB::table('ordere')->where(['order_id'=>$order_id])->get();
        // dd($arr);
        // echo 111;
        return view('goods/success',['arr'=>$arr]);
    }
    public function orrder($id){
        // dd($id);
        $where=[
            'order_no'=>$id
        ];
        $order=DB::table('ordere')->select(['order_num','order_no'])->where($where)->first();
        //echo app_path('libs/alipay/wappay/service/AlipayTradeService.php');die;
        require app_path('libaxtel/alipay/wappay/service/AlipayTradeService.php');
        require  app_path('libaxtel/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
       // if (!empty($id)&& trim($id)!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $id;
            //订单名称，必填
            $subject ='哈哈';
            //付款金额，必填
            $total_amount = $order->order_num;
            //商品描述，可空
            $body ='哈哈';
            //超时时间
            $timeout_express="1m";
            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTimeExpress($timeout_express);
            $aop = new \AlipayTradeService(config('alipay'));
            $response = $aop->wapPay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));
        //}
    }
    public function alipay(){
        echo "订单成功";
    }
     /** 异步支付 */
     public function tell(Request $request){
		$arr=$_REQUEST;
        $str=var_export($arr,true);//初始化
        file_put_contents("/tmp/alipay.log",$str,FILE_APPEND); //生成日志

    }
}
