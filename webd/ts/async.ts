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

$(document).ready( function (event) {
    var data = $(this).serializeArray();
    data.push({name: 'target_ipaddress',value: target_ipaddress})
    data.push({name: 'target_os',value: target_os})
    data.push({name:'machine_id',value: machine_id})
    jQuery.ajax({
        type: "POST",
        url: "includes/search.php",
        data: data,
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

jQuery("#form1").submit(function (event) {
    var data = $(this).serializeArray();
    data.push({name: 'target_ipaddress',value: target_ipaddress})
    data.push({name: 'target_os',value: target_os})
    data.push({name:'machine_id',value: machine_id})
    event.preventDefault();
    jQuery.ajax({
        type: "POST",
        url: "includes/search.php",
        data: data,
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
        jQuery(".modal-header").find("span.modal-title").html("<pre>"+ packageName +": "+ packageVersion + "</pre>")
        var number = 1;
        if (typeof(packageVersion)==='undefined') packageVersion = null;
        for (var Action of Actions) {
            jQuery("#modal-contents").find("p.item-"+number).html(generateLink(packageName, packageVersion, targetHost, managerHost, Action));
            sendData("p.item-"+number, packageName, packageVersion, targetHost, managerHost, Action);
                number += 1;
        }

    }

    function generateLink(packageName: String, packageVersion: String, targetHost: String, managerHost: String, packageAction: String)
    {
        var htmlLink = "<form class='sendData' method='post'>" +
            '<input type="hidden" id="packageName" value=""'+packageName+'">'+
            '<input type="hidden" id="packageVersion" value=""'+packageVersion+'">'+
            '<input type="hidden" id="targetHost" value=""'+targetHost+'">'+
            '<input type="hidden" id="managerHost" value=""'+managerHost+'">'+
            '<input type="hidden" id="packageAction" value=""'+packageAction+'">'+
            '<button class="btn btn-sm">'+
            '<i class="fa fa-refresh"></i>'+packageAction+'</button>'+
            '</form>';
        return htmlLink;
    }
    function sendData(item, packageName, packageVersion, targetHost, managerHost, Action)
    {
        $('#modal-contents > '+item+' > form').submit(function (event) {
            console.log('sendData clicked');
            console.log(event);
            console.log(item);
            console.log(item, packageName, packageVersion, targetHost, managerHost, Action, event);
            console.log();
            event.preventDefault();
            jQuery.ajax({
            type: "POST",
                url: "includes/packageAction.php",
                data: {
                    item: item,
                    packageName: packageName,
                    packageVersion: packageVersion,
                    targetHost: targetHost,
                    managerHost: managerHost,
                    Action: Action
                },
                dataType: "text",
                beforeSend: function () {
                    jQuery("p.item-5").html("\<i class=\"fa fa-refresh fa-spin fa-4x\"\>\<\/i\>");
                },
                success: function (data) {
                    console.log('data: ');
                    console.log(data);
                    jQuery("p.item-5").html("<pre><code>"+ data +"</code></pre>");
                    jQuery("p.item-6").html("<p>実行コマンドが成功です。</p>");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    jQuery("p.item-5").html("<p>"+ xhr.status + "<br>"+xhr.responseText+"<br>"+thrownError+"</p>");
                    jQuery("p.item-6").html("<p>実行コマンドが失敗です。</p>");

                    //alert(xhr.status);
                    //alert(thrownError);
                    //alert(xhr.responseText);
                }

            });
            event.preventDefault();
        });
    }




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
})
});

