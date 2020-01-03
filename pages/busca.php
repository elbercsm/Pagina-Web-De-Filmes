<?php

$termo = ['assunto' => '','campo' =>'']; //oque esta sendo buscado.

$comp = 'Geral';
if (isset($_GET['assunto'])) { //busca por um assunto especifico
	
	$assunto = $_GET['assunto'];
	$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
	$palavra = (isset($_GET['palavra'])) ? $_GET['palavra'] : "";


	switch ($assunto) {

		case 'genero':

		$sql = "SELECT F.id , F.titulo, F.poster, G.titulo AS gTitulo FROM  generos G, filmes_generos FG, filmes F
		WHERE G.id  = FG.genero_id
		AND FG.filme_id = F.id
		AND G.id = {$id}";

		$termo['assunto'] = 'Gênero';
		$termo['campo'] = 'gTitulo';
		break;

		case 'ator':

		$sql = "SELECT F.id, F.titulo, F.poster, A.titulo AS aTitulo FROM atores A, atores_filmes AF, filmes F
		WHERE A.id = AF.ator_id
		AND AF.filme_id = F.id
		AND A.id = {$id}";
		
		$termo['assunto'] = 'Ator';
		$termo['campo'] = 'aTitulo';
		break;

		case 'diretor':

		$sql = "SELECT F.id, F.titulo, F.poster, D.titulo AS dTitulo FROM diretores D, diretores_filmes DF, filmes F
		WHERE D.id = DF.diretor_id
		AND DF.filme_id = F.id
		AND D.id = {$id}";
		
		$termo['assunto'] = 'Diretor';
		$termo['campo'] = 'dTitulo';
		break;

//buscar em titulo do filme, nome do ator, diretor ou genero
		case 'geral':

		if($palavra != ""){
				$sql = "SELECT DISTINCT(F.id), F.titulo, F.poster FROM generos G, filmes_generos FG, filmes F, atores A, atores_filmes FA, diretores D, diretores_filmes DF WHERE (G.id = FG.genero_id AND FG.filme_id = F.id) AND (A.id = FA.ator_id AND FA.filme_id = F.id) AND (D.id = DF.diretor_id AND DF.filme_id = F.id) AND (F.titulo LIKE '%{$palavra}%' OR G.titulo LIKE '%{$palavra}%' OR A.titulo LIKE '%{$palavra}%' OR D.titulo LIKE '%{$palavra}%')";
			}else{
				$sql = "SELECT id, titulo, poster FROM `filmes` F WHERE id = 0";
			}

		$termo['assunto'] = 'Geral';
		$termo['campo'] = 'Titulo';

		
		break;

		
		default:

		break;
	}

	$direc = 'ASC';

	if (isset($_GET['ordem'])) {
		$ordem = $_GET['ordem'];

		switch ( $ordem ) {
			case 'nome':

			$campoOrdem = 'F.titulo'; break;
			
			case 'data':

			$campoOrdem = 'F.ano'; break;

			case 'nota':

			$campoOrdem = 'F.nota'; break;
			
			default:

			$campoOrdem = 'F.id';

			break;
		}

		
		if (isset($_GET['direc'])) {
			$direc = $_GET['direc'];
			$direc = ( $direc == "DESC" ) ? "DESC" : "ASC";
		}


		$sql = $sql . " ORDER BY {$campoOrdem} {$direc}";

		if (isset($_GET['direc'])){
			$direc = ( $direc == "DESC") ? "ASC" : "DESC";
		}
		
	}
$sel = $con->query($sql);
	// total
	$total = $sel->num_rows;
	// Itens por paginas
	$registros = 12;
	// retorno da pagina para clicar no link = pagina
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$numPaginas = ceil($total / $registros);

	$inicio = ($registros * $pagina) - $registros;

	$sql = $sql . " LIMIT $inicio, $registros";

	$sel = $con->query($sql);

	//echo $sql;
	
	$sel = $con->query($sql);


}else{ // busca geral ( por um formulario)

}



?>


<h1> Resultado </h1>


<?php if ( $sel->num_rows == 0) : // nao encontrou resultado ?>

	<div class="alert alert-secondary">
		nenhum resultado encontrado !
	</div>

<?php else : // encontrou resultado ?>

	<div class="row">
		<div class="col-lg-8">
			<h4>

				Buscar em
				<?php echo $termo['assunto'];?> :
				
			</h4>
		</div>
		<div class="col-lg-4 text-right">
			<a href="index.php?sec=busca&assunto=<?php echo $assunto;?>&id=<?php echo $id;?>&ordem=nome&direc=<?php echo $direc;?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-sort"></i>Nome</a>


			<a href="index.php?sec=busca&assunto=<?php echo $assunto;?>&id=<?php echo $id;?>&ordem=data&direc=<?php echo $direc;?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-sort"></i>Data</a>

			<a href="index.php?sec=busca&assunto=<?php echo $assunto;?>&id=<?php echo $id;?>&ordem=nota&direc=<?php echo $direc;?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-sort"></i>Nota</a>

		</div>
	</div>
	


	<div class="row">
		<?php
		$cont = 0;
			$sel->data_seek(0); //volta para primeiro registro
			while ($filme = $sel->fetch_assoc()) : ?>
				<div class='col-lg-3 poster text-center'>
					<a href="index.php?sec=filme&id=<?php echo $filme['id'];?>">
						<img src="<?php echo $filme['poster']; ?>" title="<?php echo $filme['titulo']; ?>"> 
					</a>
				</div>
				<?php
				if (++ $cont % 4 == 0){
					echo "</div>";
					echo "<div class='row'>";
				}
			endwhile;
			?>
		</div>

		<br>
		<br><?php
  	
  ?>
		<ul class="pagination">

			<?php
			if ($pagina==1) {?>
				<li class="page-item"><a href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=1 "></a></li>
				
  <li class="page-item"><a href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php
  if ($pagina<=1) {
  		$pagina =1;
  		echo $pagina;
  	
  	}else{
   echo $pagina-1; }?> "></a></li>
				
			<?php } else{?>
			<li class="page-item"><a class="page-link" href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=1 "><<</a></li>
				
  <li class="page-item"><a class="page-link" href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php
  if ($pagina<=1) {
  		$pagina =1;
  		echo $pagina;
  	
  	}else{
   echo $pagina-1; }?> "><</a></li> <?php } ?>

  
	<?php
	for($i=0; $i<$numPaginas;$i++){
		$estilo ="";
		if ($pagina == $i)
			$estilo = "class=\"apt_get_active_\"";
		?>
		
	<li class="page-item" <?php echo $estilo; ?> ><a class="page-link" href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php echo $i+1; ?>"><?php echo $i + 1; ?></a></li><?php   } ?>
		
<!-- Proxima Pagina -->
<?php
if ($pagina==$numPaginas) {?>
	 <li class="page-item"><a href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php 

   if ($pagina>=$numPaginas) {
  		$pagina = $numPaginas;
  		echo $pagina;
  	
  	}else{
  echo $pagina+1; }?> "></a></li>
<li class="page-item"><a href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php echo $numPaginas; ?> "></a></li>
	
<?php } else {?>
  <li class="page-item"><a class="page-link" href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php 

   if ($pagina>=$numPaginas) {
  		$pagina = $numPaginas;
  		echo $pagina;
  	
  	}else{
  echo $pagina+1; }?> ">></a></li>
<li class="page-item"><a class="page-link" href="index.php?sec=busca&assunto=genero&id=<?php echo $id; ?>&pagina=<?php echo $numPaginas; ?> ">>></a></li><?php } ?>

</ul>



		<?php endif; ?>