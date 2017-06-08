
$(document).ready(function () {
    var subtotal = 0;
    for (var i=0;i<$('.shop-list').length;i++) {
        subtotal += parseFloat($('.shop-list').eq(i).children('td').eq(2).children('.shop_price').html());
    }
    $('.subtotal').html(subtotal);//商品总价
    $('.money-box').children('ul').children('li').eq(1).children("span").html(subtotal);
    var due = parseFloat(subtotal) + 0.00;
    $('#allprice').html(due);//订单价
    if ( $("input[name='type']").val() != 'integral') {
        $('.f4_b').html(Math.round(subtotal));//可获积分
        $("input[name='get_point']").val(Math.round(subtotal));
    }
    $('#ECS_BONUS').val('');//红包恢复
    $("input[name='order_price']").val(due);
    $('.money-box').children('ul').children('li').eq(3).children("span").html('0.00');
    $("input[name='pack_price']").val('0.00');

    for (var j=0;j<$("input[name='userAddress']").length;j++) {
        if ($("input[name='userAddress']").eq(j).prop('checked') == true) {
            var obj = $("input[name='userAddress']").eq(j);
            var address_name = obj.parents('div').children('.addr-name').html();
            var address_tel = obj.parents('div').children('.addr-tel').html();
            var addrInfo = obj.parents('div').children('.addr-info').html();
            var addrInfo = addrInfo.split(" ");
            $("input[name='address_name']").val(address_name);
            $("input[name='address_tel']").val(address_tel);
            $("input[name='province']").val(addrInfo[0]);
            $("input[name='city']").val(addrInfo[1]);
            $("input[name='district']").val(addrInfo[2]);
            $("input[name='address']").val(addrInfo[3]);
        }
    }

})

$(document).on('click','#shipping-list li',function () {
    var obj = $(this);
    var shipping_money = obj.children("input[name='logistics_price']").val();
    var subtotal = $('.money-box').children('ul').children('li').eq(1).children("span").html();
    var pack_price = $('.money-box').children('ul').children('li').eq(3).children("span").html();
    var due = parseFloat(subtotal)-parseFloat(pack_price)+parseFloat(shipping_money);
    $('.money-box').children('ul').children('li').eq(2).children("span").html(shipping_money);
    $('#allprice').html(due);
    $("input[name='pack_price']").val(pack_price);
    $("input[name='order_price']").val(due);
})

$(document).on('change','#ECS_BONUS',function () {
    var ECS_BONUS = $(this).val();
    var pack_price = $(this).children('option:selected').html();
    var low_use_price = $(this).children('option:selected').attr('low_use_price');
    var pack = $('.money-box').children('ul').children('li').eq(3).children("span").html();
    if (ECS_BONUS == '') {
        $('.money-box').children('ul').children('li').eq(3).css("display","none");
        $('.money-box').children('ul').children('li').eq(3).children("span").html('0.00');
    } else {
        $('.money-box').children('ul').children('li').eq(3).css("display","block");
        $('.money-box').children('ul').children('li').eq(3).children("span").html(pack_price);
    }
    if (pack_price == '请选择') {
        pack_price = '0.00';
    }
    if (low_use_price == '') {
        low_use_price = '0.00';
    }
    $('#pack_price').html(pack_price);
    $('#low_use_price').html(low_use_price);
    var shipping_money = $('.money-box').children('ul').children('li').eq(2).children("span").html();
    var subtotal = $('.money-box').children('ul').children('li').eq(1).children("span").html();
    var allprice = parseFloat(shipping_money)-parseFloat(pack_price)+parseFloat(subtotal)> 0 ? parseFloat(shipping_money)-parseFloat(pack_price)+parseFloat(subtotal):0.00;
    $('#allprice').html(allprice);
    $("input[name='pack_price']").val(pack_price);
    $("input[name='order_price']").val(allprice);
})

$(document).on('click',"input[name='userAddress']",function () {
    var address_name = $(this).parents('div').children('.addr-name').html();
    var address_tel = $(this).parents('div').children('.addr-tel').html();
    var addrInfo = $(this).parents('div').children('.addr-info').html();
    var addrInfo = addrInfo.split(" ");
    $("input[name='address_name']").val(address_name);
    $("input[name='address_tel']").val(address_tel);
    $("input[name='province']").val(addrInfo[0]);
    $("input[name='city']").val(addrInfo[1]);
    $("input[name='district']").val(addrInfo[2]);
    $("input[name='address']").val(addrInfo[3]);
})

$(document).on('click','.logistics-price',function () {
    $(this).next('input[name="logistics_price"]').attr('checked',true);
    $("input[name='logistics_type']").val($(this).html());
})

$(document).on('click','.pay-type',function () {
    $(this).next('input[name="pay_type"]').attr('checked',true);
})

$(document).on('click','#submit',function () {
    var low_use_price = $('#low_use_price').html();
    var allprice = $('#allprice').html();
    var pack_price =  $("input[name='pack_price']").val();
//        var sku_id = '';
//        var num = '';
//        for (var i=0;i<$("input[name='sku_id']").length;i++) {
//            sku_id += ','+ $("input[name='sku_id']").eq(i).val();
//            num += ','+ $("input[name='num']").eq(i).val();
//        }
//        sku_id = sku_id.substr(1);
    if (parseFloat(allprice)+parseFloat(pack_price) < parseFloat(low_use_price)) {
        alert('该订单不能使用该红包！')
        return false;
    }
    $('#theForm').submit();
})


