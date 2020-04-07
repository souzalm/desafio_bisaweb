<?php

require_once '../user.php';
require_once '../funcoes.php';

if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
	echo "Connectado ao $bdBanco em $host com sucesso.";
}

/* Sequência abaixo serve para fazer a consulta no BD da Movimentação Financeira especificada por qualquer uma das informações possíveis */		

/* Variável $pdf% para pesquisa nos registros do BD. */

$pdftipo = filter_input(INPUT_GET, "pdftipo");

if (isset($_GET['pdfdata'])) { 
	$pdfdata = traduz_data_para_banco(filter_input (INPUT_GET, "pdfdata")); 
} 				

/* IF serve para verificar se há algo em $pdf%, se sim trás os dados de $pdf%, se não também trás os dados sem considerar $parametro como filtro. */
if ($pdftipo) {
	$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE tipo_movimentacao LIKE '$pdftipo' ORDER BY id_movimentacao");
} elseif ($pdfdata) {
	$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE data_movimentacao LIKE '$pdfdata' ORDER BY id_movimentacao");
	} else {
		$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira ORDER BY id_movimentacao");
		}
		
/* Variável que recebe as linhas de dados. */
$linha = mysqli_fetch_assoc($dados);			

/* Variável que guarda o total de linhas recuperadas. */
$total = mysqli_num_rows($dados);
require('../fpdf182/fpdf.php');
$pdf = new FPDF('P','cm','A4');
$pdf -> AddPage();

/* Títulos */

	$pdf -> SetFont('Arial','B',16);
	$pdf -> cell(20,2,utf8_decode('Relatório de Movimentação Financeira'),0,'','C');

if ($pdftipo) {
	$pdf -> Ln(1);
	$pdf -> SetFont('Arial','B',14);
	$pdf -> cell(20,2,utf8_decode('Tipo da Movimentação Financeira: '),0,'','C');
	$pdf -> Ln(1);
	$pdf -> SetFont('Arial','',14);
	$pdf -> cell(20,2,$pdftipo,0,'','C');
} else if ($pdfdata) {
		$pdf -> Ln(1);
		$pdf -> SetFont('Arial','B',14);
		$pdf -> cell(20,2,utf8_decode('Data da Movimentação Financeira: '),0,'','C');
		$pdf -> Ln(1);
		$pdf -> SetFont('Arial','',14);
		$pdf -> cell(20,2,traduz_data_para_exibir($pdfdata),0,'','C');	
		} else {
		}
						
	$pdf -> Ln(2);
	$pdf -> SetFont('Arial','B',12);
	$pdf -> cell(2,0.5,utf8_decode('Id'),1,'','C');
	$pdf -> cell(4,0.5,utf8_decode('Descrição'),1,'','C');
	$pdf -> cell(2,0.5,utf8_decode('Tipo'),1,'','C');
	$pdf -> cell(4,0.5,'Valor',1,'','C');
	$pdf -> cell(3,0.5,utf8_decode('Data'),1,'','C');
	$pdf -> cell(4,0.5,utf8_decode('Conta Bancária'),1,'','C');
	$pdf -> Ln(1);

/* Linhas da Tabela. */
	$pdf -> SetFont('Times','',12);
if($total) { do {
	$pdf -> cell(2,0.5,$linha['id_movimentacao'],1,'','C');
	$pdf -> cell(4,0.5,utf8_decode($linha['descricao_movimentacao']),1,'','C');
	$pdf -> cell(2,0.5,$linha['tipo_movimentacao'],1,'','C');
	$pdf -> cell(4,0.5,$linha['valor'],1,'','C');
	$pdf -> cell(3,0.5,traduz_data_para_exibir($linha['data_movimentacao']),1,'','C');
	$pdf -> cell(4,0.5,$linha['conta_bancaria'],1,'','C');
	$pdf->Ln();
} while($linha = mysqli_fetch_assoc($dados));				

/* Limpa $dados da memória. */
mysqli_free_result($dados);
}

ob_end_clean();

$pdf -> Output();

?>