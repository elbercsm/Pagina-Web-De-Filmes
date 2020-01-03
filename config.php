<?php

//config.php
date_default_timezone_set("America/Sao_Paulo");
session_start();

//conecxao

$con = new mysqli("127.0.0.1", "root" ,"" , "iftm_filmes");

if ($con-> connect_error ) {
	die('Erro na conexao :' . $con-> connect_error);
}

?>