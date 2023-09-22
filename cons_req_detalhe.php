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

<div id="formulario">
<h1 class="lj">Detalhamento Requisição</h1></br>
	<?php
	session_start();
	require "verifica.php"; 
	unset($_SESSION['pedcdqtdped']);
	session_destroy($_SESSION['pedcdqtdped']);
	
	$nroreq = $_GET[valor];
	$usuario = $_SESSION['pedcdusuario'];

	?>
				<?php
				require "bd.php"; 
				//echo $nrcarga;				
				$sqlo = "select a.seqpedido,b.descsetor,a.seqproduto,c.desccompleta,sum(a.qtde) QTDE,d.embalagem QTDEMB,a.embalagem from consinco.imp_pedcd_temprequisicao a, consinco.imp_pedcd_setores b, consinco.map_produto c, consinco.map_famembalagem d where a.seqpedido = ".$nroreq." and a.seqsetor = b.seqsetor and a.seqproduto = c.seqproduto and c.seqfamilia = d.seqfamilia and a.embalagem = d.qtdembalagem  group by a.seqpedido,b.descsetor,a.seqproduto,c.desccompleta,d.embalagem,a.embalagem order by 4";
				//echo $sqlo;
				$orareq1=oci_parse($conn,$sqlo);
				oci_execute($orareq1);
				echo "<table border='1' frame='void' id='agendinserte'>";
						echo "<tr>";
						echo "<th> NRO_REQ </th>";
						echo "<th> DESC_SETOR </th>";
						echo "<th> SEQ_PRODUTO </th>";
						echo "<th id='descdoprod'> DESC_PRODUTO </th>";
						echo "<th> QTDE_PEDIDA </th>";
						echo "<th> EMB </th>";
						echo "<th> QTDE </th>";
						echo "</tr>";
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) {
					$seqpedido = $r1['SEQPEDIDO'];
					$descsetor = $r1['DESCSETOR'];
					$seqproduto = $r1['SEQPRODUTO'];
					$descproduto = $r1['DESCCOMPLETA'];
					$qtdpedida = $r1['QTDE'];
					$qtdembprod = $r1['QTDEMB'];
					$embprod = $r1['EMBALAGEM'];
						echo "<tr>";
						echo "<td> ".$seqpedido." </td>";
						echo "<td id='dessetor'> ".$descsetor." </td>";
						echo "<td> ".$seqproduto." </td>";
						echo "<td id='descesquerda'> ".$descproduto." </td>";
						echo "<td> ".$qtdpedida." </td>";
						echo "<td> ".$qtdembprod." </td>";
						echo "<td> ".$embprod." </td>";
						echo "</tr>";
					
					
				}
				
				
				?>
		</table>	
	</br></br></br>
</div> 
</body>
</html> 