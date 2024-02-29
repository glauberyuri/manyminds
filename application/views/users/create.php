<?php
$disabled= empty($data['dataView']['preview']) ? '' : 'disabled';
?>
<div class="d-flex flex-row justify-content-between bd-highlight mb-3">

</div>
<div class="container" style="max-width: 960px;">
	<main>
		<div class="py-5 text-center">
			<h2><?=$data['dataView']['title'] ?? ''?></h2>
		</div>
		<div class="row g-5">
			<div class="col-md-5 col-lg-4 order-md-last">
				<a href="<?=base_url('users')?>" class="btn btn-light">Voltar</a>
			</div>
			<div class="col-md-7 col-lg-8">
				<h4 class="mb-3">Dados Pessoais</h4>
				<form class="needs-validation form_input" novalidate>
					<input id="idUser" name="idUser" type="hidden" value="<?=$data['dataView']['user']->idUser ?? ''?>">
					<div class="row pt-4 g-3">
						<div class="col-sm-6">
							<label for="firstName" class="form-label">Nome Completo</label>
							<input type="text" class="form-control" name="name" id="firstName" placeholder="" value="<?=$data['dataView']['user']->name ?? ''?>" <?=$disabled?>  required>
							<div class="text-danger error_name">
							</div>
						</div>

						<div class="col-sm-6">
							<label for="lastName" class="form-label">CPF</label>
							<input type="text" class="form-control" name="cpf" id="cpfcode" placeholder="" value="<?=$data['dataView']['user']->cpf ?? ''?>" <?=$disabled?> required>
							<div class="text-danger error_cpf">

							</div>
						</div>

						<div class="col-6">
							<label for="username" class="form-label">Senha</label>
							<div class="input-group has-validation">
								<input type="password" class="form-control" name="password" id="password" value="<?=$data['dataView']['user']->password ?? ''?>" <?=$disabled?> placeholder="****" required>
							</div>
							<div class="text-danger error_password">
							</div>
						</div>

						<div class="col-6">
							<label for="username" class="form-label">Celular</label>
							<div class="input-group has-validation">
								<input type="text" class="form-control" name="phone" id="phone" placeholder="Celular" value="<?=$data['dataView']['user']->phone ?? ''?>" <?=$disabled?> required>
							</div>
							<div class="text-danger error_phone">
							</div>
						</div>

						<div class="col-12">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="seu-email@exemplo.com" value="<?=$data['dataView']['user']->email ?? ''?>" <?=$disabled?> required>
							<div class="text-danger error_email">
							</div>
						</div>

						<hr class="my-4">

						<div class="col-12 row g-2">
							<div class="col-8"><h4 class="mb-3">Endereços</h4></div>
							<?php if(empty($data['dataView']['preview'])){?>
							<div class="col-4 m-0 ps-4"><button type="button" class="btn btn-success addAddress">Adicionar Endereço</button></div>
							<?php }?>
						</div>
						<div class="addresses">
							<div class="d-none address row">
								<div class="col-8">
									<label for="address" class="form-label">CEP</label>
									<input type="text" class="form-control" name="cep[]" id="cepcode" placeholder="" required>
									<div class="invalid-feedback">
										Este campo é obrigatorio
									</div>
								</div>
								<div class="col-4">
									<label for="address2" class="form-label">Número</label>
									<input type="text" class="form-control"  name="number[]" id="number" placeholder="">
								</div>
								<div class="col-6">
									<label for="address3" class="form-label">Rua</label>
									<input type="text" class="form-control" name="street[]" id="address3" placeholder="">
								</div>
								<div class="col-6">
									<label for="address4" class="form-label">Bairro</label>
									<input type="text" class="form-control" name="block[]" id="address4" placeholder="">
								</div>

								<div class="col-md-6">
									<label for="city" class="form-label">Cidade</label>
									<input type="text" class="form-control" name="city[]" id="city" placeholder="" required>
									<div class="invalid-feedback">
										Este campo é obrigatorio
									</div>
								</div>
								<div class="col-md-4">
									<label for="country" class="form-label">Pais</label>
									<input type="text" class="form-control" name="country[]" id="country" placeholder="">
								</div>
								<div class="col-md-2">
									<label for="state" class="form-label">Estado</label>
									<input type="text" class="form-control" name="state[]" id="state" placeholder="">
								</div>
								<div class=" text-end mt-3">
									<button type="button" class="btn btn-danger removeAddress">
										Remover
									</button>
								</div>
								<hr class="my-4">
							</div>
						</div>
					</div>
					<?php if(empty($data['dataView']['preview'])){?>
					<button class="w-100 btn btn-primary btn-lg submit" type="submit">Salvar</button>
					<?php }?>
				</form>
			</div>
		</div>
	</main>
	<footer class="my-5 pt-5 text-muted text-center text-small">
		<p class="mb-1">&copy; 2024</p>
	</footer>
</div>
