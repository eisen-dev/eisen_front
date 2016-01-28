/// <reference path="libs/Promise.ts"/>
/// <reference path="libs/jquery.d.ts"/>
/// <reference path="libs/jqueryui.d.ts"/>
"use strict";

// this variable are get from php in package_list.php
declare var target_ipaddress: string;
// target_os needed for install in different operating system
declare var target_os: string;
// target_os needed for install in different operating system
declare var machine_id: string;


//var userID = <?php echo json_encode($userData); ?>;
//console.log(target_ipaddress);


jQuery("#form1").submit(function (event) {
    var data = $(this).serializeArray();
    data.push({name: 'target_ipaddress',value: target_ipaddress})
    data.push({name: 'target_os',value: target_os})
    data.push({name:'machine_id',value: machine_id})
    event.preventDefault();
    console.log(event);
    jQuery.ajax({
        type: "POST",
        url: "includes/search.php",
        data: data,
        dataType: "text json",
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
        var modalActiveTrue = jQuery("[data-modal-active='true']");
        // 開かれているモーダルを閉じる
        modalActiveTrue.fadeOut("0", "easeOutCubic", function () {
            modalActiveTrue.css("visibility", "hidden").css("display", "block");
            jQuery("[data-modal-active='true']" + ">" + ".modal-wrapper").css("left", "0px");
            modalActiveTrue.attr({"data-modal-active": "false"});
        });
    });
    jQuery(document).on("click", '[data-modal-type="test"]', function (event)  {
        var packageName = jQuery(event.target).closest("tr").find(".name").text();
        var packageVersion = jQuery(event.target).closest("tr").find(".version").text();
        if (packageName) {

            showPopup(packageName, packageVersion, target_ipaddress, machine_id);
        }
    });

    function showPopup(packageName, packageVersion, targetHost, managerHost)
    {
        var Actions: String[] = ['install','update','delete'];
        var number = 1;
        if (typeof(packageVersion)==='undefined') packageVersion = null;
        for (var Action of Actions) {
            jQuery("#modal-contents").find("p.item-"+number).html(generateLink(packageName, packageVersion, targetHost, managerHost, Action));
                number += 1;
        }
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
    //console.log(target_ipaddress);
    //console.log(target_os);
    //console.log(machine_id);
    jQuery.ajax({
        type: "POST",
        url: "includes/package_update.php",
        data: {target_ipaddress: target_ipaddress, target_os: target_os, machine_id: machine_id},
        dataType: "text json",
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