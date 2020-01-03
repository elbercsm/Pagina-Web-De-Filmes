<?php
	if(isset($_POST['exluir'])){
		// Deleta da Tabela Filmes
		$sqlDeleteFilme = "DELETE FROM filmes WHERE id= '$id'";

		$selDeleteFilme = $con -> query($sqlDeleteFilme);

		// Deleta da Tabela atores-filmes
		$sqlDeleteAtores = "DELETE FROM atores_filmes WHERE filme_id = '$id'";

		$selDeleteAtores = $con -> query($sqlDeleteAtores);

		// Deleta da Tabela diretores_filmes
		$sqlDeleteDiretores = "DELETE FROM diretores_filmes WHERE filme_id = '$id'";

		$selDeleteDiretores = $con -> query($sqlDeleteDiretores);

		// Deleta da Tabela filmes_generos
		$sqlDeleteGeneros = "DELETE FROM filmes_generos WHERE filme_id = '$id'";

		$selDeleteGeneros = $con -> query($sqlDeleteGeneros);

		// Deleta da Tabela filmes_idiomas
		$sqlDeleteIdiomas = "DELETE FROM filmes_idiomas WHERE filme_id = '$id'";

		$selDeleteIdiomas = $con -> query($sqlDeleteIdiomas);


		// Deleta da Tabela filmes_paises
		$sqlDeletePaises = "DELETE FROM filmes_paises WHERE filme_id = '$id'";

		$selDeletePaises = $con -> query($sqlDeletePaises);


		echo"<script language='javascript' type='text/javascript'>
				alert('Filmes Excluido Com Sucesso');window.location.
				href='index.php'</script>";

		//header("Location: index.php");
	}
?>