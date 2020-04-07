    <html>
        <head>
<!-- Título da Página: -->
            <title>Desafio BisaWeb - Sistema de Gestão Financeira - Movimentação Financeira</title>
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
			?>
        </head>
    <body>
<!-- Título interno da Página e formulário de input dos dados: -->
		<div id="conteudo">	
			<h1>Sistema de Gestão Financeira - Cadastro de nova Movimentação Financeira</h1>
			<p>
			<form action="salvar_movimentacao.php">
				Descrição da Movimentação Financeira: <input type="text" name="descricao_movimentacao"/> <br />
				<label for="tipo_movimentacao">Escolha um Tipo da Movimentação Financeira</label>
				<select name= "tipo_movimentacao" type="text"  id="tipo_movimentacao">
					<option name= "tipo_movimentacao" value="Receita">Receita</option>
					<option name= "tipo_movimentacao" value="Despesa">Despesa</option>
				</select> <br />
				Data da Movimentação Financeira: <input type="text" name="data_movimentacao"/> (Formato DD/MM/AAAA) <br />
				Valor da Movimentação Financeira: <input type="text" name="valor"/> (Formato 000000.00) <br />
				Conta Bancária da Movimentação Financeira: <input type="text" name="conta_bancaria"/> <br />
				<input type="submit" value="Adicionar"/>
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