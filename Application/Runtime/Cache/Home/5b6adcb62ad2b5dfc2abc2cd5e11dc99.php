<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>深圳臻云技术控制系统登录</title>
<script src="/Public/js/jquery-1.8.0.min.js" type="text/javascript" ></script>
<link rel="stylesheet" type="text/css" href="/Public/css/login.css"/>
</head>
<body>
<div class='signup_container'>
    <h1 class='signup_title'>用户登陆</h1>
    <img src='/Public/images/people.png' id='admin'/>
    <div id="signup_forms" class="signup_forms clearfix">
	    <form class="signup_form_form" id="signup_form" method="post" action=""  data-secure-ajax-action="">
           <div class="form_row first_row">
               <label for="signup_email">请输入用户名</label>
               <input type="text" name="user_name" placeholder="请输入用户名" id="signup_name" data-required="required">
           </div>
           <div class="form_row">
               <label for="signup_password">请输入密码</label>
               <input type="password" name="passwd" placeholder="请输入密码" id="signup_password" data-required="required">
           </div>
           <!--<div class="form_row">
                   <input type="text" name="user[password]" placeholder="请输入验证码" id="signup_select" value='' data-required="required">
                   <img src='/Public/images/d.png' id='d'/>
                   <ul>
                       <li>管理员</li>
                       <li>用户1</li>
                       <li>用户2</li>
                   </ul>
           </div>
	   --></form>
    </div>
    <div class="login-btn-set"><a href='javascript:userLogin()' class='login-btn'></a></div>
    <div class="input">
		<div class="formError" id="checklogin" style="display:none"></div>
	</div>	
    <p class='copyright'>版权所有 深圳臻云技术股份有限公司</p>
</div>

</body>

<script type="text/javascript">
$(document).ready(function(){
	/**
	 * 按回车登录
	 */
	$(document).keydown(function(e) {
	    if(!e) e = window.event;  //火狐中是 window.event
	    if((e.keyCode || e.which) == 13){
	    	userLogin();
	    }
	});
});
/**
 * 用户登录
 */
function userLogin() {
	//获取参数
	var username = $.trim($('#signup_name').val());
	var passwd = $.trim($('#signup_password').val());

	//校验参数
	if(!username) {
		$('#checklogin').show().html('<font color="red">请填写用户名！</font>');
		setTimeout(function() {
			$('#checklogin').hide();
		}, 2000);
		return false;
	}
	if(!passwd){
		$('#checklogin').show().html('<font color="red">请填写用户密码！</font>');
		setTimeout(function() {
			$('#checklogin').hide();
		}, 2000);
		return false;
	}
	//登录
	$.ajax({
		type:'POST',
		url:'<?php echo U("Login/doLogin");?>',
		data:{'username':username, 'passwd':passwd},
		async:false,
		dataType: 'json',
		cache:false,
		success:function(data){
			if(data.status == 0){
				$('#checklogin').show().html('<font color="red">'+data.info+'</font>');
				setTimeout(function() {
					$('#checklogin').hide();
				}, 2000);
				return false;
			}else{
				window.location.href = '../';
				return true;
			}
		}
	});
}
</script>
</html>