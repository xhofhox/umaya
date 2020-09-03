
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"  id="preview{{ $invoice['data']['id'] }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h5><i class="material-icons">search</i> &nbsp;&nbsp;Vista previa del CFDI</h4>
            </div>
            <div class="modal-body" style="height: 600px; overflow-y: auto; max-height: 650px;">
            <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a href="#">
                            <img src="{{ asset('images/umaya.jpg') }}" data-holder-rendered="true" >
                        </a>
                    </div>
                    <div class="col company-details">
                        <h3 class="name" style="color:#26358C">Universidad Maya</h3>
                        <div><b>Folio fiscal:</b> Por generarse</div>
                        <?php $now = date("d-m-Y"); ?>
                        <div><b>Fecha de expedición:</b>{{ $now }} </div>
                        <div><b>Folio:</b> Por generarse</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-8 invoice-to" style="font-weight: bold;">
                            <h6 style="font-weight: bold; color:#26358C;">Datos del emisor</h6>
                            <div>CENTRO DE FORMACION PROFESIONAL DE CHIAPAS S.C.</div>
                            <div>LAN7008173R5</div>
                            <div>Av Manuel Acuna 1 Col. Terranova. C.P. 44670, Guadalajara, Jalisco, México</div>
                        </div>
                        <div class="col-md-4 invoice-from">
                            <h6 style="font-weight: bold; color:#26358C;">Datos del receptor</h6>
                            <div>Uso CFDI: <b>{{ $invoice['data']['val_uso_cfdi'] }}</b></div>
                            <div id="view-rfc"><b>{{ $invoice['data']['razonsocial'] }}</b></div>
                            <div><b>{{ $invoice['data']['rfc'] }}</b></div>
                        </div>
                    </div>
                </div>
                <div class="row col-md-12">
                    <h6 style="font-weight: bold; color:#26358C;">Conceptos</h6>
                    <hr/>
                    <table class="table table-striped" style="font-size:14px">
                        <thead>
                            <tr color='#003399'>
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
                        <?php $totalConcepts = 0; ?>
                        @foreach($invoice['concepts'] as $concept)
                            <?php $totalConcepts += $concept['to_pay']; ?>
                        @endforeach 			
                    </table>
                    <div style="text-align: right; -webkit-text-stroke-width: medium;"> SUBTOTAL: ${{ $totalConcepts }}</div>
                    <div style="text-align: right; -webkit-text-stroke-width: medium;"> IVA (Exento%): $0</div>
                    <div style="text-align: right; -webkit-text-stroke-width: medium;"> TOTAL: ${{ $totalConcepts }}</div>
                </div>
                <div class="row col-md-12">
                    <div><b>Forma de pago:</b> {{ $invoice['data']['val_forma_pago'] }}</div>
                    <div><b>Método de pago:</b> {{ $invoice['data']['val_metodo_pago'] }}</div>
                    <div><b>Moneda:</b> MXN</div>
                </div>                
                <div class="row">
                    <div class="col-md-12">
                        <h6 style="font-weight: bold; color:#26358C;">Complemento educativo</h6>
                        <hr/>
                        <div class="col-md-8">
                            <div><b>Alumno:</b> {{ $invoice['concepts'][0]['nombre_alumno'] }}</div>
                            <div><b>Nivel educativo:</b> Bachillerato o su equivalente</div>
                            <div><b>RFC Pago:</b> {{ $invoice['concepts'][0]['rfc'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <div><b>CURP:</b> {{ $invoice['concepts'][0]['curp'] }}</div>
                            <div><b>RVOE:</b> {{ $invoice['concepts'][0]['rvoe'] }}</div>
                        </div>
                    </div>
                </div>
                </br>
            </main>
            <footer clas="row" style="font-size:10px">
            CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACION DIGITAL DEL SAT
            </br>
            :::::::::::::::::::::::::::::::::::::::::::::: Se genera al timbrar ::::::::::::::::::::::::::::::::::::::::::::::
            </br>
            SELLO DIGITAL DEL CFDI
            </br>
            :::::::::::::::::::::::::::::::::::::::::::::: Se genera al timbrar ::::::::::::::::::::::::::::::::::::::::::::::
            </br>
            SELLO DIGITAL DEL SAT
            </br>
            :::::::::::::::::::::::::::::::::::::::::::::: Se genera al timbrar ::::::::::::::::::::::::::::::::::::::::::::::
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
