<?php
error_reporting(E_ALL ^ E_NOTICE);
  
  		
		$dbconexao[0]='consulta';
		$dbconexao[1]='cons4lt4';
		$dbconexao[2]='(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=tns.grupomundialmix.com.br)(PORT=1521)))(CONNECT_DATA=(SERVICE_NAME=dborcl)))';
		
	    $conn=oci_connect($dbconexao[0],$dbconexao[1],$dbconexao[2]);
		
		
		
	
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>