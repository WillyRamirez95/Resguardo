// function mostarcomentario(){
//     $('#comentario').css('display','block','position','absolute')
// }

// function ocultarcomentario(){
//     $('#comentario').css('display','none','position','absolute')
// }

function activarusopdt(){
    var estado=''
    estado = $('#uso-pdt-on').val()
    if (estado == 'on'){
        $('.contenedorinterno-pdt').css('display','block')
    }
}

function desactivarusopdt(){
    var estado=''
    estado = $('#uso-pdt-off').val()
    if (estado == 'on'){
        $('.contenedorinterno-pdt').css('display','none')
    }
}

function multiusuario(){
    
    $('input[name=multiusuario]').change(function(){
        var estado  = $(this).val()
    
        if(estado=='Si'){
            $('#contenedor-multiusuario').css('display','block')
            $('#Informacion_General').css('display','none')
            $('#datos_general').hide()
            $('#multiusuario').show()
            $('#permisos_gp').hide()
            $('#permisos_pdt_oneil').hide()
        }else{
            $('#contenedor-multiusuario').css('display','none')
            $('#Informacion_General').css('display','block')
            $('#datos_general').show()
            $('#multiusuario').hide()
            $('#permisos_gp').show()
            $('#permisos_pdt_oneil').show()
        }
    })
}

function miembropoly_si(){
    var estado=''
    estado = $('#miembro-poly-si').val()
    if(estado == 'on'){
        $('#miembro-poly').css({'display':'block','transition':'.4s'})
        $('#TRPerfil').css('visibility','visible')
    }
}

function miembropoly_no(){
    var estado=''
    estado = $('#miembro-poly-no').val()
    if(estado == 'on'){
        $('#miembro-poly').css('display','none')
        $('#TRPerfil').css('visibility','hidden')
    }
}


function asignarcc_yes(){
    var estado = ''
    estado = $('#cc-si').val()
    if(estado=='on'){
        $('#tabla-c').css('display','flex')
        $('#agregar').css('display','block')
        $('#cuentaysubcuenta').css('height','auto')
    }
}

function asignarcc_no(){
    var estado = ''
    estado = $('#cc-no').val()
    if(estado=='on'){
        $('#tabla-c').css('display','none')
        $('#agregar').css('display','none')
        $('#cuentaysubcuenta').css('height','20px')
    }
}

function buscar(){
    var filedom=document.getElementById('buscar-firma')
    var img=document.getElementById('firma-img')
    if(filedom&&img){
        fileHandle(filedom,img);
    }
}
function fileHandle(filedom,img){
    var file = filedom.files[0];
    var reader=new FileReader();

    reader.readAsDataURL(file);
    reader.onloadstart = function () { 
        // console.log('muestra')
     };

     reader.onload = function(e){
         img.setAttribute('src',reader.result)
     }

    $('#buscar-firma').css('display','none')
    $('#firma-img').css('display','flex')

}





// function ver_sugerencia(){
//     // $('#cont-sugerencia').hover(function () {
//     //     // $(this).css('display','block')
//     //     $(this).css('transition','.5s')
//     //   })

// //    $('#cont-sugerencia').css('display','block')

// //    $('#cont-sugerencia').hover(function () {
//             // over
// //            $(this).css('display','block')
// //            $(this).css('transition','.5s')
// //        }, function () {
//             // out
// //           $(this).css('display','none')
//  //      }   
//   //  );
    
// }

// function ocultar_sugerencia(){
//     $('#cont-sugerencia').css('display','none')
// }

// function agregarfirma(){
//     // var url =$('#buscar-firma').html()
//     // alert(url)
//     //$('#firma-img').prop('src',url)
//     // $('#firma').html('')
//     var matches = document.querySelectorAll('div.nota, div.alerta');
// }

// function modificar_src(){
//     const $seleccionArchivos = document.querySelector("#buscar-firma"),
//     $imagenPrevisualizacion = document.querySelector("#firma-img");
  
//   // Escuchar cuando cambie
//   $seleccionArchivos.addEventListener("change", () => {
//     // Los archivos seleccionados, pueden ser muchos o uno
//     const archivos = $seleccionArchivos.files;
//     // Si no hay archivos salimos de la función y quitamos la imagen
//     if (!archivos || !archivos.length) {
//       $imagenPrevisualizacion.src = "";
//       return;
//     }
//     // Ahora tomamos el primer archivo, el cual vamos a previsualizar
//     const primerArchivo = archivos[0];
//     // Lo convertimos a un objeto de tipo objectURL
//     const objectURL = URL.createObjectURL(primerArchivo);
//     // Y a la fuente de la imagen le ponemos el objectURL
//     $imagenPrevisualizacion.src = objectURL;
//   });
    
// }

// function init() {
//     var inputFile = document.getElementById('inputFile1');
//     inputFile.addEventListener('change', mostrarImagen, false);
//   }
  
//   function mostrarImagen(event) {
//     var file = event.target.files[0];
//     var reader = new FileReader();
//     reader.onload = function(event) {
//       var img = document.getElementById('#firma-img');
//       img.src= event.target.result;
//     }
//     reader.readAsDataURL(firma-img);
//   }


//$('#cont-sugerencia').hover(function () {

