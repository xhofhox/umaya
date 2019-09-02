 
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
									<td id="folio">{{ $data['Folio'] }}</td>
									<td>{{ $data['Receptor'] }}</td>
									<td>{{ $data['Total'] }}</td>
									<td>{{ $data['FechaTimbrado'] }}</td>
									<td>{{ $data['Status'] }}</td>
									<td width="1%">
										<button data-value="{{ $data['UID'] }}" title="Descargar PDF" class="waves-effect waves-light btn-small download-pdf">
											<i class="material-icons center">picture_as_pdf</i>
										</button>
									</td>
									<td width="1%">
										<button data-value="{{ $data['UID'] }}" title="Descargar XML" class="waves-effect waves-light btn-small light-blue darken-4 download-xml">
											<i class="material-icons center">insert_drive_file</i>
										</button>
									</td>
									<td width="1%">
										<button data-value="{{ $data['UID'] }}" title="Cancelar Factura" class="waves-effect waves-light btn-small red cancel" id="cancel">
											<i class="material-icons center">close</i>
										</button>
									</td>
									<td width="1%">
										<button data-value="{{ $data['UID'] }}" title="Enviar Factura" class="waves-effect waves-light btn-small amber send" id="send_email">
											<i class="material-icons center">email</i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
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

		let pathname = window.location.pathname,
			serverId = parseInt(pathname.split('/')[pathname.split('/').length - 1]);
		
		//Ejecutar Datatable
		custom.dataTable('#table-records');

		//Descargar factura
		function downloadCFDI(format, item)
		{
			console.log(item.attr('data-value'));
			$.ajax({
				url: 'http://localhost:8083/invoice/downloadCFDI/' + serverId + '/' + item.attr('data-value') + '/' + format,
				method: 'GET',
				xhrFields: {
					responseType: 'blob'
				},
				success: function (response) {
					let a = document.createElement('a'),
						folio = item.parent().parent().find('td#folio').text(),
						url = window.URL.createObjectURL(response);

					a.href = url;
					a.download = folio + '.' + format;
					document.body.append(a);
					a.click();
					a.remove();
					window.URL.revokeObjectURL(url);
				},
				error: function (jqXHR, textStatus, errorThrown) { }
			});
		};

		//Impresión de factura en formato PDF
		$("#table-records").on("click", ".download-pdf", function(){
			let item = $(this),
				format = 'pdf';

			$.ajax({
				url: 'http://localhost:8083/invoice/downloadCFDI/' + serverId + '/' + item.attr('data-value') + '/' + format,
				method: 'GET',
				xhrFields: {
					responseType: 'blob'
				},
				success: function (response) {
					let a = document.createElement('a'),
						folio = item.parent().parent().find('td#folio').text(),
						url = window.URL.createObjectURL(response);

					a.href = url;
					a.download = folio + '.' + format;
					document.body.append(a);
					a.click();
					a.remove();
					window.URL.revokeObjectURL(url);
				},
				error: function (jqXHR, textStatus, errorThrown) { }
			});
		});

		//Impresión de factura en formato XML
		$("#table-records").on("click", ".download-xml", function(){
			let item = $(this),
				format = 'xml';

			$.ajax({
				url: 'http://localhost:8083/invoice/downloadCFDI/' + serverId + '/' + item.attr('data-value') + '/' + format,
				method: 'GET',
				//dataType: 'xml',
				contentType: false,
				processData: false,
				xhrFields: {
					responseType: 'blob'
				},
				success: function (response) {
					
					console.log(response);

					let a = document.createElement('a'),
						folio = item.parent().parent().find('td#folio').text(),
						url = window.URL.createObjectURL(response);
						//url = window.URL.createObjectURL(new blob(response, {type: "text/xml"}));
						
					
					//var foo = xmlDocument.createElement('foo');
					//foo.appendChild(document.createTextNode('bar'));
					//xmlDocument.documentElement.appendChild(foo);

					a.href = url;
					a.download = folio + '.' + format;
					document.body.append(a);
					a.click();
					a.remove();
					window.URL.revokeObjectURL(url);
				},
				error: function (jqXHR, textStatus, errorThrown) { }
			});
		});

		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		//Cancelacion de la factura
		$("#table-records").on("click", ".cancel", function(){
			let item = $(this);

			//Confirmación de cancelación
			swal({
				title: "¿Estás seguro de cancelar la factura?",
				text: "Esta acción no se puede deshacer",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willCancel) => {
				if (willCancel) {
					$.ajax({
						url: 'http://localhost:8083/invoice/cancelCFDI/' + serverId + '/' + item.attr('data-value'),
						method: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							console.log(result);
							var result = JSON.parse(data);
							if(result.response === "success")
							{
								swal({
									title: "¡Éxito!",
									text: result.message ,
									type: "success",
									icon: "success",
									timer: 10000,
									button: "OK",
								});
							}
							else
							{
								swal({
									title: "¡Error!",
									text: result.message ,
									type: "error",
									icon: "error",
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

		//Envío de la factura
		$("#table-records").on("click", ".send", function(){
			let item = $(this);

			$.ajax({
				url: 'http://localhost:8083/invoice/sendCFDI/' + serverId + '/' + item.attr('data-value'),
				method: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					console.log(result);
					var result = JSON.parse(data);
					if(result.response === "success")
					{
						swal({
							title: "¡Éxito!",
							text: result.message ,
							type: "success",
							icon: "success",
							timer: 10000,
							button: "OK",
						});
					}
					else
					{
						swal({
							title: "¡Error!",
							text: result.message ,
							type: "error",
							icon: "error",
							timer: 10000,
							button: "OK",
						});
					}
					
				},
				error: function (jqXHR, textStatus, errorThrown) { }
			});
		});

	});
 </script>
