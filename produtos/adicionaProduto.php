<?php 
	include('conexao.php');
	
	//CAPTURA OS DADOS DO FORMULÁRIO
	$nomeProduto = $_REQUEST[nomeProduto];
	$idCategoria = $_REQUEST[categoria];
	$preco = $_REQUEST[preco];	
	$estoque = $_REQUEST[estoque];	
	
	//VALIDAÇÃO DE DADOS
	if ($nomeProduto == ''){
		echo json_encode(array( 'retorno' => '<font color=red><b>Nome do produto obrigat&oacuterio!</b></font>' ));
		exit;
	}
	
	//MONTAGEM DO COMANDO SQL 	
	$sql = "insert into produto(nomeProduto,idCategoria,preco,estoque)
            values('$nomeProduto','$idCategoria','$preco','$estoque')";

	mysql_query($sql) or die();
	echo json_encode(array( 'retorno' => 'Cadastro com sucesso!' ));
	

?>


