<?php
// logar.php


	include("config.php");

	if (isset($_POST['usuario']) && isset($_POST['senha']) ) {

		$usuario = $_POST['usuario'];
		$senha = sha1($_POST['senha']);
		

		$sql = "SELECT * FROM usuarios 
				WHERE usuario='{$usuario}' AND senha = '{$senha}'";

				$sel = $con->query($sql);

				if ($sel->num_rows) { //usuario existe

					$_SESSION['logado'] = true;
					$_SESSION['user']   = $sel->fetch_assoc();

					header("Location: index.php");

				} else {  //usuario nao encontardo
					header("Location: index.php?sec=login&erro=notfound");
				}
		
	}else {
		header("Location: index.php?sec=login&erro=empty");
	}

?>