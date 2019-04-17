<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改公告</title>
</head>
<body>
    <form action="update" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="a_id" value="{{$res->a_id}}">
        @csrf
        <table>
            <tr>
                <td>标题</td>
                <td><input type="text" name="a_name" value="{{$res->a_name}}"></td>
            </tr>
            <tr>
                <td>关键词</td>
                <td><input type="text" name="a_key" value="{{$res->a_key}}"></td>
            </tr>
            <tr>
                <td>图片：</td>
                <td><input type="file" name="a_img">
                 <img src="http://www.uploads.com/{{$res->a_img}}" alt="暂无图片"width="100xp;">
                </td>
            </tr>
            <tr>
                <td>是否展示</td>
                <td>
                    @if($res->a_show==1)
                        <input type="radio" name="a_show" value="1" checked>展示
                        <input type="radio" name="a_show" value="2">不展示
                    @else
                        <input type="radio" name="a_show" value="1">展示
                        <input type="radio" name="a_show" value="2" checked>不展示
                    @endif
                </td>
            </tr>
            <tr>
                <td>内容</td>
                <td>
                    <textarea name="a_text" id="" cols="30" rows="10">   {{$res->a_text}}
                    </textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" vlaue="修改"></td>
            </tr>
        </table>
    </form>
</body>
</html>
