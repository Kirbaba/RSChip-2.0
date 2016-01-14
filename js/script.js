/*-------------GOOGLE MAPS-----------------*/

function initialize() {

    var mapOptions = {
        center: new google.maps.LatLng(55.662878, 37.540873),
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    };    
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);    
    var image = img.url + 'map-marker.png';
    var myLatLng = new google.maps.LatLng(55.662561,37.540873);
    var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
    });
}

function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyAaOWKyamSxMTXclSDFmJ2N4Am20PCTD6I&sensor=FALSE&callback=initialize";
    document.body.appendChild(script);
}

window.onload = loadScript;


$(function() {

    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').click(function() {
        $('body,html').animate({scrollTop: 0}, 1000);
    });

    $('.smoothScroll').click(function(event) {
        event.preventDefault();
        var href=$(this).attr('href');
        var target=$(href);
        var top=target.offset().top;
        $('html,body').animate({
            scrollTop: top
        }, 1000);
    });


    var clock;
    clock = $('.clock').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,   
        lang: 'ru'  
    });    

    clock.setTime(440880);
    clock.setCountdown(true);
    clock.start();

    var clock2;
    clock2 = $('.clock_2').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,   
        lang: 'ru'  
    });    

    clock2.setTime(440880);
    clock2.setCountdown(true);
    clock2.start();

    jQuery(function ($) {

        jQuery('.reviews__carousel').slick({
            dots: false,
            infinite: true,
            autoplay: true,
            adaptiveHeight: true,
            speed: 300,
            arrows: true,        
            slidesToShow: 1,
            slidesToScroll: 1,
            focusOnSelect: false,
        });
    });

});

