<?php

require_once '../user.php';

/* Verifica se está puxando id da URL e faz a atribuição de $id_movimentacao. */
if (isset($_GET["id_movimentacao"])) {
	$getId = $_GET["id_movimentacao"];
	$id_movimentacao = filter_var($getId, FILTER_SANITIZE_NUMBER_INT);
}

/* Confere se é possível se conectar ao BD, emite mensagem, realiza o DELETE e retorna para template_conta.php. */
if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
	echo "Connectado ao $bdBanco em $host com sucesso.";
	$query = mysqli_query($conn, "DELETE FROM movimentacao_financeira WHERE id_movimentacao='$id_movimentacao';");
	if ($query) {
		header("Location: template_movimentacao.php");
	} else {
		die ("Erro: ".mysqli_error($conn));
	}
}
?>