<!DOCTYPE html>
<html lang="en">
<head>
<title>Vendas</title>
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
	jQuery("#vendasGrid").jqGrid({
			url:'ajaxListarVendas.php',
			editurl:'modeloAction.php',
            datatype:'json',
            mtype:'GET',
            jsonReader:
				{'repeatitems':false},
            pager:'#vendasPagerGrid',
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
            sortname:'dataVenda',
            sortorder:'desc',
			caption: "Vendas",
            colModel:[
                {label:'Cód.',width:60,align:'center',name:'idVenda'},
				{label:'Data Venda',width:100,align:'center',name:'dataVenda'},
				{label:'Nome do Vendedor',width:200,align:'left',name:'nomeVendedor'},
				{label:'Nome do Cliente',width:200,align:'left',name:'nomeCliente'}
            ] 
        });
	jQuery("#vendasGrid").jqGrid('navGrid', '#vendasPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	//cadastro de venda
	$("#btnCadastrar").click(function(){
		window.location = "vendaCad.php";				   
	})
	
	//edição de categoria
	$("#btnEditar").click(function(){
	    //Captura a linha selecionada na Grid
		var linhaSelecionada = jQuery("#categoriasGrid").getGridParam('selrow');
		//Captura o ID na linha selecionada (célula da coluna 0 - zero)
		var id = jQuery("#categoriasGrid").getCell(linhaSelecionada,0);
		
		if(id != null){
			window.location = "categoriaEdit.php?id="+id;				
		}else{
		    alert("Selecione um registro");
		}	   
	})
	
	//exclusão de categoria
	$("#btnDeletar").click(function(){
	    //Captura a linha selecionada na Grid
		var linhaSelecionada = jQuery("#categoriasGrid").getGridParam('selrow');
		//Captura o ID na linha selecionada (célula da coluna 0 - zero)
		var id = jQuery("#categoriasGrid").getCell(linhaSelecionada,0);
		
		if(linhaSelecionada != null){
			
			if (confirm("Confirma a exclusão?") == true){
			
				$('#objetoQualquer').load('categoriaAction.php?acao=excluir&idCategoria='+id);

   			    jQuery("#categoriasGrid").jqGrid('setGridParam',{url:'ajaxListarCategorias.php?txtNomeCategoria=',page:1}).trigger('reloadGrid');
			}	
		}else{
			alert("Selecione um Registro");
		}			   
	})
	
	jQuery("#btnPesquisar").click(function(){
		var inicio = $('#txtInicio').val();
		var fim = $('#txtFim').val();
		var nomeCliente = $('#txtNomeCliente').val();	
		var nomeVendedor = $('#txtNomeVendedor').val();	
		
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarVendas.php?inicio='+inicio+'&fim='+fim+'&nomeCliente='+nomeCliente+'&nomeVendedor='+nomeVendedor ,page:1}).trigger('reloadGrid');	
	})
	
	jQuery("#btnLimpar").click(function(){	
		$('#txtPesquisar').val('');			
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarVendas.php' ,page:1}).trigger('reloadGrid');		
	})
});
</script>
</head>
<body>
<div>
    De <input type="text" id="txtInicio" name="txtInicio" value="2020-01-01 00:00:00"> 
	até <input type="text" id="txtFim" name="txtFim" value="2020-12-31 23:59:59">
	Cliente: <input type="text" id="txtNomeCliente" name="txtNomeCliente"/> 
	Vendedor: <input type="text" id="txtNomeVendedor" name="txtNomeVendedor"/> 
    <input type="button" id="btnPesquisar" value="Pesquisar"/>  
    <input type="button" id="btnLimpar" value="Limpar"/>       
</div>
<hr>
<div id="botoes" style="padding:4px 4px 4px 4px; color:#666; font-size:12px; font-weight:bold;">
    <input type="button" id="btnCadastrar" value="Cadastrar"/>
    <input type="button" id="btnEditar" value="Editar"/>
    <input type="button" id="btnDeletar" value="Deletar"/>
</div> 
<hr>
<table id="vendasGrid" ></table>
<div id="vendasPagerGrid"></div>
<div id="objetoQualquer"></div>
</body>
</html>





