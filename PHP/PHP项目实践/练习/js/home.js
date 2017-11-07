$(document).ready(function() {
    $(document).on('click', '.submeun', function() {
        var div = $("#div-navigation");
        div.animate({
            height: 'toggle'
        });
    });

    $(function() {
        $('#a_banner').nivoSlider({
        	effect:'slideInRight',
        	animSpeed:500,
        	pauseTime:2000
        });
    });





// function listClickChange(a) {
// 	$('.no-chose').removeClass('chose');
// 	a.children().addClass('chose');
// 	$('#right').remove();
// }
});
