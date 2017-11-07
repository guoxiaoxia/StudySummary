$(function(){
	//幻灯	
	$('#slideshow').slide({
		titCell: ".hd ul",
		mainCell: ".bd ul",
		effect: "fade",
		delayTime:1500,
		interTime: 5000,
		autoPlay: true,
		autoPage: true,
		trigger: "click"
	});
	$('#search_btn').click(function(){
		if ($('#search_text').val() == ''){
			alert('请输入要查找的关键字');
			$('#search_text').focus();
			return false;
		};
	});	
});
