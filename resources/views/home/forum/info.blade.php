@include('layouts.forum-header')
<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">
            <!-- start of page content -->
            <div class="span8 page-content">

    <form id="contact-form" class="row">
        <div class="span2">
               <a href=""><label for="name">我的收藏<span>（0）</span> </label></a>
        </div>

        <div class="span2">
                <a href=""><label for="email">关注我的<span>（0）</span></label></a> 
        </div>

        <div class="span2">
                <a href=""><label for="reason">我关注的<span>（0）</span></label></a> 
        </div>

        <div class="span6 offset2 error-container"></div>
        <div class="span8 offset2" id="message-sent"></div>
    </form>
</div>
<!-- end of page content -->


<!-- start of sidebar -->
<aside class="span4 page-sidebar">

 <section class="widget">
<div class="quick-links-widget">
        <h3 class="title">个人信息</h3>
        <ul id="menu-quick-links" class="menu clearfix">
                <li><a href="index-2.html">手机号</a><span>{{$data->tel}}</span></li>
                <li><a href="articles-list.html">邮箱</a><span>{{$data->email}}</span></li>
                <li><a href="faq.html">性别</a><span>{{$data->sex}}</span></li>
                <li><a href="contact.html">年龄</a><span>{{$data->age}}</span></li>
                <li><a href="contact.html">注册时间</a><span>{{$data->reg_time}}</span></li>
                <li><a href="contact.html">微博</a><span>{{$data->sina_id}}</span></li>
                <li><a href="contact.html">积分</a><span>{{$data->user_point}}</span></li>
        </ul>
</div>
</section>
<section class="widget">
<h3 class="title">我的动态</h3>
<ul class="articles">
        <li class="article-entry standard">
                <h4><a href="single.html">我是标题</a></h4>
                <span class="article-meta">我是内容<a href="#" title="View all posts in Server &amp; Database">Server &amp; Database</a></span>
                <span class="like-count">66</span>
        </li>
</ul>
</section>
                                        </aside>
                                        <!-- end of sidebar -->
                                </div>
                        </div>
                </div>
                <!-- End of Page Container -->
 

