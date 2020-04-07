    <html>
        <head>
<!-- Título da Página: -->
            <title>Desafio BisaWeb - Sistema de Gestão Financeira - Conta Bancária</title>
			<?php 
			require_once '../user.php';
			/* Variável $parametro para pesquisa nos registros do BD. */
			$parametro = filter_input(INPUT_GET, "parametro");
						
			/* Confere se é possível se conectar ao BD e emite mensagem. */
			if ($conn = mysqli_connect($host, $bdUsuario, $bdSenha, $bdBanco)) {
			echo "Connectado ao $bdBanco em $host com sucesso.";
			}

			/* Se não for possível se conectar ao BD, emite mensagem. */
			if (mysqli_connect_errno($conn)) { 
			echo "Problemas para conectar no banco. Verifique os dados!"; 
			die(); 
			}
			?>
        </head>
    <body>
<!-- Título interno da Página e formulário de input dos dados: -->
		<div id="conteudo">	
			<h1>Sistema de Gestão Financeira - Cadastro de nova Conta Bancária</h1>
			<p>
			<form action="salvar_conta.php">
				Descrição da Conta Bancária: <input type="text" name="descricao_conta"/><br />
				Saldo Inicial: <input type="text" name="saldo_inicial"/> (Formato 000000.00) <br />
				<input type="submit" value="Adicionar"/>
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