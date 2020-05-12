<?
	
	include("conexao.php");

	//Capturada dados do formulario
	$acao = addslashes($_REQUEST['oper']);
	$id   = addslashes($_REQUEST['id']);	
	
	
	
	if($acao=="add"){
		
		$query = "INSERT...";
	
		$result = mysql_query($query);
		
		if($result==1){ 
			echo json_encode(array( 'sucesso'=>true ,'mensagem' => 'Cadastrado com Sucesso' ));	
		}else{
			echo json_encode(array( 'sucesso'=>false ,'mensagem' => 'Não foi possível Cadastrado, Tente mais tarde' ));	
		}
	}
	
	
	if($acao=="edit"){
		
		$query = "UPDATE...";
	
		$result = mysql_query($query);
		
		if($result==1){ 
			echo json_encode(array( 'sucesso'=>true ,'mensagem' => 'Deletado com Alterado' ));	
		}else{
			echo json_encode(array( 'sucesso'=>false ,'mensagem' => 'Não foi possível Alterado, Tente mais tarde' ));	
		}
		
	}	
	
	if($acao=="del"){
										
		$query = "DELETE FROM produtos WHERE idProduto = $id";
		
		$result = mysql_query($query);
		
		if($result==1){ 
			echo json_encode(array( 'sucesso'=>true ,'mensagem' => 'Deletado com Sucesso' ));	
		}else{
			echo json_encode(array( 'sucesso'=>false ,'mensagem' => 'Não foi possível Deletar, Tente mais tarde' ));	
		}
	}

?> 