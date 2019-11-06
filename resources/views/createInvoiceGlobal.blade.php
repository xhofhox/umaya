 
 @extends('layouts.app')

 @section('content')


<div class="container"> 
<div>
	<div class="col-md-12 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Nuevo CFDI Global</h4></div>
				<div class="panel-body">
					<form method="POST" 
						action="http://localhost:8083/invoice/crearCFDIGlobal"
						accept-charset="UTF-8" 
						id="form-invoice">            
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value=" {{ $invoice['data']['id'] }}">
						
						<div class="row">
							<div class="form-group">
								<label for="Servidor">Servidor:</label>
								<select class="form-control col-md-8 selection-list" name="Servidor">
									<option value="selecciona">Selecciona</option>
									<option value="1" selected="true">Sandbox</option>
									<option value="2">Producción</option>
								</select>
								</br>
							</div> 
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="TipoDocumento">Tipo de CFDI:</label>
									<select class="form-control col-md-8 selection-list" name="TipoDocumento">
									<option value="selecciona">Selecciona</option>
									<option value="factura" selected="true">Factura</option>
									<option value="factura_hotel">Factura para hoteles</option>
									<option value="honorarios">Recibo de honorarios</option>
									<option value="nota_cargo">Nota de cargo</option>
									<option value="donativos">Donativo</option>
									<option value="arrendamiento">Recibo de arrendamiento</option>
									<option value="nota_credito">Nota de crédito</option>
									<option value="nota_devolucion">Nota de devolución</option>
									<option value="carta_porte">Carta porte</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="UsoCFDI">Uso de CFDI:</label>
									<select class="form-control col-md-8 selection-list" name="UsoCFDI">
										<option value="selecciona">Selecciona</option>
										<option value="{{ $invoice['data']['uso_cfdi'] }}">{{ $invoice['data']['val_uso_cfdi'] }}</option>
										<option value="G01">G01 Adquisición de mercancias</option>
										<option value="G02">G02 Devoluciones, descuentos o bonificaciones</option>
										<option value="G03">G03 Gastos en general</option>
										<option value="I01">I0I Construcciones</option>
										<option value="I02">I02 Mobilario y equipo de oficina por inversiones</option>
										<option value="I03">I03 Equipo de transporte</option>
										<option value="I04">I04 Equipo de computo y accesorios</option>
										<option value="I05">I05 Dados, troqueles, moldes, matrices y herramental</option>
										<option value="I06">I06 Comunicaciones telefónicas</option>
										<option value="I07">I07 Comunicaciones satelitales</option>
										<option value="I08">I08 Otra maquinaria y equipo</option>
										<option value="D01">D01 Honorarios médicos, dentales y gastos hospitalarios.</option>
										<option value="D02">D02 Gastos médicos por incapacidad o discapacidad</option>
										<option value="D03">D03 Gastos funerales.</option>
										<option value="D04">D04 Donativos.</option>
										<option value="D05">D05 Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación).</option>
										<option value="D06">D06 Aportaciones voluntarias al SAR.</option>
										<option value="D07">D07 Primas por seguros de gastos médicos.</option>
										<option value="D08">D08 Gastos de transportación escolar obligatoria.</option>
										<option value="D09">D09 Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones.</option>
										<option value="D10">D10 Pagos por servicios educativos (colegiaturas)</option>
										<option value="P01" selected="true"> P01 Por definir</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="Receptor">RFC CLIENTE/RECEPTOR</label>
									<input class="form-control" name="RFC" value="{{ $invoice['data']['rfc'] }}"/>
									<input class="form-control hide" name="Receptor" value="{{ $invoice['data']['uid'] }}"/>  
									<!-- <input class="form-control hide" name="Receptor" value="5d4122f4120a4"/> -->
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Receptor">Razón Social</label>
									<input class="form-control" name="razonsocial" value="{{ $invoice['data']['razonsocial'] }}"/>
								</div>
							</div>
						</div> 
				
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="FormaPago">Forma de pago: </label>
									<select class="form-control col-md-8 selection-list" name="FormaPago">
										<option value="selecciona">Selecciona</option>
										
										<option value="{{ $invoice['data']['forma_pago'] }}" selected="true">{{ $invoice['data']['val_forma_pago'] }}</option>
										<option value="01"> 01 Efectivo </option>
										<option value="02">02 Cheque nominativo</option>
										<option value="03">03 Transferencia electrónica de fondos</option>
										<option value="04">04 Tarjeta de crédito</option>
										<option value="05">05 Monedero electrónico</option>
										<option value="06">06 Dinero electrónico</option>
										<option value="08">08 Vales de despensa</option>
										<option value="12">12 Dación en pago</option>
										<option value="13">13 Pago por subrogación</option>
										<option value="14">14 Pago por consignación</option>
										<option value="15">15 Condonación</option>
										<option value="17">17 Compensación</option>
										<option value="23">23 Novación</option>
										<option value="24">24 Confusión</option>
										<option value="25">25 Remisión de deuda</option>
										<option value="26">26 Prescripción o caducidad</option>
										<option value="27">27 A satisfacción del acreedor</option>
										<option value="28">28 Tarjeta de débito</option>
										<option value="29">29 Tarjeta de servicios</option>
										<option value="30">30 Aplicación de anticipos</option>
										<option value="31">31 Intermediario pagos</option>
										<option value="99">99 Por definir</option> 
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="MetodoPago">Método de pago:</label>
									<select class="form-control col-md-8 selection-list" name="MetodoPago">
										<option value="selecciona">Selecciona</option>
										<!-- <option value="{{ $invoice['data']['metodo_pago'] }}">{{ $invoice['data']['val_metodo_pago'] }}</option> -->
										<option value="PUE" selected="true">Pago en una sola exhibición</option>
										<option value="PPD">Pago en parcialidades o diferido</option>
									</select>
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="Serie">Serie:</label>
									<select class="form-control col-md-8 selection-list" name="Serie">
										<option value="selecciona">Selecciona</option>
										<option value="3413" selected="true">F</option>
										<option value="3414">R</option>
										<option value="3415">C</option>
										<option value="3416">N</option>
										<option value="3417">NOM</option>
										<option value="3418">FH<option>
										<option value="3419">NC</option>
										<option value="3420">DO</option>
										<option value="3421">RA</option>
										<option value="3422">ND</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Moneda">Moneda:</label>
									<select class="form-control col-md-8 selection-list" name="Moneda">
										<option value="selecciona">Selecciona</option>
										<option value="MXN" selected="true">MXN</option>
									</select>
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="CondicionesDePago">Condiciones de pago:</label>
									<input class="form-control" name="CondicionesDePago" value="Contado"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Moneda">Número de cuenta:</label>
									<input class="form-control" name="Cuenta" placeholder="Últimos 4 dígitos de la tarjeta o cuenta bancaria del cliente."/>
								</div>
							</div>
						</div>
				
						<h5>Conceptos</h5>
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
									 <td>1</td>
									 <td>ACT</td>
									 <td>Recibo {{ $concept['folio'] }}</td>
									 <td>{{ $concept['to_pay'] }}</td>
									 <td>{{ $concept['to_pay'] }}</td>
								</tr>
								
								@endforeach
							</tbody>
						</table>
						@include('sweet::alert')
						<button id="btn-save-invoice" type="submit" class="btn btn-primary">Enviar</button>
					</form>
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
		  },
          success:  function (data) {
            console.log(data);
            var responseInvoice = JSON.parse(data);
            if (!undefined)
            {
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
                data.append('fechatimbrado',responseInvoice.SAT.FechaTimbrado);
                data.append('nocertificadosat',responseInvoice.SAT.NoCertificadoSAT);
                data.append('serie', responseInvoice.INV.Serie);
                //aqui van los demas campos
                
				//Actualizar el registro de factura para indicar que se ha generado
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost:8083/invoice/actualizarRegistroFactura',
                    data: data, 
                    contentType: false,
                    processData: false,
                    beforeSend: function () {},
                    success:  function (response) {
                      
                      console.log(response);
                    }
                });

				//Actualizar el registro de recibos facturados
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost:8083/invoice/actualizarRegistroRecibos',
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
          },
		  complete: function () {
		  }
      });
    });


  });
</script>

