<?php
	include('conexao.php');
	$rs = mysql_query('select idCategoria,nomeCategoria from categoria');
		
	//Captura do "id"	
	$idProduto = $_REQUEST[id];
	
	//Pesquisar o Produto referente ao "id" passado pela JGrid
	$rs1 = mysql_query("select * from produto where idProduto=$idProduto");
	$reg1 = mysql_fetch_object($rs1);
?>
<html>
<head>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
	<script>
		function editaProduto(){
		$.ajax({
			type:"POST",
			url:"editaProduto.php",
			dataType:"json",
			data:{idProduto:$("#idProduto").val(),
				  nomeProduto:$("#txtNomeProduto").val(),
			      categoria:$("#cboCategoria").val(),
			      preco:$("#txtPreco").val(),
				  estoque:$("#txtEstoque").val() },
			success: function(data, textStatus, request){
				$("#retorno").html(data['retorno']);
			}	
		});
	}
	</script>
	
</head>
<body>
	<form>
		<input hidden type="text" name="idProduto" id="idProduto" value="<?=$idProduto?>">
		<table>
			<tr><td>Nome do Produto</td>
				<td><input type='text' name='txtNomeProduto' id='txtNomeProduto'
						   value='<?=$reg1->nomeProduto?>'></td>
			</tr>
			<tr><td>Categoria</td>
				<td>
					<select name='cboCategoria' id='cboCategoria'>
					<?
						while ($reg = mysql_fetch_object($rs)){
						
							if ($reg->idCategoria == $reg1->idCategoria){
								echo "<option selected value=".$reg->idCategoria.">".
													 $reg->nomeCategoria."</option>";						
							}
							else{
								echo "<option value=".$reg->idCategoria.">".
							                      $reg->nomeCategoria."</option>";
							}	
						 /*
						 echo "<option " . (($reg->idCategoria==$reg1->idCategoria)?"selected":"") .
						          "value=".$reg->idCategoria.">".
								   		   $reg->nomeCategoria."</option>";
						 */	
						}
					?>
					</select>
				</td>
			</tr>	
			<tr><td>Preço</td>
				<td><input type='text' name='txtPreco' id='txtPreco'
						   value='<?=$reg1->preco?>'></td>
			</tr>
			<tr><td>Estoque</td>
				<td><input type='text' name='txtEstoque' id='txtEstoque'
						   value='<?=$reg1->estoque?>'></td>
			</tr>	
			<tr><td><input type="button" name="btnSalvar" id="btnSalvar" 
			               value="Salvar" onClick="editaProduto()"></td>
						   
				<td><input type="reset" value="Limpar"></td>
			</tr>	
 		</table>
		<div name="retorno" id="retorno"></div>
	</form>
</body>
</html>