<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>崔芳芳</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />

    <!-- Bootstrap -->
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="dingdanlist" >
      <table>
       <tr>
       @foreach($address as $k=>$v)
        @if($v->is_default==1)
            <td  address_id="{{$v->address_id}}" class="dingimg" width="75%" colspan="2">
            <h3> 收货地址</h3>
                <p>姓名：{{$v->address_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话：{{$v->address_tel}}</p>
                <p>&nbsp;</p>
                <p>{{$v->province}}.{{$v->city}}.{{$v->area}}</p>
            </td>
        @endif
       @endforeach

        <td align="right"><img src="/index/images/jian-new.png" /></td>
       </tr>

       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right"><span class="hui">支付包</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">优惠券</td>
        <td align="right"><span class="hui">无</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
        <td align="right"><span class="hui">个人</span></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
        @foreach($goodsinfo as $v)

            <tr goods_id="{{$v->goods_id}}" class="a">
                <td class="dingimg" width="15%"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" /></td>
                <td width="50%">
                <h3>{{$v->goods_name}}</h3>
                <time>下单时间：2015-08-11  13:51</time>
                </td>
                <td align="right"><span class="qingdan">X{{$v->buy_number}}</span></td>
            </tr>
            <tr>
                <th colspan="3">¥<strong class="orange ja">{{$v->goods_price*$v->buy_number}}</strong></th>
            </tr>
        @endforeach
       <tr>
        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange">¥20.80</strong></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->


    </div><!--content/-->

    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：¥<strong class="orange unt">0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
    <script src="\layui\layui.all.js"></script>
    <script src="\layui\layui.js"></script>
  </body>
</html>
<script>
$(function(){
    layui.use('layer',function(){
        var unt=$('.unt').text();
        // console.log(unt);
        var ja=$('.ja');
        var num=0;
        ja.each(function(index){
            num+=parseInt($(this).text());
        })
        var unt=$('.unt').text(num);
        $('.jiesuan').click(function(){
            // alert(11);
            var _this=$(this);
            //获取订单地址id
            var address_id=_this.parents('body').find("td[class='dingimg']").attr('address_id');
            //获取商品id
            var a=$('.a');
            var goods_id="";
            a.each(function(index){
                goods_id+=$(this).attr('goods_id')+',';
            })
            var goods_id=goods_id.substr(0,goods_id.length-1);
            var unt=$('.unt').text();
            // console.log(unt);

            $.post(
                'jiesuan',
                {address_id:address_id,goods_id:goods_id,unt:unt},
                function(res){
                    layer.msg(res.font,{icon:res.code});
                    // console.log(res);
                    if(res.code==1){
                        location.href="success"
                    }
                }
            );
        })
    })
})

</script>
