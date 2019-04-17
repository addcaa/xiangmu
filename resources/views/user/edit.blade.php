<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员修改</title>
</head>
<body>
    <h3>管理员修改</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <form action="update" method="post"  enctype="multipart/form-data" >
         @csrf
         <input type="hidden" name="user_id" value="{{$arr->user_id}}">
        <table border=1>
            <tr>
                <td>用户名：</td>
                <td><input type="text" name="user_name" value="{{$arr->user_name}}"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" name=""></td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td><input type="password" name=""></td>
            </tr>
            <tr>
                <td>手机号：</td>
                <td><input type="text" name="user_tel"  value="{{$arr->user_tel}}"></td>
            </tr>
            <tr>
                <td>邮箱：</td>
                <td><input type="text" name="user_email" value="{{$arr->user_email}}" ></td>
            </tr>
            <tr>
                <td>性别：</td>
                <td>
                    @if($arr->user_sax==1)
                        <input type="radio" name="user_sax" value="1" checked>男
                        <input type="radio" name="user_sax" value="2" >女
                    @else
                        <input type="radio" name="user_sax" value="1" >男
                        <input type="radio" name="user_sax" value="2"checked >女
                    @endif


                </td>
            </tr>
            <tr>
                <td>图片添加</td>
                <td>
                    <input type="file" name="img">
                    <img src="http://www.uploads.com/{{$arr->img}}"  width="100px;"alt="赞无图片">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="修改"></td>
            </tr>
        </table>
     </form>
</body>
</html>
