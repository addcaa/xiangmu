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
       <form class="prosearch"><input type="text" id="sest"/></form>
      </div>
     </header>
     <ul class="pro-select pay">
      <li class="pro-selCur" type='1'><a href="javascript:;">新品</a></li>
      <li type='2'><a href="javascript:;" >销量</a></li>
      <li type='3'><a href="javascript:;" >价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist" id="show">
        @foreach($goodsinfo as $v)
            <dl brand_id="{{$v->brand_id}}" goods_sales="{{$v->goods_sales}}">
                <dt><a href="proinfo{{$v->goods_id}}"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" width="100" height="100" /></a></dt>
                <dd>
                    <h3><a href="proinfo{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
                    <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥{{$v->market_price}}</span></div>
                    <div class="prolist-yishou"><span>5.0折</span> <em>已售：{{$v->goods_sales}}</em></div>
                </dd>
                <div class="clearfix"></div>
            </dl>
        @endforeach
     </div><!--prolist/-->
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
    <!--焦点轮换-->
    <script src="/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
    </script>
    <script src="\js\jquery-3.1.1.min.js"></script>
    <script src="\layui\layui.all.js"></script>
    <script src="\layui\layui.js"></script>
  </body>
</html>
<script>
$(function(){
    $('.pay').find("li").click(function(){
        var _this=$(this);
        _this.addClass('pro-selCur');
        _this.siblings("li").removeClass("pro-selCur");
        var type=$('.pro-selCur').attr('type');
        // console.log(type);
        var brand_id=_this.parents("div").find('dl').attr('brand_id');

        // console.log(goods_sales);
        $.post(
            'typeid',
            {type:type,brand_id:brand_id},
            function(res){
                var info=res.info;
                $("#show").empty();
                $("#show").append(info);
            }
        );
    })
    $("#sest").blur(function(){
        // alert(111);
        var _this=$(this);
        var brand_id=_this.parents('body').find('dl').attr('brand_id');
        console.log(brand_id);
    })
})
</script>
