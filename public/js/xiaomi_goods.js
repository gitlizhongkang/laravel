$(function(){
	$("#item-thumbs").slide({mainCell:".bd ul",autoPage:true,effect:"top",vis:5,scroll:1,autoPlay:true,pnLoop:true});
	$(".taocan_bd").slide({mainCell:"#taocan_panels",titCell:"#taocan_tabs li",trigger:"click",effect:"fold"});

	$("#item-thumbs li a").click(function(){
		$("#item-thumbs li").removeClass("current");
		$(this).parent().addClass("current");
	})
	
	$("#membership,.membership_con").mouseenter(function(){
		$(".membership_con").show();
	})
	
	$("#membership,.membership_con").mouseleave(function(){
		$(".membership_con").hide();
	})
	
	$(".seemore_items").slide({mainCell:".bd ul",effect:"top",autoPage:true,scroll:3,vis:3});

	$("#skunum").on('click', 'span', function(e) {
		if ($(this).hasClass("add")) {
			countNum(1);
		} else {
			countNum(-1);
		}
		return false;
    });
	
	$(".sku_list a").click(function(){
		$(this).parent().find("a").removeClass("selected");
		$(this).addClass("selected");
		$(this).parent().find("input:radio").prop("checked",false);
		$(this).find("input:radio").prop("checked",true);
		// changePrice();
	})
	
//	//tabs_Top = $("#tabs_bar").offset().top;
//	$(window).scroll(function(){		
//		var c = $(window).scrollTop();
//	
//		if(c >= tabs_Top)
//		{
//			$(".tabs_bar").addClass("fixed").css({'position':'fixed'});
//		}
//		else
//		{
//			$(".tabs_bar").removeClass("fixed").css({'position':''});
//		}
//	})	
//		
//	$("#tabs_bar li").mouseenter(function(){
//		$(this).animate(300,function(){
//			$(this).addClass("hover");
//		})	
//	})
//	
//	$("#tabs_bar li").click(function(){
//		$("#tabs_bar li").not($(this)).removeClass("current_select");
//		$(this).addClass("current_select");
//	})
//
//	$(".pjxqitem").click(function(){
//		$(".product_tabs .sectionbox:eq(0)").hide();
//	})
//	$(".spxqitem").click(function(){
//		$(".product_tabs .sectionbox:eq(0)").show();
//	})
//	
//	$("#taocan_tabs li").click(function(){
//		$("#taocan_tabs li").removeClass("current");
//		$(this).addClass("current");
//		var i = $("#taocan_tabs li").index($(this));
//		$("#taocan_panels .panel").hide();
//		$("#taocan_panels .panel").eq(i).show();
//	})
})


function countNum(i) {
	var $count_box = $("#skunum");
	var $input = $count_box.find('input');
	var num = $input.val();
	var sku_num = $('#choose').attr('sku-num');
	
    if (!$.isNumeric(num)) {
		alert("请您输入正确的购买数量!");
        $input.val('1');
        return;
	}	
    num = parseInt(num) + i;
    if (parseInt(sku_num) < num) {
		alert('库存不足');
		$input.val(sku_num);
		return false;
	}
    switch (true) {
		case num == 0:
			$input.val('1');
			alert('您至少得购买1件商品！');
			break;
        default:
        	$input.val(num);
            break;
    }
   
}

/*	//滚动固定选项卡
	$(function(){
		
			//详情页页面滚动tab顶部固定
			$(window).scroll(function(){
				if($(window).scrollTop() >  $(".goods-detail-main").offset().top){
					$(".goods-sub-bar").addClass("goods-sub-bar-play");
					autoTab();
				}else{
					$(".goods-sub-bar").removeClass("goods-sub-bar-play");
				}
			 });
		
			//详情页tab点击
			 $(".detail-list").find("li").click(function(){
				var n=$(".detail-list").find("li").index($(this));
				n=n%3;
				// $(this).addClass("on").siblings().removeClass("on");
				switch(n){
					case 0:
						$("html,body").animate({scrollTop:$("#goodsDetail").offset().top-0},200)
						break;
					case 1:
						$("html,body").animate({scrollTop:$("#goodsParam").offset().top-70},200)
						break;
					case 2:
						$("html,body").animate({scrollTop:$("#goodsComment").offset().top-70},200)
						break;
				}
			 }) ;
			 
			 //点击商品详情右侧的评价和满意度
			 $(".J_scrollcomment").click(function(){
				 $("html,body").animate({scrollTop:$("#goodsComment").offset().top-70},200);
		     })		 
		});
		
		
	function autoTab(){//滚动自动切换选项卡
		var tb1=$("#goodsDetail .detail-list li").eq(0);
    	var tb2=$("#goodsDetail .detail-list li").eq(1);
    	var tb3=$("#goodsDetail .detail-list li").eq(2);
		var tb1clone=$("#goodsSubBar .detail-list li").eq(0);
    	var tb2clone=$("#goodsSubBar .detail-list li").eq(1);
    	var tb3clone=$("#goodsSubBar .detail-list li").eq(2);
    	var goodsDetail=$("#goodsDetail");
    	var goodsParam=$("#goodsParam");
    	var goodsComment=$("#goodsComment");
    	if( $(window).scrollTop()+80 > goodsComment.offset().top ){
    		if(!tb3.hasClass("on")){
    			tb3.addClass("on").siblings().removeClass("on");
    			tb3clone.addClass("on").siblings().removeClass("on");
    		}
    	}else if( $(window).scrollTop()+80 > goodsParam.offset().top ){
    		if(!tb2.hasClass("on")){
    			tb2.addClass("on").siblings().removeClass("on");
    			tb2clone.addClass("on").siblings().removeClass("on");
    		}
    	}else if(!tb1.hasClass("on")){
    		tb1.addClass("on").siblings().removeClass("on");
    		tb1clone.addClass("on").siblings().removeClass("on");
    	}
	}
	
$(function(){
	
	//评论列表回复框
	$(".J_commentAnswerInput").focus(function(){
		$(this).parents(".user-comment-self-input").addClass("showIn");
	}).blur(function(){
		$(this).parents(".user-comment-self-input").removeClass("showIn");
	});
	
});
*/

$(function(){
	$(".J_scrollcomment").click(function(){
		$("html,body").animate({scrollTop:$("#goodsComment").offset().top-70},200);
	})	

	function tabs(){//滚动自动切换选项卡
		var arr=[];
		$(window).scroll(function(){
			var top=$(document).scrollTop();
			
			$(".goods_con_item").each(function(i){
				arr[i]=$(this).offset().top-60;
			})
			if(top>=arr[0]+60){
				$(".goods-sub-bar").css("top",0);
			}else{
				$(".goods-sub-bar").css("top",-71);
			}
			
			$.each(arr,function(k,v){
				if(top>=v){
					li.removeClass("on").eq(k).addClass("on");
					li2.removeClass("on").eq(k).addClass("on");
				}
			});
		});
		
		var li=$(".goods-detail-nav").find("li");
		var li2=$(".goods-sub-bar").find("li");
		li.click(function(){
			fn(this,li);
		});
		li2.click(function(){
			fn(this,li2);
		});
		var fn=function(obj,li){
			var i=li.index(obj);
			$(obj).addClass("on").siblings("li").removeClass("on");
			$("body,html").animate({scrollTop:arr[i]});
		}
	}
	tabs();	
	
	//评论列表回复框
	$(".J_commentAnswerInput").focus(function(){
		$(this).parents(".user-comment-self-input").addClass("showIn");
	}).blur(function(){
		$(this).parents(".user-comment-self-input").removeClass("showIn");
	});
	
});
