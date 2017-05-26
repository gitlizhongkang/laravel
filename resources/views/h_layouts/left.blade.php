<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>卖奶粉的</title>

<link rel="stylesheet" href="css/indexx.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/add.css" type="text/css" media="screen" />
<link rel="stylesheet" href="plug/utilLib/bootstrap.min.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/h_jquery.min.js"></script>
<script type="text/javascript" src="js/h_tendina.min.js"></script>
<script type="text/javascript" src="js/h_common.js"></script>
<script language="javascript" type="text/javascript" src="js/WdatePicker.js"></script>

</head>
<body>
    <!--顶部-->
    <div class="layout_top_header">
            <div style="float: left"><span style="font-size: 16px;line-height: 45px;padding-left: 20px;color: #8d8d8d">XXXX管理后台</h1></span></div>
            <div id="ad_setting" class="ad_setting">
                <a class="ad_setting_a" href="javascript:; ">
                    <i class="icon-user glyph-icon" style="font-size: 20px"></i>
                    <span>管理员</span>
                    <i class="icon-chevron-down glyph-icon"></i>
                </a>
                <ul class="dropdown-menu-uu" style="display: none" id="ad_setting_ul">
                    <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-user glyph-icon"></i> 个人中心 </a> </li>
                    <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-cog glyph-icon"></i> 设置 </a> </li>
                    <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-signout glyph-icon"></i> <span class="font-bold">退出</span> </a> </li>
                </ul>
            </div>
    </div>
    <!--顶部结束-->
    <!--菜单-->
    <div class="layout_left_menu">
        <ul id="menu">
            <li class="childUlLi">
               <a href="main.php"  target="menuFrame"><i class="glyph-icon icon-home"></i>首页</a>
                <ul>
                    <li><a href="user_add.html" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>用户添加</a></li>
                </ul>
            </li>
            <li class="childUlLi">
                <a href="user.html"  target="menuFrame"> <i class="glyph-icon icon-reorder"></i>成员管理</a>
                <ul>
                    <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>后台菜单管理</a></li>
                    <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>展示商品管理</a></li>
                    <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>数据管理</a></li>
                </ul>
            </li>
            <li class="childUlLi">
                <a href="role.html" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>角色管理</a>
                <ul>
                    <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>修改密码</a></li>
                    <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>帮助</a></li>
                </ul>
            </li>
            <li class="childUlLi">
                <a href="#"> <i class="glyph-icon  icon-location-arrow"></i>数据统计</a>
                <ul>
                    <li><a href="{{URL::to('/admin-count-sales')}}"><i class="glyph-icon icon-chevron-right"></i>销售金额统计</a></li>
                    <li><a href="{{URL::to('/admin-count-order')}}"><i class="glyph-icon icon-chevron-right"></i>订单统计</a></li>
                    <li><a href="{{URL::to('/admin-count-per')}}"><i class="glyph-icon icon-chevron-right"></i>人均消费统计</a></li>
                </ul>
            </li>
             <li class="childUlLi" id='a'>
                <a href="#"> <i class="glyph-icon  icon-location-arrow"></i>权限管理</a>
                <ul>
                    <li ><a href="{{URL::to('/admin-index-system')}}"><i class="glyph-icon icon-chevron-right"></i>管理员</a></li>
                    <li><a href="{{URL::to('/admin-index-login')}}"><i class="glyph-icon icon-chevron-right"></i>角色</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div id="layout_right_content" class="layout_right_content">

    <input type="hidden" id="part_name" value="<?php echo  Session::get('part_name'); ?>" >

<script type="text/javascript">
$().ready(function(){
    var part_name = $("#part_name").val();
    if (part_name == '钻石')
    {
         document.getElementById('a').style.display = 'block';
    }
    else
    {
         document.getElementById('a').style.display = 'none';
    }
})
 
</script>

 
