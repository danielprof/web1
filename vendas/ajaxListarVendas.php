<?php

	include('../conexao.php');
	
	$page  = $_GET['page']; 
	$limit = $_GET['rows']; 
	$sidx  = $_GET['sidx']; 
	$sord  = $_GET['sord']; 		
	
	//Captura dos parâmetros passados na chamada GET
	$inicio = $_GET['inicio'];
	$fim = $_GET['fim'];
	$nomeCliente = $_GET['nomeCliente'];
	$nomeVendedor = $_GET['nomeVendedor'];
	
	$where = " WHERE dataVenda BETWEEN '$inicio' AND '$fim' ";
	
	if( $nomeCliente != "" ){	 	
		$where .= " AND nomeCliente LIKE '%".$nomeCliente."%' ";		
	}

	if( $nomeVendedor != "" ){	 	
		$where .= " AND nomeVendedor LIKE '%".$nomeVendedor."%' ";		
	}
	
	$queryCount = "SELECT count(*) total
			       FROM venda
			          INNER JOIN cliente ON venda.idCliente = cliente.idCliente 
					  INNER JOIN vendedor ON venda.idVendedor = vendedor.idVendedor
 			       $where";
				 
	$resultSetCount = mysql_query($queryCount);			 
				 
	$rowCount = mysql_fetch_array($resultSetCount);
	$count = $rowCount['total'];
	
	if( $count>0 ){
		$total_pages = ceil($count/$limit);	
	}else{
		$total_pages = 0;
	}
	
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	
	
    $query = "SELECT idVenda, nomeCliente, nomeVendedor, dataVenda
			  FROM venda
			          INNER JOIN cliente ON venda.idCliente = cliente.idCliente 
					  INNER JOIN vendedor ON venda.idVendedor = vendedor.idVendedor
			  $where
			  ORDER BY $sidx $sord 
			  LIMIT $start , $limit";				 
	
    $resultSet = mysql_query($query);
	
	$response->page = $page;
	$response->total = $total_pages;
	$response->records = $count;
	$i=0;
	
	while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idVenda']=$row['idVenda'];
			$response->rows[$i]['nomeCliente']=$row['nomeCliente'];
			$response->rows[$i]['nomeVendedor']=$row['nomeVendedor'];
			$response->rows[$i]['dataVenda']=$row['dataVenda'];

			$i++;
				
	}
	
	echo json_encode($response);

?>