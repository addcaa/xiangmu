<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>发送邮件</title>
</head>
<body>
邮箱：<input type="text" name="email" id="email">
        <input type="submit" id="sub" value="发送">
</body>
</html>
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="\layui\layui.js"></script>

<script>
    $(function(){
        layui.use('layer',function(){
            $("#sub").click(function(){
                // alert(11);
                 var email=$('#email').val();
                //  console.log(email);
                $.post(
                    "email",
                    {email:email},
                    function(res){
                        console.log(res);
                        // layer.msg(res.font,{icon:res.code});
                    }
                );
            })

        })
    })
</script>
