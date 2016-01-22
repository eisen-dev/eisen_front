/// <reference path="libs/Promise.ts"/>
/// <reference path="libs/jquery.d.ts"/>
/// <reference path="libs/jqueryui.d.ts"/>
/// <reference path="async.ts"/>
"use strict";

jQuery(
    function (): any
    {
        // topbarのメニューボタン
        jQuery(".menu-icon").click(function () {
            var navw = jQuery(".navigation").width();
            var popup = jQuery(this).parent().children(".menu-popup");
            if (jQuery(popup).css("display") == "none") {
                // menu-popupをすべて閉じる,popupの切替
                jQuery(".menu-popup").animate({height: "hide"}, {
                    duration: 0,
                    easing: "easeOutCubic"
                });
                // モバイル幅でnavigationが開いていた場合の処理
                if (window.matchMedia("(max-width: 480px)").matches && jQuery(".navigation").css("left") == "0px") {
                    // navigationを閉じる
                    jQuery(".navigation").animate({left: "-" + navw + "px"}, {
                        duration: 300,
                        easing: "easeOutCubic",
                    });
                }
                // popupを開く
                jQuery(popup).css("display", "block");
            } else if (jQuery(popup).css("display") != "none") {
                // popupが表示されてたら閉じる
                jQuery(popup).css("display", "none");
            }
        });
        // 左ナビゲーション
        jQuery(".navigation-toggle").click(function () {
            var navw = jQuery(".navigation").width();
            // css leftの位置で開閉を判定
            if (jQuery(".navigation").css("left") != "0px") {
                // 	menu-popupをすべて閉じる モバイルで干渉するため
                jQuery(".menu-popup").css("display", "none");
                jQuery(".navigation").animate({left: "0px"}, {
                    duration: 300,
                    easing: "easeOutCubic"
                });
            } else if (jQuery(".navigation").css("left") == "0px") {
                jQuery(".navigation").animate({left: "-" + navw + "px"}, {
                    duration: 300,
                    easing: "easeOutCubic"
                });
            }
        });
        // ウィンドウ幅が切り替わった際のナビゲーション位置リセット
        jQuery(window).resize(function () {
            var navw = jQuery(".navigation").width();
            if (window.matchMedia("(max-width: 769px)").matches) {
				jQuery(".navigation").css("left", "-" + navw + "px");
            } else {
                jQuery(".navigation").css("left", "0px");
            }
        });
        // モーダルウィンドウ関連
        // リサイズ時のモーダル位置を設定
        jQuery(window).resize(function () {
            jQuery('.list-data-cbox').bind('click',function(e){
                e.stopPropagation();
            });
            // リサイズ対象の現在開かれているモーダル
            var resizetarget = "[data-modal-active='true']";
            // モーダルの幅を取得
            var modalw = jQuery(resizetarget + ">" + ".modal-wrapper").outerWidth();
            // 描画エリアの幅を取得(この要素を基準に中央寄せ)
            var areaw = jQuery(resizetarget).width();
            // positionの位置を計算
            var modalcenter = (areaw / 2) - (modalw / 2);
            jQuery(resizetarget + ">" + ".modal-wrapper").css("left", modalcenter + "px");
        });
        // モーダルの開閉
        jQuery("[data-modal='open']").click(function () {
            // 開きたいモーダルのID
            var target = "#" + jQuery(this).attr("data-modal-target");
            // 開きたいモーダルに属性追加
            jQuery(target).attr({"data-modal-active": "true"});
            // モーダルの初期位置を設定
            var modalw = jQuery(target + ">" + ".modal-wrapper").outerWidth();
            var areaw = jQuery(target).width();
            var modalcenter = (areaw / 2) - (modalw / 2);
            jQuery(target + ">" + ".modal-wrapper").css("left", modalcenter + "px");
            // モーダルを開く
            jQuery(target).css("visibility", "visible").hide().fadeIn("0", "easeOutCubic");
        });
        jQuery("[data-modal='close']").click(function () {
            // 開かれているモーダルを閉じる
            jQuery("[data-modal-active='true']").fadeOut("0", "easeOutCubic", function () {
                jQuery("[data-modal-active='true']").css("visibility", "hidden").css("display", "block");
                jQuery("[data-modal-active='true']" + ">" + ".modal-wrapper").css("left", "0px");
                jQuery("[data-modal-active='true']").attr({"data-modal-active": "false"});
            });
        });
        // リストのドロップダウンメニューテスト
        jQuery(".list-data-option-icon").click(function () {
            var target = jQuery(this).parent().children(".dropdown-menu");
            if (jQuery(target).css("display") == "none") {
                jQuery(target).css("display", "block");
            } else if (jQuery(target).css("display") != "none") {
                jQuery(target).css("display", "none");
            }
        });
		// フィルターの開閉
		jQuery(".n-filter-button").click(function () {
			var target = jQuery(".list-filter");
            if (jQuery(target).css("display") == "none") {
                jQuery(target).css("display", "block");
            } else if (jQuery(target).css("display") != "none") {
                jQuery(target).css("display", "none");
            }
		});
        // マシンステータスウィジェットのリスト開閉
        jQuery(".wgt-mstat-open-mnghosts").click(function () {
            // 開閉対象のターゲットホストリスト
            var target = jQuery(this).parents('.wgt-mstat-li-thost').children('.wgt-mstat-mnghosts');
            if (jQuery(target).css("display") == "none"){
                // 矢印の向き変更
                jQuery(this).removeClass('fa-caret-right').addClass('fa-caret-down');
                jQuery(target).css("display", "flex");
            } else {
                // 矢印の向き変更
                jQuery(this).removeClass('fa-caret-down').addClass('fa-caret-right');
                jQuery(target).css("display", "none");
            }
        });
    });

