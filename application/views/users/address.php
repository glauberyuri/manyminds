
<div class="<?=!empty($ismodel) ? 'd-none' : '' ?> address row">
	<div class="col-8">
		<label for="address" class="form-label">CEP</label>
		<input type="text" class="form-control" name="cep[]" id="cepcode" value="<?=$address['cep'] ?? ''?>" placeholder=""  <?=$disabled?>  required>
		<div class="invalid-feedback">
			Este campo é obrigatorio
		</div>
	</div>
	<div class="col-4">
		<label for="address2" class="form-label">Número</label>
		<input type="text" class="form-control"  name="number[]" id="number" value="<?=$address['number'] ?? ''?>"  <?=$disabled?>  placeholder="">
	</div>
	<div class="col-6">
		<label for="address3" class="form-label">Rua</label>
		<input type="text" class="form-control" name="street[]" id="address3" value="<?=$address['street'] ?? ''?>"  <?=$disabled?>  placeholder="">
	</div>
	<div class="col-6">
		<label for="address4" class="form-label">Bairro</label>
		<input type="text" class="form-control" name="block[]" id="address4" value="<?=$address['block'] ?? ''?>"  <?=$disabled?> placeholder="">
	</div>

	<div class="col-md-6">
		<label for="city" class="form-label">Cidade</label>
		<input type="text" class="form-control" name="city[]" id="city" value="<?=$address['city'] ?? ''?>"  <?=$disabled?>  placeholder="" required>
		<div class="invalid-feedback">
			Este campo é obrigatorio
		</div>
	</div>
	<div class="col-md-4">
		<label for="country" class="form-label">Pais</label>
		<input type="text" class="form-control" name="country[]" id="country" value="<?=$address['country'] ?? ''?>" <?=$disabled?>  placeholder="">
	</div>
	<div class="col-md-2">
		<label for="state" class="form-label">Estado</label>
		<input type="text" class="form-control" name="state[]" id="state" value="<?=$address['state'] ?? ''?>"  <?=$disabled?> placeholder="">
	</div>
	<div class=" text-end mt-3">
		<?php if(empty($$disabled)){?>
		<button type="button" class="btn btn-danger removeAddress" >
			Remover
		</button>
		<?php }?>
	</div>
	<hr class="my-4">
</div>
