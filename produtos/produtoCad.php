<?php
	include('conexao.php');
	$rs = mysql_query('select idCategoria,nomeCategoria from categoria');
?>
<html>
<head>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
	<script>
		function adicionaProduto(){
			$.ajax({
				type:"POST",
				url:"adicionaProduto.php",
				dataType:"json",
				data:{nomeProduto:$("#txtNomeProduto").val(),
					categoria:$("#cboCategoria").val(),
					preco:$("#txtPreco").val(),
				  	estoque:$("#txtEstoque").val() },
				success: function(data, textStatus, request){
					$("#retorno").html(data['retorno']);
				}	
			});
		}
	
		function limpaForm(){
				$("#retorno").html('');
				$("#txtNomeProduto").val('');
				$("#txtPreco").val('');
				$("#txtEstoque").val('');
				$("#txtNomeProduto").focus();
		}	
	
	</script>
	
</head>
<body>
	<center><h3>Cadastro de Produtos</h3></center>
	<hr>
	
	<form>
		<center>
		<table>
			<tr><td>Nome do Produto</td>
				<td><input type='text' name='txtNomeProduto' id='txtNomeProduto'></td>
			</tr>
			<tr><td>Categoria</td>
				<td>
					<select name='cboCategoria' id='cboCategoria'>
					<?
						while ($reg = mysql_fetch_object($rs)){
							echo "<option value=".$reg->idCategoria.">".
							                      $reg->nomeCategoria."</option>";
						}
					?>
					</select>
				</td>
			</tr>	
			<tr><td>Preço</td>
				<td><input type='text' name='txtPreco' id='txtPreco'></td>
			</tr>
			<tr><td>Estoque</td>
				<td><input type='text' name='txtEstoque' id='txtEstoque'></td>
			</tr>	
			<tr><td><input type="button" name="btnSalvar" id="btnSalvar" 
			               value="Salvar" onClick="adicionaProduto()"></td>
						   
				<td><input type="button" name="btnLimpar" id="btnLimpar"
						   value="Limpar" onClick="limpaForm()"></td>
			</tr>	
		</table>
		<div name="retorno" id="retorno"></div>
	</form>
</body>
</html>