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
	
	//CAPTURA OS DADOS DO FORMULÁRIO
	$cep = $_REQUEST[cep];
	$tipo = $_REQUEST[tipo];
	$logradouro = $_REQUEST[logradouro];	
	$bairro = $_REQUEST[bairro];	
	$cidade = $_REQUEST[cidade];	
	$uf = $_REQUEST[uf];
	
	//VALIDAÇÃO DE DADOS
	if ($cep == ''){
		echo json_encode(array( 'retorno' => '<font color=red><b>Cep obrigatorio!</b></font>' ));
		exit;
	}
	
	if ($logradouro == ''){
		echo json_encode(array( 'retorno' => 'Logradouro obrigatorio!' ));
		exit;
	}
	
	//MONTAGEM DO COMANDO SQL 	
	$sql = "insert into logradouro(cep,tipo,logradouro,bairro,cidade,uf)
            values('$cep','$tipo','$logradouro','$bairro','$cidade','$uf')";

	mysql_query($sql) or die();
	echo json_encode(array( 'retorno' => 'Cadastro com sucesso!' ));
	

?>


