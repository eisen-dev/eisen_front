$(function () {
    $('.notifications__toggle').css("cursor", "pointer");
    $('.notifications__toggle').click(function () {
        $('.notifications__list').slideToggle(200);
    });
});
