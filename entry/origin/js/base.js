$(function () {
    $("header #sidebar").click(function () {
        $('.ui.sidebar').sidebar('toggle');
    });
    $('.ui.dropdown').dropdown();
    $('.article-info .ui.rating').rating();
    $('.article-list .ui.rating').rating('disable');
    $('.ui.accordion').accordion();
});