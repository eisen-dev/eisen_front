$(function () {
	//topbarのメニューボタン
	$('.menu-button').click(function () {
		var popup = $(this).children('.menu-popup');
		if ($(popup).css("display") == "none") {
			//menu-popupをすべて閉じる,popupの切替
			$('.menu-popup').animate({height: "hide"}, {duration: 0, easing: "easeOutCubic"});
			//モバイル幅の場合の処理
			if (window.matchMedia('(max-width: 480px)').matches) {
				//ナビゲーションが開かれていれば閉じる
				if ($('.navigation').css("left") == "0px") {
					$('.navigation').animate({left: "-=200px"}, {duration: 300, easing: "easeOutCubic"});
					//$('.navigation').delay(300)[0].removeAttr('style');
				}
			}
			//popupを開く
			$(popup).css("display", "block");
			//$(popup).animate({height:"show"}, {duration:300, easing:"easeOutCubic"});
		}else if ($(popup).css("display") != "none") {
			//popupが表示されてたら閉じる
			//$(popup).animate({height:"hide"}, {duration:300, easing:"easeOutCubic"});
			$(popup).css("display", "none");
		}
    });
	//左ナビゲーション
	$('.navigation-toggle').click(function () {
		//css leftの位置で開閉を判定
		if ($('.navigation').css("left") != "0px") {
			//	menu-popupをすべて閉じる モバイルで干渉するため
			$('.menu-popup').css("display", "none");
			$('.navigation').animate({left: "+=200px"}, {duration: 300, easing: "easeOutCubic"});
		}else if ($('.navigation').css("left") == "0px") {
			//一回閉じるとデスクトップ幅にした場合ナビゲーションが開けなくなるためStyleを削除
			$('.navigation').animate({left: "-=200px"}, {duration: 300, easing: "easeOutCubic"}).delay(300)[0].removeAttr('style');
			//.attr
			//innerwidth
			//ready load
		}
	});
});
