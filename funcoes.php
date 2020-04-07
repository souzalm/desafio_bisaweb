<?php
/* Função que traduz Data inserida no formulário para o BD. */
function traduz_data_para_banco($data) {
	if ($data == "") { 
	return ""; 
	}
	
$dados = explode("/", $data);

$data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

return $data_mysql;
}

/* Função que traduz Data do BD para exibição na lista de movimentações financeiras. */
function traduz_data_para_exibir($data) { 
	if ($data == "" OR $data == "0000-00-00") { 
	return ""; }

$dados = explode("-", $data);

$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

return $data_exibir;
}

