$(function () {
    $('.toggle--notifications').css("cursor", "pointer");
    $('.toggle--notifications').click(function () {
        $('.notifications__list').slideToggle(200);
    });
});
