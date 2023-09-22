
<?php
session_start();
require "verifica.php";
require "bd.php"; 

$usuario = $_SESSION['pedcdusuario'];
$nropedido = $_SESSION['pedcdnropedido'];
if (empty($nropedido)){
	$nropedido = 0;
}

if ($nropedido == 0) {
	echo '<script type="text/JavaScript">alert( "Não é possível inserir um Pedido em branco! Primeiro Selecione o Setor e insira os itens desejados!" );location.href="pedinc.php"</script>';
}
else {
	$sqlo = "call consinco.imp_pedcdfinalped(".$nropedido.")";
	$orareq1=oci_parse($conn,$sqlo);
	$r1 =    oci_execute($orareq1);
	if ($r1 == 1){
		echo '<script type="text/JavaScript">alert( "Pedido gerado com sucesso!" );location.href="pedinc.php"</script>';
	}
	else {
		echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na inserção do Pedido. Tente novamente. Em caso de erro, Contate a TI!" )';
	}
}

?>	