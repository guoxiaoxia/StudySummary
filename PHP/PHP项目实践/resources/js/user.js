$(document).ready(function(){
	setUserId();

	//为连接加上userId值
	function setUserId(){
		var userId = getUrlParam('userId');
		$('#HTML-home').attr('href', 'home.html?userId='+userId);
		$('#HTML-user').attr('href', 'user.html?userId='+userId);
		$('#HTML-note').attr('href', 'note.html?userId='+userId);
	}
// -----------------------------左边的-----------------------------------------------------
	//生成个人资料界面
	$(document).on('click', '#user-personal-data',function () {
		listClickChange($(this));
		var personal_data_text = '<div id="right">'
		+'<table id="personal-data-table">'
		+'		<tr class="height-40">'
		+'			<th>昵称</th>'
		+'			<td class="ip-myself">'
		+'				<input id="user-name" class="ip-box" name="user-name" type="text" maxlength="12" placeholder="请输入昵称,2-12位">'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th>学校</th>'
		+'			<td class="ip-myself">'
		+'				<input id="user-school" class="ip-box" name="user-school" type="text" maxlength="20" placeholder="请输入学校">'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th>城市</th>'
		+'			<td class="ip-myself">'
		+'				<input id="user-position" class="ip-box" name="user-position" type="text" maxlength="10" placeholder="请输入城市">'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th>性别</th>'
		+'			<td id="user-sex">'
		+'				<input name="user-sex" type="radio" value="2">保密'
		+'				<input name="user-sex" type="radio" value="1">男'
		+'				<input name="user-sex" type="radio" value="0">女'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr>'
		+'			<th>个性签名</th>'
		+'			<td>'
		+'				<textarea id="user-signature" class="signature-textarea" name="signature" rows="6" maxlength="200" placeholder="请输入个性签名,0-100字哦o(^▽^)o！"></textarea>'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th></th>'
		+'			<td>'
		+'				<div id="bt-personal-date-submit">提交</div>'
		+'			</td>'
		+'		</tr>'
		+'	</table>'
		+'</div>';
		$('#left').after(personal_data_text);
		AppendUserData();
	});
 	$('#user-personal-data').click();
	
 	//填充个人资料原来的信息
 	function AppendUserData(){
 		var userId = getUrlParam('userId');
		//获取用户信息
		 $.ajax({
	            url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getUserInfo',
	            type: 'POST',     
	            data:{},
	            success:function(data){
	                data=JSON.parse(data);	                	                	
	                $('#user-name').val(data.name);	 
	                $('#user-school').val(data.school);
	                $('#user-position').val(data.city);
	                if(data.sex == 0){	                	
	                	$('input:radio[name="user-sex"][value=0]').attr("checked",true);
	                }
	                else if(data.sex == 1){
	                	$('input:radio[name="user-sex"][value=1]').attr("checked",true);
	                }
	                else if(data.sex == 2){
	                	$('input:radio[name="user-sex"][value=2]').attr("checked",true);
	                }	            
	                $('#user-signature').val(data.signature);	                               	                
	            },
	            error:function(){
	                alert("请求失败！");
	            }
    		});         
	}

	//生成设置头像界面
	$(document).on('click', '#set-avatar',function () {
		listClickChange($(this));
		var set_avatar_text='<div id="right">'
		+'	<div id="set-avatar-div">'
		+'		<img src="images/user/2.jpg" alt="默认头像" height="200" width="200"/>'
		+'		<p>当前头像</p>'
		+'		<p id="bt-set-avatar-subimt">更改头像</p>'
		+'	</div>'
		+'</div>';
		$('#left').after(set_avatar_text);
	});

	//生成邮箱验证界面
	$(document).on('click', '#verify-email',function () {
		listClickChange($(this));
		var verify_email_text='<div id="right">'
		+'	<div id="verify-email-div">'
		+'		<p>当前邮箱</p>'
		+'		<p class="change-email">814192130@qq.com</p>'
		+'		<p id="bt-verify-email-subimt">验证邮箱</p>'
		+'	</div>'
		+'</div>';
		$('#left').after(verify_email_text);
	});
	//生成修改密码界面
	$(document).on('click', '#reset-password',function () {
		listClickChange($(this));
		var reset_password_text='<div id="right">'
		+'	<table id="reset-password-table">'
		+'		<tr class="height-40">'
		+'			<th>当前密码</th>'
		+'			<td class="ip-user">'
		+'				<input id="current-password" class="ip-box" name="current-password" type="text" placeholder="请输入当前密码">'
		+'			</td>'
		+'		</tr>	'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th>新密码</th>'
		+'			<td class="ip-user">'
		+'				<input id="new-password" class="ip-box" name="new-password" type="text" placeholder="请输入新密码">'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th>确认密码</th>'
		+'			<td class="ip-user">'
		+'				<input id="comfirm-password" class="ip-box" name="comfirm-password" type="text" placeholder="请输入密码">'
		+'			</td>'
		+'		</tr>'
		+'		<tr class="height-25"></tr>'
		+'		<tr class="height-40">'
		+'			<th></th>'
		+'			<td>'
		+'				<div id="bt-reset-password-submit">提交</div>'
		+'			</td>'
		+'		</tr>'
		+'	</table>'
		+'</div>';
		$('#left').after(reset_password_text);
	});
//----------------------公共调用函数部分-------------------------------------
	//个人设置页面的左边导航栏，选中和不选中的样式改变
	function listClickChange(a){
		$('.no-chose').removeClass('chose');
		a.parent().addClass('chose');
		$('#right').remove();
	}
	
	//获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }


// --------------------------后台操作-----------------------------------
	// --------------------更新个人资料--------------------------
	$(document).on('click', '#bt-personal-date-submit',function () {
		var userId = getUrlParam('userId');
    	var user_name = $('#user-name').val();
        var user_school = $('#user-school').val();
        var user_position = $('#user-position').val();
        var user_sex = $('input:radio[name="user-sex"]:checked').val();
        var user_signature = $('#user-signature').val();
        // alert('1'+user_name+'2'+user_school+'3'+user_position+'4'+user_sex+'5'+user_signature);
        // 输入信息检查
        if(user_name == ''){
           alert('昵称不能为空哦o(^▽^)o!');   
        }else{
            $.ajax({
	            url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/userPersonalData',
	            type: 'POST',     
	            data:{
	                name:user_name,
	                school:user_school,
	                city:user_position,
	                sex:user_sex,
	                signature:user_signature
	            },
	            success:function(data){
	                data=JSON.parse(data);
	                if(data.resultCode == 0){
	                    alert(data.message);
	                }
	                if(data.resultCode == 1){
	                    alert(data.message);
	                }
	            },
	            error:function(){
	                alert("请求失败！");
	            }
    		});                      
        }
    });
	
	// --------------------修改密码--------------------------
	$(document).on('click', '#bt-reset-password-submit',function () {
		var userId = getUrlParam('userId');
    	var current_password = $('#current-password').val();
        var new_password = $('#new-password').val();
        var comfirm_password = $('#comfirm-password').val();
        // alert('1'+current_password+'2'+new_password+'3'+comfirm_password);
        // 输入信息检查
        if(current_password == '' || new_password == '' || comfirm_password == ''){
           alert('请填写好每一个输入哦o(^▽^)o!');   
        }else{
        	if(new_password != comfirm_password){
        		alert('新密码和确认密码不一样哦o(^▽^)o!');   
        	}else{
        		$.ajax({
		            url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/resetPassword',
		            type: 'POST',     
		            data:{
		                oldPassword:current_password,
		                newPassword:new_password	       
		            },
		            success:function(data){
		                data=JSON.parse(data);
		                if(data.resultCode == 0){
		                    alert(data.message);
		                }
		                if(data.resultCode == 1){
		                    alert(data.message);
		                }
		            },
		            error:function(){
		                alert("请求失败！");
		            }
	    		});      
        	}                           
        }
    });
});