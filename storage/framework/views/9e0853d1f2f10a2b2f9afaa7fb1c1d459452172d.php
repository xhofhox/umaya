 
 

 <?php $__env->startSection('content'); ?>


<div class="container">
 
<div>
  <div class="col-md-12 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Nuevo CFDI</div>
        <div class="panel-body">
          <form method="POST" 
                action="http://localhost:8083/invoice/crearCFDI"
                accept-charset="UTF-8" 
                id="form-invoice">            
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
            <div class="form-group">
              <label for="Servidor">Servidor:</label>
              <select class="form-control col-md-8 selection-list" name="Servidor">
                 <option value="selecciona">Selecciona</option>
                 <option value="1" selected="true">Sandbox</option>
                 <option value="2">Producción</option>
              </select>
            </div>
            <!--<div class="form-group">
              <label for="invoice_apiKey">Api key:</label>
              <select class="form-control col-md-8 selection-list" name="apiKey">
                 <option value="selecciona">Selecciona</option>
                 <option value="JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh" selected="true">Sandbox</option>
                 <option value="JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp" selected="true">Producción</option>
              </select>
            </div>
              <div class="form-group">
              <label for="invoice_secretKey">Secret key:</label>
              <select class="form-control col-md-8 selection-list" name="secretKey">
                 <option value="selecciona">Selecciona</option>
                 <option value="JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5" selected="true">Sandbox</option>
                 <option value="JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l" selected="true">Producción</option>
              </select>
            </div>-->             
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
                  <label for="Receptor">RFC CLIENTE/RECEPTOR</label>
                  <input class="form-control" name="RFC" value="<?php echo e($data->rfc); ?>"/>
                  <input class="form-control hide" name="Receptor" value="5d4122f4120a4"/>
               </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="UsoCFDI">Uso de CFDI:</label>
                 <select class="form-control col-md-8 selection-list" name="UsoCFDI" value="<?php echo e($data->uso_cfdi); ?>">
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
                       <option value="D10" selected="true">Pagos por servicios educativos (colegiaturas)</option>
                       <option value="P01">Por definir</option>
                 </select>
               </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                 <label for="FormaPago">Forma de pago: </label>
                 <select class="form-control col-md-8 selection-list" name="FormaPago">
                       <option value="selecciona">Selecciona</option>
                       <option value="01" selected="true">Efectivo </option>
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
                       <option value="99">Por definir</option> 
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
                 <label for="Moneda">Número de cuenta:</label>
                 <input class="form-control" name="Cuenta" placeholder="Últimos 4 dígitos de la tarjeta o cuenta bancaria del cliente."/>
               </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
                  
                </div>
              </div>
             </div>              
             <h2>Conceptos</h2>
             <hr></hr>            
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label for="ClaveProdServ">Clave producto o servicio:</label>
                 <!--<input class="form-control" name="ClaveProdServ" value="86121701" />-->
                 <select class="form-control col-md-8 selection-list" name="ClaveProdServ">
                       <option value="selecciona">Selecciona</option>
                       <option value="86121701" selected="true">86121701 Programas de pregrado</option>
                       <option value="86121702">86121702 Programas de posgrado</option>
                       <option value="47121502">47121502 Otro</option>
                        
                 </select>
                </div>
              </div>
              <div class="col-md-4">
               <div class="form-group">
                 <label for="NoIdentificacion">Número de identificación/SKU:</label>
                 <input class="form-control" name="NoIdentificacion" />
                </div>
              </div>
              <div class="col-md-4">
               <div class="form-group">
                 <label for="Cantidad">Cantidad:</label>
                 <input class="form-control" name="Cantidad" value="<?php echo e($data->cantidad); ?>"/>
                </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label for="ClaveUnidad">Unidad:</label>
                 <select class="form-control col-md-8 selection-list" name="ClaveUnidad">
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
              <div class="col-md-4">
               <div class="form-group">
                 <label for="Descripcion">Descripcion:</label>
                 <input class="form-control" name="Descripcion" value="<?php echo e($data->descripcion); ?>"/>
                </div>
              </div>
              <div class="col-md-4">
               <div class="form-group">
                 <label for="ValorUnitario">Precio Unitario:</label>
                 <input class="form-control" name="ValorUnitario" placeholder="15000.00" value="<?php echo e($data->valorunitario); ?>"/>
                </div>
              </div>
             </div>              
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label for="Importe">Importe:</label>
                 <input class="form-control" name="Importe" value="<?php echo e($data->valorunitario * $data->cantidad); ?>" />
                </div>
              </div>             
              <div class="col-md-4">
               <div class="form-group">
                 <label for="tipoDesc">Tipo descuento:</label>
                 <select class="form-control col-md-8 selection-list" name="Impuesto">
                       <option value="selecciona">Selecciona</option>
                       <option value="porcentaje" selected="true">%</option>
                       <option value="cantidad">$</option>
                 </select>
                </div>
              </div>
               <div class="col-md-4">
               <div class="form-group">
                 <label for="Descuento">Descuento:</label>
                 <input class="form-control" name="Descuento" value="0"/>
                </div>
              </div>
             </div>             
             <h2>Complementos</h2>
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                 <label for="NombreAlumno">Nombre del Alumno:</label>
                 <input class="form-control" name="NombreAlumno"  value="<?php echo e($data->nombre_alumno); ?>"/>
                </div>
              </div>             
              <div class="col-md-4">
               <div class="form-group">
                 <label for="Curp">Curp:</label>
                 <input class="form-control" name="Curp"  value="<?php echo e($data->curp); ?>"/>
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
                 <input class="form-control" name="RVOE" value="<?php echo e($data->roev); ?>"/>
                </div>
              </div>             
              <div class="col-md-4">
               <div class="form-group">
                 <label for="RFCPago">RFC Pago:</label>
                 <input class="form-control" name="RFCPago" value="<?php echo e($data->rfc); ?>"/>
                </div>
              </div>
             </div>             
             <h2>Impuestos</h2>
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
            <?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <button id="save" type="submit" class="btn btn-primary">Enviar</button>
          </form>          
          <div id="prueba"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formId = '#form-invoice';

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
            //$('#prueba').html(data);
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
                text: "Favor de intentarlo más tarde.",
                type: "error",
                timer: 1000
              });
            }
          }
      });
    });
  });
</script>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>