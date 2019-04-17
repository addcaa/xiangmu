<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加公告</title>
</head>
<!-- /*验证*/ -->
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<body>
    <form action="add_do" method="post"  enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>标题</td>
                <td><input type="text" name="a_name"></td>
            </tr>
            <tr>
                <td>关键词</td>
                <td><input type="text" name="a_key"></td>
            </tr>
            <tr>
                <td>图片：</td>
                <td><input type="file" name="a_img"></td>
            </tr>
            <tr>
                <td>是否展示</td>
                <td>
                    <input type="radio" name="a_show" value="1" checked>展示
                    <input type="radio" name="a_show" value="2">不展示
                </td>
            </tr>
            <tr>
                <td>内容</td>
                <td>
                    <textarea name="a_text" id="" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" vlaue="添加"></td>
            </tr>
        </table>
    </form>
</body>
</html>

