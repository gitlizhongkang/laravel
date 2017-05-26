<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>商城</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/user.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/user.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.json.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="js/xiaomi_common.js"></script>
    <script type="text/javascript">
        function checkSearchForm()
        {
            if(document.getElementById('keyword').value)
            {
                return true;
            }
            else
            {
                alert("请输入搜索关键词！");
                return false;
            }
        }
    </script>
</head>
<body class="user_center">

{{--头部--}}
{{--@include('header')--}}

<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href=".">首页</a> <code>&gt;</code> 用户中心    </div>
</div>

<div class="xm-bg">
    <div id="wrapper" class="container"><div class="my_nala_main">
           {{--左侧栏--}}
            @include('home/personal/left')

            <div class="my_nala_centre ilizi_centre">
                <div class="ilizi cle">
                    <div class="box">
                        <div class="box_1">
                            <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
                                <h1>收货人信息</h1>

                                <script type="text/javascript" src="js/region.js"></script><script type="text/javascript" src="js/shopping_flow.js"></script>              <script type="text/javascript">
                                    region.isAdmin = false;
                                    var consignee_not_null = "收货人姓名不能为空！";
                                    var country_not_null = "请您选择收货人所在国家！";
                                    var province_not_null = "请您选择收货人所在省份！";
                                    var city_not_null = "请您选择收货人所在城市！";
                                    var district_not_null = "请您选择收货人所在区域！";
                                    var invalid_email = "您输入的邮件地址不是一个合法的邮件地址。";
                                    var address_not_null = "收货人的详细地址不能为空！";
                                    var tele_not_null = "电话不能为空！";
                                    var shipping_not_null = "请您选择配送方式！";
                                    var payment_not_null = "请您选择支付方式！";
                                    var goodsattr_style = "1";
                                    var tele_invaild = "电话号码不有效的号码";
                                    var zip_not_num = "邮政编码只能填写数字";
                                    var zip_not_null = "邮政编码不能为空！";
                                    var mobile_invaild = "手机号码不是合法号码";

                                    onload = function() {
                                        if (!document.all)
                                        {
                                            document.forms['theForm'].reset();
                                        }
                                    }

                                </script>
                                @foreach ($userAddressInfo as $val)
                                <form action="user.php" method="post" name="theForm" onsubmit="return false">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" address_id="{{ $val['id'] }}">
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">配送区域：</td>
                                            <td colspan="3" align="left" bgcolor="#ffffff">
                                                <select name="province" class="province">
                                                    <option value="">请选择省</option>
                                                    @foreach ($province as $v)
                                                        <option value="{{ $v['district_id'] }}" @if ($val['province'] == $v['district_name']) selected @endif >{{ $v['district_name'] }}</option>
                                                    @endforeach

                                                </select>
                                                <select name="city" class="city">
                                                    <option value="">请选择市</option>
                                                    @if ($val['city'] != '')
                                                        <option value="{{ $val['city'] }}" selected>{{ $val['city'] }}</option>
                                                    @endif
                                                </select>
                                                <select name="district" class="district" >
                                                    <option value="">请选择区</option>
                                                    @if ($val['district'] != '')
                                                        <option value="{{ $val['district'] }}" selected>{{ $val['district'] }}</option>
                                                    @endif
                                                </select>
                                                (必填) </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">收货人姓名：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg address_name" id="consignee_0" value="{{ $val['address_name'] }}" />
                                                (必填) </td>
                                            <td align="right" bgcolor="#ffffff">电话：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg address_tel" id="tel_0" value="{{ $val['address_tel'] }}" />
                                                (必填)</td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">详细地址：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg address" id="address_0" value="{{ $val['address'] }}" />
                                                (必填)</td>
                                            <td align="right" bgcolor="#ffffff">是否设为默认：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="is_default" type="checkbox" class="is_district is_default" value="1" @if ($val['is_default'] == 1) checked @endif /></td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">&nbsp;</td>
                                            <td colspan="3" align="center" bgcolor="#ffffff">
                                                <input type="submit" name="submit" class="btn btn-primary updateUserAddress" value="确认修改" />
                                                <input name="button" type="button" class="btn btn-primary delete" value="删除"/>
                                                <input type="hidden" name="act" value="act_edit_address" />
                                                <input name="address_id" type="hidden" value="31" />
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                @endforeach

                                <form action="user.php" method="post" name="theForm" onsubmit="return false">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">配送区域：</td>
                                            <td colspan="3" align="left" bgcolor="#ffffff">
                                                <select name="province" class="province">
                                                    <option value="">请选择省</option>
                                                    @foreach ($province as $v)
                                                        <option value="{{ $v['district_id'] }}" district="{{ $v['district_name'] }}">{{ $v['district_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <select name="city" class="city">
                                                    <option value="">请选择市</option>

                                                </select>
                                                <select name="district" class="district" style="display:none">
                                                    <option value="">请选择区</option>
                                                </select>
                                                (必填) </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">收货人姓名：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg" id="address_name" value="" />
                                                (必填) </td>
                                            <td align="right" bgcolor="#ffffff">电话：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" id="tel" value="" />
                                                (必填)</td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">详细地址：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" id="address" value="" />
                                                (必填)</td>
                                            <td align="right" bgcolor="#ffffff">是否设为默认：</td>
                                            <td align="left" bgcolor="#ffffff"><input name="is_default" type="checkbox" class="is_default" value="1"/></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">&nbsp;</td>
                                            <td colspan="3" align="center" bgcolor="#ffffff">
                                                <input type="submit" name="submit" class="btn btn-primary" id="addUserAddress" value="新增收货地址"/>
                                                <input type="hidden" name="act" value="act_edit_address" />
                                                <input name="address_id" type="hidden" value="" />
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="breadcrumbs"></div>
<script type="text/javascript">
    var msg_title_empty = "留言标题为空";
    var msg_content_empty = "留言内容为空";
    var msg_title_limit = "留言标题不能超过200个字";
</script>

{{--脚部--}}
{{--@include('footer')--}}

<script>
//省-市change
    $(document).on('change','.province',function () {
        var obj = $(this);
        var district_id = obj.val();
        if (district_id == '') {
            return false;
        }
        $.ajax({
            type:'post',
            url:'home-personal-getDistrict',
            data:{_token:"{{csrf_token()}}",parent_id:district_id},
            dataType:'json',
            success:function (data) {
                if (data['error'] == 0) {
                    var str = '<option value="">请选择市</option>';
                    $.each(data['data'],function (k,v) {
                        str += '<option value='+v['district_id']+'>'+v['district_name']+'</option>';
                    })
                    obj.next().html(str);
                    obj.next().next().css('display','none');
                } else {
                    alert(data['msg'])
                }
            }
        })
    })

//市-县change
    $(document).on('change','.city',function () {
        var obj = $(this);
        var district_id = obj.val();
        if (district_id == '') {
            return false;
        }
        $.ajax({
            type:'post',
            url:'home-personal-getDistrict',
            data:{_token:"{{csrf_token()}}",parent_id:district_id},
            dataType:'json',
            success:function (data) {
                if (data['error'] == 0) {
                    var str = '';
                    $.each(data['data'],function (k,v) {
                        str += '<option  name="district" value='+v['district_id']+'>'+v['district_name']+'</option>';
                    });
                    obj.next().html(str);
                    obj.next().css('display','')
                } else {
                    alert(data['msg'])
                }
            }
        })
    })

//新增收货地址
    $(document).on('click','#addUserAddress',function () {
        var obj = $(this);
        //获取省份
        var province = obj.parents('table').children('tbody').children('tr').eq(0).children('td').eq(1).children('.province').children('option:selected').html();
        //获取市
        var city = obj.parents('table').children('tbody').children('tr').eq(0).children('td').eq(1).children('.city').children('option:selected').html();
        //获取县、区
        var district = obj.parents('table').children('tbody').children('tr').eq(0).children('td').eq(1).children('.district').children('option:selected').html();
        //获取收获人姓名
        var address_name = $('#address_name').val();
        //获取收货人电话
        var address_tel = $('#tel').val();
        //获取详细地址
        var address = $('#address').val();
        if ($('#is_default').prop('checked') == true) {
            var is_default = 1;
        } else {
            var is_default = 0;
        }
        if (province == '' || city == '' || district == '') {
            alert('配送区域必填');
            return false;
        }
        if (address_name == '') {
            alert('收货人姓名必填');
            return false;
        }
        if (address_tel == '') {
            alert('收货人电话必填');
            return false;
        }
        if (address == '') {
            alert('收货人详细地址必填');
            return false;
        }
        $.ajax({
            type:'post',
            url:'home-personal-addUserAddress',
            data:{_token:"{{csrf_token()}}",province:province,city:city,district:district,address_name:address_name,address_tel:address_tel,address:address,is_default:is_default},
            dataType:'json',
            success:function (data) {
                if (data['error'] == 0) {
                    alert(data['msg']);
                    location.href="";
                } else {
                    alert(data['msg'])
                }
            }
        })
    })

    //修改收货地址
    $(document).on('click','.updateUserAddress',function () {
        var obj = $(this);
        //获取id
        var id = obj.parents('table').attr('address_id');
        //获取省份
        var province = obj.parents('table').children('tbody').children('tr').eq(0).children('td').eq(1).children('.province').children('option:selected').html();
        //获取市
        var city = obj.parents('table').children('tbody').children('tr').eq(0).children('td').eq(1).children('.city').children('option:selected').html();
        //获取县、区
        var district = obj.parents('table').children('tbody').children('tr').eq(0).children('td').eq(1).children('.district').children('option:selected').html();
        //获取收获人姓名
        var address_name = obj.parents('table').children('tbody').children('tr').eq(1).children('td').eq(1).children('.address_name').val();
        //获取收货人电话
        var address_tel = obj.parents('table').children('tbody').children('tr').eq(1).children('td').eq(3).children('.address_tel').val();
        //获取详细地址
        var address = obj.parents('table').children('tbody').children('tr').eq(2).children('td').eq(1).children('.address').val();
        if (obj.parents('table').children('tbody').children('tr').eq(2).children('td').eq(3).children('.is_default').prop('checked') == true) {
            var is_default = '1';
        } else {
            var is_default = '0';
        }
        if (province == '' || city == '' || district == '') {
            alert('配送区域必填');
            return false;
        }
        if (address_name == '') {
            alert('收货人姓名必填');
            return false;
        }
        if (address_tel == '') {
            alert('收货人电话必填');
            return false;
        }
        if (address == '') {
            alert('收货人详细地址必填');
            return false;
        }
        $.ajax({
            type:'post',
            url:'home-personal-updateUserAddress',
            data:{_token:"{{csrf_token()}}",id:id,province:province,city:city,district:district,address_name:address_name,address_tel:address_tel,address:address,is_default:is_default},
            dataType:'json',
            success:function (data) {
                if (data['error'] == 0) {
                    alert(data['msg']);
                    location.href="";
                } else {
                    alert(data['msg']);
                }
            }
        })
    })

//删除收货地址
    $(document).on('click','.delete',function () {
        var obj = $(this);
        //获取id
        var id = obj.parents('table').attr('address_id');
        if (confirm('你确认要删除该收货地址吗？'))
            $.ajax({
                type:'post',
                url:'home-personal-deleteUserAddress',
                data:{_token:"{{csrf_token()}}",id:id},
                dataType:'json',
                success:function (data) {
                    if(data['error'] == 0) {
                        alert(data['msg']);
                        location.href='';
                    } else {
                        alert(data['msg']);
                    }
                }
            })
    })
</script>