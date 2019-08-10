 
 @extends('layouts.app')

 @section('content')


<div class="container">
  <div>
    <div class="col-md-12 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Listar CFDI</div>
          <div class="panel-body">
            <form method="POST" 
                  action="http://localhost:8083/invoice/listarCFDI"
                  accept-charset="UTF-8" 
                  id="list-invoice">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <div class="col-md-6">
                  <label for="Servidor">Servidor:</label>
                  <select class="form-control col-md-8 selection-list" name="Servidor">
                     <option value="selecciona">Selecciona</option>
                     <option value="1" selected="true">Sandbox</option>
                     <option value="2">Producción</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <br />
                  <button id="show-list" type="submit" class="btn btn-primary">Listar</button>
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
                    <th> UID</th>
                    <th> UUID</th>
                    <th> Total</th>
                    <th> FechaTimbrado</th>
                  </tr>
                </thead>
                <tbody>
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
            debugger
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
              }
              
              $('#table-records > tbody').html('');         
              debugger
              for(var i = 0; i < response.data.length; i++) {
                $('#table-records > tbody').append('<tr>' + 
                  '<td>' + response.data[i].Folio + '</td>' +
                  '<td>' + response.data[i].UID + '</td>' +
                  '<td>' + response.data[i].UUID + '</td>' +
                  '<td>' + response.data[i].Total + '</td>' +
                  '<td>' + response.data[i].FechaTimbrado + '</td>' +
                  '</tr>');  
              }
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
    });
  });
</script>