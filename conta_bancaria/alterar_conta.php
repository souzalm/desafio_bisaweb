<?php

require_once '../user.php';

$id_conta = filter_input(INPUT_GET, "id_conta", FILTER_VALIDATE_INT);
$descricao_conta = filter_input(INPUT_GET, "descricao_conta");

if (isset($_GET["saldo_inicial"])) {
$getvalor = $_GET["saldo_inicial"];
$saldo_inicial = filter_var($getvalor, FILTER_VALIDATE_FLOAT, DECIMAL);
}

/* Confere se é possível se conectar ao BD, emite mensagem se houver erro e apaga a query, realiza o INSERT INTO e retorna para template_conta.php. */
if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
	echo "Connectado ao $bdBanco em $host com sucesso.";
	if ($saldo_inicial >= 0) {
		if (!empty($descricao_conta)) {
			$query = mysqli_query($conn, "UPDATE conta_bancaria SET descricao_conta='$descricao_conta', saldo_inicial='$saldo_inicial' WHERE id_conta='$id_conta';");
		} else {
			echo " O campo Descrição da Conta Bancária precisa ser preenchido!";
		}
		if ($query) {
			header("Location: template_conta.php");
		} else {
			die (" A atualização dos dados não foi realizada.");
		}
	} else {
	echo " Saldo Inicial não pode ser menor que 0.";
	}
}
	
/* Se não for possível se conectar ao BD, emite mensagem. */
if (mysqli_connect_errno($conn)) { 
	echo "Problemas para conectar no banco. Verifique os dados!"; 
die(); 
}