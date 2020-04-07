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
			
			/* Verificação se $id_conta está sendo preenchido e também atribuição de $id_conta. */
			if (isset($_GET["id"])) {
			$getId = $_GET["id"];
			$id_conta = filter_var($getId, FILTER_SANITIZE_NUMBER_INT);
			}
			
			/* Atribuição de valores as variáveis $descricao_conta e $saldo_inicial. */
			$descricao_conta = filter_input (INPUT_GET, "descricao_conta");
			$saldo_inicial = filter_input (INPUT_GET, "saldo_inicial");
			?>
        </head>
    <body>
<!-- Título interno da Página e Tabela de Exibição dos dados: -->
		<div id="conteudo">	
			<h1>Sistema de Gestão Financeira - Alterar Conta Bancária</h1>
			<p>
			<form action="alterar_conta.php">
				<input type="hidden" name="id_conta" value="<?php echo $id_conta ?>"/>
				Descrição Conta Bancária: <input type="text" name="descricao_conta" value="<?php echo $descricao_conta ?>"/> <br/>
				Saldo Inicial: <input type="text" name="saldo_inicial" value="<?php echo $saldo_inicial ?>"/> (Formato 000000.00) <br/>
				<input type="submit" value="Alterar"/>
			</form>
			</p>
			<table border="1">
<!-- Link para a página template_movimentacao.php e para index.php. -->
			<p>
				<a href="<?php echo "template_conta.php"?>">Voltar para a página principal de Conta Bancária</a> <br /> <br />
				<a href="<?php echo "../index.php"?>">Voltar para o Índice</a> <br />
			</p>
		</div>
    </body>
</html>