<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>友情链接</title>
</head>
<body>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<a href="add">添加友情链接</a>
    <form >
        <input type="text" name="l_URL" value="{{$l_URL}}">
        <input type="submit" vlaue="搜索">
    </form>
    <table border=1>
        <tr>
            <td>id：</td>
            <td>网址名称：</td>
            <td>图片：</td>
            <td>网址类型：</td>
            <td>状态：</td>
            <td>管理操作：</td>
        </tr>
        @foreach($arr as $v)
        <tr>
            <td>{{$v->l_id}}</td>
            <td>{{$v->l_URL}}</td>
            <td>
                <img src="http://www.uploads.com/{{$v->l_img}}"  alt="赞无图片" width="80px;" >
            </td>
            @if($v->l_type==1)
                <td>LOGO链接 </td>
            @else
                <td> 文字链接</td>
            @endif
            @if($v->l_show==1)
                <td>显示</td>
            @else
                <td>不显示</td>
            @endif
            <td  l_id="{{$v->l_id}}">
                <a class="del" href="javascript:;">删除</a>|
                <a href="edit{{$v->l_id}}">修改</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $arr->appends(['l_URL'=>$l_URL])->links()}}

</body>
</html>
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/layui/layui.js"></script>

<link rel="stylesheet" href="\css\page.css">
<script>
    $(function(){
        $(".del").click(function(){
            // alert(11);
            var _this=$(this);
            var l_id=_this.parent('td').attr('l_id');
            // console.log(l_id);
            $.post(
                "destroy",
                {l_id:l_id},
                function(res){
                    if(res.code==1){
                        location.href="index";
                    }
                },
                'json'
            );
            // console.log(user_id);


        })
    })
</script>

