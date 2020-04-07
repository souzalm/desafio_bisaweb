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
			
			/* Atribuição de valores as variáveis . */
			$id_movimentacao = filter_input (INPUT_GET, "id_movimentacao");
			$descricao_movimentacao = filter_input (INPUT_GET, "descricao_movimentacao");
			$tipo_movimentacao = filter_input (INPUT_GET, "tipo_movimentacao");
			$data_movimentacao = filter_input (INPUT_GET, "data_movimentacao");
			$valor = filter_input (INPUT_GET, "valor1");		
			
			/* Verifica se está puxando conta_bancaria da URL e faz a atribuição de $conta_bancaria. */
			if (isset($_GET["conta_bancaria"])) {
			$getconta = $_GET["conta_bancaria"];
			$conta_bancaria = filter_var($getconta, FILTER_SANITIZE_NUMBER_INT);
			}
			
			?>
        </head>
    <body>
<!-- Título interno da Página e Tabela de Exibição dos dados: -->
		<div id="conteudo">	
			<h1>Sistema de Gestão Financeira - Alterar Movimentação Financeira</h1>
			<p>
			<form action="alterar_movimentacao.php">
				<input type="hidden" name="id_movimentacao" value="<?php echo $id_movimentacao ?>"/>
				<input type="hidden" name="valor1" value="<?php echo $valor ?>"/>
				Descrição da Movimentação Financeira: <input type="text" name="descricao_movimentacao" value="<?php echo $descricao_movimentacao ?>"/> <br />
				Tipo da Movimentação Financeira: <input type="text" name="tipo_movimentacao" value="<?php echo $tipo_movimentacao ?>"/> (Inserir ou Receita ou Despesa) <br/>
				Data da Movimentação Financeira: <input type="text" name="data_movimentacao" value="<?php echo traduz_data_para_exibir($data_movimentacao) ?>"/> (Formato DD/MM/AAAA) <br />
				Valor da Movimentação Financeira: <input type="text" name="valor2" value="<?php echo $valor ?>"/> (Formato 000000.00) <br />
				Conta Bancária da Movimentação Financeira: <input type="text" name="conta_bancaria" value="<?php echo $conta_bancaria ?>"/> <br />
				<input type="submit" value="Alterar"/>
			</form>
			</p>
			<table border="1">
<!-- Link para a página template_movimentacao.php e para index.php. -->
			<p>
				<a href="<?php echo "template_movimentacao.php"?>">Voltar para a página principal de Movimentação Financeira</a> <br /> <br />
				<a href="<?php echo "../index.php"?>">Voltar para o Índice</a> <br />
			</p>
		</div>
    </body>
</html>