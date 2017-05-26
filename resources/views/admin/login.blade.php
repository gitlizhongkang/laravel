<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="css/h_reset.css">
        <link rel="stylesheet" href="css/h_supersized.css">
        <link rel="stylesheet" href="css/h_style.css">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="page-container">
            <h1>Login</h1>
            <form>
                <input type="text" name="admin_name" id='admin_name' class="username" placeholder="Username">
                <input type="password" name="admin_pwd" id='admin_pwd' class="password" placeholder="Password">
             
                <button type="button" id='button'>It's too late to explain. poke me</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>We sell milk powder together</p>
                <p>
                    <a class="facebook" href=""></a>
                    <a class="twitter" href=""></a>
                </p>
            </div>
        </div>
        <div align="center"><a href="http://www.cssmoban.com/" target="_blank" title="."></a></div>

        <!-- Javascript -->
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/supersized.3.2.7.min.js"></script>
        <script src="js/supersized-init.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<script type='text/javascript'>
    //ajax检查admin_name唯一性
    $("#button").click(function()
    {
        var admin_name = $('#admin_name').val()
        var admin_pwd = $('#admin_pwd').val()

        $.ajax({
            url  :  "admin-index-login",
            type :  'post',
            data :  {_token:'{{csrf_token()}}',admin_name:admin_name,admin_pwd:admin_pwd},
            success:function(success)
            {
                if (success.status == 2)
                    {
                        window.location.href = 'admin-index-login_scs';
                    }
                    else
                    {
                         alert(success.success)
                    } 
            }
        })
    })
</script>



