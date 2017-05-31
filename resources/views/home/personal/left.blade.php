<div class="slidebar">
    <ul class="slide_item">
        <li class="item">
            <div class="root_node">
                订单中心
            </div>
            <ul>
                <li>
                    <a class="home-personal-userOrder" href="home-personal-userOrder">我的订单</a>
                    <a class="home-personal-userAddress" href="home-personal-userAddress">收货地址</a>
                </li>
            </ul> </li>
        <li class="item">
            <div class="root_node">
                会员中心
            </div>
            <ul>
                <li>
                    <a class="home-personal-index" href="home-personal-index">我的个人中心</a>
                    <a class="home-personal-userInfo" href="home-personal-userInfo">用户信息</a>
                    <a class="" href="">我的推荐</a>
                </li>
            </ul> </li>
        <li class="item">
            <div class="root_node">
                账户中心
            </div>
            <ul>
                <li>
                    <a class="home-personal-userPoin" href="home-personal-userPoint">积分管理</a>
                    <a class="" href="">我的红包</a>
                    <a class="" href="home-personal-trackingPackages">跟踪包裹</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function () {
        var URL = window.location.pathname;
        var arr = URL.split('/');
        var route = arr[arr.length-1];
        if (route == 'home-personal-index') {
            $('.home-personal-index').addClass('on').siblings().removeAttr('class','on');
        } else if (route == 'home-personal-userInfo') {
            $('.home-personal-userInfo').addClass('on').siblings().removeAttr('class','on');
        } else if (route == 'home-personal-userAddress') {
            $('.home-personal-userAddress').addClass('on').siblings().removeAttr('class','on');
        } else if (route == 'home-personal-userOrder' || route ==  'home-personal-orderDetail') {
            $('.home-personal-userOrder').addClass('on').siblings().removeAttr('class','on');
        }else if (route == 'home-personal-userPoin') {
            $('.home-personal-userPoin').addClass('on').siblings().removeAttr('class','on');
        }
    })
</script>