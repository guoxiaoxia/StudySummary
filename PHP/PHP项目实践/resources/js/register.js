$(document).ready(function(){
	 //登陆界面输入框的样式变化
    $(document).on('click', '#bt-register-submit',function () {
        $('.message').remove();
         $('.registerBackground').css('height',320);
    	var register_email = $("#register-email").val();
        var register_name = $("#register-name").val();
        var register_password = $("#register-password").val();
        // 输入信息检查
        if((register_email == '' || register_name == '' || register_password== '')){
            AddWarn($('#register-password'),'请填写所有信息o(^▽^)o！');   
        }else{
            if(!register_email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
            AddWarn($('#register-email'),'邮箱格式不正确！'); 
            }else{
                $.ajax({
            url: 'http://localhost:8080/GoodGoodStudy/User/register',
            type: 'POST',       
            data:{
                emailAddress:register_email,
                name:register_name,
                password:register_password
            },
            success:function(data){
                data=JSON.parse(data);
                if(data.resultCode == 0){
                    alert(data.message);
                }
                if(data.resultCode == 1){
                    alert(data.message+"快点到邮箱验证吧o(^▽^)o！");
                }
            },
            error:function(){
                alert("请求失败！");
            }
        });      
            }       
        }
    });
//------------------------调用函数--------------------
    //-------------添加提示----------------------
    function AddWarn(element,message){
        var height = $('.registerBackground').height();      
        $('.registerBackground').css('height',height+20);
        element.after('<p class="little-tab-register message">'+message+'</p>'); 
    }
});