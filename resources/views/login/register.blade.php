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
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text"  name="email" id="email"placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="address" id="address"placeholder="输入短信验证码" />
       <input class="email" type="button"style="float: right;border: 0;padding: 0;margin: 0;margin: 3px 0;width: 28%;height: 38px;line-height: 38px;background: #f60;color: #fff;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius: 4px;" value="获取验证码"></div>
       <div class="lrList"><input type="text" name="password"  id="password"placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="pwd" id="pwd"placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button"  id="submit"value="立即注册" />
      </div>
     </form><!--reg-login/-->
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
  </body>
</html>
<script src="\layui\layui.all.js"></script>
    <script src="\layui\layui.js"></script>
<script>
    $(function(){
        layui.use(['layer'],function(){
            var layer=layui.layer;
            var form=layui.form;
            $(".email").click(function(){
                // alert(11);
                var email=$('#email').val();
                // console.log(email);
                $.post(
                    'email',
                    {email:email},
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                        // console.log(res);
                    },
                    'json'
                );
            })
            $("#submit").click(function(){
                // alert(11);
                var email=$('#email').val();
                var address=$("#address").val();
                var password=$('#password').val();
                var pwd=$('#pwd').val();
                if(email==""){
                    layer.msg("用户名不能为空",{icon:2});
                    return false;
                }
                if(address==""){
                    layer.msg("验证码不能为空",{icon:2});
                    return false;
                }
                if(password==""){
                    layer.msg("密码不能为空",{icon:2});
                    return false;
                }
                if(pwd==""){
                    layer.msg("确认密码不能为空",{icon:2});
                    return false;
                }
                $.post(
                    'reg',
                    {email:email,address:address,pwd:pwd,password:password},
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                        if(res.code==1){
                             location.href="login"
                        }
                    },
                    'json'
                );
            })
        })
    })
</script>
