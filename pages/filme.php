<?php

$id = $_GET['id'];

$sql = "SELECT * FROM filmes WHERE id = {$id}";

$sel = $con->query($sql);

$filme = $sel->fetch_assoc();

//print_r
//atores...
$sqlAtores = "SELECT A.id, A.titulo
			FROM atores A, atores_filmes AF
			WHERE AF.filme_id = {$id} AND A.id = AF.ator_id";
$selAtores = $con->query($sqlAtores);

$atores = [];

while ($ator = $selAtores->fetch_assoc()) {
	$atores[] = $ator;
}

//direçao
$sqlDiretores = "SELECT D.id, D.titulo
			FROM diretores D, diretores_filmes DF
			WHERE DF.filme_id = {$id} AND D.id = DF.diretor_id";
$selDiretores = $con->query($sqlDiretores);

$diretores = [];

while ($diretor = $selDiretores->fetch_assoc()) {
	$diretores[] = $diretor;
}

//genero 
$sqlGeneros = "SELECT G.id, G.titulo
			   FROM generos G, filmes_generos FG
			   WHERE FG.filme_id = {$id} AND G.id = FG.genero_id";
$selGeneros = $con->query($sqlGeneros);

$generos = [];

while ($genero = $selGeneros->fetch_assoc()) {
	$generos[] = $genero['titulo'];
}


// Comentarios
$sqlComentarios = "SELECT  C.autor AS nome, C.data AS data, C.texto AS texto
				   FROM comentarios C
				   WHERE filmes_id = {$id}
				   ORDER BY id DESC";

$selComentarios = $con->query($sqlComentarios);

$comentarios = [];


while ($comentario = $selComentarios->fetch_assoc()) {
	$comentarios[] = $comentario;
}

?>



<h1>
	<?php echo $filme['titulo']; ?>
	<small>
		(<?php echo $filme['ano']; ?>)
		<?php echo $filme['duracao']; ?> min /
		<?php echo implode(" | ", $generos); ?>
</h1>

<div class="row">
	<div class="col-lg-4">
		<img src="<?php echo $filme['poster']; ?>" class="poster_principal">
	</div>
	
	<div class="col-lg-3">
		<div class="filme-atores">
			<h3>Atores</h3>
			<?php foreach ($atores as $ator) : ?>
				<a href="index.php?sec=busca&assunto=ator&id=<?php echo $ator['id']; ?>">
					<?php echo $ator['titulo'] . '<br>'; ?>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="filme-direcao">
			<h3>Direção</h3>
			<?php foreach ($diretores as $diretor) : ?>
				<a href="index.php?sec=busca&assunto=diretor&id=<?php echo $diretor['id']; ?>">
					<?php echo $diretor['titulo'] . '<br>'; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php

	if (isset($_SESSION['logado']) && $_SESSION['logado'] ) : ?>
	<?php
		if($_SESSION['user']['nivel'] > 1){ 

	?>


		<form  method="post">

			

			<!-- Deletando Filme -->
				<button type="submit" class="btn btn-warning" name="exluir">Excluir Este Filme</button>

				<?php

					include("deletar_filme.php");

				?>
		</form>
		

	<?php
		} else {
	?>
		<li class="nav-item">
				
		</li>	
	<?php
		}
	?>
	
	<?php endif; ?>
	<div class="col-lg-5">
		<div class="filme-avaliacao">
			<span class="filme-nota">
				<?php echo $filme['nota']; ?>
			</span>
			<span class="filme-stars">
				<?php
				for ($i = 1; $i <= 10; $i++) {
					if ($filme['nota'] >= $i) {
						echo "<i class='fas fa-star'></i>"; //cheia
					} else {
						if ($i - $filme['nota'] < 1) {
							echo "<i class='fas fa-star-half-alt'></i>"; //metade
						} else {
							echo "<i class='far fa-star'></i>"; //metade
						}
					}
				} ?>
			</span>
		</div>
		<h3>Sinopse</h3>
		<p align="justify"><?php echo $filme['sinopse']; ?></p>
	</div>
</div>

<!-- Comentarios -->
<div class="row">
		<div class="col-sm-6">
			<h1>Comente</h1>
				<form action="pages/comentarios.php" method="post" >
					<input type="hidden" name="id" value="<?php echo $id; ?>">

					<input type="hidden" name="id_filme" id="id_filme" value="<?php echo $id ?>">


					<!-- Decide se estiver Logado pode Comentar -->
					<?php

						if (isset($_SESSION['logado']) && $_SESSION['logado'] ) : ?>
						
							<label for="formGroupExampleInput"><h3>Nome: </h3></label>
    						<input type="text" class="form-control" id="formGroupExampleInput" name="nome" size="25">
  							
  							<label for="exampleFormControlTextarea1"><h3>Mensagem: </h3></label>
    						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="texto"></textarea><br>
			
								
							<input type="submit" class="btn btn-warning" value="Enviar" id="btnEnviar">
						
						<?php else: ?>
								
							<h4>Entre ou Cadastre-se para fazer um comentario !</h4>
							<a href="index.php?sec=login" class="btn btn-warning">Entrar</a>
							<a href="index.php?sec=cadastrar" class="btn btn-warning">Cadastrar-se</a>
						
						<?php endif; ?>

				</form>

		</div>

		<!-- Div que carrega as comentários -->
		<div class="col-sm-6">
			<h1>Comentários</h1>
				<div class="loadComentarios">
			
					<div class="text -center" id="tempComentarios">
						
						<button class="btn btn-warning" id="btnLoad">Exibir</button>

					</div>

				</div>

		</div>

		<!-- Linkando filmes.js -->
		<script type="text/javascript" src="js/filmes.js"></script>

		<div class="comentarios1 col-sm-6">

				
			
		</div>
	</div>