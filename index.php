<?php
	$error = isset($_GET['erro']) ? $_GET['erro'] : NULL;

	$register = isset($_GET['register']) ? $_GET['register'] : -1;
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
		
		<script type="text/javascript">
			$(document).ready(function() {
				$("input[name='login']").click(function() {
					
					var empty_fields = false;

					if($("input[name='username']").val() == '') {
						$("input[name='username']").css({ 'border-color' : '#A94442'});
						empty_fields = true;
					}
					else {
						$("input[name='username']").css({ 'border-color' : '#CCC'});
					}

					if($("input[name='password']").val() == '') {
						$("input[name='password']").css({ 'border-color' : '#A94442'});
						empty_fields = true;
					}
					else {
						$("input[name='password']").css({ 'border-color' : '#CCC'});
					}
					return !empty_fields;
					
				});
			});
		</script>
	</head>

	<body>
		<!-- Static Navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img src="imagens/icone_twitter.png"/>
				</div> <!-- Navbar-header-->

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="signup.php">Inscreva-se</a></li>
						<li class="dropdown <?= $error == 1 ? 'open' : '' ?>">
							<a id="entrar" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
							<ul class="dropdown-menu" aria-labelledby="entrar">
								<li>
									<div class="col-md-12">
										<p>Você possui uma conta?</p>

										<form action="validate_login.php" method="post" id="loginForm">
											<div class="form-group">
												<input type="text" class="form-control" name="username" placeholder="Usuário">
											</div>

											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Senha">
											</div>

											<input type="submit" class="btn btn-primary" name="login" value="Entrar">
										</form>

										<?php
											if($error == 1) {
												echo '<br/><font color=#FF0000> Usuário e/ou senha inválidos. </font>';
											}
										?>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div> <!-- Navbar Collapse -->
			</div> <!-- Container Inside Nav -->
		</nav><!-- Static Navbar -->
	
		<div class="container">
			<?php if($register == 1): ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Registro Efetuado com Sucesso!</strong>
				</div>
			<?php endif ?>
			<?php if($error == 1): ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Nome de usuário e/ou senha incorretos.</strong>
				</div>
			<?php endif ?>
			<!-- Main component for a primary marketing message or call to action -->
			<div class="jumbotron">
				
				<h1>Bem vindo ao twitter clone</h1>
				<p>Veja o que está acontecendo agora...</p>
			</div>

			<div class="clearfix"></div>
		</div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	</body>
</html>