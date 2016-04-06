$(document).ready(function () {
    //NiceScroll
    $(".commentList").niceScroll({
        zindex: 1000000,
        cursorborderradius: "4px", // Làm cong các góc của scroll bar
        cursorcolor: "#EA6A48", // Màu của scroll bar
        cursorwidth: "10px", // Kích thước bề ngang của scroll bar
        autohidemode: true   //Tắt chế độ tự ẩn của scroll bar
    });
    var kt = 0;


    //slider
    $('#image-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 9,
        slideMargin: 0,
        speed: 1000,
        auto: false,
        loop: true,
        keyPress: true,
        onSliderLoad: function () {
            $('#image-gallery').removeClass('cS-hidden');
            $("div.lSSlideWrapper").after("<hr/>");
            
        }
    });
});