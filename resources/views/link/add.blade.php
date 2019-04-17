<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>友情链接添加</title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     <form action="add_do" method="post"  enctype="multipart/form-data">
         @csrf
        <table>
            <tr>
                <td>网址名称：</td>
                <td><input type="text" name="l_URL" id="l_URL"></td>
            </tr>
            <tr>
                <td>网站网址</td>
                <td><input type="text"  name="l_website" id="l_website"></td>
            </tr>
            <tr>
                <td>网址类型</td>
                <td>
                    <input type="radio" value="1" name="l_type" >loco链接
                    <input type="radio" value="2"  name="l_type" >文字链接
                </td>
            </tr>
            <tr>
                <td>图片logo:</td>
                <td><input type="file" name="l_img" id="l_img"></td>
            </tr>
            <tr>
                <td>网站联系人：</td>
                <td><input type="text" name="l_name" id="l_name"></td>
            </tr>
            <tr>
                <td>网站简绍：</td>
                <td>
                    <textarea name="l_text" id="" cols="30" rows="10" id="l_text"></textarea>
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" value="1" name="l_show"id="shi">是
                    <input type="radio" value="2" name="l_show" id="shi">否
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit"id="sbt" value="确定" ></td>
            </tr>
        </table>
     </form>
</body>
</html>
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/layui/layui.js"></script>
<script>
    $(function(){
        layui.use(['form','layer'], function(){
            $("#sbt").click(function(){
                var a=/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
                var l_URL=$("#l_URL").val();
                if(l_URL==""){
                    layer.msg("网站名称不能为空",{icon:2});
                    return false;
                }else if(!a.test(l_URL)){
                    layer.msg("中文字母数字下划线",{icon:2});
                    return false;
                }
                var c=/^http:\/\/.*\.com$/;
                var l_website=$("#l_website").val();
                if(l_website==""){
                    layer.msg("网站不能为空",{icon:2});
                    return false;
                }else if(!c.test(l_website)){
                    layer.msg("格式应该以http://开头",{icon:2});
                    return false;
                }
            })
        })
    })
</script>
