$(document).ready(function(){
	setUserId();
	//为连接加上userId值
	function setUserId(){
		var userId = getUrlParam('userId');
		$('#HTML-home').attr('href', 'home.html?userId='+userId);
		$('#HTML-user').attr('href', 'user.html?userId='+userId);
		$('#HTML-note').attr('href', 'note.html?userId='+userId);
	}

	//获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }    
});