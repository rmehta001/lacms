$(document).ready(function () {

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });


    $(window).scroll(function () {

        if ($(this).scrollTop() > 100) {
            $(".navbar-home").addClass("bg-white trasition");
            $(".nav-link-home").removeClass("text-white");
        }
        else {
            $(".navbar-home").removeClass("bg-white");
            $(".nav-link-home").addClass("text-white");
        }

    });



});