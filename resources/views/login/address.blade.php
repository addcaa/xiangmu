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
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="http://www.uploads.com/uploads/20190319/jXpsBjPZbVITXrQ1ZwoZPeJhL7adIGFV5Ix0SgyS.jpeg" />
     </div><!--head-top/-->
      <div class="lrBox">
       <div class="lrList"><input type="text" name="address_name" id="address_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" name="address_detail" id="address_detail" placeholder="详细地址" /></div>

        <select  name="province" id="province"selected="selected"class="area">
         <option>省份/直辖市</option>
         @foreach($provinceInfo as $v)
            <option value="{{$v->id}}" >{{$v->name}}</option>
         @endforeach
        </select>
        <select name="city"  id="city"selected class="area a">
            <option value='0'>区县</option>
        </select>
        <select name="area" id="area" selected class="area a"    >
         <option value='0'>详细地址</option>
        </select>
       <div class="lrList"><input type="text"  name="address_tel" id="address_tel"placeholder="手机" /></div>
       <div class="lrList2"><input type="checkbox" name="is_default" id="is_default" placeholder="设为默认地址" /> <button>设为默认</button></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="sub" value="保存" />
      </div>

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
        //change内容改变
        $(document).on('change','.area',function(){
            // alert(11)
            var _this=$(this);
            var  id=_this.val();
            var _option="<option value='0'>请选择</option>";
                _this.nextAll('select').html(_option);
            $.post(
                'getArea',
                {id:id},
                function(res){
                    if(res.code==1){
                        for(var i in res['areaInfo']){
                            _option+="<option value='"+res['areaInfo'][i]['id']+"'>"+res['areaInfo'][i]['name']+"</option>";
                        }
                        _this.next("select").html(_option);
                        }else{
                            layer.msg(res.font,{icon:res.code})
                        }
                },
                'json'
            );
        })

        //保存地址
        $(document).on('click','#sub',function(){
            var address_name=$('#address_name').val();
            var address_detail=$('#address_detail').val();
            var province=$('#province').val();
            var city=$('#city').val();
            var area=$('#area').val();
            var address_tel=$('#address_tel').val();
            var is_default=$('#is_default').val();
            var is_default=$("#is_default").prop("checked");
            if(is_default==true){
                is_default=1;
            }else{
                is_default=2;
            }
            // console.log(is_default);
            $.post(
                'addressDo',
               {address_name:address_name,address_detail:address_detail,province:province,city:city,area:area,address_tel:address_tel,is_default:is_default},
                function(res){
                    layer.msg(res.msg,{icon:res.code});
                    // console.log(res);
                    if(res.code==1){
                        location.href="add_address"
                    }
                },
                'json'
            )
        })
    })
})
</script>
