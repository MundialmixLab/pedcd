
<?php
session_start();
require "verifica.php";
require "bd.php"; 

$usuario = $_SESSION['pedcdusuario'];
$qtdpedidos = $_SESSION['pedcdqtdmanut'];
$contador = 1;

if (empty($_POST["idelreq"])) {
	$deletar = 'N';
}
else {
	$deletar = 'S';
}
//echo $deletar;
//die();
	
	while ($contador <= $qtdpedidos) {
		if (empty($_POST["".$contador.""])){
			
		}
		else {
				$pedidos = $_POST["s".$contador.""];
				$sqlo = "call consinco.imp_pedcdmanutcarga(".$pedidos.",'".$deletar."')";
				$orareq1=oci_parse($conn,$sqlo);
				$r1 =    oci_execute($orareq1);
				if ($r1 <> 1){
					unset($_SESSION['pedcdqtdmanut']);
					echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na Manutenção da Carga. Tente novamente. Em caso de erro, Contate a TI!" );location.href="manutreq.php"</script>';
				}
				else {
					if ($deletar == 'S') {
						unset($_SESSION['pedcdqtdmanut']);
						echo '<script type="text/JavaScript">alert( "Carga Deletada com Sucesso!" );location.href="manutreq.php"</script>';
					}
					else {
						unset($_SESSION['pedcdqtdmanut']);
						echo '<script type="text/JavaScript">alert( "Carga Finalizada com Sucesso" );location.href="manutreq.php"</script>';
					}
				}
		}
		$contador++;
	}

?>	