$(function () {
    $("#registros").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "language": {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Último',
                firts: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
            search: 'Buscar: ',
            lengthMenu: "Mostrar _MENU_ Entradas ",
            infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
        }
    });

    //Date range picker

    $('#fecha').datetimepicker({
        format: 'L',
        locale: 'es'
    });

    //Initialize Select2 Elements
    $('.sel').select2();



    function crearCookie(nombre, valor, dias) {
        var expira;
        if (dias) {
            var date = new Date();
            date.setTime(date.getTime() + (dias * 24 * 60 * 60 * 1000));
            expira = "; expires=" + date.toGMTString();
        } else {
            expira = "";
        }
        document.cookie = escape(nombre) + "=" + escape(valor) + expira + "; path=/";
    }


    // Envio de parametro a url
    $('#valor-query').on('input', function () {
        var query = parseInt($(this).val());

        if (location.search.indexOf('q=') < 0) {

            crearCookie("query", query, 2);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }


    }

    );


    // Validacion fecha anterior

    $('#input-fecha').on('input', function () {

        var input_fecha = new Date($("#input-fecha").val());
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };


        if (input_fecha < fecha_actual) {

            /* console.log('no se puede ingresar lla fecha'); */
            $('#guardar-presu').attr("disabled", true);
            $('#mensaje').text('No puede registrar inversiones posteriores a la fecha: ' + fecha_actual.toLocaleDateString("es-Ec", options));
            $('#mensaje').show();
            return false;

        }
        if (input_fecha == fecha_actual) {
            /* console.log('si se puede ingresar el registro'); */
            $('#mensaje').hide();
            $('#guardar-presu').attr("disabled", false);
            return false;
        }


        if (input_fecha > fecha_actual) {
            /* console.log('si se puede ingresar el registro'); */
            $('#mensaje').hide();
            $('#guardar-presu').attr("disabled", false);
            return false;

        }

    });

});