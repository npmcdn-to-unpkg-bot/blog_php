$(function () {
    if ($(window).height() > $(".pusher").height()) {
        console.log($(window).height());
        console.log($(".pusher header").height());
        console.log($(".pusher footer").height());
        console.log($(window).height() - $(".pusher header").height() - $(".pusher footer").height());
        $(".pusher section").innerHeight($(window).height() - $(".pusher header").height() - $(".pusher footer").height());
    }
    $("header #sidebar").click(function () {
        $('.ui.sidebar').sidebar('toggle');
    });
    $('.ui.dropdown').dropdown();
    $('.article-info .ui.rating').rating();
    $('.article-list .ui.rating').rating('disable');
    $('.ui.accordion').accordion();
});