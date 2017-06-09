@extends('layouts.admin-header')

@section('content')

    <!--头部-->
    <header class="navbar-wrapper">
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid cl">
                <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">后台管理</a>
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                    <ul class="cl">
                        <li class="dropDown dropDown_hover">
                            <a href="#" class="dropDown_A">{{$user->name}} <i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                                <li><a href="{{url('/admin-index-logout')}}">退出登录</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!--结束-->

    <!--侧栏-->
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            <dl id="menu-tongji">
                <dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计</dt>
                <dd>
                    <ul>
                        <li><a data-href="admin-stats-goods" data-title="商品销量" href="javascript:void(0)">商品销量</a></li>
                        <li><a data-href="admin-stats-user" data-title="用户注册量" href="javascript:void(0)">用户注册量</a></li>
                        <li><a data-href="admin-stats-order" data-title="订单成交量" href="javascript:void(0)">订单成交量</a></li>                        
                    </ul>
                </dd>
            </dl>
            <dl id="menu-product">
                <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理</dt>
                <dd>
                    <ul>
                        <li><a data-href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
                        <li><a data-href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
                        <li><a data-href="{{url('/admin-goods-listView')}}" data-title="商品管理" href="javascript:void(0)">商品管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-comments">
                <dt><i class="Hui-iconfont">&#xe622;</i> 评论管理</dt>
                <dd>
                    <ul>
                        <li><a data-href="feedback-list.html" data-title="评论列表" href="javascript:void(0)">意见反馈</a></li>
                    </ul>
                </dd>
            </dl>
            @role('admin')
            <dl id="menu-admin">
                <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理</dt>
                <dd>
                    <ul>
                        <li><a data-href="{{url('/admin-rbac-roleView')}}" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                        <li><a data-href="{{url('/admin-rbac-permissionView')}}" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
                        <li><a data-href="{{url('/admin-rbac-adminView')}}" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                    </ul>
                </dd>
            </dl>
            @endrole
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <!--侧栏结束-->

    <!--页面标签-->
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active">
                        <span title="我的桌面" data-href="welcome.html">我的桌面</span>
                        <em></em>
                    </li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="images/l.png"></iframe>
            </div>
        </div>
    </section>

    <div class="contextMenu" id="Huiadminmenu">
        <ul>
            <li id="closethis">关闭当前 </li>
            <li id="closeall">关闭全部 </li>
        </ul>
    </div>
    <!--页面标签结束-->

@endsection


