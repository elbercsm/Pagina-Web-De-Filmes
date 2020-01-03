<?php
include("config.php");

$titulo = $_POST['titulo'];
$ano = ($_POST['ano']);
$duracao = $_POST['duracao'];
$sinopse = $_POST['sinopse'];
$nota = $_POST['nota'];
$votos = $_POST['votos'];
$generos = $_POST['generos'];
$atores = isset($_POST['atores']) ? $_POST['atores'] : array();
$diretores = $_POST['diretores'];

	//print_r($_POST);
	//echo "<br>";
	//print_r($_FILES);


			$poster = '';
			if (isset($_FILES['arquivo'])){

				$extensao = strtolower( substr($_FILES['arquivo']['name'], -4));
				$novo_nome = md5(time()). $extensao;

				$diretorio = "upload/";

				$resultado = move_uploaded_file($_FILES ['arquivo'] ['tmp_name'],$diretorio . $novo_nome);
				if ( $resultado ) {
					$poster = $diretorio . $novo_nome;
				}
				
			} 

			$sql_filmes = "INSERT INTO filmes (titulo, ano,duracao,sinopse,poster,nota,votos)
			VALUES ('$titulo','$ano','$duracao','$sinopse','$poster','$nota','$votos')";
	
	if($titulo== "" || $ano == "" || $duracao == "" ||$sinopse =="" ||$poster == "" ||$nota =="" ||$votos=="" || $generos =="" || $atores== "" || $diretores ==""){

				header("Location: index.php?sec=cadastro_filme&erro=embranco");
			} else {

			if (mysqli_query($con, $sql_filmes)) {
				$sql_pega_id_filmes =" SELECT id FROM filmes ORDER BY `filmes`.`id` DESC LIMIT 1";

					$selFilmes = $con -> query($sql_pega_id_filmes);
					$pega_id_filme = $selFilmes-> fetch_assoc();
					$filme_id = $pega_id_filme['id'];

					foreach ($generos as $generos_id ) {
						$sqlGeneros = "INSERT INTO filmes_generos(filme_id, genero_id)
						VALUES  ('$filme_id','$generos_id')";
							$selGeneros = $con->query($sqlGeneros);
					}


					foreach ($atores as $atores_id ) {
						$sqlAtores = "INSERT INTO atores_filmes(ator_id, filme_id)
						VALUES  ('$atores_id','$filme_id')";
							$selAtores = $con->query($sqlAtores);
					}

					foreach ($diretores as $diretores_id ) {
						$sqlDiretores = "INSERT INTO diretores_filmes(diretor_id, filme_id)
						VALUES  ('$diretores_id','$filme_id')";
							$selDiretores = $con->query($sqlDiretores);
					}
					foreach ($diretores as $diretores_id ) {
						$sqlDiretores = "INSERT INTO diretores_filmes(diretor_id, filme_id)
						VALUES  ('$diretores_id','$filme_id')";
							$selDiretores = $con->query($sqlDiretores);
					}
					foreach ($idiomas as $idiomas_id ) {
						$sqlIdiomas = "INSERT INTO filmes_idiomas(filme_id, idioma_id)
						VALUES  ('$idiomas_id','$filme_id')";
							$selIdiomas = $con->query($sqlIdiomas);
					}
					foreach ($paises as $paises_id ) {
						$sqlPaises = "INSERT INTO filmes_paises(filme_id, pais_id)
						VALUES  ('$paises_id','$filme_id')";
							$selPaises = $con->query($sqlPaises);
					}

				header("Location: index.php?sec=cadastro_filme&erro=sucesso");
				//echo "OK: " . $sql_filmes;
			} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($con);
			header("Location: index.php?sec=cadastro_filme&erro=naoCadastrado");
				//echo "ERRO: " . $sql_filmes;

			}
		

		}

?>