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
     <div class="head-top">
      <img src="http://www.uploads.com/uploads/20190314/edfZsEZ7DvcrlSUyw9J5VwLnVCPkbZXPxzBGxVP6.png"/>
      <dl>
       <dt><a href="user.html"><img src="http://www.uploads.com/uploads/20190313/N52UycHaJc8fXPnlpG6x0GbCl0jHaNCOU98FXGks.png" /></a></dt>
       <dd>
        <h1 class="username">
            @if(session('user')=="")
            @else
                欢迎<samp style="color:#ffff00; ">{{$email}}</samp>登陆💗<a href="/login/tui">退出</a>
            @endif
        </h1>
        <ul>
         <li><a href="prolist"><strong>{{$count}}</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form class="search">
      <input type="text" name="goods_name" class="seaText fl" value="{{$goods_name}}" />
      <input type="submit" id="sub" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     @if(session('user')=="")
        <ul class="reg-login-click">
        <li><a href="/login/login">登录</a></li>
        <li><a href="/login/register" class="rlbg">注册</a></li>
        <div class="clearfix"></div>
        </ul><!--reg-login-click/-->
     @endif

     <div id="sliderA" class="slider">
      <img src="http://www.uploads.com/uploads/20190313/N52UycHaJc8fXPnlpG6x0GbCl0jHaNCOU98FXGks.png" />
      <img src="http://www.uploads.com/uploads/20190313/akitAnnE0VFiAblHE7xAsmtCRZ06PpBKTTVmJPsf.png" />
      <img src="http://www.uploads.com/uploads/20190314/1TSzF3atgst8Mwg0RNnGWxMqENaAdeK3FL223oXv.png" />
      <img src="http://www.uploads.com/uploads/20190313/0gD5lcq42kT9A8Kgu3hmBiHn0zIBgp6B9jQWEYux.png" />
      <img src="http://www.uploads.com/uploads/20190314/edfZsEZ7DvcrlSUyw9J5VwLnVCPkbZXPxzBGxVP6.png" />
    </div>
    {{--分类--}}
    <div style="height: 200px;overflow-y:auto;">
        <ul class="pronav" >
            @foreach($brandinfo as $v)
            <li><a href="prolist?brand_id={{$v->brand_id}}">{{$v->brand_name}}</a></li>
            @endforeach
        <div class="clearfix"></div>
        </ul>
    </div>

     <div class="index-pro1">
        @foreach($goodsinfo as $v)
         <div class="index-pro1-list">
            <dl>
                <dt><a href="/goods/proinfo{{$v->goods_id}}"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" /></a></dt>
                <dd class="ip-text"><a href="/goods/proinfo{{$v->goods_id}}">{{$v->goods_name}}</a><span>已售：{{$v->goods_sales}}</span></dd>
                <dd class="ip-price"><strong>¥{{$v->goods_price}}</strong> <span>¥{{$v->market_price}}</span></dd>
            </dl>
        </div>
        @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     {{--
     <div class="prolist">
      <dl>
       <dt><a href="proinfo.html"><img src="/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      <dl>
       <dt><a href="proinfo.html"><img src="/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      <dl>
       <dt><a href="proinfo.html"><img src="/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--prolist/-->
     --}}
     <div class="joins"><a href="fenxiao"><img src="http://www.uploads.com/uploads/20190314/F2Uvi4OQGTzXZIndflHlTQLcLPO6Xba48FkljdGF.jpeg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">已经到底了~</span></div>

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
    <script src="\index\js\jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="\index\js\jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>
<script>
    $(function(){
        $("#sub").click(function(){
            alret(11);
        })
    })
</script>
