<html>
<head>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
	<script>
		function adicionaCategoria(){
			$.ajax({
				type:"POST",
				url:"categoriaAction.php",
				dataType:"json",
				data:{acao:'inserir',
				  	  nomeCategoria:$("#txtNomeCategoria").val() },
				success: function(data, textStatus, request){
					$("#retorno").html(data['retorno']);
				}	
			});
		}
	
		function limpaForm(){
				$("#retorno").html('');
				$("#txtNomeCategoria").val('');
				$("#txtNomeCategoria").focus();
		}	
	
	</script>
	
</head>
<body>
	<center><h3>Cadastro de Categorias</h3></center>
	<hr>
	
	<form>
		<center>
		<table>
			<tr><td>Nome da Categoria</td>
				<td><input type='text' name='txtNomeCategoria' id='txtNomeCategoria'></td>
				
			<tr><td><input type="button" name="btnSalvar" id="btnSalvar" 
			               value="Salvar" onClick="adicionaCategoria()"></td>
						   
				<td><input type="button" name="btnLimpar" id="btnLimpar"
						   value="Limpar" onClick="limpaForm()"></td>
			</tr>	
		</table>
		<div name="retorno" id="retorno"></div>
	</form>
</body>
</html>