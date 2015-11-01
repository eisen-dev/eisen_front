$(function () {
    $('.toggle-notifications').css("cursor", "pointer");
    $('.toggle-notifications').click(function () {
        $('.notifi-slide-target').slideToggle(200);
    });
});
