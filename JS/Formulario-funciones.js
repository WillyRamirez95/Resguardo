//FUNCION CHECKBOX SERVICIOS
//SE1
function TodosSE1() {
    if ($('#SE1').prop("checked")) {
        $(".SE1").prop("checked", true)
    } else {
        $(".SE1").prop("checked", false)
    }
}

function QuitarTodosSE1() {
    $('#SE1').prop("checked", false)
}

//SE1
function TodosSE2() {
    if ($('#SE2').prop("checked")) {
        $(".SE2").prop("checked", true)
    } else {
        $(".SE2").prop("checked", false)
    }
}

function QuitarTodosSE2() {
    $('#SE2').prop("checked", false)
}

//SE3
function TodosSE3() {
    if ($('#SE3').prop("checked")) {
        $(".SE3").prop("checked", true)
    } else {
        $(".SE3").prop("checked", false)
    }
}

function QuitarTodosSE3() {
    $('#SE3').prop("checked", false)
}

//SR1
function TodosSR1() {
    if ($('#SR1').prop("checked")) {
        $(".SR1").prop("checked", true)
    } else {
        $(".SR1").prop("checked", false)
    }
}

function QuitarTodosSR1() {
    $('#SR1').prop("checked", false)
}

//SR2
function TodosSR2() {
    if ($('#SR2').prop("checked")) {
        $(".SR2").prop("checked", true)
    } else {
        $(".SR2").prop("checked", false)
    }
}

function QuitarTodosSR2() {
    $('#SR2').prop("checked", false)
}

// function validar() {
//     if ($('.SE1').prop('checked') ) {
//         alert("Checkbox seleccionado")
//     }
// }

    // function eliminar(){
    //     $(this).parent().parent().remove()
    //     console.log($(this).parent())
    // }

//Agregar fila para cuenta y subcuenta
function agregar() {
    const text='<tr>'+
    '<td><input class="cnt-sbc"></td>'+
    '<td><input class="cnt-sbc"></td>'+
    '<td><input type="button" value="X" class="bt-eliminar"></td>'+
    '</tr>'
    $('#tabla-c>tbody').append(text);
}



function agregarfila_multiusuario() {
    $('#multiusuario>tbody').append(
        '<tr><td class="fila-multiusuario"><input type="text"></td>' +
        '<td class="fila-multiusuario"><input type="text"></td>' +
        '<td class="fila-multiusuario"><input type="text"></td>' +
        '<td class="fila-multiusuario"><select name="tuser" class="tuser">' +
        '<option label="[Seleccionar]"></option>' +
        '<option label="Avanzado"></option>' +
        '<option label="Básico"></option>' +
        '<option label="Consulta"></option>' +
        '</select></td>' +
        '<td class="fila-multiusuario"><input type="button" value="X" class="bt-eliminar"></td>' +
        // '<td><input type="text" placeholder="Member Poly"></td>'+
        '</tr>'
    );
}

function agregarfila_multiusuario_Oneil() {
    $('#multiusuario_oneil>tbody').append(
        '<tr>' +
        '<td><input type="text"></td>' +
        '<td><input type="text"></td>' +
        '<td><input type="text"></td>' +
        '<td>' +
        '<select name="GPCLientes" id="GPClientes">' +
        '<option label="[Seleccionar]"></option>' +
        '<option label="P-Todos"></option>' +
        '<option label="P-Polyfiles"></option>' +
        '</select>' +
        '</td>' +
        '<td>' +
        '<select name="GPPermisos" id="GPPermisos">' +
        '<option label="[Seleccionar]"></option>' +
        '<option label="Almacen-Operad"></option>' +
        '<option label="Almacén-Reasign"></option>' +
        '<option label="Almacén-Coord"></option>' +
        '<option label="Desp-Coord"></option>' +
        '<option label="Gest-Gestor"></option>' +
        '<option label="Gest-Superv"></option>' +
        '<option label="Inv-Operad"></option>' +
        '<option label="Inv-Coord"></option>' +
        '<option label="Oneil-Audit"></option>' +
        '<option label="Oneil-Asist"></option>' +
        '<option label="Oneil-Lider"></option>' +
        '</select>' +
        '</td>' +
        '<td class="fila-multiusuario"><input type="button" value="X" class="bt-eliminar"></td>' +
        '</tr>'
    )
}

function valideKey(evt) {

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode

    if (code == 8) { // backspace.
        return true
    } else if (code >= 48 && code <= 57) { // is a number.
        return true
    } else { // other keys.
        return false;
    }
}

// function viewSug() {
//     $('.sugerencia-img').on('drag'){
//         $('sugerencia-span').prop('display','flex')
//     }
// }

function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}

function PrintFileweb() {
    //Informacion_General
    var estado = $('input[name=multiusuario]:checked').val()

    if (estado == 'Si') {
        //no valida nada
        window.print()
    } else {
        var EUsuario = $('#usuario').val()
        var ECorreo = $('#correo').val()
        var ETelefono = $('#telefono').val()
        if (EUsuario == '') {
            alert('Por favor completar el campo: "nombre del usuario"')
        } else {
            if (ECorreo == '') {
                alert('Por favor completar el campo: "correo"')
            } else {
                if (ETelefono == '') {
                    alert('Por favor completar el campo: "telefono"')
                } else {
                    window.print()
                }
            }
        }

    }

}

function PrintOneil() {
    window.print()
}


function ObtenerDatos() {

    var validacion_cliente = $('#cliente').val()
    var validacion_ruc = $('#RUC').val()
    var validacion_usuario = $('#usuario').val()

    if (validacion_cliente == '') {
        alert('Por favor completar el campo "Nombre de cliente"')
        $('ObtenerDatos()').finish()
        // return false;
    }
    if (validacion_ruc == '') {
        alert('Por favor completar el campo "RUC"')
        $('ObtenerDatos()').finish()
    }
    if (validacion_usuario == '') {
        alert('Por favor completar el campo "Responsable"')
        $('ObtenerDatos()').finish()
    }


    //Datos de la primera parte:
    var HorariosA = ''
    var ha
    var HorarioT = ''
    var conteoha = 0
    var conteot = 0
    $('input[class=horario]').each(function () {
        ha = $(this).val()
        conteot = conteot + 1
        if (ha == '') {
            conteoha = conteoha + 1
        }

        if (HorariosA == '') {
            HorariosA = ha
            // alert(HorariosA)
        } else {
            HorariosA = HorariosA + ' ' + ha
            // alert(HorariosA)
        }

        if (conteot == 1) {
            HorarioT = 'Primer Turno:' + ' ' + ha
        } else {
            if (conteot == 2) {
                HorarioT = HorarioT + ' - ' + ha
            } else {
                if (conteot == 3) {
                    HorarioT = HorarioT + ' ~ ' + 'Segundo Turno' + ' ' + ha
                } else {
                    HorarioT = HorarioT + ' - ' + ha
                }
            }

        }

    })

    //En caso no tenga completo el horario de atención se finaliza el proceso.
    if (conteoha > 0) {
        // alert(ha)
        alert('Por favor completar los datos de: Horario de atención')
        $('ObtenerDatos()').finish()
    }

    //Responsable
    var usuario = $('#usuario').val()
    if (usuario == '') {
        alert('Por favor completar el campo responsable*')
        $('ObtenerDatos()').finish()
    }
    // alert(usuario)


    const hoy = new Date();
    const dia = hoy.getDate();
    const mes = hoy.getMonth();
    const año = hoy.getFullYear();
    const time = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds()
    var fecha = dia + '/' + mes + '/' + año + ' - ' + time
    $('.fechaformato').text(fecha)


    // var encriptado = btoa(data)
    // $('#encriptado').text(encriptado)
    // atob = desencriptar

    // document.getElementById(encriptado).innerHTML = encriptado;
    $('#flotante').css('display', 'flex')

    //  function exportar (data, fileName) {
    // const a = document.createElement("a");
    // const contenido = encriptado,
    //     blob = new Blob([contenido], {type: "octet/stream"}),
    //     url = window.URL.createObjectURL(blob);
    // a.href = url;
    // a.download = nombreArchivo;
    // a.click();
    // window.URL.revokeObjectURL(url);

    $('fechaformato').text(fecha)
    window.print()

}


//
//ONEIL
//

function limpiarTA() {

    var ta = $('#tacomentarios').text()
    if (ta = 'Ejemplo: WRÑ = pdt fresno') {
        $('#tacomentarios').text('')
        $('#tacomentarios').css('color', 'black')
    } else {

    }
}


// function alerta(){
//     // alert($('#buscar-firma').val)

// //     var image = $('#buscar-firma')[0];       // $('#this_one img') this will return the img array. In order to get the first item use [0]
// // var imageSrc = image.src;
// // alert(imageSrc);

// // var someimage = document.getElementById('firma-img').firstChild.getAttribute("src");
// // alert(someimage);
// document.getElementById('firma-img').getElementsByTagName('img')[0].src
// }

// function prueba(){
//     const hoy = new Date();
//     const dia = hoy.getDate();
//     const mes = hoy.getMonth();
//     const año = hoy.getFullYear();
//     var fecha = dia+'/'+mes+'/'+año 
//     $('.fechaformato').text(fecha)
// }


// function valcheckprueba(){
//     var numero=prompt('ingrese numero')
//     if(numero%2 ==0){
//         document.write('par')
//     }else{
//         document.write('inpar')
//     }
// }

// function valcheck() {



//     // var doc = new jsPDF();
//     // var elementHTML = $('#frame').html();
//     // var specialElementHandlers = {
//     //     '#editor': function (element, renderer) {
//     //         return true;
//     //     }
//     // };
//     // doc.fromHTML(elementHTML, 15, 15, {
//     //     'width': 170,
//     //     'elementHandlers': specialElementHandlers
//     // });

//     // // Save the PDF
//     // doc.save('sample-document.pdf');

//     //Definimos el botón para escuchar su click
// // // const $boton = document.querySelector("#btnCapturar"), // El botón que desencadena
// // $objetivo = document.body; // A qué le tomamos la fotocanvas
// // // Nota: no necesitamos contenedor, pues vamos a descargarla

// // // Agregar el listener al botón
// // // $boton.addEventListener("click", () => {
// // html2canvas($objetivo) // Llamar a html2canvas y pasarle el elemento
// //   .then(canvas => {
// //     // Cuando se resuelva la promesa traerá el canvas
// //     // Crear un elemento <a>
// //     let enlace = document.createElement('a');
// //     enlace.download = "Captura de página web - Parzibyte.me.png";
// //     // Convertir la imagen a Base64
// //     enlace.href = canvas.toDataURL();
// //     // Hacer click en él
// //     enlace.click();
// //   });
// // });  


// // const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
// // html2pdf()
// //     .set({
// //         margin: 1,
// //         filename: 'documento.pdf',
// //         image: {
// //             type: 'jpeg',
// //             quality: 0.98
// //         },
// //         html2canvas: {
// //             scale: 3, // A mayor escala, mejores gráficos, pero más peso
// //             letterRendering: true,
// //         },
// //         jsPDF: {
// //             unit: "in",
// //             format: "a3",
// //             orientation: 'portrait' // landscape o portrait
// //         }
// //     })
// //     .from($elementoParaConvertir)
// //     .save()
// //     .catch(err => console.log(err));


// var doc = new jsPDF();
//     var specialElementHandlers = {
//         '#editor': function (element, renderer) {
//             return true;
//         }
//     };

//     // $('#cmd').click(function () {
//         doc.fromHTML($('#frame').html(), 15, 15, {
//             'width': 170,
//                 'elementHandlers': specialElementHandlers
//         });
//         doc.save('sample-file.pdf');
//     // });


// }

// function prueba(){
//     var HorariosA=''
//     var ha
//     $('input[class=horario]').each(function(){
//         ha=$(this).val()
//         if(HorariosA==''){
//             // HorariosA   = ha
//             alert(HorariosA)
//             $('prueba()').finish()
//         }else{
//             HorariosA = HorariosA + ' '+ ha
//             alert(HorariosA)
//         }
//     })
// }