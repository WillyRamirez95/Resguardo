





function buscarahora(buscar,id) {
    var parametros = { "buscar": buscar,"campoid": id };
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '../programacion/vistas/busqueda-lo.php',
        success: function (data) {
            // $('body').innerHTML = data;
            document.getElementById("resultado-busqueda").innerHTML = data;
        }
    });
    console.log("funciona");
}






// $('.campobusqueda').keyup(function(){
//     // $('.canpobusqueda').on('click',function(){
        
//     console.log("cambio")
//     // $('#cliente').attr("readonly",true)
//     $('.campobusqueda').attr("readonly",true)
//     $(this).attr("readonly",false)
    
// })




// $('#add').on('click',function(){
//     $('#if').append('<iframe src="addregistroci.php" frameborder="0"' +
//     'id="addiframe">'+
//     '</iframe>');
//     $('.content-iframe').css('display','block');
// })


// $('.close').on('click',function(){
//     $('#addiframe').remove()
//     $('.content-iframe').css('display','none');
//     location.reload();

// })


