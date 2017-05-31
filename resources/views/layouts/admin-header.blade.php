<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="plug/hadmin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="plug/hadmin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="plug/hadmin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="plug/hadmin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="plug/hadmin/static/h-ui.admin/css/style.css" />
</head>
<body>

@yield('content')


<!--公共js-->
<script type="text/javascript" src="plug/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="plug/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="plug/hadmin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="plug/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="plug/hadmin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<!--公共js结束-->

@yield('js')


</body>
</html>
