$(function () {
	//topbarのメニューボタン
	$('.menu-button').click(function () {
		var popup = $(this).children('.menu-popup');
		if ($(popup).css("display") == "none") {
			//menu-popupをすべて閉じる,popupの切替
			$('.menu-popup').animate({height: "hide"}, {duration: 0, easing: "easeOutCubic"});
			//モバイル幅でnavigationが開いていた場合の処理
			if (window.matchMedia('(max-width: 480px)').matches && $('.navigation').css("left") == "0px") {
				//navigationを閉じる
				$('.navigation').animate({left: "-200px"}, {duration: 300, easing: "easeOutCubic"});
			}
			//popupを開く
			$(popup).css("display", "block");
		}else if ($(popup).css("display") != "none") {
			//popupが表示されてたら閉じる
			$(popup).css("display", "none");
		}
    });
	//左ナビゲーション
	$('.navigation-toggle').click(function () {
		//css leftの位置で開閉を判定
		if ($('.navigation').css("left") != "0px") {
			//	menu-popupをすべて閉じる モバイルで干渉するため
			$('.menu-popup').css("display", "none");
			$('.navigation').animate({left: "0px"}, {duration: 300, easing: "easeOutCubic"});
		}else if ($('.navigation').css("left") == "0px") {
			$('.navigation').animate({left: "-200px"}, {duration: 300, easing: "easeOutCubic"});
		}
	});

	//ウィンドウ幅が切り替わった際のナビゲーション位置リセット
	$(window).resize(function () {
		var w = $(window).Width();
		//innerwidthもある
		var mobile = 480;
		var desktop = 768;
		var navw = 200;
		if (w <= mobile) {
			$('.navigation').css("left","-200px");
		}
		if (w >= mobile) {
			$('.navigation').css("left","0px");
		}
	});
});
