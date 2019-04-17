<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
</head>
<body>
<form >
    <input type="text" name="goods_name"  value="{{$goods_name}}">
    <input type="submit" value="搜索">
</form>
    <table border=1>
        <tr>
            <td>ID:</td>
            <td>名称：</td>
            <td>图片：</td>
            <td>价格：</td>
            <td>操作</td>
            <td>操作</td>
        </tr>
        @foreach($arr as $v)
            <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" alt="" width=100px;></td>
                <td>{{$v->goods_price}}</td>
                <td>编辑</td>
                <td>删除</td>
            </tr>
        @endforeach
    </table>
    {{ $arr->appends(['goods_name'=>$goods_name])->links()}}
</body>
</html>
