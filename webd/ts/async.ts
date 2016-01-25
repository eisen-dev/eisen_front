/// <reference path="libs/Promise.ts"/>
/// <reference path="libs/jquery.d.ts"/>
/// <reference path="libs/jqueryui.d.ts"/>
"use strict";

// this variable are get from php in package_list.php
declare var target_ipaddress: string;
// target_os needed for install in different operating system
declare var target_os: string;


//var userID = <?php echo json_encode($userData); ?>;
//console.log(target_ipaddress);


jQuery("#form1").submit(function (event) {
    event.preventDefault();
    console.log(event);
    jQuery.ajax({
        type: "POST",
        url: "includes/search.php",
        data: jQuery(this).serialize(),
        dataType: "json",
        beforeSend: function () {
            jQuery("table#resultTable tbody").html("<tr><td></td><td><i class='fa fa-spinner fa-pulse fa-2x'></i></td></tr>");
        },
        success: function (data) {
            jQuery("table#resultTable tbody").html(data.msg);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            alert(xhr.responseText);
        }
    });
});


jQuery(document).ajaxComplete(function (event, xhr, settings) {
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
    jQuery(document).on("click", '[data-modal-type="test"]', function (event)  {
        var packageName = jQuery(event.target).closest("tr").find(".name").text();
        var packageVersion = jQuery(event.target).closest("tr").find(".version").text();
        if (packageName) {
            var targetHost='localhost';
            var managerHost='192.168.33.10';
            showPopup(packageName, packageVersion, targetHost, managerHost);
        }
    });

    function showPopup(packageName, packageVersion, targetHost, managerHost)
    {
        if (typeof(packageVersion)==='undefined') packageVersion = null;
        jQuery("#modal-contents").find("p.item-1").html(generateLink(packageName, packageVersion, targetHost, managerHost,'install'));
        jQuery("#modal-contents").find("p.item-2").html(generateLink(packageName, packageVersion, targetHost, managerHost,'update'));
        jQuery("#modal-contents").find("p.item-3").html(generateLink(packageName, packageVersion, targetHost, managerHost,'delete'));
    }

    function generateLink(packageName: String, packageVersion: String, targetHost: String, managerHost: String, packageAction: String)
    {
        var htmlLink = "<a href=includes/package_action/package_action.php?" +
            "packageName="
            + packageName +
            "\&packageVersion="
            + packageVersion +
            "\&action="
            + packageAction +
            "\&target="
            + targetHost +
            "\&manager="
            + managerHost +
            ">"
            + packageAction +
            ": "
            + packageName +
            "-"
            + packageVersion +
            "\</a>";
        return htmlLink;
    }
});

jQuery("#form2").submit(function (event) {
    event.preventDefault();
    console.log(event);
    jQuery.ajax({
        type: "POST",
        url: "includes/package_update.php",
        data: jQuery(this).serialize(),
        dataType: "json",
        beforeSend: function () {
            jQuery("#form2").html("\<button class=\"btn btn-primary\" type=\"submit\">package update\<i class=\"fa fa-refresh fa-spin\"\>\<\/i\>\<\/button\>");
        },
        success: function (user_id) {
            jQuery("#form2").html("\<form id=\"form2\"> <input type=\"hidden\" name=\"user_id\" id=\"user_id\" value= "+user_id+" \><button class=\"btn btn-primary\" type=\"submit\"> package update <i class=\"fa fa-refresh\"></i> </button> </form>");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            alert(xhr.responseText);
        }
    });
});