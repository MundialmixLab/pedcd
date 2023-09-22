<?php 

session_start(); 
$tudo = $_GET[valor];
$ar = explode('|', $tudo);
$seqprod = $ar[0];
$qsol = $ar[1];
$embqsol = $ar[2];


require "bd.php"; 
require "verifica.php"; 


	$sqlo = "select case when ((a.estqdeposito-a.qtdreservadavda)-(".$qsol."*".$embqsol.")) < 0 then round((a.estqdeposito-a.qtdreservadavda)/".$embqsol.",2) else  round(((".$qsol."*".$embqsol.")/".$embqsol."),2) end qatend  from consinco.mrl_produtoempresa a where a.seqproduto = ".$seqprod." and a.nroempresa = 990";
	$orareq1=oci_parse($conn,$sqlo);
			 oci_execute($orareq1);
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
					$qatendida = $r1['QATEND'];
				}
	if (empty($qatendida)) {
		$qatendida = "T";
		echo $qatendida;
	}
	else {
		echo $qatendida;
	}
	


?>		