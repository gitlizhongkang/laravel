@include('layouts.forum-header')

<div id='replace'>
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
<span id="dianjicishu"></span>

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
 
    
 