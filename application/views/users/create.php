<?php
$disabled= empty($dataView['preview']) ? '' : 'disabled';
?>
<div class="d-flex flex-row justify-content-between bd-highlight mb-3">

</div>
<div class="container" style="max-width: 960px;">
	<main>
		<div class="py-5 text-center">
			<h2><?=$dataView['title'] ?? ''?></h2>
		</div>
			<div class="errorMsg">
			</div>
		<div class="text-end">
			<a href="<?=base_url('users')?>" class="btn btn-outline-primary">Voltar</a>
		</div>
		<div class="g-5">
			<h4 class="mb-3">Dados Pessoais</h4>
			<form class="needs-validation form_input" novalidate>
				<input id="idUser" name="idUser" type="hidden" value="<?=$dataView['user']['idUser'] ?? ''?>">
				<div class="row pt-4 g-3">
					<div class="col-sm-6">
						<label for="firstName" class="form-label">Nome Completo</label>
						<input type="text" class="form-control" name="name" id="firstName" placeholder="" value="<?=$dataView['user']['name'] ?? ''?>" <?=$disabled?>  required>
						<div class="text-danger error_name">
						</div>
					</div>

					<div class="col-sm-6">
						<label for="lastName" class="form-label">CPF</label>
						<input type="text" class="form-control" name="cpf" id="cpfcode" placeholder="" value="<?=$dataView['user']['cpf'] ?? ''?>" <?=$disabled?> required>
						<div class="text-danger error_cpf">

						</div>
					</div>

					<div class="col-6">
						<label for="username" class="form-label">Senha</label>
						<div class="input-group has-validation">
							<input type="password" class="form-control" name="password" id="password" value="" <?=$disabled?> placeholder="****" required>
						</div>
						<div class="text-danger error_password">
						</div>
					</div>

					<div class="col-6">
						<label for="username" class="form-label">Celular</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control" name="phone" id="phone" placeholder="Celular" value="<?=$dataView['user']['phone'] ?? ''?>" <?=$disabled?> required>
						</div>
						<div class="text-danger error_phone">
						</div>
					</div>

					<div class="col-12">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="seu-email@exemplo.com" value="<?=$dataView['user']['email'] ?? ''?>" <?=$disabled?> required>
						<div class="text-danger error_email">
						</div>
					</div>

					<hr class="my-4">

					<div class="col-12 row g-2">
						<div class="col-8"><h4 class="mb-3">Endereços</h4></div>
						<?php if(empty($dataView['preview'])){?>
						<div class="text-end"><button type="button" class="btn btn-success addAddress">Adicionar Endereço</button></div>
						<?php }?>
					</div>
					<div class="addresses">
						<?= $this->load->view('users/address',array(
							'ismodel' => 1
						), true); ?>
						<?php foreach ($dataView['user']['address'] ?? [] as $address)
							{
								$this->load->view('users/address', array(
									'ismodel' => 0,
									'address' => $address,
									'disabled' => $disabled
								));
							}
						?>
					</div>
				</div>
				<?php if(empty($dataView['preview'])){?>
				<button class="w-100 btn btn-primary btn-lg submit" type="submit">Salvar</button>
				<?php }?>
			</form>
		</div>
	</main>
	<footer class="my-5 pt-5 text-muted text-center text-small">
		<p class="mb-1">&copy; 2024</p>
	</footer>
</div>
