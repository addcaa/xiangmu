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
    <link href="/index/css/response.css" rel="stylesheet">
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
       <h1>我的订单</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="http://www.uploads.com/uploads/20190313/N52UycHaJc8fXPnlpG6x0GbCl0jHaNCOU98FXGks.png" />
     </div><!--head-top/-->

     <div class="zhaieq oredereq">
      <a href="javascript:;" type="1"class="zhaiCur">待付款</a>
      <a href="javascript:;" type="3">待发货</a>
      <a href="javascript:;" type="2">已取消</a>
      <a href="javascript:;" type="4" style="background:none;">已完成</a>
      <div class="clearfix"></div>
     </div><!--oredereq/-->
    @foreach($arr as $v)
        <div order_id="{{$v->order_id}}" id="show" class="dingdanlist" onClick="window.location.href='proinfo.html'">
            <table>
            <tr>
                <td colspan="2" width="65%">订单号：<strong>{{$v->order_no}}</strong></td>
                <td width="35%" align="right"><div class="qingqu"><a href="javascript:;" class="orange">订单取消</a></div></td>
            </tr>
            <tr>
                <td class="dingimg" width="15%"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" /></td>
                <td width="50%">
                <h3>{{$v->goods_name}}</h3>
                <time>下单时间：2015-08-11  13:51</time>
                </td>
                <td align="right"><img src="/index/images/jian-new.png" /></td>
            </tr>
            <tr>
                <th colspan="3"><strong class="orange">¥{{$v->order_num}}</strong></th>
            </tr>
            </table>
        </div><!--dingdanlist/-->
    @endforeach



     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="/goods/prolist">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="/goods/car">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="/login/users">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
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
  </body>
</html>
<script src="\layui\layui.all.js"></script>
    <script src="\layui\layui.js"></script>
<script>
    $(function(){
        layui.use('layer',function(){
            var layer=layui.layer;
        var form=layui.form;
        $(".zhaieq").find('a').click(function(){
            // alert(11);
            // var _this=$(this);
            var type=$('.zhaiCur').attr('type');
            // var order_id=$(this).parents('body').find("div[class='dingdanlist']").attr('order_id');
            // console.log(order_id);
            $.post(
                'orders',
                {type:type},
                function(res){
                    layer.msg(res.font,{icon:res.code});
                    // console.log(res)
                    // var info=res.res;
                    // $("#show").empty();
                    // $("#show").append(info);
                },
                'json'
            );

        })
    })

    })
</script>
