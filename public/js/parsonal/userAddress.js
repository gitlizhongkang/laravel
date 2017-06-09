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
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        data:{parent_id:district_id},
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
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        data:{parent_id:district_id},
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
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        data:{province:province,city:city,district:district,address_name:address_name,address_tel:address_tel,address:address,is_default:is_default},
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
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        data:{id:id,province:province,city:city,district:district,address_name:address_name,address_tel:address_tel,address:address,is_default:is_default},
        dataType:'json',
        success:function (data) {
            if (data['error'] == 0) {
                alert(data['msg']);
                location.href='';
            } else {
                alert(data['msg'])
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
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data:{id:id},
            dataType:'json',
            success:function (data) {
                if(data['error'] == 0) {
                    alert(data['msg']);
                    obj.parents('form').remove();
                } else {
                    alert(data['msg']);
                }
            }
        })
})


//新增收货地址-订单页
$(document).on('click','.addUserAddress',function () {
    var obj = $(this);
    var address_name = $('#address_name').val();
    var address_tel = $('#address_tel').val();
    var province = $('.province').children('option:selected').html();;
    var city = $('.city').children('option:selected').html();;
    var district = $('.district').children('option:selected').html();;
    var address = $('#address').val();
    //获取id
    var id = obj.parents('table').attr('address_id');
    if (address_name == ''||address_tel == ''||province == ''||city == ''||district == ''||address == '') {
        alert('收货信息不能为空');
        return false;
    }
    if (confirm('需要保存收货地址吗？')){
        $.ajax({
            type:'post',
            url:'home-personal-addUserAddress',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data:{address_name:address_name,address_tel:address_tel,province:province,city:city,district:district,address:address,is_default:1},
            dataType:'json',
            success:function (data) {
                if(data['error'] == 0) {
                    alert(data['msg']);
                } else {
                    alert(data['msg']);
                }
            }
        })
    }
    var str = '<div class="section-body" style="width: 450px"><span><input type="radio" name="userAddress" checked></span><span class="addr-name"> '+address_name+' </span><span class="addr-info">'+province+' '+city+' '+district+' '+address+' </span><span class="addr-tel">'+address_tel+'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
    $('.addrss').append(str);
})

$(document).on('click','.add',function () {
    var obj = $(this);
    var status = obj.attr('status');
    if (status == 1) {
        obj.parents('li').next().css('display','block');
        obj.attr('status','2');
    } else {
        obj.parents('li').next().css('display','none');
        obj.attr('status','1');
    }
})
