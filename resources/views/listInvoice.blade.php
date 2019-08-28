 
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
										<button data-value="{{ $data['UID'] }}" title="Cancelar Factura" class="waves-effect waves-light btn-small red" id="cancel">
											<i class="material-icons center">close</i>
										</button>
									</td>
									<td width="1%">
										<button data-value="{{ $data['UID'] }}" title="Enviar Factura" class="waves-effect waves-light btn-small amber" id="send_email">
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
		
		//Ejecutar Datatable
		custom.dataTable('#table-records');

		//Descargar factura
		function downloadCFDI(format, item)
		{
			let pathname = window.location.pathname,
				serverId = parseInt(pathname.split('/')[pathname.split('/').length - 1]);
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
			let pathname = window.location.pathname,
				serverId = parseInt(pathname.split('/')[pathname.split('/').length - 1]),
				item = $(this),
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
			let pathname = window.location.pathname,
				serverId = parseInt(pathname.split('/')[pathname.split('/').length - 1]),
				item = $(this),
				format = 'xml';

			$.ajax({
				url: 'http://localhost:8083/invoice/downloadCFDI/' + serverId + '/' + item.attr('data-value') + '/' + format,
				method: 'GET',
				dataType: 'xml',
				success: function (response) {
					debugger
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
	});
 </script>
