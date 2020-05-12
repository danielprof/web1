<form action="produtoaction.php" method="get">

<?
include "conexao.php";
echo "Categoria<br>";
echo "<select name='idCategoria'>";
echo   "<option value=''>Selecione uma categoria</option>";
//Loop para preencher as opções do combo
$sql = "select idCategoria,nomeCategoria from categoria";
$rs = mysql_query($sql);  //objeto que armazena o Result Set da consulta
while ( $reg = mysql_fetch_object($rs) ){
	echo "<option value='$reg->idCategoria'>$reg->nomeCategoria</option>";
}	
echo "</select>";
?>

<input type="submit" value="Enviar">

</form>
