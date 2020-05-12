<?php 
	include('conexao.php');
	
	//CAPTURA OS DADOS DO FORMULÁRIO
	$idProduto   = $_REQUEST[idProduto];
	$nomeProduto = $_REQUEST[nomeProduto];
	$idCategoria = $_REQUEST[categoria];
	$preco 		 = $_REQUEST[preco];	
	$estoque     = $_REQUEST[estoque];	
	
	//VALIDAÇÃO DE DADOS
	if ($nomeProduto == ''){
		echo json_encode(array( 'retorno' => '<font color=red><b>Nome do produto obrigat&oacuterio!</b></font>' ));
		exit;
	}
	
	//MONTAGEM DO COMANDO SQL 	
	$sql = "update produto set nomeProduto = '$nomeProduto',
                   idCategoria = '$idCategoria',
                   preco       = '$preco',
                   estoque     = '$estoque'
            where idProduto = $idProduto";
	
	mysql_query($sql) or die();
	echo json_encode(array( 'retorno' => 'Alterado com sucesso!' ));
	

?>


