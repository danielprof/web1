<?php

	//LOCALHOST
		
	$host   = "localhost";
	$login  = "root";
	$senha  = "jesus";
	$banco  = "unisys";

	//CONECTANDO AO SERVIDOR
	$conexao = mysql_connect($host, $login, $senha)
	or die ("<script>
				 alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
			 </script>");

	//SELECIONA O BANCO DE DADOS
	$db = mysql_select_db($banco)
	or die ("<script>
				 alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
			 </script>");
?>