$(document).ready(function(){

//autocompletes: inicio

	$("#nombre").on('keypress keyup', function(){
		var datos = $("#nombre").val();
			$.ajax({
				type: 'POST',
				url: "ajax.php",
				dataType: "json",
				data: {
					columna: 'nombre',
					datos: datos
				},
				success: function(data){
					$("#body_table").empty();
					$.each(data, function(index, value) {
						$("#body_table").append("<tr><td>"+value.nombre+"</td><td>"+value.codigo+"</td><td>"+value.descripcion+"</td></tr>");
					});
				},
			});
	});

	$("#codigo").on('keypress keyup', function(){
		var datos = $("#codigo").val();
			$.ajax({
				type: 'POST',
				url: "ajax.php",
				dataType: "json",
				data: {
					columna: 'codigo',
					datos: datos
				},
				success: function(data){
					$("#body_table").empty();
					$.each(data, function(index, value) {
						$("#body_table").append("<tr><td>"+value.nombre+"</td><td>"+value.codigo+"</td><td>"+value.descripcion+"</td></tr>");
					});
				},
			});
	});

	$("#descripcion").on('keypress keyup', function(){
		var datos = $("#descripcion").val();
			$.ajax({
				type: 'POST',
				url: "ajax.php",
				dataType: "json",
				data: {
					columna: 'descripcion',
					datos: datos
				},
				success: function(data){
					$("#body_table").empty();
					$.each(data, function(index, value) {
						$("#body_table").append("<tr><td>"+value.nombre+"</td><td>"+value.codigo+"</td><td>"+value.descripcion+"</td></tr>");
					});
				},
			});
	});

		//autocomplete clientes relaciones
	$("#busquedaClientes").on('keypress keyup', function(){
		var datos = $("#busquedaClientes").val();
			$.ajax({
				type: 'POST',
				url: "ajax.php",
				dataType: "json",
				data: {
					tipo: 'cliente',
					datos: datos
				},
				success: function(data){
					$("#listadoClientes").empty();
					$.each(data, function(index, value) {
						$("#listadoClientes").append("<li  class='list-group-item'><a class='text-secondary' href=?id="+value.id+">"+value.nombre+" "+value.apellidos+" - "+value.dni+"</a><li>");
					});
				},
			});
	});


//autocompletes: fin


//mostrar form añadir cliente
	$("#addCliente").on('click', function(){
		$("#formCliente").show('slow');
		$("#botonFormCliente").hide('slow');
	});

//ocultar form añadir cliente
	$("#cerrarForm").on('click', function(){
		$("#formCliente").hide('slow');
		$("#botonFormCliente").show('slow');
	});

//comprobamos los checkbox's
	$("#btnRelacionar").on('click', function(){

		var idCliente = $("#id_cliente").val();
		var productos = [];

		$(".chekcbox_producto:checked").each(function(){
			productos.push($(this).val());
		});

		var datos = JSON.stringify(productos);

		$.ajax({
				type: 'POST',
				url: "ajax.php",
				dataType: "json",
				data: {
					idCliente: idCliente,
					datos: datos
				},
				success: function(response){
					if(response == "OK"){
						$("#confirm").show('slow').delay(1200).hide('slow');
					}else{
						$("#error").show('slow').delay(1200).hide('slow');
					}
				}
			});
	});
	
});