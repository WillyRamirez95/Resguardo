//ACCIONES

$('.resultado').on('click',function(){
    //REMOVER MENSAJE
    $('.resultado').remove();
})

$('.respuesta').on('click',function(){
    //REMOVER MENSAJE
    $('.respuesta').remove();
})


$('.more').on('click',function(){
    var estado = $('.oculto').is(':visible')
    if(estado){
        $('.oculto').css('display','none')
        $('.more').text("Mostrar mas campos de búsqueda(+)")
    }else{
        $('.oculto').css('display','block')
        $('.more').text("Ocultar campos de búsqueda adicionales (-)")

    }
    // $('#cliente').attr("readonly",true)
    // $('#solicitante').attr("readonly",true)
})

//FUNCIONES PARA ADDREGISTROCI
//función para filtrar add control inv  -  level oneil


$('body').on('click', '.registrocuenta', function () {
    // console.log($(this).text()) //('id'))
    var codigo = $(this).children('.cod').text();
    var cliente = $(this).children('.cliente').text();
    var referencia = $(this).children('.referencia').text();
    var idcliente = $(this).children('.idcliente').text();
    // var coordinador = $(this).children('.coordinador').text();
    // console.log(codigo)
    // console.log(ref)
    // console.log(desc)
    $('#codcliente').val(codigo);
    $('#cliente').val(cliente);
    $('#cuenta').val(referencia);
    $('#idcliente').text(idcliente);
    console.log(idcliente + ' ' + $('#idcliente').val(idcliente))
    // $('#coordinador').val(coordinador);

    $(this).closest('#resultado').remove();    
    $('body').css('display','block')
    $('#resultado-busqueda').css('display','none')
})



//FUNCIONES

function buscarahora(buscar,id) {
    var parametros = { "buscar": buscar,"campoid": id };
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '../programacion/vistas/busqueda-lo.php',
        success: function (data) {
            // $('body').innerHTML = data;
            document.getElementById("resultado-busqueda").innerHTML = data;
            $('#resultado-busqueda').css('display','block')
        }
    });
    $('body').css('display','flex')
}



function Busquedapersonalizada(buscar,id){
    var parametros = { "buscar": buscar,"campo":id };
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '../programacion/vistas/busqueda-ci.php',
        success: function (data) {
            // $('body').innerHTML = data;
            document.getElementById("datos-busqueda").innerHTML = data
        }
    });
}


// $(document).ready(function(){

//     $("#search").keyup(function(){

//     _this = this;

    

//         $.each($("#datos tbody tr"), function() {

//         if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)

//         $(this).hide();

//         else

//         $(this).show();

//         });

//     });

// });