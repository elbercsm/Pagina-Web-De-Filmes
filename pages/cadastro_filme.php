<?php
if (isset($_GET['erro']) ) {

	$erro = $_GET['erro'];

	if ($erro == 'embranco') {

		$msg = 'Insira todos os dados!';

	
	}elseif ( $erro == 'sucesso') {

		$msg = 'Filme adicionado com sucesso!';
	
	}


	if($msg == 'Filme adicionado com sucesso!'){

		echo "<div class='alert alert-success'>{$msg}</div>";

	}else {
		echo "<div class='alert alert-danger'>{$msg}</div>";
	}
	
	
}
?>
	<h1>Adicionar Novo Filme.</h1><br>
	<h2>Filme</h2>
<form action="novo_filme.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="titulo">Título do filme</label>
    	<input type="text" name="titulo" class="form-control" id="titulo">
    <div class="form-group">
   		 <label for="ano">Ano</label>
   		 <input type="text" name="ano" class="form-control" id="ano">
    <div class="form-group">
    <label for="duracao">Duração</label>
    <input type="text" name="duracao" class="form-control" id="duracao">
    <div class="form-group">
    <label for="sinopse">Sinópse</label>
    <textarea class="form-control" name="sinopse" rows="5" id="sinopse"></textarea>
    
  <div class="form-group">
    <label for="nota">Nota</label>
    <input type="text" name="nota" class="form-control" id="nota">		
  </div>
  <div class="form-group">
    <label for="votos">Votos</label>
    <input type="text" name="votos" class="form-control" id="votos">		
  </div>
<label for="exampleFormControlSelect1">Gênero</label>
    <select multiple class="form-control" id="exampleFormControlSelect1 name" name="generos[]">

    	<?php
    		include ("config.php");

    		$sql = "SELECT id, titulo from generos
    		ORDER BY titulo";
    		$sel = $con -> query($sql);
    	?>

    	<?php while ($genero = $sel-> fetch_assoc()): ?>

      		<option value ="<?php echo $genero['id']?>"><?php echo $genero['titulo']?></option>

 		<?php endwhile?>
     
    </select>

<label for="exampleFormControlSelect2">Ator</label>
    <select multiple class="form-control" id="exampleFormControlSelect2 name" name="atores[]">

    	<?php
    		include ("config.php");

    		$sql = "SELECT id, titulo from atores
    		ORDER BY titulo";
    		$sel = $con -> query($sql);
    	?>

    	<?php while ($ator = $sel-> fetch_assoc()): ?>

      		<option value ="<?php echo $ator['id']?>"><?php echo $ator['titulo']?></option>

 		<?php endwhile?>
     
    </select>

    <label for="exampleFormControlSelect3">Diretor</label>
    <select multiple class="form-control" id="exampleFormControlSelect3 name" name="diretores[]">

    	<?php
    		include ("config.php");

    		$sql = "SELECT id, titulo from diretores
    		ORDER BY titulo";
    		$sel = $con -> query($sql);
    	?>

    	<?php while ($diretor = $sel-> fetch_assoc()): ?>

      		<option value ="<?php echo $diretor['id']?>"><?php echo $diretor['titulo']?></option>

 		<?php endwhile?>
     
    </select>

    <label for="exampleFormControlSelect4">Idiomas</label>
    <select multiple class="form-control" id="exampleFormControlSelect4 name" name="idiomas[]">

    	<?php
    		include ("config.php");

    		$sql = "SELECT id, titulo from idiomas
    		ORDER BY titulo";
    		$sel = $con -> query($sql);
    	?>

    	<?php while ($idioma = $sel-> fetch_assoc()): ?>

      		<option value ="<?php echo $idioma['id']?>"><?php echo $idioma['titulo']?></option>

 		<?php endwhile?>
     
    </select>

    <label for="exampleFormControlSelect4">Paises</label>
    <select multiple class="form-control" id="exampleFormControlSelect4 name" name="paises[]">

    	<?php
    		include ("config.php");

    		$sql = "SELECT id, titulo from paises
    		ORDER BY titulo";
    		$sel = $con -> query($sql);
    	?>

    	<?php while ($pais = $sel-> fetch_assoc()): ?>

      		<option value ="<?php echo $pais['id']?>"><?php echo $pais['titulo']?></option>

 		<?php endwhile?>
     
    </select>

    <div class="form-group">
    <label for="exampleFormControlFile1">Escolher arquivo</label>
    <input type="file" name="arquivo" class="form-control-file" id="exampleFormControlFile1">
  </div>

 <button type="submit" class="btn btn-dark">Salvar</button>

</form>



