<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <title>Pedidos Logística Grupo MundialMix</title>
    <link rel="stylesheet" type="text/css"  href="_css/estilos.css" /> 
	<script src="_js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="_js/jquery.mask.min.js" type="text/javascript"></script>
	<script src="_js/funcs.js" type="text/javascript"></script>
	<script src="_js/funcsestq.js" type="text/javascript"></script>
	<script src="_js/funcsinsertprod.js" type="text/javascript"></script>
	<script src="_js/funcbuscareq.js" type="text/javascript"></script>
	<script src="_js/funcconsreq.js" type="text/javascript"></script>
	<script src="_js/imprime.js" type="text/javascript"></script>
	<LINK REL="stylesheet" TYPE="text/css" MEDIA="print, handheld" HREF="_css/print.css">
	<script language="javascript">
		function confirma(valor){
			if (confirm('Tem certeza que deseja sair?'))
				self.location.href='sair.php';
			else	
				location.href="menu.php";
		}
		
		function setFocus() {
			document.getElementById("box").focus(); 
		}

function so_nro(e,args)
{			
if (document.all){
	var evt=event.keyCode;
}
else {
	var evt = e.charCode;
}
var valid_chars = '0123456789';
var chr= String.fromCharCode(evt);
//alert(evt); 
//alert(chr);
//alert(valid_chars.indexOf(chr));

if (valid_chars.indexOf(chr)>-1 ){
return true;
}
if (evt < 9){return true;}

return false;

}

function so_nro2(e,args)
{			
if (document.all){
	var evt=event.keyCode;
}
else {
	var evt = e.charCode;
}
var valid_chars = '0123456789';
var chr= String.fromCharCode(evt);
//alert(evt); 
//alert(chr);
//alert(valid_chars.indexOf(chr));
var key = e.which ; 
if (valid_chars.indexOf(chr)>-1 ){
	//document.getElementById('qtdsol').focus();
    return true;
}
if (key === 8) {
	return true;
}
if (key === 13 ){
	//alert(key);
		document.getElementById('binsertprod').focus();
		return false;
	}
if (evt < 9) {
	return true;
}

return false;


}

function so_enter(e,args)
{			
if (document.all){
	var evt=event.keyCode;
}
else {
	var evt = e.charCode;
}
if(evt === 0) {
			document.getElementById('seqprod').focus();
}

}


	</script>
	
	<script type="text/JavaScript">
		
		
		function sem_acento(e,args)
{		
	if (document.all){var evt=event.keyCode;} // caso seja IE
	else{var evt = e.charCode;}	// do contrário deve ser Mozilla
	var valid_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_ '+args;	// criando a lista de teclas permitidas
	var chr= String.fromCharCode(evt);	// pegando a tecla digitada
	//alert(evt);
	//alert(valid_chars.indexOf(chr));
	if (valid_chars.indexOf(chr)>-1 ){return true;}	// se a tecla estiver na lista de permissão permite-a
	// para permitir teclas como <BACKSPACE> adicionamos uma permissão para 
	// códigos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
	if (evt < 9 ){return true;}
	if (evt == 32){return true;}	// se a tecla estiver na lista de permissão permite-a
	return false;	// do contrário nega
}


	</script>	

</head>

<body >


	<?php
	session_start();
	require "verifica.php"; 
	unset($_SESSION['pedcdqtdped']);
	session_destroy($_SESSION['pedcdqtdped']);
	
	$vstatusreq = $_GET[valor];
	
	$usuario = $_SESSION['pedcdusuario'];

	?>
				<?php
				require "bd.php"; 
				//echo $vstatusreq;
				if ($vstatusreq == "1") {
					$sqlo = "select b.descsetor, a.seqpedido nroreq, count(a.seqproduto) SKU, a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy') dtainc,case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end STATUS from consinco.imp_pedcd_temprequisicao a, consinco.imp_pedcd_setores b where a.seqsetor = b.seqsetor and (trunc(a.datainc) >= trunc(sysdate-60) and a.status in ('A','S')) and a.status != 'D' group by b.descsetor,a.seqpedido ,a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy'),case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end order by 1,6,2,4,3";
				}
				elseif ($vstatusreq == "2") {
					$sqlo = "select b.descsetor, a.seqpedido nroreq, count(a.seqproduto) SKU, a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy') dtainc,case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end STATUS from consinco.imp_pedcd_temprequisicao a, consinco.imp_pedcd_setores b where a.seqsetor = b.seqsetor and trunc(a.datainc) >= trunc(sysdate-60) and a.status in ('F') and a.status != 'D' group by b.descsetor,a.seqpedido ,a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy'),case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end order by 1,6,2,4,3";
				}
				elseif ($vstatusreq == "3") {
					$sqlo = "select b.descsetor, a.seqpedido nroreq, count(a.seqproduto) SKU, a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy') dtainc,case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end STATUS from consinco.imp_pedcd_temprequisicao a, consinco.imp_pedcd_setores b where a.seqsetor = b.seqsetor and (trunc(a.datainc) >= trunc(sysdate-60) and a.status in ('C')) and a.status != 'D' group by b.descsetor,a.seqpedido ,a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy'),case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end order by 1,6,2,4,3";
				}
				else {
					$sqlo = "select b.descsetor, a.seqpedido nroreq, count(a.seqproduto) SKU, a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy') dtainc,case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end STATUS from consinco.imp_pedcd_temprequisicao a, consinco.imp_pedcd_setores b where a.seqsetor = b.seqsetor and (trunc(a.datainc) >= trunc(sysdate-60) and a.status in ('A','S','F')) and a.status != 'D' group by b.descsetor,a.seqpedido ,a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy'),case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end order by 1,6,2,4,3";
				}
				//echo $sqlo;
				$orareq1=oci_parse($conn,$sqlo);
				oci_execute($orareq1);
				echo "<table border='1' frame='void' id='agendinserte'>";
						echo "<th> DESC_SETOR </th>";
						echo "<th> NRO_REQUISICAO </th>";
						echo "<th> ITENS_SKU </th>";
						echo "<th> USER_INC </th>";
						echo "<th> DTA_INC </th>";
						echo "<th id='stped'> STATUS_PEDIDO </th>";
						echo "</tr>";
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) {
					$descsetor = $r1['DESCSETOR'];
					$nroreq = $r1['NROREQ'];
					$sku = $r1['SKU'];
					$userinc = $r1['USERINC'];
					$dtainc = $r1['DTAINC'];
					$statusreq = $r1['STATUS'];
						echo "<tr>";
						echo "<td> ".$descsetor." </td>";
						echo "<td id='nroreqcons' onclick='buscarReq(this.innerHTML)'> ".$nroreq." </td>";
						echo "<td> ".$sku." </td>";
						echo "<td> ".$userinc." </td>";
						echo "<td> ".$dtainc." </td>";
						echo "<td> ".$statusreq." </td>";
						echo "</tr>";
					}
				
				
				?>
		</table>	
	</br></br></br>
</body>
</html> 