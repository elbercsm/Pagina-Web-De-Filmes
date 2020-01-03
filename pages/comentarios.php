<?php

	include("../config.php");

	$nome = $_POST['nome'];
	$mensagem = $_POST['texto'];
	$data = date("Y-m-d H:i:s");
	$id = $_POST['id'];

	$sql = "INSERT INTO  comentarios (autor, data, texto, filme_id) VALUES ('$nome','$data','$mensagem', '$id')";

	if(mysqli_query($con,$sql)){

	}else{
		
	}

	header("Location: ../index.php?sec=filme&id={$id}");
?>