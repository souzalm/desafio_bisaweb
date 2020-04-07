<?php

require_once '../user.php';

/* Verifica se está puxando id da URL e faz a atribuição de $id_conta. */
if (isset($_GET["id"])) {
	$getId = $_GET["id"];
	$id_conta = filter_var($getId, FILTER_SANITIZE_NUMBER_INT);
}

/* Confere se é possível se conectar ao BD, emite mensagem, realiza o DELETE e retorna para template_conta.php. */
if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
	echo "Connectado ao $bdBanco em $host com sucesso.";
	$query = mysqli_query($conn, "DELETE FROM conta_bancaria WHERE id_conta='$id_conta';");
	if ($query) {
		header("Location: template_conta.php");
	} else {
		die ("Erro: ".mysqli_error($conn));
	}
}
?>