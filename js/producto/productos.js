		$(document).ready(function() {
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: './ajax/producto/buscar_productos.php?action=ajax&page=' + page + '&q=' + q,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $('#loader').html('');

		        }
		    })
		}

		function eliminar(id) {
		    var q = $("#q").val();
		    if (confirm("Realmente deseas eliminar el producto")) {
		        $.ajax({
		            type: "GET",
		            url: "./ajax/producto/buscar_productos.php",
		            data: "id=" + id,
		            "q": q,
		            beforeSend: function(objeto) {
		                $("#resultados").html("Mensaje: Cargando...");
		            },
		            success: function(datos) {
		                $("#resultados").html(datos);
		                load(1);
		            }
		        });
		    }
		}

		$("#guardar_producto").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/producto/nuevo_producto.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		$("#editar_producto").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/producto/editar_producto.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax2").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		function obtener_datos(id) {

		    var codCrm = $("#codCrm" + id).val();
		    var codNeural = $("#codNeural" + id).val();
		    var nombProducto = $("#nombProducto" + id).val();
		    var nombProdNeural = $("#nombProdNeural" + id).val();
		    var modelo = $("#modelo" + id).val();
		    var codigoLP = $("#codigoLP" + id).val();
		    var codigo_inicio = $("#codigo_inicio" + id).val();
		    var tipo_bater = $("#tipo_bater" + id).val();
		    var estado = $("#estado" + id).val();

		    console.log(codCrm);

		    $("#mod_codCrm").val(codCrm);
		    $("#mod_codNeural").val(codNeural);
		    $("#mod_nombProducto").val(nombProducto);
		    $("#mod_nombProdNeural").val(nombProdNeural);
		    $("#mod_modelo").val(modelo);
		    $("#mod_codigoLP").val(codigoLP);
		    $("#mod_codigo_inicio").val(codigo_inicio);
		    $("#mod_tipo_bater").val(tipo_bater);
		    $("#mod_estado").val(estado);
		    $("#mod_id").val(id);

		}

		// Copia de parametro a otro parametro
		$("#nombProducto").on("input", function() {
		    var value = $(this).val();
		    $("#nombProdNeural").val(value);
		    $("#modelo").val(value);
		    $("#codigoLP").val(value);
		});

		$("#mod_nombProducto").on("input", function() {
		    var value = $(this).val();
		    $("#mod_nombProdNeural").val(value);
		    $("#mod_modelo").val(value);
		    $("#mod_codigoLP").val(value);
		});


		$("#close").click(function() {
		    $("#nombProducto").val('');
		    $("#nombProdNeural").val('');
		    $("#modelo").val('');
		    $("#codigoLP").val('');
		    $("#codigo_inicio").val('');
		    $("#tipo_bater").val('');
		    $("#estado_bater").val('');
		});
		$("#closeM").click(function() {
		    $("#nombProducto").val('');
		    $("#nombProdNeural").val('');
		    $("#modelo").val('');
		    $("#codigoLP").val('');
		    $("#codigo_inicio").val('');
		    $("#tipo_bater").val('');
		    $("#estado_bater").val('');
		});