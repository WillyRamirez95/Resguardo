function validarclave(){
    var v1 = $('#pass1').val()
    var v2 = $('#pass2').val()

   if(v1!==v2){
        $('#valpass').text("Las contraseñas no coinciden")
        $('.bt-registrase').css('display','none')
        $('#valpass').css('display','block')
        // $('#btregistarse').attr('disabled','disabled')
        // $('#btregistarse').css('background-color','grey')
    }else{
        $('.bt-registrase').css('display','block')
        $('#valpass').css('display','none')
        // $('#btregistarse').css('background-color','dodgerblue')
        // $('#btregistarse').attr('disabled','')

    }
    // console.log(v1 + ' ' + v2)
}