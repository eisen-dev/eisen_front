$(function () {
	//topbarのメニューボタン
	$('.menu-button').click(function () {
		var navw = $(".navigation").width();
		var popup = $(this).children('.menu-popup');
		if ($(popup).css("display") == "none") {
			//menu-popupをすべて閉じる,popupの切替
			$('.menu-popup').animate({height: "hide"}, {duration: 0, easing: "easeOutCubic"});
			//モバイル幅でnavigationが開いていた場合の処理
			if (window.matchMedia('(max-width: 480px)').matches && $('.navigation').css("left") == "0px") {
				//navigationを閉じる
				$('.navigation').animate({left: "-" + navw + "px"}, {duration: 300, easing: "easeOutCubic"});
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
		var navw = $(".navigation").width();
		//css leftの位置で開閉を判定
		if ($('.navigation').css("left") != "0px") {
			//	menu-popupをすべて閉じる モバイルで干渉するため
			$('.menu-popup').css("display", "none");
			$('.navigation').animate({left: "0px"}, {duration: 300, easing: "easeOutCubic"});
		}else if ($('.navigation').css("left") == "0px") {
			$('.navigation').animate({left: "-" + navw + "px"}, {duration: 300, easing: "easeOutCubic"});
		}
	});
	//ウィンドウ幅が切り替わった際のナビゲーション位置リセット
	$(window).resize(function () {
		var navw = $(".navigation").width();
		var w = $(window).width();
		//innerwidthもある
		var mobile = 480;
		var desktop = 768;
		var navw = 200;
		if (w < mobile) {
			$('.navigation').css("left", "-" + navw + "px");
		}
		if (w > mobile) {
			$('.navigation').css("left","0px");
		}
	});
	//モーダルウィンドウ関連
	//リサイズ時のモーダル位置を設定
	$(window).resize(function () {
		//リサイズ対象の現在開かれているモーダル
		var resizetarget = '[data-modal-active="true"]';
		//モーダルの幅を取得
		var modalw = $(resizetarget + '>' + ".modal-wrapper").outerWidth();
		//描画エリアの幅を取得(この要素を基準に中央寄せ)
		var areaw = $(resizetarget).width();
		//positionの位置を計算
		var modalcenter = (areaw / 2) - (modalw / 2);
		$(resizetarget + '>' + ".modal-wrapper").css("left",modalcenter + "px");
	});
	//モーダルの開閉
	$('[data-modal="open"]').click(function () {
		//開きたいモーダルのID
		var target = '#' + $(this).attr("data-modal-target");
		//開きたいモーダルに属性追加
		$(target).attr({'data-modal-active':'true'});
		//モーダルの初期位置を設定
		var modalw = $(target + ">" + ".modal-wrapper").outerWidth();
		var areaw = $(target).width();
		var modalcenter = (areaw / 2) - (modalw / 2);
		$(target + '>' + ".modal-wrapper").css("left",modalcenter + "px");
		//モーダルを開く
		$(target).css('visibility','visible').hide().fadeIn('0', 'easeOutCubic');
	});
	$('[data-modal="close"]').click(function () {
		//開かれているモーダルを閉じる
		$('[data-modal-active="true"]').fadeOut('0', 'easeOutCubic', function(){
			$('[data-modal-active="true"]').css('visibility','hidden').css('display','block');
			$('[data-modal-active="true"]' + '>' + ".modal-wrapper").css("left", "0px");
			$('[data-modal-active="true"]').attr({'data-modal-active':'false'});
		});
	});
	//リストのドロップダウンメニューテスト
	$('.list-data-option-icon').click(function () {
		if ($('.dropdown-menu').css("display") == "none") {
			$('.dropdown-menu').css("display", "block");
		}else if($('.dropdown-menu').css("display") != "none") {
			$('.dropdown-menu').css("display", "none");
		}
	});
});
