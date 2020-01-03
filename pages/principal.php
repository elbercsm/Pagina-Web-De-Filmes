<h1>Ultimos lançamentos</h1>


<?php

$sql1 = "SELECT id, titulo, poster
FROM filmes
ORDER BY ano DESC
LIMIT 4";


$sel = $con-> query( $sql1);



if ($sel->num_rows > 0) {

	echo "<div class='row'>";
	//retorna a linha no formato de um array
	while($filme = $sel->fetch_assoc()){
		$id = $filme['id'];
		$titulo = $filme['titulo'];
		$poster = $filme['poster'];

		echo "<div class='col-sm-3 poster text-center'>";
		//echo '<img src="' . $poster . '">';
		echo "<a href='index.php?sec=filme&id={$id}'>";
		echo "<img src='{$poster}' title='{$titulo}'>";
		echo "</a>";
		echo "</div>";
	}
	echo "</div>";
}
?>


<h1> Mais Assistidos</h1>


<?php

$sql2 = "SELECT id, titulo, poster
FROM filmes
ORDER BY votos DESC
LIMIT 4";


$sel = $con-> query( $sql2);



if ($sel->num_rows > 0) {

	echo "<div class='row'>";
	//retorna a linha no formato de um array
	while($filme = $sel->fetch_assoc()){
		$id = $filme['id'];
		$titulo = $filme['titulo'];
		$poster = $filme['poster'];

		echo "<div class='col-sm-3 poster text-center'>";
		//echo '<img src="' . $poster . '">';
		echo "<img src='{$poster}' title='{$titulo}'>";
		echo "</div>";
	}
	echo "</div>";
}
?>
