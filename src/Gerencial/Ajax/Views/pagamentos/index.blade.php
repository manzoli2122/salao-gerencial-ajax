@extends( Config::get('app.templateMasterJson' , 'templates.templateMasterJson')  )

@section( Config::get('app.templateMasterContent' , 'content')  )

<section class="content-header">
	<h1>
		<span id="div-titulo-pagina">Listagem dos Pagamentos</span>		
	</h1>
</section>	
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success" id="div-box"> 
				<div class="box-body" style="padding-top: 5px; padding-bottom: 3px;">
					<table style="font-size: 12px;" class="table table-bordered table-striped table-hover" id="datatable">
						<thead>
							<tr>
								<th pesquisavel style="max-width:20px">ID</th>						
								<th pesquisavel style="max-width:70px">Data</th>
								<th pesquisavel style="max-width:60px">Forma Pag.</th>
								<th pesquisavel style="max-width:80px">Operadora</th>
								<th pesquisavel style="max-width:80px">Bandeira</th>
								<th pesquisavel>Cliente</th>
								<th>Valor</th>			
								<th pesquisavel style="max-width:40px">V.P.O.</th>	
								<th pesquisavel style="max-width:50px">Na Conta</th>										
								<th class="align-center" style="width:100px">Ação</th>
								
							</tr>
						</thead>
					</table>
        		</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push(Config::get('app.templateMasterScript' , 'script') )
	<script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			var dataTable = datatablePadrao('#datatable', {
				order: [[ 1, "asc" ]],
				ajax: { 
					url:'{{ route('pagamentos.ajax.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' , orderable: false },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'formaPagamento', name: 'formaPagamento' , orderable: false},
					{ data: 'bandeira', name: 'bandeira' , orderable: false},
					{ data: 'nome', name: 'nome' , orderable: false},		
					{ data: 'cliente', name: 'cliente' , orderable: false},				
					{ data: 'valor', name: 'valor' , orderable: false},
					{ data: 'operado', name: 'operado' , orderable: false },	
					{ data: 'na_conta', name: 'na_conta' , orderable: false },									
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
					
				],
			});

			dataTable.on('draw', function () {
				$('[btn-confirmar-operadora]').click(function (){
					confirmarOperadoraPagamentoPeloId($(this).data('id'), "@lang('msg.conf_operadora_o', ['1' => 'Pagamento'])", "{{ route('pagamentos.ajax.confirmarOperadora') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});

			dataTable.on('draw', function () {
				$('[btn-confirmar-banco]').click(function (){
					confirmarOperadoraPagamentoPeloId($(this).data('id'), "@lang('msg.conf_banco_o', ['1' => 'Pagamento'])", "{{ route('pagamentos.ajax.confirmarBanco') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush							