<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员添加</title>
</head>
<body>
    <h3>管理员添加</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <form action="store" method="post"  enctype="multipart/form-data" >
         @csrf
        <table border=1>
            <tr>
                <td>用户名：</td>
                <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" name="user_pwd"></td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td><input type="password" name="user_pawd"></td>
            </tr>
            <tr>
                <td>手机号：</td>
                <td><input type="text" name="user_tel"></td>
            </tr>
            <tr>
                <td>邮箱：</td>
                <td><input type="text" name="user_email"></td>
            </tr>
            <tr>
                <td>性别：</td>
                <td>
                    <input type="radio" name="user_sax" value="1" checked>男
                    <input type="radio" name="user_sax" value="2" >女
                </td>
            </tr>
            <tr>
                <td>图片添加</td>
                <td><input type="file" name="img"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="添加"></td>
            </tr>
        </table>
     </form>

</body>
</html>
