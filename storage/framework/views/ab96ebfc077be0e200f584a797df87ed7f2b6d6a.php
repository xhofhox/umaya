 
 

 <?php $__env->startSection('content'); ?>

<div class="container">
  <div>
    <div class="col-md-12 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Listado CFDI</h3></div>
          <!-- Filtro
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
               Filtro-->
        
          <div class="panel-body">
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
                  <?php $__currentLoopData = $list['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($data['RazonSocialReceptor']); ?></td>
                      <td><?php echo e($data['Folio']); ?></td>
                      <td><?php echo e($data['Receptor']); ?></td>
                      <td><?php echo e($data['Total']); ?></td>
                      <td><?php echo e($data['FechaTimbrado']); ?></td>
                      <td><?php echo e($data['Status']); ?></td>
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
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>

          </div>
        </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
  $(document).ready(function() {
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
  });
 </script>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>