$(".li-formulario").mouseover(function() {
    // console.log($(this).find("a").text());
    var elmt = $(this).find("a").text();
    $(this).hover(function() {
        // over
        $('.imagenes').css({
            'background-image': 'url(img/' + elmt + '.png)',
            'background-repeat': 'no-repeat',
            'background-size': 'contain',
            'background-position-x': 'center',
            'background-position-y': 'center',
            'transition': '.4s'
        });
    }, function() {
        $('.imagenes').css({
            'background-image': 'url(img/Banner.png)',
            'background-size': 'cover',
            'transition': '.4s'
        });
    });

});


// $('.li-formulario').mouseout(function() {
//     $('.imagenes').css({
//         'background-image': 'url(img/Banner.png)',
//         'background-size': 'cover',
//         'transition': 'easy-in-out all 2s'
//     });
// });