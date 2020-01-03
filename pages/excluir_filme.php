<?php

	include("config.php");

	$id = $_GET['id'];

	$sql = "SELECT * FROM filmes WHERE id = {$id}";

	$sel = $con -> query($sql);

	$filme = $sel -> fetch_assoc();

	echo $filme;





?>