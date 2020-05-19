<?php
	include('../conexao.php');
		
	//Captura do "id"	
	$idCategoria = $_REQUEST[id];
	
	//Pesquisar a Categoria referente ao "id" passado pela JqGrid
	$rs = mysql_query("select * from categoria where idCategoria=$idCategoria");
	$reg = mysql_fetch_object($rs);
?>
<html>
<head>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
	<script>
		function editaCategoria(){
		$.ajax({
			type:"POST",
			url:"categoriaAction.php",
			dataType:"json",
			data:{acao:'editar',
			      idCategoria:$("#idCategoria").val(),
				  nomeCategoria:$("#txtNomeCategoria").val()},
			success: function(data, textStatus, request){
				$("#retorno").html(data['retorno']);
			}	
		  });
	    }
		
		function limpaDados(){
			$("#txtNomeCategoria").val("");
			$("#retorno").html("");
			$("#txtNomeCategoria").focus();
	    }
	</script>
	
</head>
<body>
	<form>
		<input hidden type="text" name="idCategoria" id="idCategoria" value="<?=$idCategoria?>">
		<table>
			<tr><td>Nome da Categoria</td>
				<td><input type='text' name='txtNomeCategoria' id='txtNomeCategoria'
						   value='<?=$reg->nomeCategoria?>'></td>
			</tr>
			<tr><td><input type="button" name="btnSalvar" id="btnSalvar" 
			               value="Salvar" onClick="editaCategoria()"></td>
						   
				<td><input type="button" value="Limpar" id="btnLimpar" 
				           onClick="limpaDados()"></td>
			</tr>	
 		</table>
		<div name="retorno" id="retorno"></div>
	</form>
</body>
</html>