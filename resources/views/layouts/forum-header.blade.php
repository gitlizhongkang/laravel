<!doctype html>
        <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
        <!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
        <!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
        <!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
        <head>
                <!-- META TAGS -->
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>卖奶粉的论坛</title>
                <link rel="shortcut icon" href="forum/images/favicon.png" />

                <!-- Style Sheet-->
           <!--      <link rel="stylesheet" href="forum/css/style.css"/> -->
<!-- 默认 -->
<link rel='stylesheet' id='bootstrap-css-css'  href='forum/css/bootstrap5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='responsive-css-css'  href='forum/css/responsive5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='pretty-photo-css-css'  href='forum/js/prettyphoto/prettyPhotoaeb9.css?ver=3.1.4' type='text/css' media='all' />
<link rel='stylesheet' id='main-css-css'  href='forum/css/main5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='custom-css-css'  href='forum/css/custom5152.html?ver=1.0' type='text/css' media='all' />
                <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
                <!--[if lt IE 9]>
                <script src="forum/js/html5.js"></script>
                <![endif]-->
 



        </head>
        <body>
<!-- Start of Header -->
<div class="header-wrapper">
<header>
<div class="container">
<div class="logo-container">
        <!-- Website Logo -->
        <a href="index-2.html"  title="Knowledge Base Theme">
                <img src="forum/images/logo.png" alt="Knowledge Base Theme">
        </a>
        <span class="tag-line">Premium WordPress Theme</span>
</div>

        <!-- Start of Main Navigation -->
<nav class="main-nav">
        <div class="menu-top-menu-container">
                <ul id="menu-top-menu" class="clearfix">
                        <li class="current-menu-item"><a href="admin-forum-info">张三</a></li>
                        <li><a href="#">全部文章</a></li>
                        <li><a href="#">更换皮肤</a>
                                <ul class="sub-menu">
                                        <li><a href="admin-blue-skin">蓝色皮肤</a></li>
                                        <li><a href="admin-green-skin">绿色皮肤</a></li>
                                        <li><a href="admin-red-skin">红色皮肤</a></li>
                                        <li><a href="admin-forum-index">默认皮肤</a></li>
                                </ul>
                        </li>
                </ul>
        </div>
</nav>
<!-- End of Main Navigation -->
                                </div>
                        </header>
                </div>
                <!-- End of Header -->

                <!-- Start of Search Wrapper -->
                <div class="search-area-wrapper">
                        <div class="search-area container">
                                <h3 class="search-header">有一个问题？</h3>
                                <p class="search-tag-line">如果您有任何问题，您可以在下方输入您的疑惑!</p>



<form id="search-form" class="search-form clearfix" method="get" action="#" autocomplete="off">
<input class="search-term required" type="text" id="s" name="s"  />
<input class="search-btn" type="button" value="搜索" />
        <div id="search-error-container"></div>
</form>

<input type="text" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />  
<div class="suggestionsBox" id="suggestions" style="display: none;">   
        <div class="suggestionList" id="autoSuggestionsList"> </div>  
</div>  
 



                        </div>
                </div>
                <!-- End of Search Wrapper -->
                <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" title="模板之家">模板之家</a></div>

                <!-- Start of Page Container -->
                <div class="page-container">
                        <div class="container">
                                <div class="row">

                                        <!-- start of page content -->
                                        <div class="span8 page-content">

                                                <!-- Basic Home Page Template -->
                                                <div class="row separator">


<!-- <script type="text/javascript" src="forum/js/jquery-1.2.1.pack.js"></script> -->
<script type='text/javascript' src='js/jquery.min.js'></script>

<input type="text" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />  
<div class="suggestionsBox" id="suggestions" style="display: none;">   
        <div class="suggestionList" id="autoSuggestionsList"> </div>  
</div>  
<script type="text/javascript">

$("#s").keyup(function(){
        //搜索的值
        data = $('#s').val()
            $.ajax({
                url  :  "admin-forum-duct",
                type :  'get',
                data :  {data:data},
                success:function(message)
                {
                    // alert(message)
                }
            });
               
            })


     function lookup(inputString)
     {  
          if(inputString.length == 0)
          {    
            $('#suggestions').hide();  
          }
          else
          {  
               $.post("rpc.php", {queryString: ""+inputString+""}, function(data)
               {  
                    if(data.length >0)
                    {  
                         $('#suggestions').show();  
                         $('#autoSuggestionsList').html(data);  
                    }  
                });  
          }  
     } 
       
     function fill(thisValue)
     {  
        $('#inputString').val(thisValue);  
        setTimeout("$('#suggestions').hide();", 200);  
     }  
</script>