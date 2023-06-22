<?php
include "../../cnf/app.php";
include "../../cnf/session.php";
include "../../conn/conn.php";
include "../../inc/head.php";
include "../../inc/header_nav.php";
include "../../inc/header_nav_menu.php";
?>
<!-- BEGIN: Content-->
<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="content-wrapper">
		<div class="content-body">
			<!-- section datatable -->
			<section id="section-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-content collapse show">
								<div class="card-body card-dashboard">
									<!-- Filtro -->
									<?php
									include "../../inc/filtro.php";
									?>
									<div style="position:relative;">
										<!-- Cad -->
										<a href="registrar.php" class="btn btn-primary btn_cad_pesq">Cadastrar</a>
										<!-- Datatable -->
										<table id="datatable" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Id</th>
													<th>Ação</th>
													<th>Status</th>
													<th>Número NF</th>
													<th>Data NF</th>
													<th>Valor NF</th>
													<th>CPF / CNPJ Dest.</th>
													<th>Nome Dest.</th>
													<th>Logradouro</th>
													<th>Número</th>
													<th>Bairro</th>
													<th>Município</th>
													<th>Estado</th>
													<th>Cep</th>
													<th>Cód. País</th>
													<th>Usuário Resp.</th>
													<th>Data Registro</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- END: Content-->
<?php 
include "../../inc/footer.php";
?>
<script>
function confirma_rm(id)
{
	Swal.fire({
	  title: "Atenção",
	  text: "Deseja realmente cancelar?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  confirmButtonText: "Sim",
	  confirmButtonClass: "btn btn-primary",
	  cancelButtonClass: "btn btn-danger ml-1",
	  cancelButtonText: "Não",
	  buttonsStyling: false
	}).then(function(result) {
	  if (result.value) {
		
		// Canc Reg
		$.ajax({
			url: '../../ws/xml/ws_canc_xml.php',
			type: 'GET',
			contentType: "application/json",
			dataSrc : '',
			data: {
				'act': 'apg_dt',
				id: id
			}
		})
		.done(function (data) {
			if(data == "ok")
			{
				Swal.fire({
				  type: "success",
				  title: "Cancelado!",
				  text: "O XML foi cancelado com sucesso",
				  confirmButtonClass: "btn btn-success"
				});
				
				// Req Datatable
				$.ajax({
					url: '../../ws/xml/ws_get_pesquisar.php',
					type: 'GET',
					contentType: "application/json",
					dataSrc : '',
					data: {
						'act': 'get_dt'
					}
				})
				.done(function (data) {
					let data_json = JSON.parse(data);
					$('#datatable').DataTable().clear().draw();
					$('#datatable').DataTable().rows.add(data_json); // Add new data
					$('#datatable').DataTable().columns.adjust().draw(); // Redraw the DataTable
					
				})
				.fail(function () {
					console.log('Failed');
				});
				
			}			
		})
		.fail(function () {
			console.log('Failed');
		});
	  }
	});	
}
//Pesquisa

$(document).ready(function() {
			
	$('#filtro_datatable').click(function(e) {  
      $('#datatable').DataTable().clear().draw();
		
		let busca = $('#busca').val();
		let de = $('#de').val();
		let ate = $('#ate').val();
		
		// Send Post Request
		$.ajax({
			url: '../../ws/xml/ws_get_pesquisar.php',
			type: 'GET',
			contentType: "application/json",
			dataSrc : '',
			data: {
				'act': 'get_dt',
				busca: busca, 
				de: de, 
				ate: ate
			}
		})
		.done(function (data) {
			let data_json = JSON.parse(data);
			$('#datatable').DataTable().clear().draw();
			$('#datatable').DataTable().rows.add(data_json); // Add new data
			$('#datatable').DataTable().columns.adjust().draw(); // Redraw the DataTable
			
		})
		.fail(function () {
			console.log('Failed');
		});
    });
	
	// Datatable
	$('#datatable').DataTable( {
		"autoWidth": false,
		"bLengthChange": false,
		pageLength: 10,
		dom: 'Bfrtip',
		buttons: [{
			extend: 'excelHtml5',
		}],
		
		"search": {
		"regex": true
		},
		destroy: true,
		"processing" : false,
		"paging": true,
		"searching": false,
		"ServerSide": true,
		"bFilter": false,
		"columnDefs":[
		   {"visible": false, "targets":0}
		],
		aaSorting: [[0, "desc"]], 
		"ajax" : {
			"url" : "../../ws/xml/ws_get_pesquisar.php",
			"type": 'GET',
			"contentType": "application/json",
			dataSrc : '',
			"data": { 
				'act': 'get_dt'
			} 
		},
		"columns" : 
		[ 
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.id + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					let canc = "";
					if(row.status != 'Cancelado')
					{
						canc = '<i id="container"  name="container" class="fa fa-trash-o" style="color:#3c3c3b; font-size: 1.4em; cursor: pointer;" onclick="confirma_rm('+row.id+')"></i>';
					}
					return '<div  class="invoice-action" style="text-align: center; width: 5em;"> ' +
						canc +
					'</div>';	
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					switch(row.status)
					{
					    case 'Registrado':
					        return '<p style="width:10em; color: #02214c; font-weight: 600;">'+ row.status + '</p>';
					    break;
						case 'Cancelado':
					        return '<p style="width:10em; color:red;">'+ row.status + '</p>';
					    break;
					}
					return '<p></p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;"><a href="'+ row.nf_xml_arquivo +'" target="_blank">'+ row.numero_nf + '</a></p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.data_nf + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.valor_nf + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_cpf_cnpj + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_nome + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_logradouro + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_numero + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_bairro + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_municipio + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_estado + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_cep + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.destinatario_end_cod_pais + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.usuario_responsavel + '</p>';
				}
			},
			{"mRender": function ( data, type, row ) 
				{
					return '<p style="width:10em;">'+ row.data_registro + '</p>';
				}
			}
		],
		initComplete: function() {
			$('#datatable').wrap("<div id='scrooll_div'></div>");
			$('#scrooll_div').doubleScroll();
		}
	});
})
</script>