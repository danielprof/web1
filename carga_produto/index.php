<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastrando Produtos</title>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>

<script language="javascript">


	function buscaProduto(){
		$.ajax({
			type:"POST",
			url:"buscaProduto.php",
			dataType:"json",
			data:{nome:$("#txtNomeProduto").val()},
			success: function(data, textStatus, request){
				$("#txtNomeProduto").val(data['nomeProduto']);
				$("#txtPreco").val(data['preco']);
				$("#txtEstoque").val(data['estoque']);
			}	
		});
	}
	
	function adicionaLogradouro(){
		$.ajax({
			type:"POST",
			url:"adicionaProduto.php",
			dataType:"json",
			data:{nome:$("#txtNomeProduto").val(),
			      preco:$("#txtPreco").val(),
			      estoque:$("#txtEstoque").val()},
			success: function(data, textStatus, request){
				$("#retorno").html(data['retorno']);
			}	
		});
	}

</script>

</head>

<body>

<form>

<table width="422" border="0">
  <tr>
    <td colspan="2" align="center"><strong>Cadastro de Produto</strong></td>
  </tr>
  <tr>
    <td width="126">&nbsp;</td>
    <td width="286">&nbsp;</td>
  </tr>
  <tr>
    <td>Nome do Produto</td>
    <td><input type="text" name="txtNomeProduto" id="txtNomeProduto" />
    <input type="button" name="btnBuscar" id="btnBuscar" value="Buscar" onclick="buscaProduto();"/></td>
  </tr>
  <tr>
    <td>Preco</td>
    <td><input type="text" name="txtPreco" id="txtPreco" /></td>
  </tr>
  <tr>
    <td><label for="txtEstoque">Estoque</label></td>
    <td><input type="text" name="txtEstoque" id="txtEstoque" /></td>
  </tr>
  <tr>
	<td colspan="2" align="center" id="retorno" name="retorno">
	</td>
  </tr>
  
  <tr>
    <td colspan="2" align="center">
		<input type="reset" value="Limpar">
	    <input type="button" name="button" id="button" value="Cadastrar" onclick="adicionaProduto();" />
    </td>
  </tr>
</table>

</form>

</body>
</html>








