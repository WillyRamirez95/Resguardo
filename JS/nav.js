// $('.user').on('click',function(){
//     $('.menu-user').slideToggle('fast');
// })

$('.web').on('click',function(){
    // $(this).parent('.menu').children('.item').slideToggle('fast');
    $('.menu').slideToggle('fast');
})

$('.item-text').on('click',function(){
    $(this).parent('.item').children('.submenu').slideToggle('fast');
})

$('.sbitem-elemento').on('click',function(){
    $('.contenedor').css('display','block')
    $('.block').remove()
var padreelemento = $(this).closest('.item').children('.item-text').text()
    var elementoenuso = $(this).text();
    $(this).closest('.submenu').slideToggle('fast');
    $(this).closest('.menu').slideToggle('fast');
    // $('.titulo').text('Resguardo Polyfiles > '+ padreelemento +' > '+ elementoenuso);
})
