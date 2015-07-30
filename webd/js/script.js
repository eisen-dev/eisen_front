$(function () {
    $('.menu__button').css("cursor", "pointer");
    $('.menu__button').click(function () {
        $('.notifications__list').slideToggle(200);
    });
});
