    <html>
        <head>
<!-- Título da Página: -->
            <title>Desafio BisaWeb - Sistema de Gestão Financeira - Movimentação Financeira</title>
			<?php 
			
			require_once '../user.php';
			require_once '../funcoes.php';
						
			/* Confere se é possível se conectar ao BD e emite mensagem. */
			if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
			echo "Connectado ao $bdBanco em $host com sucesso.";
			}

			/* Se não for possível se conectar ao BD, emite mensagem. */
			if (mysqli_connect_errno($conn)) { 
			echo "Problemas para conectar no banco. Verifique os dados!"; 
			die(); 
			}
			
			/* Sequência abaixo serve para fazer a consulta no BD da Movimentação Financeira especificada por qualquer uma das informações possíveis */
			
			/* Variável $parametro% para pesquisa nos registros do BD. */
			$parametroid = filter_input(INPUT_GET, "parametroid");
			$parametrodescricao = filter_input(INPUT_GET, "parametrodescricao");
			$parametrotipo = filter_input(INPUT_GET, "parametrotipo");
			$parametrodata = filter_input(INPUT_GET, "parametrodata");
			$parametrovalor = filter_input(INPUT_GET, "parametrovalor");
			$parametroconta = filter_input(INPUT_GET, "parametroconta");

			$data_para_banco = traduz_data_para_banco($parametrodata);
					
			/* IF serve para verificar se há algo em $parametro%, se sim trás os dados para $dados, se não também trás os dados sem considerar $parametro% como filtro. */
			if($parametroid) {
				$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE id_movimentacao LIKE '$parametroid' ORDER BY id_movimentacao");
			} elseif ($parametrodescricao) {
					$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE descricao_movimentacao LIKE '$parametrodescricao' ORDER BY id_movimentacao");
				} elseif ($parametrotipo) {
						$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE tipo_movimentacao LIKE '$parametrotipo' ORDER BY id_movimentacao");
					} elseif ($parametrodata) { 
							$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE data_movimentacao LIKE '$data_para_banco' ORDER BY id_movimentacao");
						} elseif ($parametrovalor) {
								$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE valor LIKE '$parametrovalor' ORDER BY id_movimentacao");
							} elseif ($parametroconta) {
									$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira WHERE conta_bancaria LIKE '$parametroconta' ORDER BY id_movimentacao");
									} else {
										$dados = mysqli_query($conn, "SELECT * FROM movimentacao_financeira ORDER BY id_movimentacao");
										}
			/* Variável que recebe as linhas de dados. */
			$linha = mysqli_fetch_assoc($dados);
			
			/* Variável que guarda o total de linhas recuperadas. */
			$total = mysqli_num_rows($dados);
			?>
        </head>
    <body>
		<div id="conteudo">	
<!-- Título interno da Página -->
			<h1>Sistema de Gestão Financeira - Movimentações Financeiras</h1>
			<h2>Consulta ao Banco de Dados de Movimentações Financeiras:</h2>
			
<!-- Formulário para busca de valores na própria página. -->
			<p>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>"> 
				Insira o <b>Id da Movimentação Financeira</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametroid"/> <br />
				Ou insira a <b>Descrição da Movimentação Financeira</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametrodescricao"/> <br />
				Ou insira o <b>Tipo da Movimentação Financeira</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametrotipo"/> (Inserir ou Receita ou Despesa) <br />
				Ou insira o <b>Data da Movimentação Financeira</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametrodata"/> (Formato DD/MM/AAAA) <br />
				Ou insira o <b>Valor da Movimentação Financeira</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametrovalor"/> (Formato 000000.00) <br />
				Ou insira a <b>Conta Bancária da Movimentação Financeira</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametroconta"/> <br />
				<input type="submit" value="Buscar"/>
			</form>
			</p>
			
<!-- Link para a página novaconta.php, index.php e para. -->
			
			<p>
				<a href="novamovimentacao.php">Adicionar nova Movimentação</a> <br /> <br />
				<a href="<?php echo "../index.php"?>">Voltar para o Índice</a> <br />
			</p>
			
			<h2>Geração de Relatório em PDF das Movimentações Financeiras:</h2>
			<p>
			<form target="_blank" action="gerarPDF.php"> 
				Insira o <b>Tipo da Movimentação</b> para filtrar os dados e gerar o relatório em PDF:
				<input type="text" name="pdftipo"/> (Inserir ou Receita ou Despesa) <br />
				Ou insira a <b>Data da Movimentação</b> para filtrar os dados e gerar o relatório em PDF:
				<input type="text" name="pdfdata"/> (Formato DD/MM/AAAA) <br />
				Ou deixe <b>em branco</b> e gere o relatório em PDF com todas as Movimentações Financeiras. <br />
				<input type="submit" target="_blank" value="Gerar PDF"/>
			</form>
			</p>

<!-- Tabela de exibição de dados do BD. -->
			<h2>Tabela de Movimentações Financeiras criadas:</h2>
			<h4><?php echo "Total de linhas consultadas: $total." ?> </h4>
			<table border="1">
			<tr>
				<td>Id</td>
                <td>Descrição</td>
                <td>Tipo</td>
				<td>Data</td>
				<td>Valor</td>
				<td>Conta Bancária</td>
			</tr>
			<?php
			/* Verifica se há linhas de dados e puxa os dados da variável $linha. */
				if($total) { do { 
			?>
		
			<tr>
				<td><?php echo $linha['id_movimentacao']; ?> </td>
                <td><?php echo $linha['descricao_movimentacao']; ?> </td>
                <td><?php echo $linha['tipo_movimentacao']; ?> </td>
				<td><?php echo traduz_data_para_exibir($linha['data_movimentacao']); ?> </td>
				<td><?php echo $linha['valor']; ?> </td>
				<td><?php echo $linha['conta_bancaria']; ?> </td>
				<td><a href="<?php echo "edicaomovimentacao.php?id_movimentacao=" . $linha['id_movimentacao'] . "&descricao_movimentacao=" .$linha['descricao_movimentacao'] . "&tipo_movimentacao=" .$linha['tipo_movimentacao'] . "&data_movimentacao=" .$linha['data_movimentacao'] . "&valor1=" .$linha['valor'] . "&conta_bancaria=" .$linha['conta_bancaria']?>">Alterar</a></td>
				<td><a href="<?php echo "excluir_movimentacao.php?id_movimentacao=" . $linha['id_movimentacao']?>">Excluir</a></td>
			</tr>
		
			<?php
			/* Puxa as linhas de dados do BD, quando a linha for nula, sai da estrutura de repetição. */
				} while($linha = mysqli_fetch_assoc($dados));
				
			/* Limpa $dados da memória. */
				mysqli_free_result($dados);
				}
			
			/* Fecha conexão com o BD. */
			mysqli_close($conn);	
			?>
		</div>
    </body>
</html>