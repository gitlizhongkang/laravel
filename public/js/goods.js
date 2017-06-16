$(".spec_list_box .item a").click(function(){
    $(this).parents(".dd").find(".item").removeClass("selected");
    $(this).parent().addClass("selected");
    $(this).parents(".dd").find("input:radio").prop("checked",false);
    $(this).parent().find("input:radio").prop("checked",true);
    var obj =$(this);
    var goods_id = $("input[name='id']").val();
    var len =$('#choose').attr('len');
    var norms_value = '';
    for (var i = 0; i<= len-1; i++) {
        var norms = $('input[name=norms'+i+']');
        for (var j = norms.length - 1; j >= 0; j--) {
            if (norms.eq(j).prop('checked')) {
                norms_value += ',' + norms.eq(j).val();
            }
        }
    }
    norms_value = norms_value.substr(1);
    var norms_length = norms_value.split(",");
    var _token = $("input[name='_token']").val();

    if (norms_length.length < len) {
        return false;
    } else {
        $.ajax({
            type:'post',
            url:'home-goods-getSku',
            data:{
                goods_id:goods_id,
                norms_value:norms_value,
                _token:_token
            },
            dataType:'json',
            success:function(msg){
                $('#choose').attr('sku-id',msg.sku_id);
                $('#choose').attr('sku-norms',norms_value);
                $('#choose').attr('sku-num',msg.sku_num);
                $('.sku-num').html('剩余库存：'+msg.sku_num);
                $(".spec_list_box .item a").attr('rev',msg.sku_img);
                $('#choose').attr('sku-img',msg.sku_img);
                $('#ECS_SHOPPRICE').html(msg.sku_price);
            }
        })
    }
})

    //提交评价
    $(document).on('click','.addComment',function () {
        var comment_rank = $('input[ name="comment_rank"]:checked').val();
        if (comment_rank == undefined) {
            alert('评价等级不能为空！');
            return false;
        }
        $("#commentForm").ajaxForm({
            Type:'json',
            success:function(result){
                easyDialog.close();
                window.location.reload();
            }
        }).submit();
    })
//评价权限
function commentsFrom(){
    var user_id = $("input[name='uid']").val();
    var token = $("input[name='_token']").val();
    var id = $("input[name='id']").val();
    if(user_id =='') {
        if (confirm('请先登陆！')){
            location.href = "home-user-login?URL=home-goods-goodsInfo?goods_id="+id;
        } else {
            return false;
        }
    }
    $.ajax({
        type:'post',
        url:'home-user-getOrder',
        data:{_token:token,goods_id:id},
        dataType:'json',
        success:function (data) {
            if (data['error'] == 1) {
                alert(data['msg']);
            } else {
                easyDialog.open({
                    container : 'commentsFrom'
                });
            }
        }
    })
}

    $(document).on('click','.copy',function () {
        if ( $(this).prev().prev().attr('src') != '') {
            var str = '<img class="img" src="" width="100" height="100" style="display: none;margin-left: 20px" border="0"><input type="file" name="image_url[]" style="display:none;" >';
            $(this).before(str);
        }
        $(this).prev().trigger('click');
        if ($("input[name='image_url[]']").length == 4) {
            $(this).remove();
        }
    })
    //图片预览
    $(document).on('change', "input[name='image_url[]']", function () {
        var url = window.URL.createObjectURL(this.files[0]);
        if (url) {
            $(this).prev().css('display', 'inline-block');
            $(this).prev().attr('src', url);
        } else {
            $(this).remove();
            $(this).prev().remove();
        }
    });//方法结束

