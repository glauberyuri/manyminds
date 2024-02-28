<form>
	<img class="mb-4" src="<?=base_url('/assets/image/logo.png')?>" alt="" height="57">
	<h1 class="h3 mb-3 fw-normal">Register</h1>
	<div class="form-floating">
		<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
		<label for="floatingInput">Email</label>
		<small><?= form_error(); ?></small>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control" id="floatingPassword" placeholder="Password">
		<label for="floatingPassword">Senha</label>
	</div>

	<button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
	<p class="mt-5 mb-3 text-muted">&copy; 2024</p>
</form>
