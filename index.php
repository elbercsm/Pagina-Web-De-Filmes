<!-- <script>alert("oi, eu sou o goku!");</script> -->
<?php
//inclui as configuraçoes de conexao ao banco de dados
include('config.php');
?>


<!DOCTYPE html>
<html>

<head>
	<title>Movieflix</title>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

	<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" href="fontawesome/css/all.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/jquery-3.4.1.min.js"></script>




</head>

<body>



	<!-- Header -->
	<header class="container-fluid site-header">
		<div class="container">
			<h1>MovieFlix</h1>
		</div>
	</header>



	<!-- Menu principal -->
	<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">

		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Links -->
		<div class="collapse navbar-collapse" id="menu">

			<ul class="navbar-nav">

				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?sec=generos">Gêneros</a>
				</li>
				<?php if (isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['user']['nivel'] >= 2) : ?>
					<li class="nav-item">
						<a class="nav-link" href="index.php?sec=cadastro_filme">NOVO FILME</a>
					</li>
				<?php endif;
				 ?>
			</ul>
		</div>

		<!-- Busca 
		Action : o endereço do arquivo para onde o formulario vai ser enviado
		Method : fomra de envio (Get/Post)
	-->

		<form class="form-inline" action="index.php" method="get">
			<input type="hidden" name="sec" value="busca">
			<input type="hidden" name="assunto" value="geral">
			<div class="input-group">
				<input type="text" name="palavra" class="form-control" placeholder="Busca">
				<!-- <input type="text" class="form-control" placeholder="Busca"> -->
				<div class="input-group-append">
					<button class="btn btn-dark" type="submit">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>

		</form>

		<div class="nav-user">
			<?php
			if (isset($_SESSION['logado']) && $_SESSION['logado']) : ?>
				<i class="fas fa-user"></i>&nbsp;
				<?php echo $_SESSION['user']['usuario']; ?> |
				<a href="index.php?sec=cadastrar">
					<i class="fas fa-user-plus"></i>&nbsp;
					Cadastro |
				</a>
				<a href="logout.php">Sair</a>


			<?php else : ?>

				<a href="index.php?sec=login">
					<i class="fas fa-user"></i>&nbsp;
					Entrar
				</a>
				<a href="index.php?sec=cadastrar">
					<i class="fas fa-user-plus"></i>&nbsp;
					Cadastrar-Se
				</a>

			<?php endif; ?>

		</div>


	</nav>



	<!-- Main/Principal -->
	<section class="container-fluid site-main">
		<div class="container">
			<?php
			//verificando qual pagina sera incluida no meio do site
			if (isset($_GET['sec'])) {
				# code...
				// seçoes aceitaveis para inclusao
				$secoes = ['filme', 'generos', 'busca', 'login', 'cadastrar', 'cadastro_filme'];
				$sec = $_GET['sec'];

				if (in_array($sec, $secoes)) { //existe esta secao
					include("pages/" . $sec . ".php");
				} else { // nao existe
					include("pages/principal.php");
				}
			} else {
				include('./pages/principal.php');
			}

			?>
		</div>
	</section>




	<!-- Footer -->
	<footer class="container-fluid site-footer">
		<div class="container">

		</div>
	</footer>



	<!-- Javascripts -->

	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/scripts.js"></script>

</body>

</html>