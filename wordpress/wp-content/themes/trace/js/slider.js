//Initialize Camera Slider Menu
$(document).ready(function() {			
	$('#camera_wrap_1').camera({
		height: '30%',
		easing: 'easeInOutExpo',
		fx: 'scrollTop, scrollHorz',
		thumbnails: true
	});
});