<?php
	//LOCALHOST
	$host   = "localhost";
	$login  = "root";
	$senha  = "jesus";
	$banco  = "web1";

	//CONECTANDO AO SERVIDOR
	$conexao = mysql_connect($host, $login, $senha)
	or die ("<script>
				 alert('[Erro] - Problemas no servidor do banco!');
			 </script>");

	//SELECIONA O BANCO DE DADOS
	$db = mysql_select_db($banco)
	or die ("<script>
				 alert('[Erro] - Problema ao acessar o banco $banco!');
			 </script>");
?>
