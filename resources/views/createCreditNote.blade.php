 
 @extends('layouts.app')

 @section('content')


<div class="container"> 
<div>
  <div class="col-md-12 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Nueva Nota de Crédito</h3></div>
        <div class="panel-body">
          <form method="POST" 
                action="/invoice/crearCFDICreditNote"
                accept-charset="UTF-8" 
                id="form-invoice">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value=" {{ $invoice['data']['id'] }}">
            <div class="form-group">
              <label for="Servidor">Servidor:</label>
              <select class="form-control col-md-8 selection-list" name="Servidor">
                 <option value="selecciona">Selecciona</option>
                 <option value="1" selected="true">Sandbox</option>
                 <option value="2">Producción</option>
              </select>
            </div>         
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="TipoDocumento">Tipo de CFDI:</label>
                 <select class="form-control col-md-8 selection-list" name="TipoDocumento">
                    <option value="selecciona">Selecciona</option>
                    <option value="factura">Factura</option>
                    <option value="factura_hotel">Factura para hoteles</option>
                    <option value="honorarios">Recibo de honorarios</option>
                    <option value="nota_cargo">Nota de cargo</option>
                    <option value="donativos">Donativo</option>
                    <option value="arrendamiento">Recibo de arrendamiento</option>
                    <option value="nota_credito" selected="true">Nota de crédito</option>
                    <option value="nota_devolucion">Nota de devolución</option>
                    <option value="carta_porte">Carta porte</option>
                 </select>
               </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Receptor">RFC CLIENTE/RECEPTOR</label>
                  <input class="form-control" name="RFC" value="{{ $invoice['data']['rfc'] }}"/>
                  <input class="form-control hide" name="Receptor" value="5d4122f4120a4"/>
               </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="UsoCFDI">Uso de CFDI:</label>
                 <select class="form-control col-md-8 selection-list" name="UsoCFDI" value="{{ $invoice['data']['uso_cfdi'] }}">
                       <option value="selecciona">Selecciona</option>
                       <option value="G01">Adquisición de mercancias</option>
                       <option value="G02">Devoluciones, descuentos o bonificaciones</option>
                       <option value="G03">Gastos en general</option>
                       <option value="I01">Construcciones</option>
                       <option value="I02">Mobilario y equipo de oficina por inversiones</option>
                       <option value="I03">Equipo de transporte</option>
                       <option value="I04">Equipo de computo y accesorios</option>
                       <option value="I05">Dados, troqueles, moldes, matrices y herramental</option>
                       <option value="I06">Comunicaciones telefónicas</option>
                       <option value="I07">Comunicaciones satelitales</option>
                       <option value="I08">Otra maquinaria y equipo</option>
                       <option value="D01">Honorarios médicos, dentales y gastos hospitalarios.</option>
                       <option value="D02">Gastos médicos por incapacidad o discapacidad</option>
                       <option value="D03">Gastos funerales.</option>
                       <option value="D04">Donativos.</option>
                       <option value="D05">Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación).</option>
                       <option value="D06">Aportaciones voluntarias al SAR.</option>
                       <option value="D07">Primas por seguros de gastos médicos.</option>
                       <option value="D08">Gastos de transportación escolar obligatoria.</option>
                       <option value="D09">Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones.</option>
                       <option value="D10" >Pagos por servicios educativos (colegiaturas)</option>
                       <option value="P01"selected="true">Por definir</option>
                 </select>
               </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                 <label for="FormaPago">Forma de pago: </label>
                 <select class="form-control col-md-8 selection-list" name="FormaPago">
                       <option value="selecciona">Selecciona</option>
                       <option value="01" >Efectivo </option>
                       <option value="02">Cheque nominativo</option>
                       <option value="03">Transferencia electrónica de fondos</option>
                       <option value="04">Tarjeta de crédito</option>
                       <option value="05">Monedero electrónico</option>
                       <option value="06">Dinero electrónico</option>
                       <option value="08">Vales de despensa</option>
                       <option value="12">Dación en pago</option>
                       <option value="13">Pago por subrogación</option>
                       <option value="14">Pago por consignación</option>
                       <option value="15">Condonación</option>
                       <option value="17">Compensación</option>
                       <option value="23">Novación</option>
                       <option value="24">Confusión</option>
                       <option value="25">Remisión de deuda</option>
                       <option value="26">Prescripción o caducidad</option>
                       <option value="27">A satisfacción del acreedor</option>
                       <option value="28">Tarjeta de débito</option>
                       <option value="29">Tarjeta de servicios</option>
                       <option value="30">Aplicación de anticipos</option>
                       <option value="31">Intermediario pagos</option>
                       <option value="99" selected="true">Por definir</option> 
                 </select>
               </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="MetodoPago">Método de pago:</label>
                 <select class="form-control col-md-8 selection-list" name="MetodoPago">
                       <option value="selecciona">Selecciona</option>
                       <option value="PUE" selected="true">Pago en una sola exhibición</option>
                       <option value="PPD">Pago en parcialidades o diferido</option>
                 </select>
               </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                 <label for="Serie">Serie:</label>
                 <select class="form-control col-md-8 selection-list" name="Serie">
                       <option value="selecciona">Selecciona</option>
                       <option value="3413">F</option>
                       <option value="3414">R</option>
                       <option value="3415">C</option>
                       <option value="3416" selected="true">N</option>
                       <option value="3417">NOM</option>
                       <option value="3418">FH<option>
                       <option value="3419" >NC</option>
                       <option value="3420">DO</option>
                       <option value="3421">RA</option>
                       <option value="3422">ND</option>
                 </select>
               </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="Moneda">Moneda:</label>
                 <select class="form-control col-md-8 selection-list" name="Moneda">
                       <option value="selecciona">Selecciona</option>
                       <option value="MXN" selected="true">MXN</option>
                 </select>
               </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
                  <label for="CondicionesDePago">Condiciones de pago:</label>
                  <input class="form-control" name="CondicionesDePago" value="Contado"/>
                </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
					 <label for="folio">Folio:</label>
					 <input class="form-control" name="folio" placeholder=""/>
               </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
					<label for="Cuenta">Número de cuenta:</label>
					<input class="form-control" name="Cuenta" placeholder="Últimos 4 dígitos de la tarjeta o cuenta bancaria del cliente."/>
                </div>
              </div>
             </div>

              <h4>CFDI Relacionado</h4>
             <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                 <label for="CFDIRelacionado">CFDI Relacionado:</label>
                 <select class="form-control col-md-8 selection-list" name="CFDIRelacionado">
                       <option value="selecciona">Selecciona</option>
                       <option value="1" selected="true">Si</option>
                       <option value="2">No</option>
                       
                 </select>
                </div>
              </div>
			  <div class="col-md-5">
               <div class="form-group">
                 <label for="relation_type">Tipo de Relación:</label>
                 <select class="form-control col-md-8 selection-list" name="relation_type">
                       <option value="selecciona">Selecciona</option>
					   <option value="{{ $invoice['data']['relation_type'] }}">{{ $invoice['data']['relation_type'] }}</option>
                       <option value="01" selected="false">Nota de crédito de los documentos relacionados</option>
                       <option value="02">Nota de débito de los documentos relacionados</option>
                       <option value="03">Devocución de marcancías sobre facturas o traslados previos</option>
                       <option value="04">Sustitución de los FDI previos</option>
                       <option value="05">Traslados de mercacías facturados previamente</option>
                       <option value="06">Factura generada por los traslados previos</option>
                       <option value="07">CFDI por aplicación de anticipo</option>
                       <option value="08">Factura generada por pagos en parcialidades</option>
                       <option value="09">Factura generada por pagos diferidos</option>
                 </select>
                </div>
              </div>

              <div class="col-md-5">
               <div class="form-group">
                  <label for="CFDIRel">CFDI Relacionado:</label>
                 <input class="form-control" name="CFDIRel" value="{{ $invoice['data']['relateduuid'] }}"/>
                </div>
              </div>
             </div>
            
             <h4>Conceptos</h4>
             <hr/>
            <table class="table table-striped">
              <thead>
                  <tr bgcolor='FFFDC1'>
                    <th>Clave producto o servicio</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Descripción</th>
                    <th>Precio unitario</th>
                    <th>Importe</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($invoice['concepts'] as $concept)
                  <tr>
                      <td>{{ $concept['clave_sat'] }}</td>
                      <td>{{ $concept['cantidad'] }}</td>
                      <td>{{ $concept['unidad'] }}</td>
                      <td>{{ $concept['descripcion'] }}</td>
                      <td>{{ $concept['precio_unitario'] }}</td>
                      <td>{{ $concept['importe'] }}</td>
                      <td>
                        <a href="#" 
                            class="btn-floating btn-small waves-effect waves-light blue"
                            data-target="#updateConcept{{ $concept['id'] }}"
                            data-toggle="modal">
                            <i class="material-icons">visibility</i>
                        </a>
                      </td>
                  </tr>
                  @include('modalConcept') 
                  @endforeach
              </tbody>
              <?php $totalConcepts = 0; ?>
							@foreach($invoice['concepts'] as $concept)
								<?php $totalConcepts += $concept['importe']; ?>
							@endforeach
          </table>
          <div style="text-align: right; -webkit-text-stroke-width: medium;"> Total conceptos: {{ $totalConcepts }}</div>
		  
           <!-- 
           <h4>Complementos</h4>
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label for="NombreAlumno">Nombre del Alumno:</label>
                 <input class="form-control" name="NombreAlumno"  value="{{ $invoice['data']['nombre_alumno'] }}"/>
                </div>
              </div>             
              <div class="col-md-4">
               <div class="form-group">
                 <label for="Curp">Curp:</label>
                 <input class="form-control" name="Curp"  value="{{ $invoice['data']['curp'] }}"/>
                </div>
              </div>
              <div class="col-md-4">
               <div class="form-group">
                 <label for="NivelEducativo">Nivel educativo:</label>
                 <select class="form-control col-md-8 selection-list" name="NivelEducativo">
                       <option value="selecciona">Selecciona</option>
                       <option value="1">Preescolar</option>
                       <option value="2">Primaria</option>
                       <option value="3">Secundaria</option>
                       <option value="4">Profesional técnico</option>
                       <option value="5">Bachillerato o su equivalente</option>
                 </select>
                </div>
              </div>
             </div>
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label for="RVOE">RVOE:</label>
                 <input class="form-control" name="RVOE" value="{{ $invoice['data']['roev'] }}"/>
                </div>
              </div>             
              <div class="col-md-4">
               <div class="form-group">
                 <label for="RFCPago">RFC Pago:</label>
                 <input class="form-control" name="RFCPago" value="{{ $invoice['data']['rfc'] }}"/>
                </div>
              </div>
             </div> 
             -->
             <h4>Impuestos</h4>
             <div class="row">
			 <div class="col-md-3">
                 <div class="form-group">
                  <label for="Impuesto">Impuesto:</label>
                  <select class="form-control col-md-8 selection-list" name="Impuesto">
                       <option value="selecciona">Selecciona</option>
                       <option value="001">ISR</option>
                       <option value="002" selected="true">IVA</option>
                       <option value="003">IEPS</option>
                 </select>
                 </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                   <label for="TipoFactor">Tasa:</label>
                   <select class="form-control col-md-8 selection-list" name="TipoFactor">
                      <option value="selecciona">Selecciona</option>
                      <option value="Tasa" selected="true">Tasa</option>
                      <option value="Cuota">Cuota</option>
                 </select>
                 </div>
               </div>
               <div class="col-md-3">
                <div class="form-group">
                   <label for="TasaOCuota">Tasa/Cuota:</label>
                   <input class="form-control" name="TasaOCuota" placeholder="0.16" value="0.00"/>
                 </div>
               </div>
                <div class="col-md-3">
                 <div class="form-group">
                    <label for="Importe">Importe:</label>
                    <input class="form-control" name="Importe" placeholder="2400.00" value="0.00"/>
                  </div>
               </div>
             </div>
            @include('sweet::alert')
            <button id="save" type="submit" class="btn btn-primary">Enviar</button>
          </form>          
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
    var formId = '#form-invoice';

    //Ejecutar facturación
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
			$.LoadingOverlay("show");
		  },
          success:  function (data) {
            console.log(data);
			$.LoadingOverlay("hide");
            var responseInvoice = JSON.parse(data);
            if (!undefined)
            {
				if (responseInvoice.status === "error")
				{
					swal({
						title: "¡Advertencia!",
						text: responseInvoice.message ,
						type: "error",
						icon: "error",
						timer: 10000,
						button: "OK",
					});
				}
				if (responseInvoice.response === "warning")
				{
					swal({
						title: "¡Advertencia!",
						text: responseInvoice.message.message ,
						type: "warning",
						icon: "warning",
						timer: 10000,
						button: "OK",
					});
				}          
				else if (responseInvoice.response === "error")
				{              
					swal({
						title: "¡Ocurrió un error!",
						text: responseInvoice.message.message ,
						type: "error",
						icon: "error",
						timer: 10000,
						button: "OK",
					});
				}

              else
              {
                //Insertar datos factura
                var idRegistro = location.href.split('/').pop();
                
                //codigo editado 
                var data = new FormData();
                data.append('id',idRegistro);
                data.append('uuid',responseInvoice.UUID);
                data.append('folio',responseInvoice.INV.Folio);
                //aqui van los demas campos
                
                $.ajax({
                    type: 'POST',
                    url: '/invoice/actualizarRegistroFactura',
                    data: data, 
                    contentType: false,
                    processData: false,
                    beforeSend: function () {},
                    success:  function (response) {
                      
                      console.log(response);
                    }
                });      
                // Fin inserción de datos
                swal({
                  title: "¡Éxito!",
                  text: responseInvoice.message + ". Folio fiscal: " + responseInvoice.UUID,
                  type: "success",
                  icon: "success",
                  timer: 10000,
                  button: "OK",
                });
              }           
            }
            else{
              swal({
                title: "¡Ocurrió un error!",
                text: "Disculpe, existió un problema. Favor de intentarlo más tarde.",
                type: "error",
                timer: 1000
              });
            }
          }
      });
    });

    //Modal de conceptos de la factura
    $('#updateConcept').click(function() {
      $.ajax({
          url : '/invoice/mostrarConcepto/1',
          type : 'GET',
          dataType : 'html',
          success : function(respuesta) {
            debugger
              // $('#MyProducto').html(respuesta);
              $('#updateConcept1').modal('show');
          },
          error : function(xhr, status) {
              alert('Disculpe, existió un problema. Favor de intentarlo más tarde.');
          },
      });
    });

  });
</script>
