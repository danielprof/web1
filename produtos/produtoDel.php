<?

	include("conexao.php");

	//Capturada dados do formulario
	$id   = $_REQUEST[id];
	
	$query = "DELETE FROM produto WHERE idProduto = $id";
	
	$result = mysql_query($query);
	
	if ($result == 1){
		echo "<script>alert('Exclusão realizada com sucesso!');</script>";
	}else{
		echo "<script>alert('Não foi possível excluir este produto, tente novamente mais tarde. Se o erro persistir contate o administrador do sistema!');</script>";
	}	

?> 