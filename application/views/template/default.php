<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= isset($title) ? $title : '' ?></title>
	<link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?=base_url('assets/vendor/DataTables/datatables.min.css') ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img  src="<?=base_url('/assets/image/logo.png')?>" alt="" height="37"></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Inicio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link"  href="<?=base_url('users')?>">Usuarios</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<?=$this->session->userdata('auth_user')['name'] ?? ''?>
					</a>
					<ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="<?=base_url('logout')?>">Sair</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<?= $this->load->view(isset($view) ? $view : '', array(), true) ?>
</body>
<footer>
</footer>
<script src="<?=base_url('assets/vendor/jquery-3.7.1.min.js') ?>"></script>
<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?=base_url('assets/vendor/DataTables/datatables.min.js') ?>"></script>
<script>
	const BASE_URL = "<?=base_url()?>";
</script>
<script src="<?=base_url('assets/js/users.js') ?>"></script>

</html>
