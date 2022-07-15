
$('.text-nuevoreg').on('click',function(){
    if($('#addlevel').is(':visible')){
        $('#addlevel').css('display','none')
        $('.text-nuevoreg').text("Nuevo registro (+)")
    }else{
        $('#addlevel').css('display','block')
        $('.text-nuevoreg').text("Nuevo registro (-)")
    }
})

function buscarlevel(buscar,id) {
    var parametros = {"buscar": buscar, "campoid": id};
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '../programacion/vistas/busqueda-lo.php',
        success: function(data) {
            document.getElementById("resultado-busqueda").innerHTML = data;
        }
    });
}