<?php
	$err_username = isset($_GET['err_username']) ? $_GET['err_username'] : 0;
	$err_password = isset($_GET['err_password']) ? $_GET['err_password'] : 0;
	$err_email = isset($_GET['err_email']) ? $_GET['err_email'] : 0;
	$error = isset($_GET['error']) ? $_GET['error'] : 0;

	$err_username_values = array(
		0 => '',
		1 => 'Nome de usuário não pode estar vazio.',
		2 => 'Nome de usuário deve conter pelo menos 4 caracteres.',
		3 => 'Nome de usuário pode conter apenas letras de a-z e números.',
		4 => 'Já existe um usuário com esse nome.'
	);

	$err_password_values = array(
		0 => '',
		1 => 'A senha não pode estar vazia.',
		2 => 'A senha deve conter pelo menos 4 caracteres.',
	);

	$err_email_values = array(
		0 => '',
		1 => 'Email não pode estar vazio.',
		2 => 'Email inválido.',
		3 => 'Email já cadastrado.'
	);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	</head>

	<body>

		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img src="imagens/icone_twitter.png" />
				</div>
				
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">Voltar para Home</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>


		<div class="container">
			<?php if($error == 1): ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Ocorreu um erro em nosso sistema. Entre em contato informando os detalhes.</strong>
				</div>
			<?php endif; ?>
			
			<br/><br/>

			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h3>Inscreva-se já.</h3>
				<br />
			<form method="post" action="register_user.php" id="formSignup">
				<div class="form-group <?php echo $err_username == 0 ? '' : 'has-error'; ?>">
					
					<input type="text" class="form-control" name="username" placeholder="Usuário" required>
					<span class="help-block">
						<?php 
							if($err_username) {
								echo $err_username_values[$err_username]; 
							}
						?>
					</span>

				</div>

				<div class="form-group <?php echo $err_email == 0 ? '' : 'has-error'; ?>">
					<input type="email" class="form-control"  name="email" placeholder="Email" required>
					<span class="help-block">
						<?php 
							if($err_email) {
								echo $err_email_values[$err_email]; 
							}
						?>
					</span>
				</div>
				
				<div class="form-group <?php echo $err_password == 0 ? '' : 'has-error'; ?>">
					<input type="password" class="form-control" name="password" placeholder="Senha" required>
					<span class="help-block">
						<?php 
							if($err_password) {
								echo $err_password_values[$err_password]; 
							}
						?>
					</span>
				</div>
				
				<button type="submit" class="btn btn-primary form-control">Inscreva-se</button>
			</form>
		</div>
			
		<div class="col-md-4"></div>

		<div class="clearfix"></div>
		<br />
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>

		
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</body>
</html>