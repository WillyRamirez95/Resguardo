$('#tablapendientes tr').click(function(){
        var id = $(this).children('.id').text()
        var codigo = $(this).children('.codigo').text()
        var cliente = $(this).children('.cliente').text()
        // console.log(id)
        // console.log($('#cliente').text())
        $('#idcliente').val(id)
        $('#codcliente').val(codigo)
        $('#cliente').val(cliente)

        $('.bt-registrar').text('Registrar')
        $('.bt-registrar').prop('name','registrar');
})

$('#tablaregistrados tr').click(function(){
        var id = $(this).children('.idtr').text()
        var cliente = $(this).children('.clientetr').text()
        var obs = $(this).children('.obs').text()

        $('#idcliente').val(id)
        $('#cliente').val(cliente)
        $('#obs').val(obs)

        $('.bt-registrar').text('Actualizar')
        $('.bt-registrar').prop('name','actualizar');
})

$('.respuesta').click(function(){
        $('.respuesta').remove()
})