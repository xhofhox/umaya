 
 @extends('layouts.app')

 @section('content')

<div class="container">
	<div>
		<div class="col-md-12 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Listado CFDI</h3>
				</div>
				<div class="panel-body">
					<table class="table table-striped" id="table-records" style="font-size:12px;"> 
						<thead>
							<tr bgcolor="FFFDC1">
								<th>Razón social</th>
								<th>RFC</th>
								<th>Alumno</th>
								<th>Forma de pago</th>
								<th>Uso CFDI</th>
								<th>ClaveProdServ</th>
								<th>Importe</th>
								<th>Estado</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($Invoices as $data)
								<tr>
									<td>{{ $data['razonsocial'] }}</td>
									<td>{{ $data['rfc'] }}</td>
									<td>{{ $data['nombre_alumno'] }}</td>
									<td>{{ $data['val_forma_pago'] }}</td>
									<td>{{ $data['val_uso_cfdi'] }}</td>
									<td>{{ $data['claveprodserv'] }}</td>
									<!-- <td>{{ $data['val_producto_servicio'] }}</td> -->
									<td>{{ $data['total_facturado'] }}</td>
									<td>{{ $data['val_status'] }}</td>
									<td width="1%">
										<button data-value="{{ $data['id'] }}" 
											title="Editar factura" 
											class="edit waves-effect waves-light btn-small" >
											<i class="material-icons center">mode_edit</i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<button id="sendAll" type="button" class="btn btn-primary">Enviar todo</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		
		let pathname = window.location.pathname,
			serverId = parseInt(pathname.split('/')[pathname.split('/').length - 2]),
			key = parseInt(pathname.split('/')[pathname.split('/').length - 1]);

		console.log(pathname);
		console.log(serverId);
		console.log(key);
		
		//Ejecutar Datatable
		custom.dataTable('#table-records');

		//Evento al botón de editar
		$('.edit').on( "click", function() {
			let id = $(this).attr('data-value');
			window.location = 'http://localhost:8083/invoice/editMassive/' + id;    
		});


		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		//Envío de las facturas
		$(document).on("click", "#sendAll", function(){
			let item = $(this);
			
			//Confirmación de envío
			swal({
				title: "¿Estás seguro de generar las facturas?",
				text: "Esta acción no se puede deshacer",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willSend) => {
				if (willSend) {
					$.ajax({
						url: 'http://localhost:8083/invoice/createCFDIMassive/' + serverId + '/' + key,
						method: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							console.log(data);
							
							var error = false,
								detail_error = "",
								detail_success = "";

							for(var i = 1; i < data.length; i++) {
								console.log(data[i].Response);

								var result = JSON.parse(data[i].Response);

								if (result.response === "error")
								{
									detail_error += data[i].RFC + ": " + result.message + "\n";
									error = true;
								}
								if (result.response === "success")
								{
									detail_success += data[i].RFC + ": " + result.message + "\n";
									error = false;
								}	
							}
							if (error)
							{
								swal({
									title: "¡Error!",
									text: detail_error,
									type: "error",
									icon: "error",
									timer: 10000,
									button: "OK",
								});
							}
							else if(result.response === "success")
							{
								console.log(result.UUID);
								swal({
									title: "¡Éxito!",
									text: detail_success,
									type: "success",
									icon: "success",
									timer: 10000,
									button: "OK",
								});
							}
						},
						error: function (jqXHR, textStatus, errorThrown) { }
					});
				}
			});
		});

	});
 </script>
