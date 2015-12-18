/// <reference path="libs/Promise.ts"/>
/// <reference path="libs/jquery.d.ts"/>
/// <reference path="libs/jqueryui.d.ts"/>
"use strict";

/* this variable is getted from php in package_list.php */
declare var target_ipaddress: string;
declare var target_os: string;

console.log(target_ipaddress);
//var userID = <?php echo json_encode($userData); ?>;
console.log(target_ipaddress);
jQuery("#form1").submit(function (event) {
    event.preventDefault();
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
    jQuery(document).on("click", ".cell-which-triggers-popup", function (event) {
        var cellValue = jQuery(event.target).closest("tr").find(".item").text();
        if (cellValue) {
            showPopup(cellValue);
        }
    });

    function showPopup(cellValue) {
        jQuery("#popup").dialog({
            width: 500,
            height: 300,
            open: function (): any
            {
                jQuery(this).find("p.item-1").html(
                    "<a href=includes/package_action/package_action.php?" +
                    "package=" + cellValue +
                    "\&action=install" +
                    "\&target="
                    + target_ipaddress +
                    ">Install "
                    + cellValue +
                    "\</a>");
                jQuery(this).find("p.item-2").html(
                    "<a href=includes/package_action/package_action.php?" +
                    "package="
                    + cellValue +
                    "\&action=update" +
                    "\&target="
                    + target_ipaddress +
                    ">Update "
                    + cellValue +
                    "\</a>");
                jQuery(this).find("p.item-3").html(
                    "<a href=includes/package_action/package_action.php?" +
                    "package="
                    + cellValue +
                    "\&action=delete" +
                    "\&target="
                    + target_ipaddress +
                    ">Delete "
                    + cellValue +
                    "\</a>");
            },
        });
    }
});