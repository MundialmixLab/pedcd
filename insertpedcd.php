<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<link rel="stylesheet" type="text/css"  href="_css/estilos.css" /> 
</head>
<body>
<?php
session_start();
require "verifica.php";
require "bd.php"; 

$usuario = $_SESSION['pedcdusuario'];
$nropedido = $_SESSION['pedcdnropedido'];
if (empty($nropedido)){
	$nropedido = 0;
}

$tudo = $_GET[valor];
$ar = explode('|', $tudo);
$setor = $ar[0];
$seqprod = $ar[1];
$qtdemb = $ar[2];
$qtdatend = $ar[3];


	$sqlo = "call consinco.imp_pedcdtemppedido('".$setor."',".$seqprod.",".$qtdemb.",".$qtdatend.",".$nropedido.",'".$usuario."')";
	$orareq1=oci_parse($conn,$sqlo);
	$r1 =    oci_execute($orareq1);
	if ($r1 == 1){
		$sucesso = 1;
		$sqlo = "select max(a.seqpedido) seqpedido from consinco.imp_pedcd_temprequisicao a where a.userinc = '".$usuario."'";
		
		$orareq1=oci_parse($conn,$sqlo);
		oci_execute($orareq1);
			while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
					$_SESSION['pedcdnropedido']  = $r1['SEQPEDIDO'];
					$nropedido = $r1['SEQPEDIDO'];
			}
		echo "<table border='1' frame='void' id='agendinserte'>";
			echo "<tr>";
			echo "<th colspan='5'> Nro Pedido Temporário : ".$nropedido." </th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th> COD_PRODUTO </th>";
			echo "<th> DESC_PRODUTO </th>";
			echo "<th> QTDE_ATEND </th>";
			echo "<th colspan='2'> EMB </th>";
			echo "</tr>";
		$sqlo = "select a.seqproduto,substr(b.desccompleta,1,50) as descprod,sum(a.qtde) qtde,c.embalagem, a.embalagem embp from consinco.imp_pedcd_temprequisicao a, consinco.map_produto b, consinco.map_famembalagem c where a.userinc = '".$usuario."' and a.seqpedido = ".$nropedido." and a.seqproduto = b.seqproduto and b.seqfamilia = c.seqfamilia and a.embalagem = c.qtdembalagem group by a.seqproduto,substr(b.desccompleta,1,50),qtde,c.embalagem, a.embalagem";
		$orareq1=oci_parse($conn,$sqlo);
		oci_execute($orareq1);
			while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) {
				$rseqprod  = $r1['SEQPRODUTO'];
				$rdescprod  = $r1['DESCPROD'];
				$rqtdeate  = $r1['QTDE'];
				$rdescembf  = $r1['EMBALAGEM'];
				$rqtdembp  = $r1['EMBP'];
				
				echo "<tr>";
						echo "<td> ".$rseqprod." </td>";
						echo "<td id='tdescprod'> ".$rdescprod." </td>";
						echo "<td> ".$rqtdeate." </td>";
						echo "<td> ".$rdescembf." </td>";
						echo "<td> ".$rqtdembp." </td>";
				echo "</tr>";
			}
		
	}
	else {
		$sucesso = 990;
		echo $sucesso;
	}
	?>
</table>
</body>
</html> 	