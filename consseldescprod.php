<?php 

session_start(); 
$seqprod = $_GET[valor];

require "bd.php"; 
require "verifica.php"; 


	$sqlo = "select a.seqproduto, a.desccompleta, a.emb, a.qemb from  consinco.imp_pedcddescprod a where a.seqproduto = ".$seqprod."";
	//echo $sqlo;
	$orareq1=oci_parse($conn,$sqlo);
			 oci_execute($orareq1);
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
					$seqprod = $r1['SEQPRODUTO'];
					$descprod = $r1['DESCCOMPLETA'];
					$embprod = $r1['EMB'];
					$qembprod = $r1['QEMB'];
				}
	if (empty($descprod)) {
		$arproduto = 0;
		echo $arproduto;
	}
	else {
		$arproduto =  $descprod;
		$arproduto =  $seqprod.'|'.$descprod.'|'.$embprod.'|'.$qembprod;
		echo $arproduto;
	}
	


?>		