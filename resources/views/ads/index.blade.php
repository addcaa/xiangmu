<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>公告内容</title>
    <link rel="stylesheet" href="\css\page.css">

</head>
<body>
<a href="add">返回添加页面</a>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table border="1">
        <tr>
            <td>ID:</td>
            <td>标题:</td>
            <td>公共图片:</td>
            <td>关键词：</td>
            <td>内容</td>
            <td>操作</td>
        </tr>
        @foreach($arr as $v)
        <tr>
            <td>{{$v->a_id}}</td>
            <td>{{$v->a_name}}</td>
            <td>
                <img src="http://www.uploads.com/{{$v->a_img}}" alt="暂无图片"width="100xp;">
            </td>
            <td>{{$v->a_key}}</td>
            <td>{{$v->a_text}}</td>
            <td><a href="destroy{{$v->a_id}}">删除</a><a href="edit{{$v->a_id}}">修改</a></td>
        </tr>
        @endforeach
    </table>
    {{ $arr->links() }}
</body>
</html>
