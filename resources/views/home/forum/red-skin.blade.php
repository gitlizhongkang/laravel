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
<link rel="stylesheet" href="style.css"/>
<link rel='stylesheet' id='bootstrap-css-css'  href='forum/css/bootstrap5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='responsive-css-css'  href='forum/css/responsive5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='pretty-photo-css-css'  href='forum/js/prettyphoto/prettyPhotoaeb9.css?ver=3.1.4' type='text/css' media='all' />
<link rel='stylesheet' id='main-css-css'  href='forum/css/main5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='red-skin-css'  href='forum/css/red-skin5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='custom-css-css'  href='forum/css/custom5152.html?ver=1.0' type='text/css' media='all' />



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
        <input class="search-term required" type="text" id="s" name="s" placeholder="查找帖子" title="* Please enter a search term!" />
        <input class="search-btn" type="submit" value="搜索" />
        <div id="search-error-container"></div>
</form>
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

<section class="span4 articles-list">
<h3>最火文章</h3>
<ul class="articles">
        <?php foreach ($fire_card as $key => $value): ?>
        <li class="article-entry standard">
                <h4><a href="admin-forum-article?id=<?php echo $value['id']?>"><?php echo $value['head']?></a></h4>
                <span class="article-meta"><?php echo $value['date']?><br/>
<a href="#"><?php echo mb_substr($value['content'],0,40,'utf-8'); ?>.......</a></span>
<a href="JavaScript:void(0);" >
<span class="like-count" value="<?php echo $value['id']?>"><?php if (empty($value['assist'])) { echo 0;}else{ echo $value['assist'];}?></span></a>
        </li> 
        <?php endforeach ?>

</ul>
</section>

<section class="span4 articles-list">
        <h3>最新文章</h3>
        <ul class="articles">
        <?php foreach ($new_card as $key => $value): ?>
                <li class="article-entry standard">
<h4><a href="admin-forum-article?id=<?php echo $value['id']?>"><?php echo $value['head']?></a></h4>
<span class="article-meta"><?php echo $value['date']?><br/>
<a href="#"><?php echo mb_substr($value['content'],0,40,'utf-8'); ?>.......</a></span>
<a href="JavaScript:void(0);">
<span class="like-count" value="<?php echo $value['id']?>"><?php if (empty($value['assist'])) { echo 0;}else{ echo $value['assist'];}?></span></a>
                </li>
        <?php endforeach ?>
        </ul>
</section>

</div>
</div>
<!-- end of page content -->

<!-- start of sidebar -->
<aside class="span4 page-sidebar">

<section class="widget">
        <div class="support-widget">
                <h3 class="title"> <a href="admin-forum-write" class="btn btn-mini">写文章</a></h3>

        </div>
</section>

<section class="widget">
<div class="quick-links-widget">
        <h3 class="title">快速链接</h3>
        <ul id="menu-quick-links" class="menu clearfix">
                <li><a href="index-2.html">家</a></li>
                <li><a href="articles-list.html">文章列表</a></li>
                <li><a href="faq.html">常见问题解答</a></li>
                <li><a href="contact.html">联系</a></li>
        </ul>
</div>
</section>

<section class="widget">
<h3 class="title">标签</h3>
<div class="tagcloud">
        <a href="#" class="btn btn-mini">头胎</a>
        <a href="#" class="btn btn-mini">二胎</a>
        <a href="#" class="btn btn-mini">三胎</a>
        <a href="#" class="btn btn-mini">已婚已育</a>
        <a href="#" class="btn btn-mini">未婚未育</a>
        <a href="#" class="btn btn-mini">双胞胎</a>
        <a href="#" class="btn btn-mini">三胞胎</a>
        <a href="#" class="btn btn-mini">不长头发</a>
        <a href="#" class="btn btn-mini">没有眉毛</a>
        <a href="#" class="btn btn-mini">牙歪了</a>
        <a href="#" class="btn btn-mini">眼睛睁不开</a>
        <a href="#" class="btn btn-mini">尿布不用用</a>
        <a href="#" class="btn btn-mini">我们网站有！</a>
        <a href="#" class="btn btn-mini">妈咪断奶</a>
        <a href="#" class="btn btn-mini">我们有奶粉</a>
        <a href="#" class="btn btn-mini">time</a>
        <a href="#" class="btn btn-mini">videos</a>
        <a href="#" class="btn btn-mini">website</a>
        <a href="#" class="btn btn-mini">wordpress</a>
</div>
</section>

                                        </aside>
                                        <!-- end of sidebar -->
                                </div>
                        </div>
                </div>
                <!-- End of Page Container -->


@include('layouts.forum-base')

<script>
$(document).on('click','.like-count',function(){  

        var likeButton = $(this);
        var likeHtml = likeButton.html();
        var likeNum = parseInt(likeHtml, 10);
        likeNum++;
        likeButton.html(likeNum);

        //文章ID
        var id = $(this).attr('value')
        //点赞次数  

        $.ajax({
                url:'admin-forum-zan',
                type : 'get',
                data:{id:id},
                success:function(success)
                {

                }
        })    
})
</script>