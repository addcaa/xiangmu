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
     <div class="head-top">
     <img src="http://www.uploads.com/uploads/20190314/edfZsEZ7DvcrlSUyw9J5VwLnVCPkbZXPxzBGxVP6.png"" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>

        <div class="dingdanlist">
            <table>
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 全选</a></td>
            </tr>
            @foreach($carInfo as $v)
                <tr name="goods_id" goods_id="{{$v->goods_id}}" >
                    <td width="4%"><input type="checkbox" goods_id="{{$v->goods_id}}" class="box" name="1" /></td>
                    <td class="dingimg" width="15%"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" /></td>
                    <td width="50%">
                    <h3>{{$v->goods_name}}</h3>
                    <time id="goods_price">{{$v->goods_price*$v->buy_number}}</time>
                    <time>下单时间：2015-08-11  13:51</time>
                    </td>
                    <td align="right" goods_id="{{$v->goods_id}}">
                        <input type="submit" class="jia" id="jia" value="+">
                        <input type="text"  class="unm" value="{{$v->buy_number}}"  style=" height:30px; width='4%'" />
                        <input type="submit" class="jian"  id="jian" value="-">
                    </td>
                </tr>
                <tr >
                    <th colspan="3"><strong class="orange">¥{{$v->goods_price}}</strong></th>
                </tr>
            @endforeach
            <tr>

            </tr>
        </table>
        </div><!--dingdanlist/-->

     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%" >总计：<strong class="orange" id="count">0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
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
<script src="\layui\layui.all.js"></script>
<script src="\layui\layui.js"></script>
<script>
    $(function(){
        layui.use(['layer'],function(){
        var layer=layui.layer;
        var form=layui.form;
          //复选框 选择
            $(document).on('click',".box",function(){
                var box=$(".box")
                var goods_id="";
                box.each(function(index){
                    if($(this).prop('checked')==true){
                        goods_id+=$(this).attr('goods_id')+',';
                    }
                });
                var goods_id=goods_id.substr(0,goods_id.length-1);
                // console.log(goods_id);
                $.post(
                    "gercarPrice",
                    {goods_id:goods_id},
                    function(res){
                        var info=res[0].price;
                        $("#count").text('￥'+info);
                    }
                    ,'json'
                )
            })
            //加号
            $(document).on('click','#jia',function(){
                // alert(11);
                //改为Js页面的购买数量
                var _this=$(this);
                //获取文本值
                var buy_number=parseInt(_this.next('input').val());
                //获取总库存
                var goods_unm=_this.parent('td').find('span').html();
                //获取商品id
                // console.log(goods_id);
                if(buy_number>=goods_unm){
                    _this.prop('disabled',true);
                }else{
                    buy_number+=1;
                    _this.next('input').val(buy_number);
                    _this.siblings("input[class='jian']").prop('disabled',false);
                    var goods_id=_this.parent('td').attr('goods_id');
                    $.post(
                        'ace',
                        {goods_id:goods_id,buy_number:buy_number},
                        function(res){
                            history.go(0);
                        }
                    );
                }
            })
            //减号
            $(document).on('click','#jian',function(){
                //改为Js页面的购买数量
                var _this=$(this);
                //获取文本值
                var buy_number=parseInt(_this.prev('input').val());
                console.log(buy_number);
                //获取总库存
                var goods_unm=_this.parent('td').find('span').html();
                var goods_id=_this.parent('td').attr('goods_id');
                if(buy_number<=1){
                    _this.prop('disabled',true);
                }else{
                    buy_number-=1;
                    _this.prev('input').val(buy_number);
                    _this.siblings("input[class='jia']").prop('disabled',false);
                    $.post(
                        'ace',
                        {goods_id:goods_id,buy_number:buy_number},
                        function(res){
                            history.go(0);
                        }
                    )
                }
            })
            /**去结算 */
            $(document).on('click','.jiesuan',function(){
                // alert(1);
                // var _this=$(this);
                var box=$(".box")
                // console.log(box);
                var goods_id="";
                box.each(function(index){
                    if($(this).prop('checked')==true){
                        goods_id+=$(this).attr('goods_id')+',';
                    }
                });
                var goods_id=goods_id.substr(0,goods_id.length-1);
                // console.log(goods_id);
                $.post(
                    'pay',
                    {goods_id:goods_id},
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                        if(res.code==2){
                            history.go(0);
                        }
                        if(res.code==1){
                            location.href="/goods/pays"
                        }
                        // console.log(res);
                    },
                    'json'
                );
            })
        })
    })
</script>
