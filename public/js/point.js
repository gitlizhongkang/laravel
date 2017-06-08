/**
 * Created by kang on 2017/6/7.
 */
$(function(){
    $(".pagination a").attr("href","javascript:;");
    $(".category a").each(function(){
        if($(this).attr("cName")==category){
            $(this).css("color","orange");
        }
    })
    $(".point-area a").each(function(){
        if($(this).attr("area")==area){
            $(this).css("color","orange");
        }
    })
    $(".first a").each(function(){
        if($(this).attr("order")==order){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
        }
    })

        $(".category a").click(function(){
            $("input[name=category]").val($(this).attr('cName'));
            $(this).css("color","orange");
            $(this).siblings().css("color","");
        })
        $(".point-area a").click(function(){
            $("input[name=point_area]").val($(this).attr('area'));
            $(this).css("color","orange");
            $(this).siblings().css("color","");
        })
        $(".first a").click(function(){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            $("input[name=order]").val($(this).attr("order"));
        })
       $(".pagination a").click(function(){
           var page=parseInt($(".pagination .active span").html());
           if($(this).attr("rel")=="prev"){
               $("input[name=page]").val(page-1);
           }else if($(this).attr("rel")=="next"){
               $("input[name=page]").val(page+1);
           }else{
               $("input[name=page]").val($(this).html());
           }
       })
    $(".category a,.point-area a,.first a,.pagination a").click(function(){
        $("form[name=listform]").submit();
    })
})