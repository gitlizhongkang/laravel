@include('layouts.forum-header')

<!-- Start of Page Container -->
<div class="page-container">
        <div class="container">
                <div class="row">

<!-- start of page content -->
<div class="span8 page-content"> 写文章<div id="respond">
                                               
<form action="admin-forum-imgUpload" method="post" id="commentform" enctype="multipart/form-data">

<div>
        <label for="author">标题 *</label>
        <input class="span4" type="text" name="head" id="head" value="不得超过20字" size="22">
</div>

<div>
        <label for="email">配图</label>
<!-- 图   -->
    <div class="upload-mask">
    </div>
    <div class="panel panel-info upload-file">
        
        <div class="panel-body">
            <div id="validation-errors"></div>
   
            <div class="form-group">
                <input id="thumb" name="file" type="file"  required="required">
                <input id="imgID"  type="hidden" name="id" value="">

            </div>
 
        </div>
        <div class="panel-footer">
        </div>
    </div>
<!-- 图   -->
</div>

<div>
        <label for="comment">内容</label>
        <textarea class="span8" name="content" id="content" cols="58" rows="10" value='一次发布不得超过600字'></textarea>
</div>

<div>
        <input class="btn" type="submit" value="发布">
</div>

</form>

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
                                                        <h3 class="title">Latest Articles</h3>
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
                                        </aside>
                                        <!-- end of sidebar -->
                                </div>
                        </div>
                </div>
                <!-- End of Page Container -->
 


<script type='text/javascript' src='forum/js/jquery-1.8.3.min.js'></script>
<script type='text/javascript' src='forum/js/jquery.form.js'></script>


<script>
$(function(){
    //上传图片相关

    $('.upload-mask').on('click',function(){
        $(this).hide();
        $('.upload-file').hide();
    })

    $('.upload-file .close').on('click',function(){
        $('.upload-mask').hide();
        $('.upload-file').hide();
    })

    var imgSrc = $('.pic-upload').next().attr('src');
    console.log(imgSrc);
    if(imgSrc == ''){
        $('.pic-upload').next().css('display','none');
    }
    $('.pic-upload').on('click',function(){
        $('.upload-mask').show();
        $('.upload-file').show();
        console.log($(this).next().attr('id'));
        var imgID = $(this).next().attr('id');
        $('#imgID').attr('value',imgID);
    })


    //ajax 上传
    $(document).ready(function() {
        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            dataType: 'json'
        };
        $('#imgForm input[name=file]').on('change', function(){
            //$('#upload-avatar').html('正在上传...');
            $('#imgForm').ajaxForm(options).submit();
        });
    });

    function showRequest() {
        $("#validation-errors").hide().empty();
        $("#output").css('display','none');
        return true;
    }

    function showResponse(response)  {
        if(response.success == false)
        {
            var responseErrors = response.errors;
            $.each(responseErrors, function(index, value)
            {
                if (value.length != 0)
                {
                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                }
            });
            $("#validation-errors").show();
        } else {

            $('.upload-mask').hide();
            $('.upload-file').hide();
            $('.pic-upload').next().css('display','block');

            console.log(response.pic);

            $("#"+response.id).attr('src',response.pic);
            $("#"+response.id).next().attr('value',response.pic);
        }
    }

})
</script>