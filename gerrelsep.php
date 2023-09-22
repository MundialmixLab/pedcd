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
	<script src="_js/funcbuscareqr.js" type="text/javascript"></script>
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
			document.getElementById("nrocarga").focus(); 
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

<body onLoad="setFocus()">
<div id="lateral">
<div id="menu">		
	<h3 class="link-titulo">Pedidos</h3>
    <ul class="box">
	<li><a href="menu.php" >Inicio</a></li>	
	<?php
	session_start();
	$niveluser = $_SESSION['pedcdniveluser'];
	if ($niveluser == 5) {
		echo "<li><a href='pedinc.php' >Nova Requisição</a></li>";
		echo "<li><a href='pedseparacao.php' >Gera Requisições</a></li>";
		echo "<li><a href='gerrelsep.php' >Rel Separação</a></li>";
		echo "<li><a href='manutreq.php' >Manut. Requisições</a></li>";
		echo "<li><a href='conspedidos.php' >Consulta Requisições</a></li>";
	}
	if ($niveluser == 3) {
		echo "<li><a href='pedinc.php' >Nova Requisição</a></li>";
		echo "<li><a href='conspedidos.php' >Consulta Requisições</a></li>";
	}
	?>
    </ul>		
	<h3 class="link-titulo">Logout</h3>
    <ul class="box">	
    <li><a href="#" onclick="confirma(true)">Sair</a></li>
    </ul>	
</div>
</div>
<div id="formulario">
	<h1>Pedidos Logística Grupo MundialMix</h1>
	<?php
	session_start();
	require "verifica.php"; 
	unset($_SESSION['pedcdqtdped']);
	session_destroy($_SESSION['pedcdqtdped']);
	
	$usuario = $_SESSION['pedcdusuario'];
	echo "<h2> Bem vindo ".$usuario."</h2>";
	$nrol = 1;
	?>
	</br></br></br>
</div>
	<div id="print" name="print">
	
	<h1 class="lj">Gerar Relatório de Separação</h1></br></br>
		</br></br>
			
	<div id="tabela" name="tabela">
	<form method="post" action="rrelseparacao2.php" enctype="multipart/form-data" name="formaglojas" target="_blank" >
		
				<?php
				require "bd.php"; 
				//echo $nrcarga;				
				$sqlo = "select b.descsetor, c.nrocarga nroreq, count(a.seqproduto) SKU, a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy') dtainc,case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO'  end STATUS from consinco.imp_pedcd_temprequisicao a, consinco.imp_pedcd_setores b, consinco.imp_pedcd_cargareq c where a.seqsetor = b.seqsetor and a.status ='S' and a.seqpedido = c.seqpedido and c.status = 'S' and a.seqproduto = c.seqproduto group by b.descsetor,c.nrocarga ,a.userinc,to_char(trunc(a.datainc),'dd/mm/yyyy'),case when a.status = 'A' then 'AGUARDANDO INICIAR SEPARACAO' when a.status = 'S' then 'PEDIDO EM SEPARACAO' when a.status = 'F' then 'PEDIDO SEPARADO' when a.status = 'C' then 'PEDIDO CANCELADO' end order by 6,1,2,4,3";
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
						echo "<td id='dessetor'> ".$descsetor." </td>";
						echo "<td id='nroreqcons' onclick='buscarReq(this.innerHTML)'> ".$nroreq." </td>";
						echo "<td> ".$sku." </td>";
						echo "<td> ".$userinc." </td>";
						echo "<td> ".$dtainc." </td>";
						echo "<td> ".$statusreq." </td>";
						echo "</tr>";
					}
				
				
				?>
		</table>
	</div>
	</br></br></br>
	</div> 
	<div id="resultadoim">
	<input type="text" class="fpequeno" id="nrocarga" name="nrocarga"/>
	</br>
	</br>
	<input id="btgerrelsep" type="submit" name="btgerrelsep" class="new" value="Gerar" >	
	</form>
	</div>
	<div id="resultado"></div>
	

</body>
</html> 