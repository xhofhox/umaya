<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"  id="updateConcept{{ $concept['id'] }}">
  <form class="form-horizontal" method="POST" action="http://localhost:8083/invoice/saveConcept" id="form-modal-invoice">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Concepto</h4>
            </div>
            <div class="modal-body" style="height: 600px; overflow-y: auto; max-height: 650px;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row input-field col s12 m6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clave_sat">Clave producto o servicio:</label>
                            <!--<input class="form-control" name="ClaveProdServ" value="86121701" />-->
                            <select class="form-control selection-list" name="clave_sat">
                                <option value="selecciona">Selecciona</option>
                                <option value="86121701" selected="true">86121701 Programas de pregrado</option>
                                <option value="86121702">86121702 Programas de posgrado</option>
                                <option value="47121502">47121502 Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 input-field col s12 m6">                                
                        <input name="NoIdentificacion" type="text" placeholder="Número de identificación"/>
                        <label for="NoIdentificacion">SKU:</label>
                    </div>
                </div>
                
                <div class="row input-field col s12">
                    <div class="col-md-6 input-field col">                                
                        <input name="descripcion" type="text" value="{{ $concept['descripcion'] }}"/>
                        <label for="descripcion">Descripción:</label>
                    </div>
					<div class="col-md-6">
                        <div class="form-group">
                            <label for="unidad">Unidad:</label>
                            <select class="form-control selection-list" name="unidad">
                                <option value="selecciona">Selecciona</option>
                                <option value="H87">H87 Pieza</option>
                                <option value="EA">EA Elemento (Pieza)</option>
                                <option value="E48" selected="true">E48 Unidad de servicio	</option>
                                <option value="KGM">KGM Kilogramo</option>
                                <option value="GRM">GRM Gramo</option>
                                <option value="A9">A9 Tarifa</option>
                                <option value="MTR">MTR Metro</option>
                                <option value="INH">INH Pulgada</option>
                                <option value="FOT">FOT Pie</option>
                                <option value="YRD">YRD Yarda</option>
                                <option value="SMI">SMI Milla (milla estatal)</option>
                                <option value="MTK">MTK Metro cuadrado</option>
                                <option value="CMK">CMK Centímetro cuadrado</option>
                                <option value="MTQ">MTQ Metro cúbico</option>
                                <option value="LTR">LTR Litro	</option>
                                <option value="GLI">GLI Galón (UK)</option>
                                <option value="GLL">GLL Galón (EUA)</option>
                                <option value="HUR">HUR Hora</option>
                                <option value="DAY">DAY Día</option>
                                <option value="ANN">ANN Año</option>
                                <option value="C62">C62 Uno</option>
                                <option value="5B">5B Batch</option>
                                <option value="AB">AB Paquete a granel	</option>
                                <option value="LO">LO Lote [unidad de adquisición]	</option>
                                <option value="XLT">XLT Lote</option>
                                <option value="LH">LH Hora de trabajo	</option>
                                <option value="AS">AS Variedad</option>
                                <option value="HEA">HEA Cabeza	</option>
                                <option value="IE">IE Personas	</option>
                                <option value="NMP">NMP Número de paquetes	</option>
                                <option value="SET">SET Conjunto	</option>
                                <option value="ZZ">ZZ Mutuamente definido	</option>
                                <option value="XBX">XBX Caja</option>
                                <option value="XKI">XKI Kit (Conjunto de piezas)	</option>
                                <option value="XOK">XOK Bloque	</option> 
                            </select>
                        </div>
                    </div>  
                </div>

                <div class="row input-field col s12">
                    <div class="col-md-4 input-field col">
                        <input name="cantidad" type="text" value="{{ $concept['cantidad'] }}"/>
                        <label for="cantidad">Cantidad:</label>
                    </div>
					<div class="col-md-4 input-field col">
                        <input name="precio_unitario" type="text" value="{{ $concept['precio_unitario'] }}"/>
						<label for="precio_unitario">Precio Unitario:</label>
                    </div>
					<div class="col-md-4 input-field col">
                        <input name="subtotal" type="text" value="{{ $concept['importe'] }}"/>
						<label for="subtotal">Importe:</label>
                    </div>
                </div>

                <div class="row input-field col s12 m6">
                    <div class="col-md-6">                                
                        <div class="form-group">
                            <label for="tipoDesc">Tipo descuento:</label>
                            <select class="form-control col-md-8 selection-list" name="Impuesto">
                                <option value="selecciona">Selecciona</option>
                                <option value="porcentaje" selected="true">%</option>
                                <option value="cantidad">$</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 input-field col s12 m6">                                
                        <input name="descuento" type="text" value="0"/>
                        <label for="descuento">Descuento:</label>
                    </div>
                </div>
                <input type="hidden" name="cfdi_no" value="">

				<h5 style="padding-left: 0.75rem;"> Impuestos</h5>
				<hr/>
				<div class="row">              
					<div class="col-md-3">
						<div class="form-group">
						<label for="Impuesto">Impuesto:</label>
						<select class="form-control col-md-8 selection-list" name="Impuesto">
							<option value="selecciona">Selecciona</option>
							<option value="001">ISR</option>
							<option value="002" >IVA</option>
							<option value="003">IEPS</option>
							<option value="004" selected="true">N/A</option>
						</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label for="TipoFactor">Tasa:</label>
						<select class="form-control col-md-8 selection-list" name="TipoFactor">
							<option value="selecciona">Selecciona</option>
							<option value="Tasa" >Tasa</option>
							<option value="Cuota">Cuota</option>
							<option value="Excento" selected="true">Excento</option>
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

				<h5 style="padding-left: 0.75rem;"> Complementos</h5>
				<hr/>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="NombreAlumno">Nombre del Alumno:</label>
							<input class="form-control" name="NombreAlumno"  value="{{ $concept['nombre_alumno'] }}"/>
						</div>
					</div>				
					<div class="col-md-4">
						<div class="form-group">
							<label for="Curp">Curp:</label>
							<input class="form-control" name="Curp"  value="{{ $concept['curp'] }}"/>
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
							<!--<input class="form-control" name="RVOE" value="{{ $concept['roev'] }}"/>-->
							<input class="form-control" name="RVOE" value="N/A"/>
						</div>
					</div>             
					<div class="col-md-4">
						<div class="form-group">
							<label for="RFCPago">RFC Pago:</label>
							<input class="form-control" name="RFCPago" value="{{ $concept['rfc'] }}"/>
						</div>
					</div>
				</div>  
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formId = '#form-modal-invoice';

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
          beforeSend: function () {},
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
                //aqui van los demas campos
                
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
          url : 'http://localhost:8083/invoice/mostrarConcepto/1',
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

