<?

	include("conexao.php");

	//Capturada dados do formulario
	$id   = $_REQUEST[id];
	
	$query = "DELETE FROM produto WHERE idProduto = $id";
	
	$result = mysql_query($query);
	
	if ($result == 1){
		echo "<script>alert('Exclus�o realizada com sucesso!');</script>";
	}else{
		echo "<script>alert('N�o foi poss�vel excluir este produto, tente novamente mais tarde. Se o erro persistir contate o administrador do sistema!');</script>";
	}	

?> 