/*
 *Site Background by dong
 *version 1.3
 *Author URL:http://www.dearzd.com
 */
var bg = $('<div id=bg />'),
	bg_wrap = $('<div id=bg-wrap />'),
	bg_img = new Image();
function bg_image_pos(W,o,bg_img){
	var LH=bg_img.height/bg_img.width*W.width(),//对firefox，汗~~啊
		LW=bg_img.width/bg_img.height*W.height();
	o.css({'width':W.width(),'height':W.height()});
	if(LH>=W.height()){
		$(bg_img).css({
			'width':W.width(),
			'height':LH,
			'top':(W.height()-LH)/2,//垂直居中
			'left':0
		});
		
		
	}else{
		$(bg_img).css({
			'height':W.height(),
			'width':LW,
			'left':(W.width()-LW)/2,//水平居中
			'top':0
		});
	}
}
function ajax_bg(){
	if ( !$( '#bg' )[0] ){
		$.ajax({
			type:'GET',
			url: Always.ajaxurl+"?action=ajax_site_bg",
			success:function(data){
				bg_img.src = data;
			}
		});
		bg_img.onload = function(){
			bg.append(bg_img).append(bg_wrap);
			bg.css({'position':'fixed','left':'0','top':'0','z-index':'-1','overflow':'hidden'});
			$(bg_img).css({'position':'absolute','opacity':'0'});
			$( '#wrapper' ).after(bg);
			bg_image_pos($(window),bg,bg_img);
			if ( window.location.href != Always.ajaxurl && !window.location.href.match(Always.ajaxurl+'page')) {
				$(bg_img).animate({opacity:1},800);
			}
			$(window).resize(function(){//改变窗口调整大小
				bg_image_pos($(window),bg,bg_img);
			});
		}
	}else{
		$( '#bg img' ).stop().animate({opacity:1},1200);
	}
}
$(document).ready(function(){
	
});