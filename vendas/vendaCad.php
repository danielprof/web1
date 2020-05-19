<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro da Venda</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>  

<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="../js/jquery-ui-1.8.17.custom/css/smoothness/jquery-ui-1.8.17.custom.css">
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script> 
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script> 

<script type="text/javascript" src="../js/jquery.form.js"></script>

<script src="../js/jquery.jqGrid-3.8.2/js/i18n/grid.locale-pt-br.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<link href="../js/jquery.jqGrid-3.8.2/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>


<script>
$(function() {

	jQuery("#itemGrid").jqGrid({
			url:'ajaxListarItem.php',
			editurl:'modeloAction.php',
            datatype:'json',
            mtype:'GET',
            jsonReader:
				{'repeatitems':false},
            pager:'#itemPagerGrid',
            rowNum:10,
            rowList:
				[10,20,30,40,50,60,70,80,90,100],
            sortable:true,
            viewrecords:true,
            gridview:true,
            autowidth:true,
            height:370,
            shrinkToFit:true,
            forceFit:true,
            hidegrid:false,
            sortname:'nomeProduto',
            sortorder:'asc',
			caption: "Item",
            colModel:[
                {label:'Cód.',width:60,align:'center',name:'idItemVenda'},
				{label:'Nome do Produto',width:200,align:'left',name:'nomeProduto'},
				{label:'Quant.',width:300,align:'right',name:'quant'},
				{label:'Preço Unit.',width:200,align:'right',name:'precoVenda'},
				{label:'Desconto',width:200,align:'right',name:'desconto'},
				{label:'Total',width:200,align:'right',name:'total'}
            ] 
        });
		
	jQuery("#itemGrid").jqGrid('navGrid', '#itemPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	jQuery("#btnAdicionar").click(function(){
	
		//Captura os dados do fomulário
		var idVenda = $("#idVenda").val();
		var idProduto = $("#cboProduto").val();
		var quant = $("#txtQuant").val();
		var precoVenda = $("#txtPrecoVenda").val();
		var desconto = $("#txtDesconto").val();
		
		//Gravação do Item	
		gravaItem(idVenda,idProduto,quant,precoVenda,desconto);
	
		//Limpa Item
		limpaItem();
		
		//Atualiza o display do Total
		atualizaTotal(idVenda);
		
	})

	function atualizaTotal(idVenda){
		$.ajax({
			type:"POST",
			url:"vendaAction.php?acao=totalVenda&idVenda="+idVenda,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#Total").html(data['total']);	
			}	
		});
	}
	
	function gravaItem(idVenda,idProduto,quant,precoVenda,desconto){
		$.ajax({
			type:"POST",
			url:"vendaAction.php?acao=gravaItem&idVenda="+idVenda+"&idProduto="+idProduto+"&quant="+quant+"&precoVenda="+precoVenda+"&desconto="+desconto,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				var idVenda = $('#idVenda').val();	
				jQuery("#itemGrid").jqGrid('setGridParam',{url:'ajaxListarItem.php?idVenda='+idVenda ,page:1}).trigger('reloadGrid');
					
			}	
		});
	}

	function limpaItem(){
		$("#cboProduto").val(0);  
		$("#txtQuant").val(1);
		$("#txtPrecoVenda").val(0);
		$("#txtDesconto").val(0);
		$("#txtTotal").val(0);
		$("#cboProduto").focus();
	}
	
	$("#btnTeste").click(function(){
		var linha = jQuery("#itemGrid").getGridParam('selrow');
		var conteudo = jQuery("#itemGrid").getCell(linha,1);
		$("#txtTeste").val(conteudo);
		
		//Destravar o btnSalvar
		$("#btnSalvar").removeAttr('disabled');
		
	})
	
	function deletaItem(idVenda,idItemVenda){
		$.ajax({
			type:"POST",
			url:"vendaAction.php?acao=deletaItem&idVenda="+idVenda+"&idItemVenda="+idItemVenda,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
			    var retorno = data['retorno'];
				refreshGrid(retorno);
			}	
		});
	}
	
	function refreshGrid(retorno){
		if (retorno > 0){
			var idVenda = $('#idVenda').val();	
			jQuery("#itemGrid").jqGrid('setGridParam',{url:'ajaxListarItem.php?idVenda='+idVenda ,page:1}).trigger('reloadGrid');
		}else{
			jQuery("#itemGrid").jqGrid('setGridParam',{url:'ajaxListarItemVazio.php' ,page:1}).trigger('reloadGrid');
		}
	}	
	
		
	$("#btnRemover").click(function(){
	
		var linhaSelecionada = jQuery("#itemGrid").getGridParam('selrow');
		
		var idItemVenda = jQuery("#itemGrid").getCell(linhaSelecionada,0);
		
		var idVenda = $("#idVenda").val();
		
		if(linhaSelecionada != null){
			
			if (confirm("Confirma a exclusão?") == true){
			
				deletaItem(idVenda,idItemVenda);
				
				atualizaTotal(idVenda);
			}
			
		}else{
			alert("Selecione um Registro");
		}			   
	})
	
	
	jQuery("#btnPesquisar").click(function(){
		var txtNome = $('#txtNomeCliente').val();	
		
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarVendas.php?txtNomeCliente='+txtNome ,page:1}).trigger('reloadGrid');
		
	})
	
	jQuery('#cboProduto').change(function(){
		//Captura o ID no combo
		var id = $('#cboProduto').val();
		//Chama a função que irá retornar o Preço do produto
		buscaPreco(id);
	})
	
	function buscaPreco(idProduto){
		$.ajax({
			type:"POST",
			url:"vendaAction.php?acao=buscarPreco&id="+idProduto,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#txtPrecoVenda").val(data['preco']);	
			}	
		});
	}
	
	function CalcTotal(){
		quant = $("#txtQuant").val();
		preco = $("#txtPrecoVenda").val();
		desconto = $("#txtDesconto").val();
		
		total = quant * preco - desconto;
		
		$("#txtTotal").val(total);
	}
	
	jQuery("#txtQuant").blur(function(){
		CalcTotal();
	})
	
	jQuery("#txtDesconto").blur(function(){
		CalcTotal();
	})
	
	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeProduto').val('');			
		jQuery("#produtosGrid").jqGrid('setGridParam',{url:'ajaxListarProdutos.php' ,page:1}).trigger('reloadGrid');		
	})
	
	jQuery("#btnSalvar").click(function(){
		//Captura do idCliente e idVendedor selecionados nos combos
		var idCliente = $("#cboCliente").val();
		var idVendedor = $("#cboVendedor").val();
		//Validação de dados
		if (idCliente == '0'){
			alert("Cliente não foi selecionado");
			$("#cboCliente").focus();
			exit;
		}
		if (idVendedor == '0'){
			alert("Vendedor não foi selecionado");
			$("#cboVendedor").focus();
			exit;
		}
		//Gravação da venda
		GravaVenda(idCliente,idVendedor);
		
		alert($("#idVenda").val());
		
		//Desabilitar o botão btnSalvar
		$("#btnSalvar").attr("disabled","disabled");
		
		//Habilitar o botão btnCancelar
		$("#btnCancelar").removeAttr("disabled");

		//Colocar o foco no cboProduto
		$("#cboProduto").focus();
		
	})
	
	function GravaVenda(idCliente,idVendedor){
		$.ajax({
			type:"POST",
			url:"vendaAction.php?acao=gravaVenda&idCliente="+idCliente+"&idVendedor="+idVendedor,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#idVenda").val(data['idVenda']);	
			}	
		});
	}
	
	$("#btnCancelar").click(function(){
		if(confirm("Confirma cancelamento desta venda?")){
			$.ajax({
				type:"POST",
				url:"vendaAction.php?acao=deletaVenda&idVenda="+$("#idVenda").val(),
				dataType:"json",
				data:{},
				success: function(data, textStatus, request){
						refreshVenda(data['retorno']);
				}	
			}); //Fim do Ajax
		} //Fim do If
	})//Fim do evento click

	function refreshVenda(retorno){
		if (retorno == 1){
			alert("Venda cancelada!");
			limpaItem();
			refreshGrid();
			$("#cboCliente").val(0);
			$("#cboVendedor").val(0);
			$("#cboCliente").focus();
			$("#btnSalvar").removeAttr("disabled");
			$("#btnCancelar").attr("disabled","disabled");
			$("#Total").html("");
		}else{
			alert("Não foi possível cancelar esta venda!");
		}
	}
	
});
</script>

<?php
include("../conexao.php");
?>

</head>
<body>
<table id="venda">
	<tr><td><input type="hidden" id="idVenda"></td></tr>
	
	<tr><td><input type="hidden" id="txtTeste"></td></tr>
	
	<tr><td>Nome do Cliente</td>
		<td>Nome do Vendedor</td>
		<td><input type="button" id="btnSalvar" value="Salvar"></td>
		<td><div id="Total"></td>
	</tr>
	
	<tr><td><select id="cboCliente">
				<option value="0"><-Selecione o cliente-></option>
				<?
					$sql="select idCliente,nomeCliente 
					      from cliente
						  order by nomeCliente";
					$rs=mysql_query($sql);
					while ($reg = mysql_fetch_object($rs)){
						echo "<option value=".$reg->idCliente.">".
						                      $reg->nomeCliente."</option>";
					}
				?>
			</select></td>
		<td><select id="cboVendedor">
				<option value="0"><-Selecione o vendedor-></option>
				<?
					$sql="select idVendedor,nomeVendedor
					      from vendedor
						  order by nomeVendedor";
					$rs=mysql_query($sql);
					while ($reg = mysql_fetch_object($rs)){
						echo "<option value=".$reg->idVendedor.">".
						                      $reg->nomeVendedor."</option>";
					}
				?>
			</select></td>
		<td><input type="button" id="btnCancelar" value="Cancelar" disabled></td>
	</tr>	
</table>

<hr>

<table id="itemVenda" border="1">
	<tr><td>Nome do Produto</td>
		<td>Quant.</td>
		<td>Preço Unit.</td>
		<td>Desconto</td>
		<td>Total</td>
	</tr>
	<tr><td><select id="cboProduto">
				<option value="0"><-Selecione o produto-></option>
				<?
					$sql="select idProduto,nomeProduto
					      from produto
						  order by nomeProduto";
					$rs=mysql_query($sql);
					while ($reg = mysql_fetch_object($rs)){
						echo "<option value=".$reg->idProduto.">".
						                      $reg->nomeProduto."</option>";
					}
				?>
			</select></td>
		<td><input type="text" id="txtQuant" value="1">
		<td><input type="text" id="txtPrecoVenda" value="0.00">
		<td><input type="text" id="txtDesconto" value="0.00">
		<td><input type="text" id="txtTotal" value="0.00">
		
		<td><input type="button" id="btnAdicionar" value="+">
		<td><input type="button" id="btnRemover" value="-">
		<!--<td><input type="button" id="btnTeste" value="Teste">-->
	</tr>	
</table>

<hr>

<table id="itemGrid" ></table>
<div id="itemPagerGrid"></div>
<div id="objetoQualquer"></div>
</body>
</html>





