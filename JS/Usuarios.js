
$('.mostrar').on('click',function(){
    $('.contenedor-if').css('display','block')
})

function mostrariframe(){
    $('.contenedor-if').css('display','block')
    $('#iframeusuario').attr('src','usuarios-updt.php')
}

$('#cerrarif').on('click',function(){
    // $('#iframeusuario').remove()
    $('#iframeusuario').attr('src','')
    $('.contenedor-if').css('display','none')
    location.reload();
})


$('#nombre').change(function(){
    console.log("funciona")
})

function buscarusuarios(campo,id){
    var parametros = {"dato": campo, "campoid": id};
    $.ajax({
        url:'../programacion/vistas/buscarusuarios.php',
        type:'POST',
        data: parametros,
        success: function(data){
            document.getElementById("resultado-busqueda").innerHTML = data;
        }
    })
}


$('.editar').on('click',function(){
    $('.contenedor-if').css('display','block')
    // $('#iframeusuario').remove()
    // $('#iframeusuario').attr('src','usuarios-updt.php')
})