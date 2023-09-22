
<?php
session_start();
require "verifica.php";
require "bd.php"; 

$usuario = $_SESSION['pedcdusuario'];
$qtdpedidos = $_SESSION['pedcdqtdped'];
$contador = 1;
$nrcargatemp = rand();
	
	while ($contador <= $qtdpedidos) {
		if (empty($_POST["".$contador.""])){
			
		}
		else {
				$pedidos = $_POST["s".$contador.""];
				$sqlo = "call consinco.imp_pedcdgeracargatemp('".$usuario."',".$nrcargatemp.",".$pedidos.")";
				$orareq1=oci_parse($conn,$sqlo);
				$r1 =    oci_execute($orareq1);
				if ($r1 <> 1){
					echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na inserção da Carga. Tente novamente. Em caso de erro, Contate a TI!" );location.href="pedseparacao.php"</script>';
				}
		}
		$contador++;
	}
	//echo $sqlo ;
	
	$sqlo = "call consinco.imp_pedcdgeracarga('".$usuario."',".$nrcargatemp.")";
	//echo $sqlo ;
	
	$orareq1=oci_parse($conn,$sqlo);
	$r1 =    oci_execute($orareq1);
	if ($r1 <> 1){
		echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na inserção da Carga. Tente novamente. Em caso de erro, Contate a TI!" );location.href="pedseparacao.php"</script>';
	}
	else {
		$sqlo = "select max(r.nrocarga) NRCARGATEMP from  consinco.imp_pedcd_cargareq r where r.nrocargatemp = ".$nrcargatemp."";
		$orareq1=oci_parse($conn,$sqlo);
		oci_execute($orareq1);
			while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
					$nrcargaoficial = $r1['NRCARGATEMP'];
			}
		echo '<script type="text/JavaScript">alert( "Carga '.$nrcargaoficial.' gerada com sucesso!" );location.href="relseparacao2.php?valor='.$nrcargaoficial.'"</script>';
	}
    
?>	