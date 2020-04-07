<?php

require_once '../user.php';
require_once '../funcoes.php';

/* Atribuição de valores as variáveis $descricao_conta e $saldo_inicial. */
$id_movimentacao = filter_input (INPUT_GET, "id_movimentacao");
$descricao_movimentacao = filter_input (INPUT_GET, "descricao_movimentacao");
$tipo_movimentacao = filter_input (INPUT_GET, "tipo_movimentacao");
$data_movimentacao = traduz_data_para_banco(filter_input (INPUT_GET, "data_movimentacao"));
$valor1 = filter_input (INPUT_GET, "valor1");

if (isset($_GET["valor2"])) {
$getvalor2 = $_GET["valor2"];
$valor2 = filter_var($getvalor2, FILTER_VALIDATE_FLOAT, DECIMAL);
}
		
/* Verifica se está puxando conta_bancaria da URL e faz a atribuição de $conta_bancaria. */
if (isset($_GET["conta_bancaria"])) {
$getId = $_GET["conta_bancaria"];
$conta_bancaria = filter_var($getId, FILTER_SANITIZE_NUMBER_INT);
}

$data_ref='1992-01-03';

/* Confere se é possível se conectar ao BD, emite mensagem se houver erro e apaga as querys, realiza o INSERT INTO e retorna para template_movimentacao.php. */
if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
	echo "Connectado ao $bdBanco em $host com sucesso.";
	if ($valor2 > 0) {
		if (!empty($descricao_movimentacao)) {
			if (!empty($data_movimentacao)) {
				if (strtotime($data_movimentacao) > strtotime($data_ref)) {
					$query1 = mysqli_query($conn, "SELECT * FROM conta_bancaria WHERE id_conta = '$conta_bancaria';");
					if (mysqli_num_rows($query1) == 1) {
						$query2 = mysqli_query($conn, "UPDATE movimentacao_financeira SET descricao_movimentacao='$descricao_movimentacao', tipo_movimentacao='$tipo_movimentacao', data_movimentacao='$data_movimentacao', valor='$valor2', conta_bancaria='$conta_bancaria' WHERE id_movimentacao='$id_movimentacao';");
						if (($tipo_movimentacao == 'Receita') OR ($tipo_movimentacao == 'Despesa')) {
							switch (strcasecmp($tipo_movimentacao, 'Receita')) {
							case 0:
								$query3 = mysqli_query($conn, "UPDATE conta_bancaria SET saldo_inicial=saldo_inicial-'$valor1' WHERE id_conta='$conta_bancaria';");
								$query4 = mysqli_query($conn, "UPDATE conta_bancaria SET saldo_inicial=saldo_inicial+'$valor2' WHERE id_conta='$conta_bancaria';");
								break;
							case -14:
								$query5 = mysqli_query($conn, "UPDATE conta_bancaria SET saldo_inicial=saldo_inicial+'$valor1' WHERE id_conta='$conta_bancaria';");
								$query6 = mysqli_query($conn, "UPDATE conta_bancaria SET saldo_inicial=saldo_inicial-'$valor2' WHERE id_conta='$conta_bancaria';");
								break;
							}
						} else {
						die (" Deve-se preencher um Tipo de Receita com 'Receita' ou 'Despesa'.");
						unset($query1);
						unset($query2);
						}	
						if ($query3 OR $query4 OR $query5 OR $query6) {
							header("Location: template_movimentacao.php");
							unset($query1);
							unset($query2);
							unset($query3);
							unset($query4);
							unset($query5);
							unset($query6);
						}
					} else {
					die (" Deve-se inserir uma Conta Bancária cadastrada.");
					unset($query1);
					}
				} else {
				die (" Deve-se preencher uma data posterior a 03/01/1992.");
				}
			} else {
			die (" Deve-se preencher uma data no formado DD/MM/AAAA.");
			}
		} else {
			die (" Deve-se preencher uma Descrição da Movimentação Financeira.");
			}
	} else {
		die (" Valor não pode ser menor que 0 ou nulo.");
		}
}

/* Se não for possível se conectar ao BD, emite mensagem. */
if (mysqli_connect_errno($conn)) { 
	echo "Problemas para conectar no banco. Verifique os dados!"; 
	die(); 
}
?>