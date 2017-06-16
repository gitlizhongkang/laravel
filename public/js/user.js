<<<<<<< HEAD
/* $Id : user.js 4865 2007-01-31 14:04:10Z paulgao $ */
$(function(){
    $(".r-tab").mouseup(function(){
        $(this).addClass("r-check");
        if($(this).attr("id")=="has_login"){
            $("#login-box").css("display","block");
            $("#register-box").css("display","none");
            $(this).addClass("r-check");
            $("#no_login").removeClass("r-check");
            $("input:text,input:password").val("");
        }else{
            $(this).addClass("r-check");
            $("#has_login").removeClass("r-check");
            $("#register-box").css("display","block");
            $("#login-box").css("display","none");
        }
        $(".err_tip").html("");
        $(".labelbox").removeClass('params_error');
        $("input:text,input:password").val("");
    })

      var validate={
        usernameValidate:"false",
        telValidate:"false",
        passwordValidate:"false",
        confirmPasswordValidate:"false",
        codeValidate:"false"
        };
    //用户名
    
    $("#username").blur(function(){
        var username=$(this).val();
        var unlen = username.replace(/[^\x00-\xff]/g, "**").length;
        var obj = $(this);
        if ( username == '' )
        {
            $('#username_notice').html(msg_un_blank);
            validate.usernameValidate=false;
            return false;
        }

        if ( !chkstr( username ) )
        {
           $('#username_notice').html(msg_un_format);
            validate.usernameValidate=false;
            return false;
        }
        if ( unlen < 3 )
        {
            $('#username_notice').html(username_shorter);
            validate.usernameValidate=false;
            return false;
        }
        if ( unlen > 14 )
        {
            $('#username_notice').html(msg_un_length);
            validate.usernameValidate=false;
            return false;
        }
        var type="username";
           $.ajax({
            type:"GET",
            async:false,
            url:uniqueCheck,
            data:{
                type:type,
                value:username
            },
            dataType:"json",
            success:function(msg){
                if(msg['code']==1){
                    $("#username").parent().removeClass("params_error");
                    $("#username").parent().addClass("params_success");
                   $('#username_notice').html("<em></em>"); //zhouhuan
                    validate.usernameValidate=true;

                }else{
                    $("#username").parent().removeClass("params_success");
                    $("#username").parent().addClass("params_error");
                    $('#username_notice').html(msg_un_registered);
                    validate.usernameValidate=false;
                }
            }

          })            
  })
  $("#username").keyup(function(){
      $("#username").parent().removeClass("params_success");
      $("#username").parent().addClass("params_error");
      $('#username_notice').html(username_invalid);
  }).focus(function(){
      $(this).triggerHandler("keyup");      
  })

  //电话号码
  
    $("#tel").blur(function(){

          var tel = $(this).val();
          var  obj=$(this);
            var type="tel";
              if (tel == '')
              {
                  $('#tel_notice').html(tel_empty);
                  validate.telValidate=false;
                  return false;
              }
              else if (!Utils.isTel(tel))
              {
                  $('#tel_notice').html(tel_msg);
                  validate.telValidate=false;
                  return false;
              }

              $.ajax({
                  type:"GET",
                  async:false,
                  url:uniqueCheck,
                  data:{
                      type:type,
                      value:tel
                  },
                  dataType:"json",

                  success:function(msg){
                      if(msg['code']==1)
                      {
                          $("#tel").parent().removeClass("params_error");
                          $("#tel").parent().addClass("params_success");
                          $('#tel_notice').html("<em></em>"); //zhouhuan
                          validate.telValidate=true;

                      }else
                      {
                          $("#tel").parent().removeClass("params_success");
                          $("#tel").parent().addClass("params_error");
                          $('#tel_notice').html(tel_registered);
                          validate.telValidate=false;
                      }
                  }
              });
    })

    $("#tel").keyup(function(){
       $("#tel").parent().removeClass("params_success");
        $("#tel").parent().addClass("params_error");
        $('#tel_notice').html("完成验证后，你可以找回登录密码");
    }).focus(function(){
      $(this).triggerHandler("keyup");      
    })

    // 密码
     
    $("#password1").blur(function(){
        var password=$(this).val();
        if ( password.length < 6 )
        {
            $(this).parent().removeClass("params_success");
            $(this).parent().addClass("params_error");
            $('#password_notice').html(password_shorter) ;
            validate.passwordValidate=false;
            return false;
        }
        else
        {
            $(this).parent().removeClass("params_error");
            $(this).parent().addClass("params_success");
            $('#password_notice').html("<em></em>");//zhouhuan
            validate.passwordValidate=true;
            return true;
        }
    }).keyup(function(){
      $(this).triggerHandler("blur");
    }).focus(function(){
      $(this).triggerHandler("blur");      
    })

    // 确认密码
     
    $("#conform_password").blur(function(){
       var  password =$('#password1').val();
       var conform_password=$(this).val();
        if ( conform_password.length < 6 )
        {
            $(this).parent().removeClass("params_success");
            $(this).parent().addClass("params_error");
            $('#conform_password_notice').html(password_shorter);
            validate.confirmPasswordValidate=false;
            return false;
        }
        if ( conform_password != password )
        {
            $(this).parent().removeClass("params_success");
            $(this).parent().addClass("params_error");
            $('#conform_password_notice').html(confirm_password_invalid);
            validate.confirmPasswordValidate=false;
            return false;
        }
        else
        {
            $(this).parent().removeClass("params_error");
            $(this).parent().addClass("params_success");
            $('#conform_password_notice').html("<em></em>"); //zhouhuan
            validate.confirmPasswordValidate=true;
            return true;
        }
    }).keyup(function(){
      $(this).triggerHandler("blur");
    }).focus(function(){
      $(this).triggerHandler("blur");      
    })

    // 验证码
    // 
    $("#code").blur(function(){
      var code=$(this).val();
      var obj = $(this);
      if (code == '')
      {
          $('#code_notice').html(msg_code_blank);
          validate.codeValidate=false;
          return false;
      }
        $.ajax({
          type:"GET",
          url:codeCheck,
          async:false,
          data:{
              code:code
          },
          dataType:"json",
          success:function(msg){
              if(msg['code']==1){
                  $("#code").parent().removeClass("params_error");
                  $("#code").parent().addClass("params_success");
                  $('#code_notice').html("<em></em>"); //zhouhuan
                  validate.codeValidate=true;
              }else{
                  $("#code").parent().removeClass("params_success");
                  $("#code").parent().addClass("params_error");
                  $('#code_notice').html(msg_code);
                  $("#codeImg").triggerHandler("click");
                 validate.codeValidate=false;

              }
          }

        })     
    })

    $("#code").focus(function(){
       $("#code").parent().removeClass("params_success");
       $("#code").parent().addClass("params_error");
       $('#code_notice').html("看不清点击图片即可更换验证码");
    })
       //发送短信验证码
    $(".getCode").mousedown(function(){
          var countdown = 120;
          var _this = $(this);
          $("#tel").trigger("blur");
          $("#code").trigger("blur"); 
         if(validate.telValidate && validate.codeValidate){ 
              //设置button效果，开始计时
              _this.attr("disabled", "true");
              _this.html(countdown + "秒后重新获取");
              //启动计时器，1秒执行一次
              var timer = setInterval(function(){
                  if (countdown == 0) {
                      clearInterval(timer);//停止计时器
                      _this.removeAttr("disabled");//启用按钮
                      _this.html("重新发送验证码");
                  }
                  else {
                      countdown--;
                      _this.html(countdown + "秒后重新获取");
                  }
              }, 1000);
              $.ajax({
                  type : 'GET',
                  url : sendUrl,
                  async: false,
                  data : {'tel':$("#tel").val()},
                  dataType : 'json',  
                  success : function(msg) {
                      if(msg['code']==1){   
                            $('#mobilecode_notice').html(msg['msg']); 
                            validate.codeValidate=true;
                      }else if(msg['code']==2){                           
                             $('#mobilecode_notice').html(msg['msg']); 
                             validate.codeValidate=true;
                      }else{            
                            $('#mobilecode_notice').html("短信发送失败"); 
                            validate.codeValidate=false;
                      }
                  }
              });      
        }    
    });

  
  
// 表单提交
    $("form[name='formUser']").submit(function(){
        var obj=$(this);
         var mobileCode=$("#mobileCode").val();
         if($("input[name='agreement']").prop("checked") == false)
        {
          alert("请选择用户协议");
            return false;
        }
          if(mobileCode==''){
            $("#mobileCode").parent().removeClass("params_success");
            $("#mobileCode").parent().addClass("params_error");
            $('#mobilecode_notice').html("手机验证码非空");
            return false;
          }
        
        $("#username").trigger("blur");
        $("#tel").trigger("blur");
        $("#password1").trigger("blur") ;
        $("#conform_password").trigger("blur");
        $("#code").trigger("blur") ;
        if(validate.usernameValidate  && validate.telValidate && validate.passwordValidate && validate.confirmPasswordValidate && validate.codeValidate )
        {
         
          var tel=$("#tel").val();
          var validateMobile=false;
          $.ajax({
              type:"GET",
              url:mobileCheck,
              async:false,
              data:{
                  tel:tel,
                  mobileCode:mobileCode
              },
              dataType:"json",
              success:function(msg){
                  if(msg['code']==1){
                     return validateMobile=true;
                  }else{
                      $("#mobileCode").parent().removeClass("params_success");
                      $("#mobileCode").parent().addClass("params_error");
                      $('#mobilecode_notice').html(msg_code);
                      $("#codeImg").triggerHandler("click");
                  }
              }
          })

            return validateMobile;
        }else {
            return false;
        }

    })
})

/* *
 * 修改会员信息
 */
function userEdit()
{
  var frm = document.forms['formEdit'];
  var email = frm.elements['email'].value;
  var msg = '';
  var reg = null;
  var passwd_answer = frm.elements['passwd_answer'] ? Utils.trim(frm.elements['passwd_answer'].value) : '';
  var sel_question =  frm.elements['sel_question'] ? Utils.trim(frm.elements['sel_question'].value) : '';

  if (email.length == 0)
  {
    msg += email_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      msg += email_error + '\n';
    }
  }

  if (passwd_answer.length > 0 && sel_question == 0 || document.getElementById('passwd_quesetion') && passwd_answer.length == 0)
  {
    msg += no_select_question + '\n';
  }

  for (i = 7; i < frm.elements.length - 2; i++)	// 从第七项开始循环检查是否为必填项
  {
	needinput = document.getElementById(frm.elements[i].name + 'i') ? document.getElementById(frm.elements[i].name + 'i') : '';

	if (needinput != '' && frm.elements[i].value.length == 0)
	{
	  msg += '- ' + needinput.innerHTML + msg_blank + '\n';
	}
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* 会员修改密码 */
function editPassword()
{
  var frm              = document.forms['formPassword'];
  var old_password     = frm.elements['old_password'].value;
  var new_password     = frm.elements['new_password'].value;
  var confirm_password = frm.elements['comfirm_password'].value;

  var msg = '';
  var reg = null;

  if (old_password.length == 0)
  {
    msg += old_password_empty + '\n';
  }

  if (new_password.length == 0)
  {
    msg += new_password_empty + '\n';
  }

  if (confirm_password.length == 0)
  {
    msg += confirm_password_empty + '\n';
  }

  if (new_password.length > 0 && confirm_password.length > 0)
  {
    if (new_password != confirm_password)
    {
      msg += both_password_error + '\n';
    }
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * 对会员的留言输入作处理
 */
function submitMsg()
{
  var frm         = document.forms['formMsg'];
  var msg_title   = frm.elements['msg_title'].value;
  var msg_content = frm.elements['msg_content'].value;
  var msg = '';

  if (msg_title.length == 0)
  {
    msg += msg_title_empty + '\n';
  }
  if (msg_content.length == 0)
  {
    msg += msg_content_empty + '\n'
  }

  if (msg_title.length > 200)
  {
    msg += msg_title_limit + '\n';
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * 会员找回密码时，对输入作处理
 */
function submitPwdInfo()
{
  var frm = document.forms['getPassword'];
  var user_name = frm.elements['user_name'].value;
  var email     = frm.elements['email'].value;
  var errorMsg = '';
  if (user_name.length == 0)
  {
    errorMsg += user_name_empty + '\n';
  }

  if (email.length == 0)
  {
    errorMsg += email_address_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      errorMsg += email_address_error + '\n';
    }
  }

  if (errorMsg.length > 0)
  {
    alert(errorMsg);
    return false;
  }
          $.ajax({
              type:"post",
              url:getPassword,
              headers: {
                  'X-CSRF-TOKEN': $('input[name="_token"]').val()
              },
              data:$("#getPassword").serialize(),
              dataType:"json",
              async:false,
              success:function(msg){
                  if(msg['code']==1){
                      alert("发送邮件成功请查收重置密码");
                  }else{
                      alert(msg['msg']);
                  }
              }
          })
          return false;
}

/* *
 * 会员找回密码时，对输入作处理
 */
function submitPwd()
{
  var frm = document.forms['resetPassword'];
  var password = frm.elements['new_password'].value;
  var confirm_password = frm.elements['confirm_password'].value;

  var errorMsg = '';
  if (password.length == 0 || password.length<6)
  {
    errorMsg += new_password_empty + '\n';
  }

  if (confirm_password.length == 0)
  {
    errorMsg += confirm_password_empty + '\n';
  }

  if (confirm_password != password)
  {
    errorMsg += both_password_error + '\n';
  }

  if (errorMsg.length > 0)
  {
    alert(errorMsg);
    return false;
  }
  else
  {
      $("#new_password,#confirm_password").val($.md5(password));
      $.ajax({
          type:"POST",
          url:resetPassword,
          headers: {
              'X-CSRF-TOKEN': $('input[name="_token"]').val()
          },
          data:$("form[name='resetPassword']").serialize(),
          dataType:"json",
          async:false,
          success:function(msg){
              if(msg['code']==1){
                  alert(msg['msg']);
                  window.location.href=loginUrl;
              }else{
                  alert(msg['msg']);
              }
          }
      })
      return false;
  }
}

/* *
 * 处理会员提交的缺货登记
 */
function addBooking()
{
  var frm  = document.forms['formBooking'];
  var goods_id = frm.elements['id'].value;
  var rec_id  = frm.elements['rec_id'].value;
  var number  = frm.elements['number'].value;
  var desc  = frm.elements['desc'].value;
  var linkman  = frm.elements['linkman'].value;
  var email  = frm.elements['email'].value;
  var tel  = frm.elements['tel'].value;
  var msg = "";

  if (number.length == 0)
  {
    msg += booking_amount_empty + '\n';
  }
  else
  {
    var reg = /^[0-9]+/;
    if ( ! reg.test(number))
    {
      msg += booking_amount_error + '\n';
    }
  }

  if (desc.length == 0)
  {
    msg += describe_empty + '\n';
  }

  if (linkman.length == 0)
  {
    msg += contact_username_empty + '\n';
  }

  if (email.length == 0)
  {
    msg += email_empty + '\n';
  }
  else
  {
    if ( ! (Utils.isEmail(email)))
    {
      msg += email_error + '\n';
    }
  }

  if (tel.length == 0)
  {
    msg += contact_phone_empty + '\n';
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }

  return true;
}

/* *
 * 会员登录
 */
function userLogin()
{
  var  username= $("#formLogin input[name='username']");
  var  password  = $("#formLogin input[name='password']");
  var  URL  = $("#formLogin input[name='URL']").val();
  var frm      = document.forms['formLogin'];

  var msg = '';
  if (username.val().length == 0)
  {
     msg += username_empty + '\n';
    username.focus();
  }

  if (password.val().length == 0)
  {
    msg += password_empty + '\n';
    password.focus();
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
      password.val($.md5(password.val()));
    $.ajax({
      type:"post",
      url:loginCheck,
      headers: {
      'X-CSRF-TOKEN': $('input[name="_token"]').val()
      },
      data:$("#formLogin").serialize(),
      dataType:"json",
      async:false,
      success:function(msg){
            if(msg['code']==1){
                alert(msg['msg']);
                if (URL == ""){
                    window.location.href=indexUrl;
                } else {
                    window.location.href=URL;
                }
            }else{
                alert(msg['msg']);
            }
      }
    })
    return false;
  }
}

function chkstr(str)
{
  for (var i = 0; i < str.length; i++)
  {
    if (str.charCodeAt(i) < 127 && !str.substr(i,1).match(/^\w+$/ig))
    {
      return false;
    }
  }
  return true;
}
//密码大写输入提示
// function capitalTip(id){
//     $('#' + id).after('<div class="capslock" id="capital_'+id+'"><span>大写锁定已开启</span></div>');
//     var capital = false; //聚焦初始化，防止刚聚焦时点击Caps按键提示信息显隐错误
//     $('#capital_'+id).hide();
//     // 获取大写提示的标签，并提供大写提示显示隐藏的调用接口
//     var capitalTip = {
//         $elem: $('#capital_'+id),
//         toggle: function (s) {
//             if(s === 'none'){
//                 this.$elem.hide();
//             }else if(s === 'block'){
//                 this.$elem.show();
//             }else if(this.$elem.is(':hidden')){
//                 this.$elem.show();
//             }else{
//                 this.$elem.hide();
//             }
//         }
//     }
//     $('#' + id).on('keydown.caps',function(e){
//         if (e.keyCode === 20 && capital) { // 点击Caps大写提示显隐切换
//             capitalTip.toggle();
//         }
//     }).on('focus.caps',function(){capital = false}).on('keypress.caps',function(e){capsLock(e)}).on('blur.caps',function(e){

//         //输入框失去焦点，提示隐藏
//         capitalTip.toggle('none');
//     });
//     function capsLock(e){
//         var keyCode = e.keyCode || e.which;// 按键的keyCode
//         var isShift = e.shiftKey || keyCode === 16 || false;// shift键是否按住
//         if(keyCode === 9){
//             capitalTip.toggle('none');
//         }else{
//             //指定位置的字符的 Unicode 编码 , 通过与shift键对于的keycode，就可以判断capslock是否开启了
//             // 90 Caps Lock 打开，且没有按住shift键
//             if (((keyCode >= 65 && keyCode <= 90) && !isShift) || ((keyCode >= 97 && keyCode <= 122) && isShift)) {
//                 // 122 Caps Lock打开，且按住shift键
//                 capitalTip.toggle('block'); // 大写开启时弹出提示框
//                 capital = true;
//             } else {
//                 capitalTip.toggle('none');
//                 capital = true;
//             }
//         }
//     }
// };

function check_password( password )
{
    if ( password.length < 6 )
    {
		$("#password1").parent().removeClass("params_success");
		$("#password1").parent().addClass("params_error");
		
        document.getElementById('password_notice').innerHTML = password_shorter;
        validate.passwordValidate=false;
        return false;
    }
    else
    {
		$("#password1").parent().removeClass("params_error");
		$("#password1").parent().addClass("params_success");

        document.getElementById('password_notice').innerHTML = "<em></em>";//zhouhuan
        validate.passwordValidate=true;
        return true;
    }
}

function check_conform_password( conform_password )
{
    password = document.getElementById('password1').value;
    if ( conform_password.length < 6 )
    {
		$("#conform_password").parent().removeClass("params_success");
		$("#conform_password").parent().addClass("params_error");
        document.getElementById('conform_password_notice').innerHTML = password_shorter;
        validate.confirmPasswordValidate=false;
        return false;
    }
    if ( conform_password != password )
    {
		$("#conform_password").parent().removeClass("params_success");
		$("#conform_password").parent().addClass("params_error");
        document.getElementById('conform_password_notice').innerHTML = confirm_password_invalid;
        validate.confirmPasswordValidate=false;
        return false;
    }
    else
    {
		$("#conform_password").parent().removeClass("params_error");
		$("#conform_password").parent().addClass("params_success");
        document.getElementById('conform_password_notice').innerHTML = "<em></em>"; //zhouhuan
        validate.confirmPasswordValidate=true;
        return true;
    }
}

function is_registered( username )
{
	var unlen = username.replace(/[^\x00-\xff]/g, "**").length;

    if ( username == '' )
    {
        document.getElementById('username_notice').innerHTML = msg_un_blank;
        validate.usernameValidate=false;
        return false;
    }

    if ( !chkstr( username ) )
    {
        document.getElementById('username_notice').innerHTML = msg_un_format;
        validate.usernameValidate=false;
        return false;
    }
    if ( unlen < 3 )
    { 
        document.getElementById('username_notice').innerHTML = username_shorter;
        validate.usernameValidate=false;
        return false;
    }
    if ( unlen > 14 )
    {
        document.getElementById('username_notice').innerHTML = msg_un_length;
        validate.usernameValidate=false;
        return false;
    }
    var type="username";
    $.ajax({
                type:"GET",
                url:uniqueCheck,
                async:false,
                data:{
                    type:type,
                    value:username
                },
                dataType:"json",
                error:function () {
                    alert("连接失败");return false;
                },
                success:function(msg){
                    if(msg['code']==1){
                        $("#username").parent().removeClass("params_error");
                        $("#username").parent().addClass("params_success");
                        document.getElementById('username_notice').innerHTML = "<em></em>"; //zhouhuan
                        validate.usernameValidate=true;

                    }else{
                        $("#username").parent().removeClass("params_success");
                        $("#username").parent().addClass("params_error");
                        document.getElementById('username_notice').innerHTML = msg_un_registered;
                        validate.usernameValidate=false;

                    }
                }
    })
    return validate.usernameValidate;
    //Ajax.call( uniqueCheck, "type=username&value=" + username, registed_callback , 'GET', 'Json', true, true );
}


function checkEmail(email)
{
  if (email == '')
  {
    document.getElementById('email_notice').innerHTML = msg_email_blank;
      validate.emailValidate=false;
      return false;
  }
  else if (!Utils.isEmail(email))
  {
    document.getElementById('email_notice').innerHTML = msg_email_format;
      validate.emailValidate=false;
      return false;
  }
    var type="email";
    $.ajax({
        type:"GET",
        url:uniqueCheck,
        async:false,
        data:{
            type:type,
            value:email
        },
        dataType:"json",
        error:function () {
            alert("连接失败");return false;
        },
        success:function(msg){
            if(msg['code']==1){
                $("#email").parent().removeClass("params_error");
                $("#email").parent().addClass("params_success");
                document.getElementById('email_notice').innerHTML = "<em></em>"; //zhouhuan
                validate.emailValidate=true;

            }else{
                $("#email").parent().removeClass("params_success");
                $("#email").parent().addClass("params_error");
                document.getElementById('email_notice').innerHTML = msg_email_registered;
                validate.emailValidate=false;

            }
        }
    })
    return validate.emailValidate;
  //Ajax.call(uniqueCheck, "type=email&value=" + email, check_email_callback , 'GET', 'json', true, true );
}
function check_code(code)
{
    if (code == '')
    {
        document.getElementById('code_notice').innerHTML = msg_code_blank;
        validate.codeValidate=false;
        return false;
    }
    $.ajax({
        type:"GET",
        url:codeCheck,
        async:false,
        data:{
            code:code
        },
        dataType:"json",
        error:function () {
            alert("连接失败");return false;
        },
        success:function(msg){
            if(msg['code']==1){
                $("#code").parent().removeClass("params_error");
                $("#code").parent().addClass("params_success");
                document.getElementById('code_notice').innerHTML = "<em></em>"; //zhouhuan
                validate.codeValidate=true;

            }else{
                $("#code").parent().removeClass("params_success");
                $("#code").parent().addClass("params_error");
                document.getElementById('code_notice').innerHTML = msg_code;
                validate.codeValidate=false;

            }
        }
    })
    return  validate.codeValidate;
    //Ajax.call( codeCheck, 'code=' + code, check_code_callback , 'GET', 'json', true, true );
}
// function check_code_callback(result)
// {
//     if ( result['code'] == 1 )
//     {
//         $("#code").parent().removeClass("params_error");
//         $("#code").parent().addClass("params_success");
//         document.getElementById('code_notice').innerHTML = "<em></em>"; //zhouhuan
//         validate.codeValidate=true;
//         return true;
//     }
//     else
//     {
//         $("#code").parent().removeClass("params_success");
//         $("#code").parent().addClass("params_error");
//         document.getElementById('code_notice').innerHTML = msg_code;
//         validate.codeValidate=false;
//         return false;
//     }
// }

function checkTel(tel)
{
    if (tel == '')
    {
        document.getElementById('tel_notice').innerHTML = tel_empty;
        validate.telValidate=false;
        return false;
    }
    else if (!Utils.isTel(tel))
    {
        document.getElementById('tel_notice').innerHTML = tel_msg;
        validate.telValidate=false;
        return false;
    }
    var type="tel";
    $.ajax({
        type:"GET",
        url:uniqueCheck,
        async:false,
        data:{
            type:type,
            value:tel
        },
        dataType:"json",
        error:function () {
            alert("连接失败");return false;
        },
        success:function(msg){
            if(msg['code']==1){
                $("#tel").parent().removeClass("params_error");
                $("#tel").parent().addClass("params_success");
                document.getElementById('tel_notice').innerHTML = "<em></em>"; //zhouhuan
                validate.telValidate=true;

            }else{
                $("#tel").parent().removeClass("params_success");
                $("#tel").parent().addClass("params_error");
                document.getElementById('tel_notice').innerHTML = tel_registered;
                validate.telValidate=false;

            }
        }
    })
    return validate.telValidate;
    //Ajax.call( uniqueCheck, "type=tel&value=" + tel, check_tel_callback , 'GET', 'json', true, true );
}

// function check_tel_callback(result)
// {
//     if ( result['code'] == 1 )
//     {
//         $("#tel").parent().removeClass("params_error");
//         $("#tel").parent().addClass("params_success");
//         document.getElementById('tel_notice').innerHTML = "<em></em>"; //zhouhuan
//         validate.telValidate=true;
//         return true;
//     }
//     else
//     {
//         $("#tel").parent().removeClass("params_success");
//         $("#tel").parent().addClass("params_error");
//         document.getElementById('tel_notice').innerHTML = tel_registered;
//         validate.telValidate=false;
//         return false;
//     }
// }

/* *
 * 用户中心订单保存地址信息
 */
function saveOrderAddress(id)
{
  var frm           = document.forms['formAddress'];
  var consignee     = frm.elements['consignee'].value;
  var email         = frm.elements['email'].value;
  var address       = frm.elements['address'].value;
  var zipcode       = frm.elements['zipcode'].value;
  var tel           = frm.elements['tel'].value;
  var mobile        = frm.elements['mobile'].value;
  var sign_building = frm.elements['sign_building'].value;
  var best_time     = frm.elements['best_time'].value;

  if (id == 0)
  {
    alert(current_ss_not_unshipped);
    return false;
  }
  var msg = '';
  if (address.length == 0)
  {
    msg += address_name_not_null + "\n";
  }
  if (consignee.length == 0)
  {
    msg += consignee_not_null + "\n";
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * 会员余额申请
 */
function submitSurplus()
{
  var frm            = document.forms['formSurplus'];
  var surplus_type   = frm.elements['surplus_type'].value;
  var surplus_amount = frm.elements['amount'].value;
  var process_notic  = frm.elements['user_note'].value;
  var payment_id     = 0;
  var msg = '';

  if (surplus_amount.length == 0 )
  {
    msg += surplus_amount_empty + "\n";
  }
  else
  {
    var reg = /^[\.0-9]+/;
    if ( ! reg.test(surplus_amount))
    {
      msg += surplus_amount_error + '\n';
    }
  }

  if (process_notic.length == 0)
  {
    msg += process_desc + "\n";
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }

  if (surplus_type == 0)
  {
    for (i = 0; i < frm.elements.length ; i ++)
    {
      if (frm.elements[i].name=="payment_id" && frm.elements[i].checked)
      {
        payment_id = frm.elements[i].value;
        break;
      }
    }

    if (payment_id == 0)
    {
      alert(payment_empty);
      return false;
    }
  }

  return true;
}

/* *
 *  处理用户添加一个红包
 */
function addBonus()
{
  var frm      = document.forms['addBouns'];
  var bonus_sn = frm.elements['bonus_sn'].value;

  if (bonus_sn.length == 0)
  {
    alert(bonus_sn_empty);
    return false;
  }
  else
  {
    var reg = /^[0-9]{10}$/;
    if ( ! reg.test(bonus_sn))
    {
      alert(bonus_sn_error);
      return false;
    }
  }

  return true;
}

/* *
 *  合并订单检查
 */
function mergeOrder()
{
  if (!confirm(confirm_merge))
  {
    return false;
  }

  var frm        = document.forms['formOrder'];
  var from_order = frm.elements['from_order'].value;
  var to_order   = frm.elements['to_order'].value;
  var msg = '';

  if (from_order == 0)
  {
    msg += from_order_empty + '\n';
  }
  if (to_order == 0)
  {
    msg += to_order_empty + '\n';
  }
  else if (to_order == from_order)
  {
    msg += order_same + '\n';
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

/* *
 * 订单中的商品返回购物车
 * @param       int     orderId     订单号
 */
function returnToCart(orderId)
{
  Ajax.call('user.php?act=return_to_cart', 'order_id=' + orderId, returnToCartResponse, 'POST', 'JSON');
}

function returnToCartResponse(result)
{
  alert(result.message);
}

/* *
 * 检测密码强度
 * @param       string     pwd     密码
 */
function checkIntensity(pwd)
{
  var Mcolor = "#FFF",Lcolor = "#FFF",Hcolor = "#FFF";
  var m=0;

  var Modes = 0;
  for (i=0; i<pwd.length; i++)
  {
    var charType = 0;
    var t = pwd.charCodeAt(i);
    if (t>=48 && t <=57)
    {
      charType = 1;
    }
    else if (t>=65 && t <=90)
    {
      charType = 2;
    }
    else if (t>=97 && t <=122)
      charType = 4;
    else
      charType = 4;
    Modes |= charType;
  }

  for (i=0;i<4;i++)
  {
    if (Modes & 1) m++;
      Modes>>>=1;
  }

  if (pwd.length<=4)
  {
    m = 1;
  }

  switch(m)
  {
    case 1 :
      Lcolor = "2px solid red";
      Mcolor = Hcolor = "2px solid #DADADA";
    break;
    case 2 :
      Mcolor = "2px solid #f90";
      Lcolor = Hcolor = "2px solid #DADADA";
    break;
    case 3 :
      Hcolor = "2px solid #3c0";
      Lcolor = Mcolor = "2px solid #DADADA";
    break;
    case 4 :
      Hcolor = "2px solid #3c0";
      Lcolor = Mcolor = "2px solid #DADADA";
    break;
    default :
      Hcolor = Mcolor = Lcolor = "";
    break;
  }
  if (document.getElementById("pwd_lower"))
  {
    document.getElementById("pwd_lower").style.borderBottom  = Lcolor;
    document.getElementById("pwd_middle").style.borderBottom = Mcolor;
    document.getElementById("pwd_high").style.borderBottom   = Hcolor;
  }


}

function changeType(obj)
{
  if (obj.getAttribute("min") && document.getElementById("ECS_AMOUNT"))
  {
    document.getElementById("ECS_AMOUNT").disabled = false;
    document.getElementById("ECS_AMOUNT").value = obj.getAttribute("min");
    if (document.getElementById("ECS_NOTICE") && obj.getAttribute("to") && obj.getAttribute('fee'))
    {
      var fee = parseInt(obj.getAttribute("fee"));
      var to = parseInt(obj.getAttribute("to"));
      if (fee < 0)
      {
        to = to + fee * 2;
      }
      document.getElementById("ECS_NOTICE").innerHTML = notice_result + to;
    }
  }
}

function calResult()
{
  var amount = document.getElementById("ECS_AMOUNT").value;
  var notice = document.getElementById("ECS_NOTICE");

  reg = /^\d+$/;
  if (!reg.test(amount))
  {
    notice.innerHTML = notice_not_int;
    return;
  }
  amount = parseInt(amount);
  var frm = document.forms['transform'];
  for(i=0; i < frm.elements['type'].length; i++)
  {
    if (frm.elements['type'][i].checked)
    {
      var min = parseInt(frm.elements['type'][i].getAttribute("min"));
      var to = parseInt(frm.elements['type'][i].getAttribute("to"));
      var fee = parseInt(frm.elements['type'][i].getAttribute("fee"));
      var result = 0;
      if (amount < min)
      {
        notice.innerHTML = notice_overflow + min;
        return;
      }

      if (fee > 0)
      {
        result = (amount - fee) * to / (min -fee);
      }
      else
      {
        //result = (amount + fee* min /(to+fee)) * (to + fee) / min ;
        result = amount * (to + fee) / min + fee;
      }

      notice.innerHTML = notice_result + parseInt(result + 0.5);
    }
  }
}
=======
$(function(){$(".r-tab").mouseup(function(){$(this).addClass("r-check");if($(this).attr("id")=="has_login"){$("#login-box").css("display","block");$("#register-box").css("display","none");$(this).addClass("r-check");$("#no_login").removeClass("r-check");$("input:text,input:password").val("")}else{$(this).addClass("r-check");$("#has_login").removeClass("r-check");$("#register-box").css("display","block");$("#login-box").css("display","none")}$(".err_tip").html("");$(".labelbox").removeClass("params_error");$("input:text,input:password").val("")});var A={usernameValidate:"false",telValidate:"false",passwordValidate:"false",confirmPasswordValidate:"false",codeValidate:"false"};$("#username").blur(function(){var C=$(this).val();var E=C.replace(/[^\x00-\xff]/g,"**").length;var D=$(this);if(C==""){$("#username_notice").html(msg_un_blank);A.usernameValidate=false;return false}if(!chkstr(C)){$("#username_notice").html(msg_un_format);A.usernameValidate=false;return false}if(E<3){$("#username_notice").html(username_shorter);A.usernameValidate=false;return false}if(E>14){$("#username_notice").html(msg_un_length);A.usernameValidate=false;return false}var B="username";$.ajax({type:"GET",async:false,url:uniqueCheck,data:{type:B,value:C},dataType:"json",success:function(F){if(F["code"]==1){$("#username").parent().removeClass("params_error");$("#username").parent().addClass("params_success");$("#username_notice").html("<em></em>");A.usernameValidate=true}else{$("#username").parent().removeClass("params_success");$("#username").parent().addClass("params_error");$("#username_notice").html(msg_un_registered);A.usernameValidate=false}}})});$("#username").keyup(function(){$("#username").parent().removeClass("params_success");$("#username").parent().addClass("params_error");$("#username_notice").html(username_invalid)}).focus(function(){$(this).triggerHandler("keyup")});$("#tel").blur(function(){var D=$(this).val();var C=$(this);var B="tel";if(D==""){$("#tel_notice").html(tel_empty);A.telValidate=false;return false}else{if(!Utils.isTel(D)){$("#tel_notice").html(tel_msg);A.telValidate=false;return false}}$.ajax({type:"GET",async:false,url:uniqueCheck,data:{type:B,value:D},dataType:"json",success:function(E){if(E["code"]==1){$("#tel").parent().removeClass("params_error");$("#tel").parent().addClass("params_success");$("#tel_notice").html("<em></em>");A.telValidate=true}else{$("#tel").parent().removeClass("params_success");$("#tel").parent().addClass("params_error");$("#tel_notice").html(tel_registered);A.telValidate=false}}})});$("#tel").keyup(function(){$("#tel").parent().removeClass("params_success");$("#tel").parent().addClass("params_error");$("#tel_notice").html("完成验证后，你可以找回登录密码")}).focus(function(){$(this).triggerHandler("keyup")});$("#password1").blur(function(){var B=$(this).val();if(B.length<6){$(this).parent().removeClass("params_success");$(this).parent().addClass("params_error");$("#password_notice").html(password_shorter);A.passwordValidate=false;return false}else{$(this).parent().removeClass("params_error");$(this).parent().addClass("params_success");$("#password_notice").html("<em></em>");A.passwordValidate=true;return true}}).keyup(function(){$(this).triggerHandler("blur")}).focus(function(){$(this).triggerHandler("blur")});$("#conform_password").blur(function(){var B=$("#password1").val();var C=$(this).val();if(C.length<6){$(this).parent().removeClass("params_success");$(this).parent().addClass("params_error");$("#conform_password_notice").html(password_shorter);A.confirmPasswordValidate=false;return false}if(C!=B){$(this).parent().removeClass("params_success");$(this).parent().addClass("params_error");$("#conform_password_notice").html(confirm_password_invalid);A.confirmPasswordValidate=false;return false}else{$(this).parent().removeClass("params_error");$(this).parent().addClass("params_success");$("#conform_password_notice").html("<em></em>");A.confirmPasswordValidate=true;return true}}).keyup(function(){$(this).triggerHandler("blur")}).focus(function(){$(this).triggerHandler("blur")});$("#code").blur(function(){var C=$(this).val();var B=$(this);if(C==""){$("#code_notice").html(msg_code_blank);A.codeValidate=false;return false}$.ajax({type:"GET",url:codeCheck,async:false,data:{code:C},dataType:"json",success:function(D){if(D["code"]==1){$("#code").parent().removeClass("params_error");$("#code").parent().addClass("params_success");$("#code_notice").html("<em></em>");A.codeValidate=true}else{$("#code").parent().removeClass("params_success");$("#code").parent().addClass("params_error");$("#code_notice").html(msg_code);$("#codeImg").triggerHandler("click");A.codeValidate=false}}})});$("#code").focus(function(){$("#code").parent().removeClass("params_success");$("#code").parent().addClass("params_error");$("#code_notice").html("看不清点击图片即可更换验证码")});$(".getCode").mousedown(function(){var B=120;var C=$(this);$("#tel").trigger("blur");$("#code").trigger("blur");if(A.telValidate&&A.codeValidate){C.attr("disabled","true");C.html(B+"秒后重新获取");var D=setInterval(function(){if(B==0){clearInterval(D);C.removeAttr("disabled");C.html("重新发送验证码")}else{B--;C.html(B+"秒后重新获取")}},1000);$.ajax({type:"GET",url:sendUrl,async:false,data:{"tel":$("#tel").val()},dataType:"json",success:function(E){if(E["code"]==1){$("#mobilecode_notice").html(E["msg"]);A.codeValidate=true}else{if(E["code"]==2){$("#mobilecode_notice").html(E["msg"]);A.codeValidate=true}else{$("#mobilecode_notice").html("短信发送失败");A.codeValidate=false}}}})}});$("form[name='formUser']").submit(function(){var B=$(this);var E=$("#mobileCode").val();if($("input[name='agreement']").prop("checked")==false){alert("请选择用户协议");return false}if(E==""){$("#mobileCode").parent().removeClass("params_success");$("#mobileCode").parent().addClass("params_error");$("#mobilecode_notice").html("手机验证码非空");return false}$("#username").trigger("blur");$("#tel").trigger("blur");$("#password1").trigger("blur");$("#conform_password").trigger("blur");$("#code").trigger("blur");if(A.usernameValidate&&A.telValidate&&A.passwordValidate&&A.confirmPasswordValidate&&A.codeValidate){var C=$("#tel").val();var D=false;$.ajax({type:"GET",url:mobileCheck,async:false,data:{tel:C,mobileCode:E},dataType:"json",success:function(F){if(F["code"]==1){return D=true}else{$("#mobileCode").parent().removeClass("params_success");$("#mobileCode").parent().addClass("params_error");$("#mobilecode_notice").html(msg_code);$("#codeImg").triggerHandler("click")}}});return D}else{return false}})});function userEdit(){var E=document.forms["formEdit"];var A=E.elements["email"].value;var F="";var D=null;var B=E.elements["passwd_answer"]?Utils.trim(E.elements["passwd_answer"].value):"";var C=E.elements["sel_question"]?Utils.trim(E.elements["sel_question"].value):"";if(A.length==0){F+=email_empty+"\n"}else{if(!(Utils.isEmail(A))){F+=email_error+"\n"}}if(B.length>0&&C==0||document.getElementById("passwd_quesetion")&&B.length==0){F+=no_select_question+"\n"}for(i=7;i<E.elements.length-2;i++){needinput=document.getElementById(E.elements[i].name+"i")?document.getElementById(E.elements[i].name+"i"):"";if(needinput!=""&&E.elements[i].value.length==0){F+="- "+needinput.innerHTML+msg_blank+"\n"}}if(F.length>0){alert(F);return false}else{return true}}function editPassword(){var C=document.forms["formPassword"];var A=C.elements["old_password"].value;var E=C.elements["new_password"].value;var D=C.elements["comfirm_password"].value;var F="";var B=null;if(A.length==0){F+=old_password_empty+"\n"}if(E.length==0){F+=new_password_empty+"\n"}if(D.length==0){F+=confirm_password_empty+"\n"}if(E.length>0&&D.length>0){if(E!=D){F+=both_password_error+"\n"}}if(F.length>0){alert(F);return false}else{return true}}function submitMsg(){var B=document.forms["formMsg"];var A=B.elements["msg_title"].value;var C=B.elements["msg_content"].value;var D="";if(A.length==0){D+=msg_title_empty+"\n"}if(C.length==0){D+=msg_content_empty+"\n"}if(A.length>200){D+=msg_title_limit+"\n"}if(D.length>0){alert(D);return false}else{return true}}function submitPwdInfo(){var C=document.forms["getPassword"];var D=C.elements["user_name"].value;var A=C.elements["email"].value;var B="";if(D.length==0){B+=user_name_empty+"\n"}if(A.length==0){B+=email_address_empty+"\n"}else{if(!(Utils.isEmail(A))){B+=email_address_error+"\n"}}if(B.length>0){alert(B);return false}$.ajax({type:"post",url:getPassword,headers:{"X-CSRF-TOKEN":$('input[name="_token"]').val()},data:$("#getPassword").serialize(),dataType:"json",async:false,success:function(E){if(E["code"]==1){alert("发送邮件成功请查收重置密码")}else{alert(E["msg"])}}});return false}function submitPwd(){var C=document.forms["resetPassword"];var A=C.elements["new_password"].value;var D=C.elements["confirm_password"].value;var B="";if(A.length==0||A.length<6){B+=new_password_empty+"\n"}if(D.length==0){B+=confirm_password_empty+"\n"}if(D!=A){B+=both_password_error+"\n"}if(B.length>0){alert(B);return false}else{$("#new_password,#confirm_password").val($.md5(A));$.ajax({type:"POST",url:resetPassword,headers:{"X-CSRF-TOKEN":$('input[name="_token"]').val()},data:$("form[name='resetPassword']").serialize(),dataType:"json",async:false,success:function(E){if(E["code"]==1){alert(E["msg"]);window.location.href=loginUrl}else{alert(E["msg"])}}});return false}}function addBooking(){var G=document.forms["formBooking"];var C=G.elements["id"].value;var H=G.elements["rec_id"].value;var A=G.elements["number"].value;var E=G.elements["desc"].value;var B=G.elements["linkman"].value;var D=G.elements["email"].value;var F=G.elements["tel"].value;var J="";if(A.length==0){J+=booking_amount_empty+"\n"}else{var I=/^[0-9]+/;if(!I.test(A)){J+=booking_amount_error+"\n"}}if(E.length==0){J+=describe_empty+"\n"}if(B.length==0){J+=contact_username_empty+"\n"}if(D.length==0){J+=email_empty+"\n"}else{if(!(Utils.isEmail(D))){J+=email_error+"\n"}}if(F.length==0){J+=contact_phone_empty+"\n"}if(J.length>0){alert(J);return false}return true}function userLogin(){var B=$("#formLogin input[name='username']");var A=$("#formLogin input[name='password']");var C=document.forms["formLogin"];var D="";if(B.val().length==0){D+=username_empty+"\n";B.focus()}if(A.val().length==0){D+=password_empty+"\n";A.focus()}if(D.length>0){alert(D);return false}else{A.val($.md5(A.val()));$.ajax({type:"post",url:loginCheck,headers:{"X-CSRF-TOKEN":$('input[name="_token"]').val()},data:$("#formLogin").serialize(),dataType:"json",async:false,success:function(E){if(E["code"]==1){alert(E["msg"]);window.location.href=indexUrl}else{alert(E["msg"])}}});return false}}function chkstr(B){for(var A=0;A<B.length;A++){if(B.charCodeAt(A)<127&&!B.substr(A,1).match(/^\w+$/ig)){return false}}return true}function check_password(A){if(A.length<6){$("#password1").parent().removeClass("params_success");$("#password1").parent().addClass("params_error");document.getElementById("password_notice").innerHTML=password_shorter;validate.passwordValidate=false;return false}else{$("#password1").parent().removeClass("params_error");$("#password1").parent().addClass("params_success");document.getElementById("password_notice").innerHTML="<em></em>";validate.passwordValidate=true;return true}}function check_conform_password(A){password=document.getElementById("password1").value;if(A.length<6){$("#conform_password").parent().removeClass("params_success");$("#conform_password").parent().addClass("params_error");document.getElementById("conform_password_notice").innerHTML=password_shorter;validate.confirmPasswordValidate=false;return false}if(A!=password){$("#conform_password").parent().removeClass("params_success");$("#conform_password").parent().addClass("params_error");document.getElementById("conform_password_notice").innerHTML=confirm_password_invalid;validate.confirmPasswordValidate=false;return false}else{$("#conform_password").parent().removeClass("params_error");$("#conform_password").parent().addClass("params_success");document.getElementById("conform_password_notice").innerHTML="<em></em>";validate.confirmPasswordValidate=true;return true}}function is_registered(B){var C=B.replace(/[^\x00-\xff]/g,"**").length;if(B==""){document.getElementById("username_notice").innerHTML=msg_un_blank;validate.usernameValidate=false;return false}if(!chkstr(B)){document.getElementById("username_notice").innerHTML=msg_un_format;validate.usernameValidate=false;return false}if(C<3){document.getElementById("username_notice").innerHTML=username_shorter;validate.usernameValidate=false;return false}if(C>14){document.getElementById("username_notice").innerHTML=msg_un_length;validate.usernameValidate=false;return false}var A="username";$.ajax({type:"GET",url:uniqueCheck,async:false,data:{type:A,value:B},dataType:"json",error:function(){alert("连接失败");return false},success:function(D){if(D["code"]==1){$("#username").parent().removeClass("params_error");$("#username").parent().addClass("params_success");document.getElementById("username_notice").innerHTML="<em></em>";validate.usernameValidate=true}else{$("#username").parent().removeClass("params_success");$("#username").parent().addClass("params_error");document.getElementById("username_notice").innerHTML=msg_un_registered;validate.usernameValidate=false}}});return validate.usernameValidate}function checkEmail(B){if(B==""){document.getElementById("email_notice").innerHTML=msg_email_blank;validate.emailValidate=false;return false}else{if(!Utils.isEmail(B)){document.getElementById("email_notice").innerHTML=msg_email_format;validate.emailValidate=false;return false}}var A="email";$.ajax({type:"GET",url:uniqueCheck,async:false,data:{type:A,value:B},dataType:"json",error:function(){alert("连接失败");return false},success:function(C){if(C["code"]==1){$("#email").parent().removeClass("params_error");$("#email").parent().addClass("params_success");document.getElementById("email_notice").innerHTML="<em></em>";validate.emailValidate=true}else{$("#email").parent().removeClass("params_success");$("#email").parent().addClass("params_error");document.getElementById("email_notice").innerHTML=msg_email_registered;validate.emailValidate=false}}});return validate.emailValidate}function check_code(A){if(A==""){document.getElementById("code_notice").innerHTML=msg_code_blank;validate.codeValidate=false;return false}$.ajax({type:"GET",url:codeCheck,async:false,data:{code:A},dataType:"json",error:function(){alert("连接失败");return false},success:function(B){if(B["code"]==1){$("#code").parent().removeClass("params_error");$("#code").parent().addClass("params_success");document.getElementById("code_notice").innerHTML="<em></em>";validate.codeValidate=true}else{$("#code").parent().removeClass("params_success");$("#code").parent().addClass("params_error");document.getElementById("code_notice").innerHTML=msg_code;validate.codeValidate=false}}});return validate.codeValidate}function checkTel(B){if(B==""){document.getElementById("tel_notice").innerHTML=tel_empty;validate.telValidate=false;return false}else{if(!Utils.isTel(B)){document.getElementById("tel_notice").innerHTML=tel_msg;validate.telValidate=false;return false}}var A="tel";$.ajax({type:"GET",url:uniqueCheck,async:false,data:{type:A,value:B},dataType:"json",error:function(){alert("连接失败");return false},success:function(C){if(C["code"]==1){$("#tel").parent().removeClass("params_error");$("#tel").parent().addClass("params_success");document.getElementById("tel_notice").innerHTML="<em></em>";validate.telValidate=true}else{$("#tel").parent().removeClass("params_success");$("#tel").parent().addClass("params_error");document.getElementById("tel_notice").innerHTML=tel_registered;validate.telValidate=false}}});return validate.telValidate}function saveOrderAddress(I){var C=document.forms["formAddress"];var H=C.elements["consignee"].value;var F=C.elements["email"].value;var B=C.elements["address"].value;var A=C.elements["zipcode"].value;var G=C.elements["tel"].value;var E=C.elements["mobile"].value;var J=C.elements["sign_building"].value;var K=C.elements["best_time"].value;if(I==0){alert(current_ss_not_unshipped);return false}var D="";if(B.length==0){D+=address_name_not_null+"\n"}if(H.length==0){D+=consignee_not_null+"\n"}if(D.length>0){alert(D);return false}else{return true}}function submitSurplus(){var D=document.forms["formSurplus"];var B=D.elements["surplus_type"].value;var G=D.elements["amount"].value;var E=D.elements["user_note"].value;var A=0;var F="";if(G.length==0){F+=surplus_amount_empty+"\n"}else{var C=/^[\.0-9]+/;if(!C.test(G)){F+=surplus_amount_error+"\n"}}if(E.length==0){F+=process_desc+"\n"}if(F.length>0){alert(F);return false}if(B==0){for(i=0;i<D.elements.length;i++){if(D.elements[i].name=="payment_id"&&D.elements[i].checked){A=D.elements[i].value;break}}if(A==0){alert(payment_empty);return false}}return true}function addBonus(){var B=document.forms["addBouns"];var C=B.elements["bonus_sn"].value;if(C.length==0){alert(bonus_sn_empty);return false}else{var A=/^[0-9]{10}$/;if(!A.test(C)){alert(bonus_sn_error);return false}}return true}function mergeOrder(){if(!confirm(confirm_merge)){return false}var B=document.forms["formOrder"];var C=B.elements["from_order"].value;var A=B.elements["to_order"].value;var D="";if(C==0){D+=from_order_empty+"\n"}if(A==0){D+=to_order_empty+"\n"}else{if(A==C){D+=order_same+"\n"}}if(D.length>0){alert(D);return false}else{return true}}function returnToCart(A){Ajax.call("user.php?act=return_to_cart","order_id="+A,returnToCartResponse,"POST","JSON")}function returnToCartResponse(A){alert(A.message)}function checkIntensity(E){var F="#FFF",A="#FFF",H="#FFF";var G=0;var D=0;for(i=0;i<E.length;i++){var B=0;var C=E.charCodeAt(i);if(C>=48&&C<=57){B=1}else{if(C>=65&&C<=90){B=2}else{if(C>=97&&C<=122){B=4}else{B=4}}}D|=B}for(i=0;i<4;i++){if(D&1){G++}D>>>=1}if(E.length<=4){G=1}switch(G){case 1:A="2px solid red";F=H="2px solid #DADADA";break;case 2:F="2px solid #f90";A=H="2px solid #DADADA";break;case 3:H="2px solid #3c0";A=F="2px solid #DADADA";break;case 4:H="2px solid #3c0";A=F="2px solid #DADADA";break;default:H=F=A="";break}if(document.getElementById("pwd_lower")){document.getElementById("pwd_lower").style.borderBottom=A;document.getElementById("pwd_middle").style.borderBottom=F;document.getElementById("pwd_high").style.borderBottom=H}}function changeType(A){if(A.getAttribute("min")&&document.getElementById("ECS_AMOUNT")){document.getElementById("ECS_AMOUNT").disabled=false;document.getElementById("ECS_AMOUNT").value=A.getAttribute("min");if(document.getElementById("ECS_NOTICE")&&A.getAttribute("to")&&A.getAttribute("fee")){var C=parseInt(A.getAttribute("fee"));var B=parseInt(A.getAttribute("to"));if(C<0){B=B+C*2}document.getElementById("ECS_NOTICE").innerHTML=notice_result+B}}}function calResult(){var G=document.getElementById("ECS_AMOUNT").value;var B=document.getElementById("ECS_NOTICE");reg=/^\d+$/;if(!reg.test(G)){B.innerHTML=notice_not_int;return}G=parseInt(G);var C=document.forms["transform"];for(i=0;i<C.elements["type"].length;i++){if(C.elements["type"][i].checked){var A=parseInt(C.elements["type"][i].getAttribute("min"));var D=parseInt(C.elements["type"][i].getAttribute("to"));var F=parseInt(C.elements["type"][i].getAttribute("fee"));var E=0;if(G<A){B.innerHTML=notice_overflow+A;return}if(F>0){E=(G-F)*D/(A-F)}else{E=G*(D+F)/A+F}B.innerHTML=notice_result+parseInt(E+0.5)}}};
>>>>>>> 255ace48df6a05305d8686a885bca77749ad9775
