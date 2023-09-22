<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <title>Pedidos Logística Grupo MundialMix</title>
    <link rel="stylesheet" type="text/css"  href="_css/estilos.css" /> 
	<script src="_js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="_js/jquery.mask.min.js" type="text/javascript"></script>
	<script src="_js/funcselseqprod.js" type="text/javascript"></script>

</head>

<body>


<?php 

session_start(); 
$descprod = $_GET[valor];

require "bd.php"; 
require "verifica.php"; 

	echo "<table border='1' frame='void' id='agendinserte'>";
		echo "<th> SEQ_PRODUTO </th>";
		echo "<th> DESC_PRODUTO </th>";
		echo "<th> EMB </th>";
		echo "<th> QTD_ENB </th>";
	$sqlo = "select a.seqproduto, a.desccompleta, a.emb, a.qemb from  consinco.imp_pedcddescprod a where  a.desccompleta like UPPER(TRANSLATE('%".$descprod."%',' ','%')) order by 2,1";
	//echo $sqlo;
	$orareq1=oci_parse($conn,$sqlo);
			 oci_execute($orareq1);
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
					$seqprod = $r1['SEQPRODUTO'];
					$descprod = $r1['DESCCOMPLETA'];
					$embprod = $r1['EMB'];
					$qembprod = $r1['QEMB'];
					
					echo "<tr>";
						echo "<td id='nroreqcons' onclick='fselSeqprod(this.innerHTML)'> ".$seqprod." </td>";
						echo "<td id='tdescprod'> ".$descprod." </td>";
						echo "<td id='tembprod'> ".$embprod." </td>";
						echo "<td id='tqembprod'> ".$qembprod." </td>";
						echo "</tr>";
				}
	
	


?>		
</body>