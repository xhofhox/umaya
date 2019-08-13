 
 @extends('layouts.app')

@section('content')

<div class="container">
 <div>
   <div class="col-md-12 col-md-offset-1">
     <div class="panel panel-default">
       <div class="panel-heading"><h3>Listado CFDI Masivo</h3></div>
         <div class="panel-body">
          <table class="table table-striped" id="table-records" style="font-size:12px;"> 
               <thead>
                 <tr bgcolor="FFFDC1">
                   <th>Razón social</th>
                   <th>RFC</th>
                   <th>Alumno</th>
                   <th>Forma de pago</th>
                   <th>Uso CFDI</th>
                   <th>Unidad</th>
                   <th>Importe</th>
                   <th></th>
                 </tr>
               </thead>
               <tbody>
                 @foreach($Invoices as $data)
                   <tr>
                     <td>{{ $data['razonsocial'] }}</td>
                     <td>{{ $data['rfc'] }}</td>
                     <td>{{ $data['nombre_alumno'] }}</td>
                     <td>{{ $data['forma_pago_id'] }}</td>
                     <td>{{ $data['uso_cfdi'] }}</td>
                     <td>{{ $data['unidad'] }}</td><!--falta saber de donde obtenemos este dato o a que se refiere-->
                     <td>{{ $data['total_facturado'] }}</td>
                     <td width="1%">
                        <button data-value="{{ $data['id'] }}" 
                          title="Editar factura" 
                          class="edit waves-effect waves-light btn-small" >
                          <i class="material-icons center">mode_edit</i>
                       </button>
                     </td>                     
                   </tr>
                 @endforeach
               </tbody>
             </table>
             <button id="save" type="submit" class="btn btn-primary">Enviar todo</button>
         </div>
       </div>
   </div>
 </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
 $(document).ready(function() {

   //Mostrar tabla
   $('#table-records').DataTable({
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

   //Evento al botón de editar
  $('.edit').on( "click", function() {
    let id = $(this).attr('data-value');
    window.location = 'http://localhost:8083/invoice/editMassive/' + id;    
  });

 });
</script>
