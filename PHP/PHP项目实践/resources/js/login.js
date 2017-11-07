$(document).ready(function(){
	
    $(document).on('click', '#bt-login-submit',function () {
        $('.message').remove();
        $('.loginBackground').css('height',280);
        var login_name = $("#login-name").val();
        var login_password = $("#login-password").val();
        // 输入信息检查
        if(login_name == '' || login_password == ''){
            AddWarn($('#login-password'),'请填写所有信息o(^▽^)o！');   
        }else{
        	$.ajax({
            url: 'http://localhost:8080/GoodGoodStudy/User/login',
            type: 'POST',       
            data:{           
                name:login_name,
                password:login_password
            },
            success:function(data){
                data=JSON.parse(data);
                if(data.resultCode == 0){
                    alert(data.message);
                }
                if(data.resultCode == 1){
                	location.href = "http://localhost:8080/GoodGoodStudy/resources/home.html?userId="+data.data;
                }
            },
            error:function(){
                alert("请求失败！");
            }
        });                        
        }
    });
//------------------------调用函数--------------------
    //-------------添加提示----------------------
    function AddWarn(element,message){
        var height = $('.loginBackground').height();      
        $('.loginBackground').css('height',height+20);
        element.after('<p class="little-tab-register message">'+message+'</p>'); 
    }
});