
<div class="modal fade" id="updateConcept{{ $concept['id'] }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
                <h5>Concepto</h4>
            </div>
            <div class="modal-body">

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

                <div class="row input-field col s12 m6">
                    <div class="col-md-6">
                        <div class="input-field col s12 m6">                                
                            <input name="cantidad" type="text" value="{{ $invoice['data']['cantidad'] }}"/>
                            <label for="cantidad">Cantidad:</label>
                        </div>
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
                    <div class="col-md-12 input-field col s12 ">                                
                        <input name="descripcion" type="text" value="{{ $invoice['data']['descripcion'] }}"/>
                        <label for="descripcion">Descripción:</label>
                    </div>
                </div>

                <div class="row input-field col s12 m6">
                    <div class="col-md-6 input-field col s12 m6">                                
                        <input name="precio_unitario" type="text" value="{{ $invoice['data']['precio_unitario'] }}"/>
                        <label for="precio_unitario">Precio Unitario:</label>
                    </div>
                    <div class="col-md-6 input-field col s12 m6">                                
                        <input name="subtotal" type="text" value="{{ $invoice['data']['precio_unitario'] * $invoice['data']['cantidad'] }}"/>
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

            </div>            
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </div>
    </div>
</div>