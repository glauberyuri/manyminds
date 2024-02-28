<form class="form_input">
	<img class="mb-4" src="<?=base_url('/assets/image/logo.png')?>" alt="" height="57">
	<h1 class="h3 mb-3 fw-normal">Login</h1>
	<div class="alert alert-danger error_message" role="alert" style="display: none;"></div>
	<div class="alert alert-success success_message" role="alert" style="display: none;"></div>
	<div class="form-floating">
		<input type="text" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
		<label for="floatingInput">Email</label>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
		<label for="floatingPassword">Senha</label>
	</div>

	<button class="w-100 btn btn-lg btn-primary submit" type="submit">Entrar</button>
	<p class="mt-5 mb-3 text-muted">&copy; 2024</p>
</form>
