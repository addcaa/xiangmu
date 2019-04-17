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
       <h1>购物车</h1>
      </div>
     </header>
     <div class="susstext">订单提交成功</div>
     <div class="sussimg">&nbsp;</div>
     <div class="dingdanlist">
      <table>
       <tr>
       @foreach($arr as $v)
        <td width="50%">
            订单号：<h3>{{$v->order_no}}</h3>
            <time>创建日期：2015-8-11<br />失效日期：2015-9-12</time>
            ¥<strong class="orange">{{$v->order_num}}</strong>
        </td>
       @endforeach

        <td align="right"><span class="orange">等待支付</span></td>
       </tr>
      </table>
     </div>
     <div class="succTi orange">请您尽快完成付款，否则订单将被取消</div>

    </div><!--content/-->

    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <td width="50%"><a href="/goods/prolist" class="jiesuan" style="background:#5ea626;">继续购物</a></td>
       <td width="50%"><a href="/wxpay/test/{{$v->order_no}}" id="zhifu"class="jiesuan">立即支付</a></td>
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
  </body>
</html>
<script>
    $(function(){
        $("#zhifu").click(function(){
            // echo "111";
            // alert(11);
            var order_no=$(this).parents("body").find('h3').html();
            var order_num=$(this).parents("body").find('strong').html()
            // console.log(order_num );
            $.post(
                '/wxpay/test',
                {order_no:order_no,order_num:order_num},
                function(res){
                    // console.log(res);
                    location.href="/wxpay/test"
                }
            );
        })
    })
</script>
