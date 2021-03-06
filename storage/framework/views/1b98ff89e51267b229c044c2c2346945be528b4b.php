 
 

 <?php $__env->startSection('content'); ?>

<div class="container">
 
<div class="row">
  <div class="col-md-12 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Formulario</div>
        <div class="panel-body">
          <form method="POST" 
                action="http://localhost:8083/umaya/public/invoice/conexion"
                accept-charset="UTF-8" 
                id="form-invoice">
            
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
              <label for="invoice_url">URL:</label>
              <input class="form-control" name="urlFactura" />
            </div>
            <div class="form-group">
              <label for="invoice_apiKey">Api key:</label>
              <input class="form-control" name="apiKey" />
            </div>
              <div class="form-group">
              <label for="invoice_secretKey">Secret key:</label>
              <input class="form-control" name="secretKey" />
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
          data: formData, //$(formId).serialize(),
          // dataType: "html",
          // cache:false,
          // contentType: 'application/json',
          contentType: false,
          processData: false,
          beforeSend: function () {},
          success:  function (data) {
            console.log(data);
            $('#prueba').html(data);
            debugger
            if (!undefined)
            {
              swal({
                title: "¡Éxito!",
                text: "Conexión exitosa.",
                type: "success",
                timer: 1000
              });
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