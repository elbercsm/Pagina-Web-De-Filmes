<?php
	include("config.php");

	$msg = false;

	if (isset($_FILES['arquivo'])){

		$extensao = strtolower( substr($_FILES['arquivo']['name'], -4));
		$novo_nome = md5(time()). $extensao

		$diretorio = "upload/";

		move_uploaded_file($_FILES ['arquivo'] ['tmp_name'],$diretorio . $novo_nome);

		$sql_filmes = "INSERT INTO filmes (poster)
			VALUES ('$poster')";
		}

?>