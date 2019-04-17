<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>友情链接修改</title>
</head>
<body>
     <form action="update" method="post"  enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="l_id" value="{{$arr->l_id}}">
        <table>
            <tr>
                <td>网址名称：</td>
                <td><input type="text" name="l_URL" value="{{$arr->l_URL}}"></td>
            </tr>
            <tr>
                <td>网站网址</td>
                <td><input type="text"  name="l_website" value="{{$arr->l_website}}"></td>
            </tr>
            <tr>
                <td>网址类型</td>
                <td>
                @if($arr->l_type==1)
                    <input type="radio" value="1" checked>loco链接
                    <input type="radio" value="2">文字链接
                @else
                     <input type="radio" value="1">loco链接
                    <input type="radio" value="2" checked>文字链接
                @endif
                </td>
            </tr>
            <tr>
                <td>图片logo:</td>
                <td><input type="file" name="l_img"></td>
            </tr>
            <tr>
                <td>网站联系人：</td>
                <td><input type="text" name="l_name" value="{{$arr->l_name}}"></td>
            </tr>
            <tr>
                <td>网站简绍：</td>
                <td>
                    <textarea name="l_text" id="" cols="30" rows="10">{{$arr->l_text}}</textarea>
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                @if($arr->l_type==1)
                    <input type="radio" value="1" checked>是
                    <input type="radio" value="2">否
                @else
                     <input type="radio" value="1">是
                    <input type="radio" value="2" checked>否
                @endif
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
