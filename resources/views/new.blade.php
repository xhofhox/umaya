 
 @extends('layouts.app')

 @section('content')

<div class="container-1">
 
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Agregar archivos</div>
        <div class="panel-body">
          <form method="POST" 
                action="/storage/save"
                accept-charset="UTF-8" 
                enctype="multipart/form-data"
                id="form-bank">
                <!-- action="http://localhost:8083/umaya/public/storage/save" -->
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label for="bank_name">Banco:</label>
              <select class="form-control col-md-8 selection-list" name="bank_name">
                <option value="0">Selecciona</option>
                <option value="1">Banorte</option>
                <option value="2">Santander</option>
              </select>
            </div>
            <div class="form-group">
                <label for="file">Archivo:</label>
                <input type="file" class="form-control" name="file"/>
            </div>
            @include('sweet::alert')
            <button id="save" type="submit" class="btn btn-primary">Enviar</button>
          </form>
           <div id="resultado">
            
           </div>
          <div class="table-responsive">
            <table class="table table-striped" id="table-records-banorte1" style="font-size:12px;">
              <thead>
                 <tr bgcolor='FFFDC1'>
                 </tr>
              </thead>
              </thead>
              <tbody>
              </tbody>
            </table>
             <table class="table table-striped" id="table-records-banorte2" style="font-size:12px;">
              <thead>
                 <tr bgcolor='FFFDC1'>
                 </tr>
              </thead>
              </thead>
              <tbody>
              </tbody>
            </table>
             <table class="table table-striped" id="table-records-banorte3" style="font-size:12px;">
              <thead>
                 <tr bgcolor='FFFDC1'>
                 </tr>
              </thead>
              </thead>
              <tbody>
              </tbody>
            </table>
             <table class="table table-striped" id="table-records-santander" style="font-size:12px;">
              <thead>
                 <tr bgcolor='FFFDC1'>
                 </tr>
              </thead>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div id="prueba"></div>
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
    var formId = '#form-bank';
	var host = location.origin;

    $(formId).on('submit', function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
          type: $(formId).attr('method'),
          url: host + $(formId).attr('action'),
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            
          },
          success:  function (data) {
            if (!undefined)
            {
              swal({
                title: "¡Éxito!",
                text: "Archivo procesado",
                type: "success",
                timer: 500
              });
              
              $('#table-records-banorte1 > thead > tr').html('');
              $('#table-records-banorte1 > tbody').html('');
              
              $('#table-records-banorte2 > thead > tr').html('');
              $('#table-records-banorte2 > tbody').html('');
              
              $('#table-records-banorte3 > thead > tr').html('');
              $('#table-records-banorte3 > tbody').html('');
              
              $('#table-records-santander > thead > tr').html('');
              $('#table-records-santander > tbody').html('');
              
              addColumns = function (colsData, idTable) {
                $.each(colsData.split(','), function (index, content) {
                  $('#' + idTable + ' > thead > tr').append("<th>" + content + "</th>");
                });
              }
              
              var bank_name = $('select[name="bank_name"]').val(),
                  columnTip1 = false, columnTip2 = false, columnTip3 = false, columnTip4 =  false;
              
              for(var i = 0; i < data.length; i++) {
                switch (bank_name)
                {
                  case '1':
                    switch (data[i].tipo)
                    {
                      case "1":
                         var columns = "Tipo Registro, Empresa, Fecha, Cuenta de cheque, Filler";
                         $('#table-records-banorte1 > tbody').append('<tr>' + 
                           '<td>' + data[i].registro + '</td>' +
                           '<td>' + data[i].empresa + '</td>' +
                           '<td>' + data[i].fecha + '</td>' +
                           '<td>' + data[i].cuenta_cheque + '</td>' +
                           '<td>' + data[i].filler + '</td>' +
                           '</tr>');  
                        if (!columnTip1)
                        {
                          addColumns(columns, "table-records-banorte1");
                          columnTip1 = true;
                        }                       
                      break;
                      case "2":
                        var columns = "Tipo Registro, Folio, Método pago, Forma pago, Importe bruto, Importe descuento recargo, Id descuento recargo, Importe neto, Alterna, Referencia 1, Referencia 2, Referencia 3, Referencia 4, Fecha vencimiento, Sucursal, Hora, Estatus, Filler";
                        $('#table-records-banorte2 > tbody').append('<tr>' + 
                           '<td>' + data[i].registro + '</td>' +
                           '<td>' + data[i].folio + '</td>' +
                           '<td>' + data[i].metodo_pago + '</td>' +
                           '<td>' + data[i].forma_pago + '</td>' +
                           '<td>' + data[i].importe_bruto + '</td>' +
                           '<td>' + data[i].importe_recargo + '</td>' +
                           '<td>' + data[i].id_recargo + '</td>' +
                           '<td>' + data[i].importe_neto + '</td>' +
                           '<td>' + data[i].alterna + '</td>' +
                           '<td>' + data[i].referencia + '</td>' +
                           '<td>' + data[i].referencia2 + '</td>' +
                           '<td>' + data[i].referencia3 + '</td>' +
                           '<td>' + data[i].referencia4 + '</td>' +
                           '<td>' + data[i].vencimiento + '</td>' +
                           '<td>' + data[i].sucursal + '</td>' +
                           '<td>' + data[i].hora + '</td>' +
                           '<td>' + data[i].estatus + '</td>' +
                           '<td>' + data[i].filler + '</td>' +
                           '</tr>');
                           if (!columnTip2)
                           {
                             addColumns(columns, "table-records-banorte2");
                             columnTip2 = true;
                           }                           
                      break;
                      case "3":
                        var columns = "Tipo Registro, Núm. pagos acreditados, Importe pagos acreditados, Núm. pagos devueltos, Importe pagos devueltos, Núm. pagos cancelados, Importe pagos cancelados, Núm total pagos, Importe total pagos, Indicador";
                         $('#table-records-banorte3 > tbody').append('<tr>' + 
                           '<td>' + data[i].registro + '</td>' +
                           '<td>' + data[i].num_pagos_acreditados + '</td>' +
                           '<td>' + data[i].importe_pagos_acreditados + '</td>' +
                           '<td>' + data[i].num_pagos_devueltos + '</td>' +
                           '<td>' + data[i].importe_pagos_devueltos + '</td>' +
                           '<td>' + data[i].num_pagos_cancelados + '</td>' +
                           '<td>' + data[i].importe_pagos_cancelados + '</td>' +
                           '<td>' + data[i].num_total_pagos + '</td>' +
                           '<td>' + data[i].importe_total_pagos + '</td>' +
                           '<td>' + data[i].indicador + '</td>' +
                           '</tr>');
                           if (!columnTip3)
                           {
                              addColumns(columns, "table-records-banorte3");
                              columnTip3 = true;
                           }                           
                      break;
                    }                    
                  break;
                  case '2':
                   // var columns = "Número de cuenta, Fecha, Hora movimiento, Sucursal, Descripción, Signo, Importe, Saldo, Folio, Alterna, Número de pago, Subciclo, Ciclo, Concepto";
                    var columns = "Número de cuenta, Fecha, Hora movimiento, Sucursal, Descripción, Signo, Importe, Saldo, Folio, Alterna, Referencia";
                     $('#table-records-santander > tbody').append('<tr>' + 
                       '<td>' + data[i].numero_cuenta + '</td>' +
                       '<td>' + data[i].fecha + '</td>' +
                       '<td>' + data[i].hora_movimiento + '</td>' +
                       '<td>' + data[i].sucursal + '</td>' +
                       //'<td>' + data[i].dato + '</td>' +
                       '<td>' + data[i].descripcion + '</td>' +
                       '<td>' + data[i].signo + '</td>' +
                       '<td>' + data[i].importe + '</td>' +
                       '<td>' + data[i].saldo + '</td>' +
                       '<td>' + data[i].folio_referencia_interna + '</td>' +
                       '<td>' + data[i].alterna + '</td>' +
                       '<td>' + data[i].referencia + '</td>' +
                       //'<td>' + data[i].num_pago + '</td>' +
                       //'<td>' + data[i].subciclo + '</td>' +
                       //'<td>' + data[i].ciclo + '</td>' +
                       //'<td>' + data[i].concepto_referencia_pago + '</td>' +
                       '</tr>');
                       if (!columnTip4)
                       {
                          addColumns(columns, "table-records-santander");
                          columnTip4 = true;
                       }
                       
                  break;
                }
              }
            }
            else{
              swal({
                title: "¡Ocurrió un error!",
                text: "yupiiii",
                type: "error",
                timer: 1000
              });
            }
          }
      });
    });
  });
</script>
 
