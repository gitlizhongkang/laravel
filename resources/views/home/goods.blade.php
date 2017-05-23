@include('header')
<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href=".">首页</a> <code>&gt;</code>
        <a href="category.php?id=76">购买电视与平板</a> <code>&gt;</code>
        <a href="category.php?id=77">小米电视2</a> <code>&gt;</code> 小米电视2 40英寸
    </div>
</div>
<div class="goods-detail">
    <div class="goods-detail-info  clearfix J_goodsDetail">
        <div class="container">
            <div class="row">
                <div class="span13  J_mi_goodsPic_block goods-detail-left-info">
                    <div class="goods-pic-box" id="detail_img">
                        <div class="goods-big-pic">
                            <a href="images/goods.jpg" class="MagicZoomPlus" id="Zoomer" rel="hint-text: ; selectors-effect: false; selectors-class: current; zoom-distance: 60;zoom-width: 400; zoom-height: 400;" >
                                <img  alt="" src="images/goods.jpg">
                            </a>
                        </div>
                        <div class="goods-small-pic" id="item-thumbs">
                            <a class="prev" href="javascript:void(0);"></a>
                            <a class="next" href="javascript:void(0);"></a>
                            <div class="bd">
                                <ul class="cle">

                                    <li class="current">
                                        <a href="" rel="zoom-id: Zoomer" rev="images/goods.jpg">
                                            <img alt="" src="images/goods.jpg">
                                        </a>
                                    </li>
                                    <li >
                                        <a href="images/goods.jpg" rel="zoom-id: Zoomer" rev="images/goods.jpg">
                                            <img alt="" src="images/goods.jpg">
                                        </a>
                                    </li>
                                    

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="span7 goods-info-rightbox">
                    <form action="javascript:addToCart(27)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >


                        <div class="goods-info-box" id="item-info">
                            <dl class="loaded">
                                <dt class="goods-info-head">
                                <dl>
                                    <dt class="goods-name">{{$goodsInfo['goods_name']}}</dt>
                                    <dd class="goods-phone-type"><p> 现货购买</p></dd>
                                    <del>专柜价： <em class="cancel">{{$goodsInfo['goods_low_price']}}<em>元</em></em></del>
                                    <dd class="goods-info-head-price clearfix">

                                        <span>本店价：</span> <span class="unit"> <b class="nala_price red" id="ECS_SHOPPRICE">{{$goodsInfo['goods_low_price']}}<em>元</em> </b> </span>

                                        <a href="javascript:;" id="membership" data-type="normal" class="membership">高级会员购买享有折扣</a>
                                        <div class="membership_con">
                                            <div class="how-bd">
                                                <h3>会员价格</h3>
                                                <table width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td width="50%">会员等级</td>
                                                        <td width="50%">会员价格</td>
                                                    </tr>
                                                    <tr id="ECS_RANKPRICE_1">
                                                        <td>注册用户</td>
                                                        <td>280<em>元</em></td>
                                                    </tr>
                                                    <tr id="ECS_RANKPRICE_2">
                                                        <td>vip</td>
                                                        <td>240<em>元</em></td>
                                                    </tr>
                                                    <tr id="ECS_RANKPRICE_99">
                                                        <td>微信用户</td>
                                                        <td>260<em>元</em></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </dd>
                                    <dd>
                                        <ul>
                                            <li><span>此商品可使用：<em class="red">2200</em>积分</span></li>
                                        </ul>
                                    </dd>
                                    <dd class="goods-info-choose">
                                        <div id="choose" class="spec_list_box">
                                            <ul>
                                                @foreach ($norms as $k=>$v)
                                                <li  class="GeneralAttrImg">
                                                    <div class="dt">{{$v['norms_name']}}</div>
                                                    <div class="dd">
                                                     @foreach ($v['norms_value'] as $k1=>$v1)
                                                        <div class="item selected">
                                                            <b></b>
                                                           
                                                            <a href="" title="" rel="zoom-id: Zoomer" rev="images/goods.jpg"><img src="images/goods1.jpg" width="30" height="30" /><span>{{$v1}}</span></a>
                                                           
                                                            <input id="spec_value_37" style="display:none;" type="radio" name="spec_10" value="37"  />
                                                        </div>
                                                     @endforeach
                                                    </div>
                                                </li>                                                @endforeach                                            

                                            </ul>
                                        </div>
                                        <style>
                                            #choose{margin:0;}
                                            #choose li{overflow:hidden; padding-bottom:20px;}
                                            #choose .dt{width:72px; text-align:left; float:left; padding:6px 0 0;}
                                            #choose .dd{overflow:hidden;}
                                            #choose .dd .item{float:left; margin:2px 8px 2px 0; position:relative;}
                                            #choose .dd .item a{border:1px solid #ccc; padding:4px 6px; float:left;}
                                            #choose .dd .item a span{padding:0 3px; line-height:30px;}
                                            #choose .dd .item a img{width:30px; height:30px;}
                                            #choose .dd .item b{width:12px; height:12px; background:url(images/gou.png) no-repeat; position:absolute; bottom:1px; right:1px; overflow:hidden; display:none;}
                                            #choose .dd .item.selected a{border-width:2px; border-color:#e4393c; padding:3px 5px;}
                                            #choose .dd .item.selected b{display:block;}
                                            #choose li.GeneralAttrImg .dt{padding-top:10px;}
                                            #choose li.GeneralAttrImg .dd .item a{padding:1px;}
                                            #choose li.GeneralAttrImg .dd .item a img{margin:1px;}
                                            #choose li.GeneralAttrImg .dd .item.selected a{padding:0;}
                                        </style>

                                        <script>
                                            $(".spec_list_box .item a").click(function(){
                                                $(this).parents(".dd").find(".item").removeClass("selected");
                                                $(this).parent().addClass("selected");
                                                $(this).parents(".dd").find("input:radio").prop("checked",false);
                                                $(this).parent().find("input:radio").prop("checked",true);
                                                changePrice();
                                            })
                                        </script>

                                        <ul class="sku">
                                            <li class="skunum_li clearfix">
                                                <div class="ghd">数量：</div>
                                                <div class="skunum gbd" id="skunum">
                                                    <span class="minus" title="减少1个数量"></span>
                                                    <input id="number" name="number" type="text" min="1" value="1" onchange="countNum(0)">
                                                    <span class="add" title="增加1个数量"></span>&nbsp;件
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>

                                    <dd class="goods-info-head-cart">
                                        <a href="javascript:addToCart(27)" class="btn  btn-primary goods-add-cart-btn" id="buy_btn"><i class="iconfont"></i>加入购物车</a>
                                        <a href="javascript:collect(27)" class=" btn btn-gray  goods-collect-btn " id="fav-btn"><i class="iconfont"></i>喜欢</a>
                                    </dd>
                                    <dd class="goods-info-head-userfaq clearfix">
                                        <ul>
                                            <li class=""><i class="iconfont"></i> 销量 <b>1</b></li>
                                            <li class="J_scrollcomment mid"><i class="iconfont"></i> 评价 <b>7</b></li>
                                            <li class="J_scrollcomment"><i class="iconfont"></i> 满意度 <b>86%</b></li>
                                        </ul>
                                    </dd>
                                </dl>
                                </dt>




                            </dl>
                        </div>
                    </form><div class="seemore_items" id="seemore_items" style="display:none;">
                    <h3>看了又看<a href="javascript:;" class="next refresh" title="换一组"><i class="iconfont"></i></a></h3>
                    <div class="bd">
                        <ul id="history_list">

                            <li>
                                <a href="goods.php?id=40" target="_blank" title=""> <img alt="" src="images/luyou.jpg">
                                    <p class="price">99<em>元</em></p>
                                </a>
                            </li>

                            <li>
                                <a href="goods.php?id=45" target="_blank" title=""> <img alt="" src="images/luyou.jpg">
                                    <p class="price">89<em>元</em></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                    <script type="text/javascript">
                        if (document.getElementById('history_list').innerHTML.replace(/\s/g,'').length<1)
                        {
                            document.getElementById('seemore_items').style.display='none';
                        }
                        else
                        {
                            //document.getElementById('seemore_items').style.display='block';
                        }
                        function clear_history()
                        {
                            Ajax.call('user.php', 'act=clear_history',clear_history_Response, 'GET', 'TEXT',1,1);
                        }
                        function clear_history_Response(res)
                        {
                            document.getElementById('history_list').innerHTML = '您已清空最近浏览过的商品';
                        }
                    </script></div>
            </div>
        </div>
    </div>
        <script type="text/javascript">
            
            //处理添加商品到购物车
            function ec_group_addToCart(group,goodsId,parentId){
                var goods        = new Object();
                var spec_arr     = new Array();
                var fittings_arr = new Array();
                var number       = 1;
                var quick		   = 0;
                var group_item   = (typeof(parentId) == "undefined") ? goodsId : parseInt(parentId);
                goods.quick    = quick;
                goods.spec     = spec_arr;
                goods.goods_id = goodsId;
                goods.number   = number;
                goods.parent   = (typeof(parentId) == "undefined") ? 0 : parseInt(parentId);
                goods.group = group + '_' + group_item;//组名
                Ajax.call('flow.php?step=add_to_cart_combo', 'goods=' + $.toJSON(goods), ec_group_addToCartResponse, 'POST', 'JSON'); //兼容jQuery by mike
            }
            //处理添加商品到购物车的反馈信息
            function ec_group_addToCartResponse(result)
            {
                if (result.error > 0)
                {
                    // 如果需要缺货登记，跳转
                    if (result.error == 2)
                    {
                        alert(understock);
                        cancel_checkboxed(result.group, result.goods_id);//取消checkbox
                    }
                    // 没选规格，弹出属性选择框
                    else if (result.error == 6)
                    {
                        ec_group_openSpeDiv(result.message, result.group, result.goods_id, result.parent);
                    }
                    else
                    {
                        alert(result.message);
                        cancel_checkboxed(result.group, result.goods_id);//取消checkbox
                    }
                }
                else
                {
                    //处理Ajax数据
                    var group = result.group.substr(0,result.group.lastIndexOf("_"));
                    $("."+group).each(function(index){
                        if($("."+group).eq(index).val()==result.goods_id){
                            //主件显示价格、配件显示基本件+属性价
                            var goods_price = (result.parent > 0) ? (parseFloat(result.fittings_price)+parseFloat(result.spec_price)):result.goods_price;
                            $("."+group).eq(index).attr('data',goods_price);//赋值到文本框data参数
                            $("."+group).eq(index).attr('stock',result.stock);//赋值到文本框stock参数
                            $('.'+group+'_display').eq(index).text(goods_price);//前台显示
                        }
                    });
                    getMaxStock(group);//根据套餐获取该套餐允许购买的最大数
                    display_Price(group,group.charAt(group.length-1));//显示套餐价格
                }
            }
            //处理删除购物车中的商品
            function ec_group_delInCart(group,goodsId,parentId){
                var goods        = new Object();
                var group_item   = (typeof(parentId) == "undefined") ? goodsId : parseInt(parentId);
                goods.goods_id = goodsId;
                goods.parent   = (typeof(parentId) == "undefined") ? 0 : parseInt(parentId);
                goods.group = group + '_' + group_item;//组名
                Ajax.call('flow.php?step=del_in_cart_combo', 'goods=' + $.toJSON(goods), ec_group_delInCartResponse, 'POST', 'JSON'); //兼容jQuery by mike
            }
            //处理删除购物车中的商品的反馈信息
            function ec_group_delInCartResponse(result)
            {
                var group = result.group;
                if (result.error > 0){
                    alert(data_not_complete);
                }else if(result.parent == 0){
                    $('.'+group).attr("checked",false);
                }
                display_Price(group,group.charAt(group.length-1));//显示套餐价格
            }
            //生成属性选择层
            function ec_group_openSpeDiv(message, group, goods_id, parent)
            {
                var _id = "speDiv";
                var m = "mask";
                if (docEle(_id)) document.removeChild(docEle(_id));
                if (docEle(m)) document.removeChild(docEle(m));
                //计算上卷元素值
                var scrollPos;
                if (typeof window.pageYOffset != 'undefined')
                {
                    scrollPos = window.pageYOffset;
                }
                else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat')
                {
                    scrollPos = document.documentElement.scrollTop;
                }
                else if (typeof document.body != 'undefined')
                {
                    scrollPos = document.body.scrollTop;
                }
                var i = 0;
                var sel_obj = document.getElementsByTagName('select');
                while (sel_obj[i])
                {
                    sel_obj[i].style.visibility = "hidden";
                    i++;
                }
                // 新激活图层
                var newDiv = document.createElement("div");
                newDiv.id = _id;
                newDiv.style.position = "absolute";
                newDiv.style.zIndex = "10000";
                newDiv.style.width = "300px";
                newDiv.style.height = "260px";
                newDiv.style.top = (parseInt(scrollPos + 200)) + "px";
                newDiv.style.left = (parseInt(document.body.offsetWidth) - 200) / 2 + "px"; // 屏幕居中
                newDiv.style.overflow = "auto";
                newDiv.style.background = "#FFF";
                newDiv.style.border = "3px solid #59B0FF";
                newDiv.style.padding = "5px";
                //生成层内内容
                newDiv.innerHTML = '<h4 style="font-size:14; margin:15 0 0 15;">' + select_spe + "</h4>";
                for (var spec = 0; spec < message.length; spec++)
                {
                    newDiv.innerHTML += '<hr style="color: #EBEBED; height:1px;"><h6 style="text-align:left; background:#ffffff; margin-left:15px;">' +  message[spec]['name'] + '</h6>';
                    if (message[spec]['attr_type'] == 1)
                    {
                        for (var val_arr = 0; val_arr < message[spec]['values'].length; val_arr++)
                        {
                            if (val_arr == 0)
                            {
                                newDiv.innerHTML += "<input style='margin-left:15px;' type='radio' name='spec_" + message[spec]['attr_id'] + "' value='" + message[spec]['values'][val_arr]['id'] + "' id='spec_value_" + message[spec]['values'][val_arr]['id'] + "' checked /><font color=#555555>" + message[spec]['values'][val_arr]['label'] + '</font> [' + message[spec]['values'][val_arr]['format_price'] + ']</font><br />';
                            }
                            else
                            {
                                newDiv.innerHTML += "<input style='margin-left:15px;' type='radio' name='spec_" + message[spec]['attr_id'] + "' value='" + message[spec]['values'][val_arr]['id'] + "' id='spec_value_" + message[spec]['values'][val_arr]['id'] + "' /><font color=#555555>" + message[spec]['values'][val_arr]['label'] + '</font> [' + message[spec]['values'][val_arr]['format_price'] + ']</font><br />';
                            }
                        }
                        newDiv.innerHTML += "<input type='hidden' name='spec_list' value='" + val_arr + "' />";
                    }
                    else
                    {
                        for (var val_arr = 0; val_arr < message[spec]['values'].length; val_arr++)
                        {
                            newDiv.innerHTML += "<input style='margin-left:15px;' type='checkbox' name='spec_" + message[spec]['attr_id'] + "' value='" + message[spec]['values'][val_arr]['id'] + "' id='spec_value_" + message[spec]['values'][val_arr]['id'] + "' /><font color=#555555>" + message[spec]['values'][val_arr]['label'] + ' [' + message[spec]['values'][val_arr]['format_price'] + ']</font><br />';
                        }
                        newDiv.innerHTML += "<input type='hidden' name='spec_list' value='" + val_arr + "' />";
                    }
                }
                newDiv.innerHTML += "<br /><center>[<a href='javascript:ec_group_submit_div(\"" + group + "\"," + goods_id + "," + parent + ")' class='f6' >" + btn_buy + "</a>]&nbsp;&nbsp;[<a href='javascript:ec_group_cancel_div(\"" + group + "\"," + goods_id + ")' class='f6' >" + is_cancel + "</a>]</center>";
                document.body.appendChild(newDiv);
                // mask图层
                var newMask = document.createElement("div");
                newMask.id = m;
                newMask.style.position = "absolute";
                newMask.style.zIndex = "9999";
                newMask.style.width = document.body.scrollWidth + "px";
                newMask.style.height = document.body.scrollHeight + "px";
                newMask.style.top = "0px";
                newMask.style.left = "0px";
                newMask.style.background = "#FFF";
                newMask.style.filter = "alpha(opacity=30)";
                newMask.style.opacity = "0.40";
                document.body.appendChild(newMask);
            }
            //获取选择属性后，再次提交到购物车
            function ec_group_submit_div(group, goods_id, parentId)
            {
                var goods        = new Object();
                var spec_arr     = new Array();
                var fittings_arr = new Array();
                var number       = 1;
                var input_arr      = document.getElementById('speDiv').getElementsByTagName('input'); //by mike
                var quick		   = 1;
                var spec_arr = new Array();
                var j = 0;
                for (i = 0; i < input_arr.length; i ++ )
                {
                    var prefix = input_arr[i].name.substr(0, 5);
                    if (prefix == 'spec_' && (
                            ((input_arr[i].type == 'radio' || input_arr[i].type == 'checkbox') && input_arr[i].checked)))
                    {
                        spec_arr[j] = input_arr[i].value;
                        j++ ;
                    }
                }
                goods.quick    = quick;
                goods.spec     = spec_arr;
                goods.goods_id = goods_id;
                goods.number   = number;
                goods.parent   = (typeof(parentId) == "undefined") ? 0 : parseInt(parentId);
                goods.group    = group;//组名
                Ajax.call('flow.php?step=add_to_cart_combo', 'goods=' + $.toJSON(goods), ec_group_addToCartResponse, 'POST', 'JSON'); //兼容jQuery by mike
                document.body.removeChild(docEle('speDiv'));
                document.body.removeChild(docEle('mask'));
                var i = 0;
                var sel_obj = document.getElementsByTagName('select');
                while (sel_obj[i])
                {
                    sel_obj[i].style.visibility = "";
                    i++;
                }
            }
            //关闭mask和新图层的同时取消选择
            function ec_group_cancel_div(group, goods_id){
                document.body.removeChild(docEle('speDiv'));
                document.body.removeChild(docEle('mask'));
                var i = 0;
                var sel_obj = document.getElementsByTagName('select');
                while (sel_obj[i])
                {
                    sel_obj[i].style.visibility = "";
                    i++;
                }
                cancel_checkboxed(group, goods_id);//取消checkbox
            }
            
            //回调
            function addMultiToCartResponse(result){
                if(result.error > 0){
                    alert(result.message);
                }else{
                    window.location.href = 'flow.php';
                }
            }
            //取消选项
            function cancel_checkboxed(group, goods_id){
                //取消选择
                group = group.substr(0,group.lastIndexOf("_"));
                $("."+group).each(function(index){
                    if($("."+group).eq(index).val()==goods_id){
                        $("."+group).eq(index).attr("checked",false);
                    }
                });
            }
            /*
             //sleep
             function sleep(d){
             for(var t = Date.now();Date.now() - t <= d;);
             }
             */
        </script></div>
    <div class="full-screen-border"></div>
    <div class="goods-detail-main">
        <div class="goods-detail-nav" id="goodsDetail">
            <div class="container">
                <ul class="detail-list">
                    <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">详情描述</a> </li>
                    <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">规格参数</a> </li>
                    <li><a class="J_scrollHref" href="javascript:void(0);" rel="nofollow">评价晒单(<em>7</em>)</a></li>
                </ul>
            </div>
        </div>
        <div class="product_tabs">
            <div class="goods-detail-desc goods_con_item">
                <div class="container">
                    <div class="shape-container">
                        <p><img width="720" height="598" alt="" src="images/goods1.jpg" /></p>
                        <p><img width="720" height="508" alt="" src="images/goods1.jpg" /></p>
                        <p><img width="720" height="572" alt="" src="images/goods1.jpg" /></p>
                        <p><img src="images/goods1.jpg" width="1351" height="762" alt="" /></p>
                        <p><img src="images/goods1.jpg" width="1138" height="867" alt="" /></p>
                    </div>
                </div>
            </div>

            <div class="goods-detail-nav-name-block goods_con_item">
                <div class="container main-block">
                    <div class="border-line"></div>
                    <h2 class="nav-name">规格参数</h2>
                </div>
            </div>
            <div class="goods-detail-param">
                <div class="container">
                    <ul class="param-list">
                        <li class="goods-img"><img src="images/goods1.jpg" alt="小米电视2 40英寸" /></li>
                        <li class="goods-tech-spec">
                            <ul>
                                <li>产品名称：小米电视2 40英寸</li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="goods-detail-nav-name-block goods_con_item">
                <div class="container main-block">
                    <div class="border-line"></div>
                    <h2 class="nav-name">评价晒单</h2>
                </div>
            </div>
            <div class="goods-detail-comment hasContent z-com-box-head">
                <div id="ECS_COMMENT">
                    <div class="goods-detail-comment-groom" style="border-width:0 0 1px 0">
                        <div class="container">
                            <ul class="main-block clearfix">
                                <li class="percent">
                                    <div class="per-num"><i>86</i>%</div>
                                    <div class="per-title">购买后满意</div>
                                    <div class="per-amount"><i>7</i>名用户投票</div>
                                </li>
                                <li>
                                    <ul class="z-point-list" id="min_points">
                                        <li>
                                            <label>好评：</label>
                                            <p> <span style="width: 86%;"></span> </p>
                                            <em>86%</em> </li>
                                        <li>
                                            <label>中评：</label>
                                            <p> <span style="width: 14%;"></span> </p>
                                            <em>14%</em> </li>
                                        <li>
                                            <label>差评：</label>
                                            <p> <span style="width: 0%;"></span> </p>
                                            <em>14%</em> </li>
                                    </ul>
                                </li>
                                <li class="i-want-comment">
                                    <div>对自己购买过的商品进行评价，它将成为大家购买参考依据。</div>
                                    <div class="good_com_box">
                                        所有用户都可以对该商品 <a href="javascript:void(0);" onClick="commentsFrom()" id="go_com" class="btn btn-primary">我要评价</a>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="goods-detail-comment-content">
                        <div class="container">
                            <div class="row">
                                <div class="span20 goods-detail-comment-list">
                                    <div class="comment-order-title">
                                        <div class="left-title"><h3 class="comment-name">最有帮助的评价（7） </h3></div>
                                        <div class="right-title J_showImg"><i class="iconfont">√</i> 只显示带图评价</div>
                                    </div>
                                    <ul class="comment-box-list">

                                        <li class="item-rainbow-1">
                                            <div class="user-image"> <img class="face_img" src="images/goods1.jpg"> </div>
                                            <div class="user-emoj">
                                                超爱<i class="iconfont"></i>
                                            </div>
                                            <div class="user-name-info">
                                                <span class="user-name">匿名用户</span>
                                                <span class="user-time">2015-10-23 00:00:47</span>
                                                <span class="pro-info"></span>
                                            </div>
                                            <dl class="user-comment">
                                                <dt class="user-comment-content"><p class="content-detail">buc水水水水</p></dt>
                                                <dd class="user-comment-self-input hide">
                                                    <div class="input-block"><input type="text" placeholder="回复楼主" class="J_commentAnswerInput"><a href="javascript:void(0);" class="btn  answer-btn J_commentAnswerBtn">回复</a></div>
                                                </dd>
                                            </dl>
                                        </li>

                                        <li class="item-rainbow-2">
                                            <div class="user-image"> <img class="face_img" src="images/goods1.jpg"> </div>
                                            <div class="user-emoj">
                                                超爱<i class="iconfont"></i>
                                            </div>
                                            <div class="user-name-info">
                                                <span class="user-name">匿名用户</span>
                                                <span class="user-time">2015-09-08 15:00:30</span>
                                                <span class="pro-info"></span>
                                            </div>
                                            <dl class="user-comment">
                                                <dt class="user-comment-content"><p class="content-detail">收到实物后，看见耳机确实是蓝色的，有一点像小清新的天空蓝，颜色真好看，超喜欢的说≧◇≦</p></dt>
                                                <dd class="user-comment-self-input hide">
                                                    <div class="input-block"><input type="text" placeholder="回复楼主" class="J_commentAnswerInput"><a href="javascript:void(0);" class="btn  answer-btn J_commentAnswerBtn">回复</a></div>
                                                </dd>
                                            </dl>
                                        </li>
                                        <li class="pagenav">
                                            <form name="selectPageForm" action="/mishop/goods.php" method="get">
                                                <a href="javascript:;" class="step" style="border:1px solid #eee; color:#ccc;">上一页</a>
                                                <a href="javascript:;" class="step" style="border:1px solid #eee; color:#ccc;">下一页</a>

                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="z-com-box-head">

                        <div class="z-com-list" id="ECS_COMMENT">


                            <div id="compage">

                            </div>
                        </div>
                        <script type="Text/Javascript" language="JavaScript">
                            <!--

                            function selectPage(sel)
                            {
                                sel.form.submit();
                            }

                            //-->
                        </script>


                        <div id="commentsFrom">
                            <form action="javascript:;" onsubmit="submitComment(this)" method="post" name="commentForm" id="commentForm">
                                <ul class="form addr-form" id="addr-form">
                                    <span style="position:absolute; right:10px; top:5px; font-size:24px; cursor:pointer;" onClick="easyDialog.close();">×</span>
                                    <li>
                                        <label>用户名</label>
                                        匿名用户      </li>
                                    <li>
                                        <label>E-mail</label>
                                        <input type="text" name="email" id="email"  maxlength="100" value="" class="txt"/>
                                    </li>
                                    <li>
                                        <label>评价等级</label>
                                        <input name="comment_rank" type="radio" value="1" id="comment_rank1" />
                                        <img src="images/stars1.gif" />
                                        <input name="comment_rank" type="radio" value="2" id="comment_rank2" />
                                        <img src="images/stars2.gif" />
                                        <input name="comment_rank" type="radio" value="3" id="comment_rank3" />
                                        <img src="images/stars3.gif" />
                                        <input name="comment_rank" type="radio" value="4" id="comment_rank4" />
                                        <img src="images/stars4.gif" />
                                        <input name="comment_rank" type="radio" value="5" checked="checked" id="comment_rank5" />
                                        <img src="images/stars5.gif" />
                                    </li>
                                    <li>
                                        <label>评论内容</label>
                                        <textarea name="content" class="txt" style="height:80px; width:300px;"></textarea>
                                    </li>
                                    <li>
                                        <label>验证码</label>

                                        <input type="text" class="txt" name="captcha" maxlength="6">
                                        <img src="" alt="captcha" id="captcha" onClick="this.src='captcha.php?'+Math.random()" width="100" height="34" style="height:34px;" > </li>



                                    <li>
                                        <input type="hidden" name="cmt_type" value="0" />
                                        <input type="hidden" name="id" value="27" />
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input name="" type="submit"  value="提交评论" class="btn" style="border:none; height:40px; cursor:pointer; width:150px; font-size:16px;">
                                    </li>
                                </ul>
                            </form>
                        </div>



                        <script type="text/javascript">
                            //<![CDATA[
                            var cmt_empty_username = "请输入您的用户名称";
                            var cmt_empty_email = "请输入您的电子邮件地址";
                            var cmt_error_email = "电子邮件地址格式不正确";
                            var cmt_empty_content = "您没有输入评论的内容";
                            var captcha_not_null = "验证码不能为空!";
                            var cmt_invalid_comments = "无效的评论内容!";

                            /**
                             * 提交评论信息
                             */
                            function submitComment(frm)
                            {
                                var cmt = new Object;

                                //cmt.username        = frm.elements['username'].value;
                                cmt.email           = frm.elements['email'].value;
                                cmt.content         = frm.elements['content'].value;
                                cmt.type            = frm.elements['cmt_type'].value;
                                cmt.id              = frm.elements['id'].value;
                                cmt.enabled_captcha = frm.elements['enabled_captcha'] ? frm.elements['enabled_captcha'].value : '0';
                                cmt.captcha         = frm.elements['captcha'] ? frm.elements['captcha'].value : '';
                                cmt.rank            = 0;

                                for (i = 0; i < frm.elements['comment_rank'].length; i++)
                                {
                                    if (frm.elements['comment_rank'][i].checked)
                                    {
                                        cmt.rank = frm.elements['comment_rank'][i].value;
                                    }
                                }

//  if (cmt.username.length == 0)
//  {
//     alert(cmt_empty_username);
//     return false;
//  }

                                if (cmt.email.length > 0)
                                {
                                    if (!(Utils.isEmail(cmt.email)))
                                    {
                                        alert(cmt_error_email);
                                        return false;
                                    }
                                }
                                else
                                {
                                    alert(cmt_empty_email);
                                    return false;
                                }

                                if (cmt.content.length == 0)
                                {
                                    alert(cmt_empty_content);
                                    return false;
                                }

                                if (cmt.enabled_captcha > 0 && cmt.captcha.length == 0 )
                                {
                                    alert(captcha_not_null);
                                    return false;
                                }

                                Ajax.call('comment.php', 'cmt=' + $.toJSON(cmt), commentResponse, 'POST', 'JSON');
                                return false;
                            }

                            /**
                             * 处理提交评论的反馈信息
                             */
                            function commentResponse(result)
                            {
                                if (result.message)
                                {
                                    alert(result.message);
                                    document.getElementById("captcha").src='captcha.php?'+Math.random();
                                }

                                if (result.error == 0)
                                {
                                    var layer = document.getElementById('ECS_COMMENT');

                                    if (layer)
                                    {
                                        layer.innerHTML = result.content;
                                    }
                                    easyDialog.close();
                                    window.location.reload();
                                }
                            }

                            function commentsFrom(){
                                easyDialog.open({
                                    container : 'commentsFrom'
                                });
                            }

                            //]]>

                        </script></div>
                </div>
            </div>

        </div>
    </div>
    <div class="goods-sub-bar" id="goodsSubBar">
        <div class="container">
            <ul class="detail-list">
                <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">详情描述</a> </li>
                <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">规格参数</a> </li>
                <li><a class="J_scrollHref" href="javascript:void(0);" name="pjxqitem" rel="nofollow">评价晒单(<em>7</em>)</a></li>
            </ul>
            <dl class="goods-sub-bar-info clearfix">
                <dt><img src="images/goods.jpg" alt="小米电视2 40英寸" /></dt>
                <dd>
                    <strong>小米电视2 40英寸</strong>
                    <p><em>40/49/55英寸 现货购买</em></p>
                </dd>
            </dl>
            <a href="javascript:addToCart(27)" class="btn btn-primary goods-add-cart-btn"><i class="iconfont"></i> 加入购物车</a>
        </div>
    </div>
    <div class="add_ok" id="cart_show">
        <div class="tip">
            <i class="iconfont"> </i>商品已成功加入购物车
        </div>
        <div class="go">
            <a href="javascript:easyDialog.close();" class="back">&lt;&lt;继续购物</a>
            <a href="flow.php" class="btn">去结算</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    var goods_id = 27;
    var goodsattr_style = 1;
    var gmt_end_time = 0;
    var day = "天";
    var hour = "小时";
    var minute = "分钟";
    var second = "秒";
    var end = "结束";
    var goodsId = 27;
    var now_time = 1495336981;
    onload = function(){
        changePrice();
        fixpng();
        try {onload_leftTime();}
        catch (e) {}
    }
    /**
     * 点选可选属性或改变数量时修改商品价格的函数
     */
    function changePrice()
    {
    //     var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
    //     var qty = document.forms['ECS_FORMBUY'].elements['number'].value;
    //     Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
    }
    /**
     * 接收返回的信息
     */
    function changePriceResponse(res)
    {
        if (res.err_msg.length > 0)
        {
            alert(res.err_msg);
        }
        else
        {

            if (document.getElementById('ECS_SHOPPRICE'))
                document.getElementById('ECS_SHOPPRICE').innerHTML = res.result;
            if (document.getElementById('ECS_SHOPPRICE_TOP'))
                document.getElementById('ECS_SHOPPRICE_TOP').innerHTML = res.result;
            if (document.getElementById('ECS_GOODS_AMOUNT'))
                document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;

        }
    }
</script>



<!--脚部-->
@include('footer')