
//修改用户信息
$(document).on('click','#userInfoSubmit',function () {
    var username = $('#username').val();
    var tel = $('#tel').val();
    var age = $('#age').val();
    var email = $('#email').val();
    for (var i = 0;i < $("input[name='sex']").length;i ++){
        if ($("input[name='sex']").eq(i).prop('checked') == true){
            var sex = $("input[name='sex']").eq(i).val();
        }
    }
    var oldUsername = $(this).parents('tbody').attr('username');
    var oldTel = $(this).parents('tbody').attr('tel');
    var oldAge = $(this).parents('tbody').attr('age');
    var oldEmail = $(this).parents('tbody').attr('email');
    var oldSex = $(this).parents('tbody').attr('sex');
    if (username == oldUsername && tel == oldTel && age == oldAge && email == oldEmail && sex == oldSex) {
        alert('修改成功');
        return false;
    }
    $.ajax({
        type:'post',
        url:'home-personal-updateUserInfo',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        data:{username:username,tel:tel,sex:sex,age:age,email:email},
        dataType:'json',
        success:function (data) {
            alert(data['msg']);
        }
    })
})

//确认密码
$(document).on('blur','.comfirm_password',function () {
    var new_password = $('.new_password').val();
    var comfirm_password = $(this).val();
    if (comfirm_password == '') {
        $('.ts_password').html('<font color="red">确认密码不能为空<font>');

        return false;
    } else if (new_password != comfirm_password) {
        $('.ts_password').html('<font color="red">两次密码输入不相同<font>');

        return false;
    } else {
        $('.ts_password').html('<font color="#32cd32">√ <font>');
    }
})

//修改密码
$(document).on('click','#passwordSubmit',function () {
    $('.comfirm_password').trigger('blur');
    var new_password = hex_md5($('.new_password').val());
    var old_password = hex_md5($('.old_password').val());
    var comfirm_password = hex_md5($('.comfirm_password').val());
    if (new_password != comfirm_password) {
        return false;
    }
    $.ajax({
        type:'post',
        url:'home-personal-updatePassword',
        data:{new_password:new_password,old_password:old_password},
        dataType:'json',
        success:function (data) {
            alert(data['msg'])
        }
    })
})