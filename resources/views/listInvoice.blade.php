 
 @extends('layouts.app')

 @section('content')

<div class="container">
  <div>
    <div class="col-md-12 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Listado CFDI</h3></div>
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
                    <th>Razón social</th>
                    <th>Folio</th>
                    <th>RFC</th>
                    <th>Total</th>
                    <th>FechaTimbrado</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($list['data'] as $data)
                    <tr>
                      <td>{{ $data['RazonSocialReceptor'] }}</td>
                      <td>{{ $data['Folio'] }}</td>
                      <td>{{ $data['Receptor'] }}</td>
                      <td>{{ $data['Total'] }}</td>
                      <td>{{ $data['FechaTimbrado'] }}</td>
                      <td>{{ $data['Status'] }}</td>
                      <td width="1%">
                        <button data-value="' + response.data[i].UID + '" title="Descargar PDF" class="waves-effect waves-light btn-small" id="download-pdf">
                          <i class="material-icons center">picture_as_pdf</i>
                        </button>
                      </td>
                      <td width="1%">
                        <button data-value="' + response.data[i].UID + '" title="Descargar XML" class="waves-effect waves-light btn-small light-blue darken-4" id="download-xml">
                          <i class="material-icons center">insert_drive_file</i></button>
                      </td>
                      <td width="1%">
                        <button data-value="' + response.data[i].UID + '" title="Cancelar Factura" class="waves-effect waves-light btn-small red" id="cancel">
                          <i class="material-icons center">close</i></button>
                      </td>
                      <td width="1%">
                        <button data-value="' + response.data[i].UID + '" title="Enviar Factura" class="waves-effect waves-light btn-small amber" id="send_email">
                          <i class="material-icons center">email</i></button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Gavin Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
            </tr>
            <tr>
                <td>Martena Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
            </tr>
            <tr>
                <td>Unity Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
            </tr>
            <tr>
                <td>Howard Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
          </div>
        </div>
    </div>
  </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
 </script>