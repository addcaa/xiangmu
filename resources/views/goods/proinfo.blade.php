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
       <h1>产品详情</h1>
      </div>
     </header>

     <div id="sliderA" class="slider">
         @foreach($slider_img as $v)
         <img src="http://www.uploads.com/uploads/{{$v}}" />
         @endforeach
     </div>

     <table class="jia-len">

      <tr>
       <th><strong class="orange">{{$goodsinfo->goods_price}}</strong></th>
       <td  goods_id="{{$goodsinfo->goods_id}}">
         库存 <span> {{$goodsinfo->goods_num}}</span>
            <input type="submit" class="jia" id="jia" value="+">
            <input type="text"  class="unm"value="1" style=" height:30px; "/>
            <input type="submit" class="jian"  id="jian" value="-">
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goodsinfo->goods_name}}</strong>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang">
            <span class="glyphicon glyphicon-star-empty"></span>
        </a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>

    {{-- <h3 class="proTitle">商品规格</h3>
        <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
        </ul><!--guige/-->
    --}}
    <div class="height2"></div>
    <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
        <img src="http://www.uploads.com/{{$goodsinfo->goods_desc}}" alt="">
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id="caradd">加入购物车</a></td>
      </tr>
     </table>
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
        layui.use(['layer'],function(){
        var layer=layui.layer;
        var form=layui.form;

            //加号
            $(document).on('click','#jia',function(){
                // alert(11);
                //改为Js页面的购买数量
                var _this=$(this);
                //获取文本值
                var buy_number=parseInt(_this.next('input').val());
                // console.log(buy_number);
                //获取总库存
                var goods_unm=_this.parent('td').find('span').html();
                //获取商品id
                var goods_id=_this.parent('td').attr('goods_id');
                if(buy_number>=goods_unm){
                    _this.prop('disabled',true);
                }else{
                    buy_number+=1;
                _this.next('input').val(buy_number);
                _this.siblings("input[class='jian']").prop('disabled',false);
                }
            })
            //减号
            $(document).on('click','#jian',function(){
                //改为Js页面的购买数量
                var _this=$(this);
                //获取文本值
                var buy_number=parseInt(_this.prev('input').val());
                // console.log(buy_number);
                //获取总库存
                var goods_unm=_this.parent('td').find('span').html();
                var goods_id=_this.parent('td').attr('goods_id');
                if(buy_number<=1){
                    _this.prop('disabled',true);
                }else{
                    buy_number-=1;
                    _this.prev('input').val(buy_number);
                    _this.siblings("input[class='jia']").prop('disabled',false);
                }
            })
            //加入购物车
            $("#caradd").click(function(){
                // alert(11);
                var _this=$(this);
                var buy_number=parseInt(_this.parents('body').find("input[class='unm']").val());
                //获取总库存
                var goods_id=_this.parents('body').find('td').attr('goods_id');
                // console.log(goods_id);
                $.post(
                    'add',

                    {buy_number:buy_number,goods_id:goods_id},
                    function(res){
                        // consloe.log(res);
                        layer.msg(res.msg,{icon:res.code});
                        if(res.code==1){
                            location.href="car"
                        }
                        if(res.code==2){
                            location.href="/login/login"
                        }
                    },
                    'json'
                );
            })
            //收藏
          $(".shoucang").click(function(){
                // alert(11);
                var _this=$(this);
                var goods_id=_this.parents('table').find('td').attr('goods_id');
                // console.log(goods_id);
                $.post(
                    'callect',
                    {goods_id:goods_id},
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                        if(res.code==1){
                            history.go(0);
                        }
                    },
                    'json'
                );
            })
            //浏览记录
            var goods_id=_this.parents('table').find('td').attr('goods_id');
        })
    })
</script>
