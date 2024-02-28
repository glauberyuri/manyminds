

$(".submit").on('click', function(ev) {
		ev.preventDefault();
		$.ajax({
			type: "POST",
			url: "auth/login",
			data: $('.form_input').serialize(),
			dataType: 'json',
			success: function(response) {
				// redirects or performs other actions according to success
				if (response.error) {
					$('.error_message').text(response.error).show();
					$('.success_message').hide();
				} else if (response.success) {
					$('.success_message').text(response.success).show();
					$('.error_message').hide();
					window.location.href = response.redirect;
				}
			},
			error: function(response) {
				console.log('Erro na requisição AJAX');
			},
		});
})


