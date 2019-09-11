/*
 * Funciones globales personalizados para el 
 * */

custom = new function () {

    /**
    * AJAX : Solicitud HTTP asíncrona.
    * Info: http://api.jquery.com/jquery.ajax/
    * @access public
    * @param ajaxOptions Parámetros que define el evento(event), las variables(data) y la función a ejecutar(handler)
    */
    this.ajax = function (ajaxOptions) {
        $.ajax({
            // ---------- beforeSend: [function] Función de devolución de llamada previa a la solicitud
            beforeSend: function () {
                // Show full page Loading Overlay
                //$.LoadingOverlay("show");
            },

            // ---------- type: [String] Alías para method
            method: ajaxOptions.method ? ajaxOptions.method : 'GET',

            // ---------- url: [String] Una cadena que contiene la URL a la que se envía la solicitud
            url: ajaxOptions.url, //? ajaxOptions.url : location.reload(true),

            // ---------- data: [PlainObject / String / Array] Datos que se enviarán al servidor
            data: ajaxOptions.data,

            // ---------- dataType: [String] El tipo de datos que espera del servidor
            dataType: ajaxOptions.dataType ? ajaxOptions.dataType : 'json', //xml, script, json or html

            // ---------- dataFilter: [Function] Función para filtrar elementos en la respuesta
            //dataFilter: ajaxOptions.dataFilter
            //    ? function (response) { ajaxOptions.dataFilter(response); }
            //    : function () { },

            // ---------- contentType: [Boolean / String] Indica el tipo de que espera del servidor
            //contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            contentType: ajaxOptions.contentType,

            // ---------- processData: [Boolean] Procesa los datos pasados en la opción data y los transforma en una cadena de consulta
            processData: ajaxOptions.processData,

            // ---------- success: [Function] Función a ser llamada si la solicitud tiene éxito
            success: function (response) { ajaxOptions.success(response); },

            xhrFields: ajaxOptions.xhrFields,

            // ---------- error: [Function] Función a ser llamada si la solicitud falla
            /*
                object jqXHR:
                    Es un objeto jqXHR que contiene todos los datos de la solicitud Ajax realizada,
                    incluyendo la propiedad jqXHR.status que contiene, entre otros posibles, el código de estado HTTP de la respuesta.
                string textStatus:
                    Texto que describe el tipo de error, que puede ser, además de null, “abort”, “timeout”, “No Transport” o “parseerror”.
                string errorThrown:
                    Si hay un error HTTP, errorThrown contiene el texto de la cabecera HTTP de estado.
                    Por ejemplo, para un error HTTP 404, errorThrown es “Not found”;
                                 para error un HTTP 500 es “Internal Server Error”.
            */
            error: function (jqXHR, textStatus, errorThrown) {
                ajaxOptions.error(jqXHR, textStatus, errorThrown);
                swal({
                    title: "¡Ocurrió un error!" + jqXHR.status,
                    text: errorThrown + ", status: " + textStatus,
                    type: "error",
                    icon: "error",
                    timer: 10000,
                    button: "OK",
                });
            },

            // ---------- complete: [Function] Función a ser llamada después de las opciones success y error
            complete: function () {
                // Hide full page Loading Overlay
                //$.LoadingOverlay("hide");
            }
        });
    };

    /**
    * Función que adjunta una función de controlador de eventos para uno o más eventos a los elementos seleccionados
    *  .on( events [, selector ] [, data ], handler ):
    * Info: http://api.jquery.com/jquery.ajax/
    * @access public
    * @param {String} form_id Id del formulario <form>
    * @param {String} selector Elemento DOM dentro del <form>
    * @param parameters Parámetros que define el evento(event), las variables(data) y la función a ejecutar(handler)
    */
    this.performEventGlobal = function (form_id, selector, parameters) {
        $('#' + form_id).find(selector).on(
            parameters.event,	// --------- event: [String] Eventos: click, dblclick, change, etc.
            parameters.data,	// ---------- data: [Array] Datos que se pasarán al controlador event.data cuando se desencadene un evento.
            parameters.handler	// -------- handler: [Function] Función para ejecutar cuando se desencadena el evento.
        );
    };

    /**
     * Función para cambiar etiquetas de la tabla
     * @param {any} idtable
     */
    this.dataTable = function (table_id) {
        $(table_id).DataTable({
            language: {
                "decimal": "",
                "fixedHeader": true,
                "responsive": true,
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    };

    /**
    * Función para reemplazar una cadena
    * @param {String} string Cadena a modificar
    * @param {String} find Cadena o caracter actual
    * @param {String} replace Cadena o caracter nuevo
    */
    this.replaceAllInString = function (string, find, replace) {
        //http://stackoverflow.com/questions/1144783/replacing-all-occurrences-of-a-string-in-javascript
        function escapeRegExp(string) {
            return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        }
        //So in order to make the replaceAll function above safer, it could be modified to the following if you also include escapeRegExp
        return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
    };
};