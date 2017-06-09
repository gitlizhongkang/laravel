@include('layouts.forum-header')

<!-- Start of Page Container -->
<div class="page-container">
<div class="container">
<div class="row">

<!-- start of page content -->
<div class="span8 page-content">

 

<article class=" type-post format-standard hentry clearfix">

<h1 class="post-title"><a href="#"><?php echo $article['head']?></a></h1>

<div class="post-meta clearfix">
<span class="date"><?php echo $article['date']?></span>
<input type="hidden" value='<?php echo $article['id']?>' id='article'>
<span class="category"><a href="#" >我是标签</a></span>
<span class="comments"><a href="#" >{{$count}}条留言</a></span>
<span class="like-count"><?php echo $article['assist']?></span>
</div><!-- end of post meta -->
 
<p><img class="alignright size-full wp-image-115" alt="Man" src="<?php echo $article['images']?>" width="250" height="250"> 
<?php echo $article['content']?></p>

</article>

<div class="like-btn">

<form id="like-it-form" action="#" method="post">
<span class="like-it "><?php echo $article['assist']?></span>
<input type="hidden" name="post_id" value="99">
<input type="hidden" name="action" value="like_it">
</form>

<span class="tags">
<strong>Tags:&nbsp;&nbsp;</strong><a href="#" rel="tag">basic</a>, <a href="#" rel="tag">setting</a>, <a href="http://knowledgebase.inspirythemes.com/tag/website/" rel="tag">website</a>
</span>

</div>

<section id="comments">

<h3 id="comments-title">({{$count}}) 评论</h3>

<ol class="commentlist">

<li class="comment even thread-even depth-1" id="li-comment-2">

<article id="comment-2">
	@foreach($arr as $k =>$val)
<a href="#">
<img alt="" src="http://1.gravatar.com/avatar/50a7625001317a58444a20ece817aeca?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G" class="avatar avatar-60 photo" height="60" width="60">
</a>
<div class="comment-meta">
<h5 class="author">
<cite class="fn">
<a href="#" rel="external nofollow" class="url">{{$val->u_id}}</a>
</cite><a class="comment-reply-link" href="#"></a>
</h5>
<p class="date">
<a href="#">
<time datetime="2013-02-26T13:18:47+00:00">{{$val->time}}</time>
</a>
</p>
</div><!-- end .comment-meta -->
<div class="comment-body">
<p>{{$val->content}}</p>

</div><!-- end of comment-body -->
 @endforeach

 <style>
.pagination li {float: left; margin: 6px 3px; padding: 0 5px; font-weight: bold; font-size: 14px; border: 2px solid #9C9C9C; list-style: none;}
</style>

{{ $arr->appends(['id' => $article['id']])->links() }}

</article><!-- end of comment -->


<ul class="children">

<li class="comment byuser comment-author-saqib-sarwar bypostauthor odd alt depth-2" id="li-comment-3">
<article id="comment-3">

<a href="#">
<img alt="" src="http://0.gravatar.com/avatar/2df5eab0988aa5ff219476b1d27df755?s=60&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G" class="avatar avatar-60 photo" height="60" width="60">
</a>

<div class="comment-meta">

<h5 class="author">
<cite class="fn">李四</cite>
&nbsp;回复&nbsp;&nbsp;&nbsp;<a class="comment-reply-link" href="#">张三</a>
</h5>

<p class="date">
<a href="#">
<time datetime="2013-02-26T13:20:14+00:00">2016-10-58</time>
</a>
</p>

</div><!-- end .comment-meta -->

<div class="comment-body">
<p>N 反反复复付付付付付付付付付付付付付付付</p>
</div><!-- end of comment-body -->

</article><!-- end of comment -->

</li>
</ul>
</li>

 
</ol>

<div id="respond">

<h3>评论</h3>

<div class="cancel-comment-reply">
<a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Click here to cancel reply.</a>
</div>


<form id="commentform">

<div>
<textarea class="span8" name="comment" id="comment" cols="30" rows="5"></textarea>
</div>

<div>
<input class="btn" type="button" id="button"  value="提交">
</div>

</form>

</div>

</section><!-- end of comments -->

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
<script type='text/javascript' src='forum/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='forum/js/prettyphoto/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='forum/js/jflickrfeed.js'></script>
<script type='text/javascript' src='forum/js/jquery.liveSearch.js'></script>
<script type='text/javascript' src='forum/js/jquery.form.js'></script>
<script type='text/javascript' src='forum/js/jquery.validate.min.js'></script>
<script type='text/javascript' src='forum/js/custom.js'></script>

</body>
</html>


<script>
//无刷新评论
$(document).on('click','#button',function(){ 
//文章ID
	article_id = $('#article').val();
//评论人ID
	u_id = '44';
// 评论内容
    content = $('#comment').val()
    if (content == '')
    	{
    		alert('不能为空')
    	}
    	else
    	{
			$.ajax({
	            url:'admin-forum-comment',
	            type : 'post',
	            data:{_token:'{{csrf_token()}}', article_id:article_id, u_id:u_id, content:content},
	           	dataType: "json",
	            success:function(data)
	            {
	            	$.each(data,function(k,v)
	            	{
		            	str = '';
			            str+='<article id="comment-2">';
						str+='<a href="#"><img src="http://1.gravatar.com/avatar/50a7625001317a58444a20ece817aeca?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G" class="avatar avatar-60 photo" height="60" width="60"></a>';
						str+='<div class="comment-meta"><h5 class="author"><cite class="fn">';
						str+='<a href="#" rel="external nofollow" class="url">'+v.username+'</a>';
						str+='</cite><a class="comment-reply-link" href="#"></a></h5>';
						str+='<p class="date"><a href="#">';
						str+='<time datetime="2013-02-26T13:18:47+00:00">'+v.time+'</time></a></p></div>';
						str+='<div class="comment-body"><p>'+v.content+'</p></div>';
						str+='</article>';
	  			 		$("#comment-2").append(str);
  			 		})

  			 		$("#comment").val("").focus();
  			 		alert('评论成功')
	            }
	    	})
			    var likeButton = $('#comments-title');
		        var likeHtml = likeButton.html();
		        var likeNum = parseInt(likeHtml, 10);
		        likeNum++;
		        likeButton.html(likeNum);
	    }

	    
})
 
</script>

