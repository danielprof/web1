<?php 

	//LOCALHOST		
	$host   = "localhost";
	$login  = "root";
	$senha  = "jesus";
	$banco  = "unisys";

	//CONECTANDO AO SERVIDOR
	$conexao = mysql_connect($host, $login, $senha)
	or die ( mysql_error() );

	//SELECIONA O BANCO DE DADOS
	$db = mysql_select_db($banco)
	or die ( mysql_error() );

	ini_set("max_execution_time",100000);
	ini_set("memory_limit","100M");
    set_time_limit(0);
	
	$arquivo_csv = "cargas/produto.csv";
	
	if(file_exists($arquivo_csv)){
								
		//ABRE O ARQUIVO COM 'r' SOMENTE LEITURA
		//COLOCA O PONTEIRO DO ARQUIVO NO COMECO DO ARQUIVO
		$abre = fopen($arquivo_csv, "r");
			
		//LER ARQUIVO
		$informacao = trim(fread($abre, filesize($arquivo_csv)));
			
		//FECHA ARQUIVO
		fclose($abre);	
			
		//EXPLODE AS LINHAS QUANDO SALTAR UMA LINHA "\n"
		$linha = explode("\n", $informacao);	
		
		$count = 0;
		
		//PERCORREMOS CADA LINHA DO ARQUIVO
		$arquivo = fopen($arquivo_csv, "r");
		
		while ($linha_arquivo = fgets($arquivo)) {
			
			$linha = explode(";",$linha_arquivo);
						
			$sql = "insert into produto (nomeProduto,idCategoria,preco,estoque) 
			        values ('".addslashes(trim($linha[0]))."',".addslashes(trim($linha[1])).",".addslashes(trim($linha[2])).",".addslashes(trim($linha[3])).")";
			echo $sql;
			echo "</br>";
			mysql_query($sql);
			
		}
		fclose($arquivo);
		
		echo "<script>
					  alert('Arquivo importado com sucesso');
				  </script>";
		
		
	}else{
		echo "<script>
					  alert('Arquivo não existente');
				  </script>";
	}				
	
?>