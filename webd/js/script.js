$(document).ready(function(){
	$('.menu-button').click(function () {
		var popup = $(this).children('.menu-popup');
		if($(popup).css("display")=="none"){
			//menu-popupをすべて閉じる,popupの切替
			$('.menu-popup').animate({height:"hide"}, {duration:0, easing:"easeOutCubic"});
			//popupを開く
			 $(popup).animate({height:"show"}, {duration:300, easing:"easeOutCubic"});
		}else if($(popup).css("display")!="none"){
			//popupが表示されてたら閉じる
			$(popup).animate({height:"hide"}, {duration:300, easing:"easeOutCubic"});
		};
    });
});
