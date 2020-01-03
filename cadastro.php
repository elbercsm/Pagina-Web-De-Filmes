<?php
include("config.php");

$usuario = $_POST['usuario'];
$senha = sha1($_POST['senha']);
$nivel = $_POST['nivel'];




	$sql = "INSERT INTO usuarios (usuario, senha,nivel)
			VALUES ('$usuario','$senha','$nivel')";

		


	$sql = "SELECT * FROM usuarios WHERE usuario = '{$usuario}'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_num_rows($result);
		

		$sql = "INSERT INTO usuarios (usuario, senha, nivel)
				VALUES ('$usuario', '$senha', '$nivel')";

		if($row > 0){
		    header("Location: index.php?sec=cadastro&erro=existente");
		} elseif ($usuario == NULL || $senha == NULL){
			header("Location: index.php?sec=cadastro&erro=embranco");
		} else {

			if (mysqli_query($con, $sql)) {
				header("Location: index.php?sec=cadastro&erro=sucesso");
			} else {
			//     //echo "Error: " . $sql . "<br>" . mysqli_error($con);
			header("Location: index.php?sec=cadastro&erro=naoCadastrado");

			}
		}

	


?>

