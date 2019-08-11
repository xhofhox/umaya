 
 @extends('layouts.app')

@section('content')

<div class="container">
 <div>
   <div class="col-md-12 col-md-offset-1">
     <div class="panel panel-default">
       <div class="panel-heading">Listar CFDI</div>
         <!-- Filtro-->
         <div class="row">
           <form class="col s12">
             <div class="row">
               <div class="input-field col s6">
                 <input id="rfc" type="text" class="validate">
                 <label for="rfc">RFC</label>
               </div>
               <div class="input-field col s6">
                 <input id="folio" type="text" class="validate">
                 <label for="folio">FOLIO</label>
               </div>
             </div>

             <div class="row hidden">
               <div class="input-field col s6">
                 <button id="show-list" type="submit" class="waves-effect waves-light btn-small cyan">Filtrar</button>
               </div>
             </div>
           </form>
         </div>
              <!-- Filtro-->
       
         <div class="panel-body">
           <form method="POST" 
                 action="http://localhost:8083/invoice/listarCFDI"
                 accept-charset="UTF-8" 
                 id="list-invoice">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="form-group">
               <div class="col-md-6 hidden">
                 <label for="Servidor">Servidor:</label>
                 <select class="form-control col-md-8 selection-list hidden" name="Servidor">
                    <option value="selecciona">Selecciona</option>
                    <option value="1" selected="true">Sandbox</option>
                    <option value="2">Producción</option>
                 </select>
               </div>
               <div class="col-md-6">
                 <br />
                 <button id="show-list" type="submit" class="waves-effect waves-light btn-small cyan">Filtrar</button>
               </div>
             </div>
             @include('sweet::alert')              
           </form>
           <br/>
           <br/>
          <table class="table table-striped" id="table-records" style="font-size:12px;"> 
               <thead>
                 <tr bgcolor="FFFDC1">
                   <th>Folio</th>
                   <th>RFC</th>
                   <th>UUID</th>
                   <th>Total</th>
                   <th>FechaTimbrado</th>
                   <th></th>
                   <th></th>
                   <th></th>
                   <th></th>
                 </tr>
               </thead>
               <tbody>
                <tr bgcolor="FFFDC1">
                   <th>Folio</th>
                   <th>RFC</th>
                   <th>UUID</th>
                   <th>Total</th>
                   <th>FechaTimbrado</th>
                   <th></th>
                   <th></th>
                   <th></th>
                   <th></th>
                 </tr>
               </tbody>
             </table>
         </div>
       </div>
   </div>
 </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

 
<script>
 $(document).ready(function(){
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   var formId = '#list-invoice';

   $(formId).on('submit', function(e){
     e.preventDefault();
     var formData = new FormData($(this)[0]);
     $.ajax({
         type: $(formId).attr('method'),
         url: $(formId).attr('action'),
         data: formData,
         contentType: false,
         processData: false,
         beforeSend: function () {
           
         },
         success:  function (data) {
           console.log(data);
           var response = JSON.parse(data);
           if (!undefined)
           {
             if (response.status === "error")
             {
               swal({
                 title: "¡Ocurrió un error!",
                 text: response.message,
                 type: "error",
                 icon: "error",
                 timer: 10000,
                 button: "OK",
               });
             }
             else
             {
               //Mostrar facturas
               swal({
                 title: "¡Éxito!",
                 text: "Total: " + response.total,
                 type: "success",
                 icon: "success",
                 timer: 10000,
                 button: "OK",
               });
               $('#table-records > tbody').html('');
               for(var i = 0; i < response.data.length; i++) {
                 $('#table-records > tbody').append('<tr>' + 
                   '<td>' + response.data[i].Folio + '</td>' +
                   '<td>' + response.data[i].Receptor + '</td>' +
                   '<td>' + response.data[i].UUID + '</td>' +
                   '<td>' + response.data[i].Total + '</td>' +
                   '<td>' + response.data[i].FechaTimbrado + '</td>' +
                   '<td width="1%">' + 
                  // '<a href="http://localhost:8083/invoice/descargarPDF/' + response.data[i].UID + '">download</a>' +<span class="tooltip" title="This is my span's tooltip message!">Some text</span>
                    '<button data-value="' + response.data[i].UID + '" title="Descargar PDF" class="waves-effect waves-light btn-small" id="download-pdf"><i class="material-icons center">picture_as_pdf</i></button>' +
                   '</td>' +
                   '<td width="1%">' + 
                    '<button data-value="' + response.data[i].UID + '" title="Descargar XML" class="waves-effect waves-light btn-small light-blue darken-4" id="download-xml"><i class="material-icons center">insert_drive_file</i></button>' +
                   '</td>' +
                   '<td width="1%">' + 
                   '<button data-value="' + response.data[i].UID + '" title="Cancelar Factura" class="waves-effect waves-light btn-small red" id="cancel"><i class="material-icons center">close</i></button>' +
                   '</td>' +
                   '<td width="1%">' + 
                   '<button data-value="' + response.data[i].UID + '" title="Enviar Factura" class="waves-effect waves-light btn-small amber" id="send_email"><i class="material-icons center">email</i></button>' +
                   '</td>' +
                  '</tr>');  
               }
                //Descargar Factura en formato PDF
                $(document).on(
                    'click',
                    '#download-pdf',
                    function (event) {
                       
                       var cfdi_uid = $(this).attr('data-value');
                       var servidor = $('select[name="Servidor"]').val();
                       
                       var data = new FormData();
                       data.append('cfdi_uid', cfdi_uid);
                       data.append('servidor', servidor);
                       
                       $.ajax({
                           type: 'GET',
                           url: 'http://localhost:8083/invoice/descargarPDF/' + cfdi_uid,
                           //data: data,
                           //dataType : 'binary',
                           //contentType: false,
                           contentType : 'application/pdf',
                           processData: false,
                           beforeSend: function () {},
                           success:  function (data) {
                             console.log(data);
                             window.open(data);

                             
                             // var blob=new Blob([data]);
                             // var link=document.createElement('a');
                             // link.href=window.URL.createObjectURL(blob);
                             // link.download="file.pdf";
                             // link.click();
                           }
                       });
                    }
                );
               //Descargar Factura en formato XML
               $(document).on(
                    'click',
                    '#download-xml',
                    function (event) {
                       
                       var cfdi_uid = $(this).attr('data-value');
                       var servidor = $('select[name="Servidor"]').val();
                       
                       var data = new FormData();
                       data.append('cfdi_uid', cfdi_uid);
                       data.append('servidor', servidor);
                       
                       $.ajax({
                           type: 'POST',
                           url: 'http://localhost:8083/invoice/descargarXML',
                           data: data,
                           //dataType : 'binary',
                           contentType: false,
                           processData: false,
                           beforeSend: function () {},
                           success:  function (data) {
                             // debugger
                             console.log(data);
                             window.open(data);
                             var blob=new Blob([data]);
                             var link=document.createElement('a');
                             link.href=window.URL.createObjectURL(blob);
                             link.download="file.xml";
                             link.click();
                           }
                       });
                    }
                );
             } //termina else
           }
           else{
             swal({
               title: "¡Ocurrió un error!",
               text: "",
               type: "error",
               timer: 1000
             });
           }
         }
     });
   });//Fin submit
 });

</script>
