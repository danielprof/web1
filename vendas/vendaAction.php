<?php 
	include('../conexao.php');
	
	//Identifica a Ação a ser executada
	$acao = $_REQUEST[acao];

    //-- INSERIR --
	if ($acao == "inserir"){
	   //CAPTURA OS DADOS DO FORMULÁRIO
	   $nomeCategoria = $_REQUEST[nomeCategoria];
	
   	   //VALIDAÇÃO DE DADOS
	   if ($nomeCategoria == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Nome da categoria obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "insert into categoria(nomeCategoria)
               values('$nomeCategoria')";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Cadastro com sucesso!</font>'));
	}
	
	//-- EDITAR --
	if ($acao == "editar"){
	   //CAPTURA OS DADOS DO FORMULÁRIO
	   $idCategoria = $_REQUEST[idCategoria];
	   $nomeCategoria = $_REQUEST[nomeCategoria];
	
   	   //VALIDAÇÃO DE DADOS
	   if ($nomeCategoria == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Nome da categoria obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "update categoria set nomeCategoria = '$nomeCategoria'
	           where idCategoria = $idCategoria";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Altera&ccedil;&atilde;o com sucesso!</font>'));
	}
	
	//-- EXCLUIR --
	if ($acao == "excluir"){
	   //CAPTURA OS DADOS DO FORMULÁRIO
	   $idCategoria = $_REQUEST[idCategoria];
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "delete from categoria where idCategoria = $idCategoria";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Categoria exclu&iacute;da com sucesso!</font>'));
	}
?>


