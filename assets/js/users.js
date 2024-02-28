$(document).ready( function () {
	$('#tableUsers').DataTable( {
		searching: false,
		padding: false,
		oLanguage: {
			"sEmptyTable": "Nenhum registro encontrado",
			"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
			"sInfoFiltered": "(Filtrados de _MAX_ registros)",
			"sInfoPostFix": "",
			"sInfoThousands": ".",
			"sLengthMenu": "_MENU_ resultados por página",
			"sLoadingRecords": "Carregando...",
			"sProcessing": "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal' ></i> Processando...",
			"sZeroRecords": "Nenhum registro encontrado",
			"sSearch": "<i class=\"bx bx-search\" aria-hidden=\"true\"></i>",
			"sSearchPlaceholder": "Pesquisar",
			"oPaginate": {
				"sFirst": "<i class=\"bx bxs-chevrons-left\"></i>",
				"sLast": "<i class=\"bx bxs-chevrons-right\"></i>",
				"sNext": "<i class=\"bx bxs-chevron-right\"></i>",
				"sPrevious": "<i class=\"bx bxs-chevron-left\"></i>"
			},
			"oAria": {
				"sSortAscending": ": Ordenar colunas de forma ascendente",
				"sSortDescending": ": Ordenar colunas de forma descendente"
			}
		},
		columns: [
			{ data: 'name'},
			{ data: 'cpf'},
			{ data: 'phone'},
			{ data: 'city'},
			{ data: 'action'}
		],
		ajax: {
			url: $('#tableUsers').data('url'),
			type: 'GET',
			data: function(json) {
				return json.data;
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
			}
		}
	});
} );

function bindEvents()
{
	$('.btn-status').off('click').on('click', function() {
		$.ajax({
			type: "POST",
			url: BASE_URL+"users/toggle-status",
			data: {
				id: $(this).data('id')
			},
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					alert('Tente novamente');
				} else if (response.success) {
					window.location.reload();
				}
			},
			error: function(response) {
				console.log('Erro na requisição AJAX');
			},
		});
	});
}

bindEvents();


$(".submit").on('click', function(ev) {
	ev.preventDefault();
	$.ajax({
		type: "POST",
		url: BASE_URL+"create",
		data: $('.form_input').serialize(),
		dataType: 'json',
		success: function(response) {
			// redirects or performs other actions according to success
			console.log(response['name_error'])
			if (response.error) {
				(response['name_error'] != '') ? $('.error_name').html(response['name_error']) : $('.error_name').html('');
				(response['cpf_error'] != '') ? $('.error_cpf').html(response['cpf_error']) : $('.error_cpf').html('');
				(response['phone_error'] != '') ? $('.error_phone').html(response['phone_error']) : $('.error_phone').html('');
				(response['email_error'] != '') ? $('.error_email').html(response['email_error']) : $('.error_email').html('');
				(response['password_error'] != '') ? $('.error_password').html(response['password_error']) : $('.error_password').html('');
			} else if (response.success) {
				window.location.href = response.redirect;
			}
		},
		error: function(response) {
			console.log('Erro na requisição AJAX');
		},
	});
})



$(".addAddress").on('click', function (ev) {
	let model = $('.address').first().html();
	$('.addresses').append('<div class="address row">'+model+'</div>')
	bindEventsAddress();

});

function bindEventsAddress()
{
	$(".removeAddress").on('click', function (ev) {
		$(this).parents('div.address').remove();
	})
}

bindEventsAddress();
