<?php
//logout.php

	session_start();

	unset($_SESSION['logado']); //destroi todas as variaveis de sessão
	unset($_SESSION['user']); //destroi todas as variaveis de sessão

	header("Location: index.php");
?>