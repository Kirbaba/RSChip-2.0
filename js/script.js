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

/*----------------SELECT--------------*/
$(document).ready(function(){
    $('#version').hide();
    $('#model').hide();
    $('#year').hide();
    $('#submitAuto').hide();

    $('#mark').on('change', function () {
        var val = $(this).val();
        $('#version').html('<option value="0">Выберите тип двигателя</option>');
        $('#year').html('<option value="0">Выберите год</option>');
        //alert(val);
        if(val!=0){
            $.ajax({
                url: myajax.url, //url, к которому обращаемся
                type: "POST",
                data: "action=getModel&idMark=" + val, //данные, которые передаем. Обязательно для action указываем имя нашего хука
                success: function (data) {
                    $('#model').html(data);
                    $('#model').fadeIn();
                    $('input, select').trigger('refresh');
                }
            });
        }

    });
    $('#model').on('change', function () {
        var val = $(this).val();
        //alert(val);
        if(val!=0){
            $.ajax({
                url: myajax.url, //url, к которому обращаемся
                type: "POST",
                data: "action=getVersion&idModel=" + val, //данные, которые передаем. Обязательно для action указываем имя нашего хука
                success: function (data) {
                    $('#version').html(data);
                    $('#version').fadeIn();
                    $('input, select').trigger('refresh');
                }
            });
        }
    });
    $('#version').on('change', function () {
        var val = $(this).val();
        //alert(val);
        if(val!=0){
            $.ajax({
                url: myajax.url, //url, к которому обращаемся
                type: "POST",
                data: "action=getYear", //данные, которые передаем. Обязательно для action указываем имя нашего хука
                success: function (data) {
                    $('#year').html(data);
                    $('#year').fadeIn();
                    $('input, select').trigger('refresh');
                }
            });
        }
    });

    $('#year').on('change', function(){
        var val = $(this).val();
        //alert(val);
        if(val!=0){
            $('#submitAuto').fadeIn();
        }
    });

    $('#submitAuto').on('click', function () {
        var val = $('#version').val();
        var year = $('#year').val();

        if(val!=0){
            $.ajax({
                url: myajax.url, //url, к которому обращаемся
                type: "POST",
                data: "action=getInfo&idVersion="+val, //данные, которые передаем. Обязательно для action указываем имя нашего хука
                success: function (data) {
                    var unpackedData = JSON.parse(data.slice(0,-1));

                    $("#hpChipInfo").html(unpackedData.hpChip);
                    $("#hpInfo").html(unpackedData.hp);
                    $("#nmDiffInfo").html('+' + unpackedData.nmDiff );
                    $("#hpDiffInfo").html('+' + unpackedData.hpDiff );
                    $("#versionInfo").html(unpackedData.mark + ' \\ ' + unpackedData.model + ' \\ ' + unpackedData.version + ' \\ ' + year );
                    $('input, select').trigger('refresh');
                }
            });
        }
        return false;
    });

    $(document).on('click','.searchresult__model__sub', function(){
        var auto =  $("#versionInfo").html();
        var hpchip =  $("#hpChipInfo").html();
        var hp =  $("#hpInfo").html();
        var nmdiff =  $("#nmDiffInfo").html();
        var hpdiff =  $("#hpDiffInfo").html();
        var mail =  $(".searchresult__model__input").val();

        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: "action=sendParams&mail="+mail+"&auto="+auto+"&hpchip="+hpchip+"&hp="+hp+"&nmdiff="+nmdiff+"&hpdiff="+hpdiff, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function (data) {
               console.log(data);
            }
        });
    });
});
