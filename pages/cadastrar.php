<?php

?>
<?php



if (isset($_GET['erro'])) {

	$erro = $_GET['erro'];

	if ($erro == 'embranco') {

		$msg = 'Insira todos os dados!';
	} elseif ($erro == 'existente') {

		$msg = 'Usário Existente - Digite outro nome de usuário!';
	} elseif ($erro == 'sucesso') {

		$msg = 'Cadastro realizado com sucesso! Faça Login: <a href="index.php?sec=login">Clique Aqui!</a>';
	} elseif ($erro == 'naoCadastrado') {

		$msg = 'Cadastro Não realizado';
	}

	if ($msg == 'Cadastro realizado com sucesso! Faça Login: <a href="index.php?sec=login">Clique Aqui!</a>') {

		echo "<div class='alert alert-success'>{$msg}</div>";
	} else {
		echo "<div class='alert alert-danger'>{$msg}</div>";
	}

	if ($msg == 'Filme adicionado com sucesso!') {

		echo "<div class='alert alert-success'>{$msg}</div>";
	} else {
		echo "<div class='alert alert-danger'>{$msg}</div>";
	}
}
?>
<h1>Cadastrar</h1>
<form action="cadastro.php" method="post">
	<div class="form-group">
		<label for="usuario">Digite um nome de usuário:</label>
		<input type="text" name="usuario" class="form-control" id="usuario">
	</div>
	<div class="form-group">
		<label for="senha">Digite uma senha:</label>
		<input type="password" name="senha" class="form-control" id="senha">

		<?php
		if (isset($_SESSION['logado']) && $_SESSION['logado'] && $_SESSION['user']['nivel'] == "3") :
		
		?>

		<div class="radio">
				<label><input type="radio" name="nivel" value="1"> Usuário Nível 01 (Comum)</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="nivel" value="2"> Usuário Nível 02 (Intermediário)</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="nivel" value="3"> Usuário Nível 03 (Admin) </label>
			</div>



		<?php 
		endif; ?>




	</div>
	<button type="submit" class="btn btn-dark">Cadastrar</button>
</form>