$(function () {
    $('.notifications').css("cursor", "pointer");
    $('.notifications').click(function () {
        $('.notifications__list').slideToggle(200);
    });
});
