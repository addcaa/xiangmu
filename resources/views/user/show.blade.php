<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
    <link rel="stylesheet" href="\css\page.css">
</head>
<body>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
 <h2>管理员展示</h2>
 <a href="/User/create">进入添加</a>
    <form >
        <input type="text" name="user_name">
        <input type="submit" vlaue="搜索">
    </form>
    <table border=1 >
        <tr>
            <td>ID:</td>
            <td>用户名：</td>
            <td>头像</td>
            <td>联系电话:</td>
            <td>邮箱：</td>
            <td>性别</td>
            <td>操作</td>
        </tr>
        @foreach($arr as $k=>$v)
        <tr  user_id="{{$v->user_id}}">
                <td>{{$v->user_id}}</td>
                <td>{{$v->user_name}}</td>
                <td>
                    <img src="http://www.uploads.com/{{$v->img}}" alt="赞无图片" width="80px;" >
                </td>
                <td>{{$v->user_tel}}</td>
                <td>{{$v->user_email}}</td>
                @if($v->user_sax==1)
                     <td>男生</td>
                @else
                    <td>女生</td>
                @endif
                <td user_id="{{$v->user_id}}">
                    <a class="del" href="javascript:;">删除</a>|
                    <a href="edit?user_id={{$v->user_id}}">修改</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $arr->appends(['user_name'=>$user_name])->links()}}
</body>
</html>
<script src="/js/jquery-3.1.1.min.js"></script>
<script>
    $(function(){
        $(document).on('click','.del',function(){
            // alert(11);
            var _this=$(this);
            var user_id=_this.parent('td').attr('user_id');
            // console.log(user_id);
           $.post(
               "destroy",
               {user_id:user_id},
               function(res){
                    if(res.code==1){
                        location.href="show";
                    }
               },
               'json'
           );
        })
    })
</script>
