<?php

	include('../conexao.php');
	
	$page  = $_GET['page']; 
	$limit = $_GET['rows']; 
	$sidx  = $_GET['sidx']; 
	$sord  = $_GET['sord']; 		
	
	
	$where = " WHERE 1 = 1 ";
	
	if( $_GET['txtNomeCategoria'] != "" ){	 	
		$where .= " AND NomeCategoria like '%".$_GET['txtNomeCategoria']."%' ";		
	}
	
	$queryCount = "SELECT COUNT(idCategoria) as count
			  	   FROM categoria 
 			       $where";
				 
	$resultSetCount = mysql_query($queryCount);			 
				 
	$rowCount = mysql_fetch_array($resultSetCount);
	$count = $rowCount['count'];
	
	if( $count>0 ){
		$total_pages = ceil($count/$limit);	
	}else{
		$total_pages = 0;
	}
	
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	
    $query = "SELECT idCategoria,
					 nomeCategoria
			  FROM categoria
			  $where
			  ORDER BY $sidx $sord 
			  LIMIT $start , $limit";				 
					
    $resultSet = mysql_query($query);
	
	$response->page = $page;
	$response->total = $total_pages;
	$response->records = $count;
	$i=0;
	
	while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idCategoria']=$row['idCategoria'];
			$response->rows[$i]['nomeCategoria']=$row['nomeCategoria'];
			$i++;
				
	}
	
	echo json_encode($response);

?>