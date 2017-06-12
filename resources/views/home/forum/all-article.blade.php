<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>
<!-- META TAGS -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Knowledge Base Theme</title>

<link rel="shortcut icon" href="forum/images/favicon.png" />




<!-- Style Sheet-->
<link rel="stylesheet" href="style.css"/>
<link rel='stylesheet' id='bootstrap-css-css'  href='forum/css/bootstrap5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='responsive-css-css'  href='forum/css/responsive5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='pretty-photo-css-css'  href='forum/js/prettyphoto/prettyPhotoaeb9.css?ver=3.1.4' type='text/css' media='all' />
<link rel='stylesheet' id='main-css-css'  href='forum/css/main5152.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='custom-css-css'  href='forum/css/custom5152.html?ver=1.0' type='text/css' media='all' />


<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="forum/js/html5.js"></script></script>
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
                                        <li><a href="index-2.html">Home</a></li>
                                        <li><a href="home-categories-description.html">Home 2</a></li>
                                        <li><a href="home-categories-articles.html">Home 3</a></li>
                                        <li  class="current-menu-item"><a href="articles-list.html">Articles List</a></li>
                                        <li><a href="faq.html">FAQs</a></li>
                                        <li><a href="#">Skins</a>
                                                <ul class="sub-menu">
                                                        <li><a href="blue-skin.html">Blue Skin</a></li>
                                                        <li><a href="green-skin.html">Green Skin</a></li>
                                                        <li><a href="red-skin.html">Red Skin</a></li>
                                                        <li><a href="index-2.html">Default Skin</a></li>
                                                </ul>
                                        </li>
                                        <li><a href="#">More</a>
                                                <ul class="sub-menu">
                                                        <li><a href="full-width.html">Full Width</a></li>
                                                        <li><a href="elements.html">Elements</a></li>
                                                        <li><a href="page.html">Sample Page</a></li>
                                                </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
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
        <h3 class="search-header">Have a Question?</h3>
        <p class="search-tag-line">If you have any question you can ask below or enter what you are looking for!</p>

        <form id="search-form" class="search-form clearfix" method="get" action="#" autocomplete="off">
                <input class="search-term required" type="text" id="s" name="s" placeholder="Type your search terms here" title="* Please enter a search term!" />
                <input class="search-btn" type="submit" value="Search" />
                <div id="search-error-container"></div>
        </form>
</div>
</div>
<!-- End of Search Wrapper -->

<!-- Start of Page Container -->
<div class="page-container">
<div class="container">
        <div class="row">

                <!-- start of page content -->
                <div class="span8 main-listing">

<article class="format-standard type-post hentry clearfix">
@foreach($data as $val)
<header class="clearfix">
        <h3 class="post-title">
                <a href="single.html">{{$val->head}}</a>
        </h3>

        <div class="post-meta clearfix">
                <span class="date">{{$val->date}}</span>
                <span class="category"><a href="#" title="View all posts in Server &amp; Database">Server &amp; Database</a></span>
                <span class="comments"><a href="#" title="Comment on Integrating WordPress with Your Website">{{$val->comment}}</a></span>
                <span class="like-count">{{$val->assist}}</span>
        </div><!-- end of post meta -->

</header>

<p>{{$val->content}}<a class="readmore-link" href="http://knowledgebase.inspirythemes.com/integrating-wordpress-with-your-website/">Read more</a></p>
 
@endforeach
</article>
<!--  -->

                        <div id="pagination">
                               <style>
.pagination li {float: left; margin: 6px 3px; padding: 0 5px; font-weight: bold; font-size: 14px; border: 2px solid #9C9C9C; list-style: none;}
</style>
{{ $data->appends(['id' => $val['id']])->links() }}
                        </div>

                </div>
                <!-- end of page content -->


                <!-- start of sidebar -->
                <aside class="span4 page-sidebar">

                        <section class="widget">
                                <div class="support-widget">
                                        <h3 class="title">Support</h3>
                                        <p class="intro">Need more support? If you did not found an answer, contact us for further help.</p>
                                </div>
                        </section>


                        <section class="widget">
                                <h3 class="title">Featured Articles</h3>
                                <ul class="articles">
                                        <li class="article-entry standard">
                                                <h4><a href="single.html">Integrating WordPress with Your Website</a></h4>
                                                <span class="article-meta">25 Feb, 2013 in <a href="#" title="View all posts in Server &amp; Database">Server &amp; Database</a></span>
                                                <span class="like-count">66</span>
                                        </li>
                                        <li class="article-entry standard">
                                                <h4><a href="single.html">WordPress Site Maintenance</a></h4>
                                                <span class="article-meta">24 Feb, 2013 in <a href="#" title="View all posts in Website Dev">Website Dev</a></span>
                                                <span class="like-count">15</span>
                                        </li>
                                        <li class="article-entry video">
                                                <h4><a href="single.html">Meta Tags in WordPress</a></h4>
                                                <span class="article-meta">23 Feb, 2013 in <a href="#" title="View all posts in Website Dev">Website Dev</a></span>
                                                <span class="like-count">8</span>
                                        </li>
                                        <li class="article-entry image">
                                                <h4><a href="single.html">WordPress in Your Language</a></h4>
                                                <span class="article-meta">22 Feb, 2013 in <a href="#" title="View all posts in Advanced Techniques">Advanced Techniques</a></span>
                                                <span class="like-count">6</span>
                                        </li>
                                </ul>
                        </section>



                        <section class="widget"><h3 class="title">Categories</h3>
                                <ul>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Advanced Techniques</a> </li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Designing in WordPress</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Server &amp; Database</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet, ">Theme Development</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Website Dev</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">WordPress for Beginners</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet, ">WordPress Plugins</a></li>
                                </ul>
                        </section>

                        <section class="widget">
                                <h3 class="title">Recent Comments</h3>
                                <ul id="recentcomments">
                                        <li class="recentcomments"><a href="#" rel="external nofollow" class="url">John Doe</a> on <a href="#">Integrating WordPress with Your Website</a></li>
                                        <li class="recentcomments">saqib sarwar on <a href="#">Integrating WordPress with Your Website</a></li>
                                        <li class="recentcomments"><a href="#" rel="external nofollow" class="url">John Doe</a> on <a href="#">Integrating WordPress with Your Website</a></li>
                                        <li class="recentcomments"><a href="#" rel="external nofollow" class="url">Mr WordPress</a> on <a href="#">Installing WordPress</a></li>
                                </ul>
                        </section>

                </aside>
                <!-- end of sidebar -->
        </div>
</div>
</div>
<!-- End of Page Container -->

<!-- Start of Footer -->
<footer id="footer-wrapper">
<div id="footer" class="container">
        <div class="row">

                <div class="span3">
                        <section class="widget">
                                <h3 class="title">How it works</h3>
                                <div class="textwidget">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
                                        <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
                                </div>
                        </section>
                </div>

                <div class="span3">
                        <section class="widget"><h3 class="title">Categories</h3>
                                <ul>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Advanced Techniques</a> </li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Designing in WordPress</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Server &amp; Database</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet, ">Theme Development</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Website Dev</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet,">WordPress for Beginners</a></li>
                                        <li><a href="#" title="Lorem ipsum dolor sit amet, ">WordPress Plugins</a></li>
                                </ul>
                        </section>
                </div>

                <div class="span3">
                        <section class="widget">
                                <h3 class="title">Latest Tweets</h3>
                                <div id="twitter_update_list">
                                        <ul>
                                                <li>No Tweets loaded !</li>
                                        </ul>
                                </div>
                                <script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js" type="text/javascript"></script>
                                <script type="text/javascript" >
                                        getTwitters("twitter_update_list", {
                                                id: "960development",
                                                count: 3,
                                                enableLinks: true,
                                                ignoreReplies: true,
                                                clearContents: true,
                                                template: "%text% <span>%time%</span>"
                                        });
                                </script>
                        </section>
                </div>

                <div class="span3">
                        <section class="widget">
                                <h3 class="title">Flickr Photos</h3>
                                <div class="flickr-photos" id="basicuse">
                                </div>
                        </section>
                </div>

        </div>
</div>
<!-- end of #footer -->

<!-- Footer Bottom -->
<div id="footer-bottom-wrapper">
        <div id="footer-bottom" class="container">
                <div class="row">
                        <div class="span6">
                                <p class="copyright">
                                        Copyright © 2013. All Rights Reserved by KnowledgeBase.Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>
                                </p>
                        </div>
                        <div class="span6">
                                <!-- Social Navigation -->
                                <ul class="social-nav clearfix">
                                        <li class="linkedin"><a target="_blank" href="#"></a></li>
                                        <li class="stumble"><a target="_blank" href="#"></a></li>
                                        <li class="google"><a target="_blank" href="#"></a></li>
                                        <li class="deviantart"><a target="_blank" href="#"></a></li>
                                        <li class="flickr"><a target="_blank" href="#"></a></li>
                                        <li class="skype"><a target="_blank" href="skype:#?call"></a></li>
                                        <li class="rss"><a target="_blank" href="#"></a></li>
                                        <li class="twitter"><a target="_blank" href="#"></a></li>
                                        <li class="facebook"><a target="_blank" href="#"></a></li>
                                </ul>
                        </div>
                </div>
        </div>
</div>
<!-- End of Footer Bottom -->

</footer>
<!-- End of Footer -->

<a href="#top" id="scroll-top"></a>

<!-- script -->
<script type='text/javascript' src='forum/js/jquery-1.8.3.min.js'></script>
<script type='text/javascript' src='forum/js/jquery.easing.1.34e44.js?ver=1.3'></script>
<script type='text/javascript' src='forum/js/prettyphoto/jquery.prettyPhotoaeb9.js?ver=3.1.4'></script>
<script type='text/javascript' src='forum/js/jquery.liveSearchd5f7.js?ver=2.0'></script>
	<script type='text/javascript' src='forum/js/jflickrfeed.js'></script>
<script type='text/javascript' src='forum/js/jquery.formd471.js?ver=3.18'></script>
<script type='text/javascript' src='forum/js/jquery.validate.minfc6b.js?ver=1.10.0'></script>
<script type='text/javascript' src='forum/js/custom5152.js?ver=1.0'></script>

</body>
</html>