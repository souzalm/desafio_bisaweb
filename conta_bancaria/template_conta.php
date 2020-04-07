    <html>
        <head>
<!-- Título da Página: -->
            <title>Desafio BisaWeb - Sistema de Gestão Financeira - Conta Bancária</title>
			<?php 
			
			require_once '../user.php';
						
			/* Confere se é possível se conectar ao BD e emite mensagem. */
			if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
			echo "Connectado ao $bdBanco em $host com sucesso.";
			}

			/* Se não for possível se conectar ao BD, emite mensagem. */
			if (mysqli_connect_errno($conn)) { 
			echo "Problemas para conectar no banco. Verifique os dados!"; 
			die(); 
			}
			
			/* Sequência abaixo serve para fazer a consulta no BD da Conta Bancária especificada por qualquer uma das informações possíveis */
			
			/* Variável $parametro% para pesquisa nos registros do BD. */
			$parametroid = filter_input(INPUT_GET, "parametroid");
			$parametrodescricao = filter_input(INPUT_GET, "parametrodescricao");
			$parametrosaldo = filter_input(INPUT_GET, "parametrosaldo");
			
			/* IF serve para verificar se há algo em $parametro%, se sim trás os dados para $dados, se não também trás os dados sem considerar $parametro% como filtro. */
			if($parametroid) {
				$dados = mysqli_query($conn, "SELECT * FROM conta_bancaria WHERE id_conta LIKE '$parametroid' ORDER BY id_conta");
			} elseif ($parametrosaldo) {
					$dados = mysqli_query($conn, "SELECT * FROM conta_bancaria WHERE saldo_inicial LIKE '$parametrosaldo' ORDER BY id_conta");
				} elseif ($parametrodescricao) {
						$dados = mysqli_query($conn, "SELECT * FROM conta_bancaria WHERE descricao_conta LIKE '$parametrodescricao' ORDER BY id_conta");
					} else { 
						$dados = mysqli_query($conn, "SELECT * FROM conta_bancaria ORDER BY id_conta");
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
			<h1>Sistema de Gestão Financeira</h1>
			<h2>Consulta ao Banco de Dados de Contas Bancárias:</h2>
			
<!-- Formulário para busca de valores na própria página. -->
			<p>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>"> 
				Insira o <b>Id da Conta Bancária</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametroid"/> <br />
				Ou insira a <b>Descrição da Conta Bancária</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametrodescricao"/> <br />
				Ou insira o <b>Saldo Inicial da Conta Bancária</b> para buscar suas informações, serão exibidas na tabela mais abaixo:
				<input type="text" name="parametrosaldo"/> (Formato 000000.00) <br />
				<input type="submit" value="Buscar"/>
			</form>
			</p>
			
<!-- Link para a página novaconta.php para adição de nova conta. -->
			<p>
				<a href="novaconta.php">Adicionar nova Conta</a> <br /> <br />
				<a href="<?php echo "../index.php"?>">Voltar para o Índice</a> <br />
			</p>

<!-- Tabela de exibição de dados do BD. -->
			<h2>Tabela de Contas Bancárias criadas:</h2>
			<h4><?php echo "Total de linhas consultadas: $total." ?> </h4>
			<table border="1">
			<tr>
				<td>Id</td>
                <td>Descrição</td>
                <td>Saldo Inicial</td>
			</tr>
			<?php
			/* Verifica se há linhas de dados e puxa os dados da variável $linha. */
				if($total) { do { 
			?>
		
			<tr>
				<td><?php echo $linha['id_conta']; ?> </td>
                <td><?php echo $linha['descricao_conta']; ?> </td>
                <td><?php echo $linha['saldo_inicial']; ?> </td>
				<td><a href="<?php echo "edicaoconta.php?id=" . $linha['id_conta'] . "&descricao_conta=" .$linha['descricao_conta'] . "&saldo_inicial=" .$linha['saldo_inicial']?>">Alterar</a></td>
				<td><a href="<?php echo "excluir_conta.php?id=" . $linha['id_conta']?>">Excluir</a></td>
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