<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= isset($title) ? $title : '' ?></title>
		<link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?=base_url('assets/css/auth.css') ?>" rel="stylesheet">
	</head>
	<body class="text-center">
		<main class="form-signin">
			<?= $this->load->view(isset($view) ? $view : '', array(), true) ?>
		</main>
	</body>
	<footer>
	</footer>
	<script src="<?=base_url('assets/vendor/jquery-3.7.1.min.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?=base_url('assets/js/auth.js') ?>"></script>

</html>
