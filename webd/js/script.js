$(function () {
    $('.toggle-notifications').css("cursor", "pointer");
    $('.toggle-notifications').click(function () {
        $('.notifications-list').slideToggle(200);
    });
});
