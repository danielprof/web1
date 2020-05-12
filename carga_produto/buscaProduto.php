<?php 
	//LOCALHOST		
	$host   = "localhost";
	$login  = "root";
	$senha  = "jesus";
	$banco  = "web1";

	//CONECTANDO AO SERVIDOR
	$conexao = mysql_connect($host, $login, $senha)
	or die ( mysql_error() );

	//SELECIONA O BANCO DE DADOS
	$db = mysql_select_db($banco)
	or die ( mysql_error() );
	
	
	$sql = "select nomeProduto,preco,estoque from produto where nomeProduto like '%".$_REQUEST['nome']."%'";
	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	echo json_encode(array( 'nomeProduto' => $row['nomeProduto'],'preco' => $row['preco'],'estoque' => $row['estoque']));	
?>


