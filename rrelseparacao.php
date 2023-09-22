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

<body onLoad="setFocus()">
<div id="lateral">
<div id="menu">		
	<h3 class="link-titulo">Pedidos</h3>
    <ul class="box">
	<li><a href="menu.php" >Inicio</a></li>	
	<?php
	function geraCodigoBarra($numero){
		$fino = 1;
		$largo = 3;
		$altura = 30;
		
		$barcodes[0] = '00110';
		$barcodes[1] = '10001';
		$barcodes[2] = '01001';
		$barcodes[3] = '11000';
		$barcodes[4] = '00101';
		$barcodes[5] = '10100';
		$barcodes[6] = '01100';
		$barcodes[7] = '00011';
		$barcodes[8] = '10010';
		$barcodes[9] = '01010';
		
		for($f1 = 9; $f1 >= 0; $f1--){
			for($f2 = 9; $f2 >= 0; $f2--){
				$f = ($f1*10)+$f2;
				$texto = '';
				for($i = 1; $i < 6; $i++){
					$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
				}
				$barcodes[$f] = $texto;
			}
		}
		
		$impressao =  '<img src="imagens/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$impressao .= '<img src="imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$impressao .= '<img src="imagens/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$impressao .= '<img src="imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		
		$impressao .= '<img ';
		
		$texto = $numero;
		
		if((strlen($texto) % 2) <> 0){
			$texto = '0'.$texto;
		}
		
		while(strlen($texto) > 0){
			$i = round(substr($texto, 0, 2));
			$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
			
			if(isset($barcodes[$i])){
				$f = $barcodes[$i];
			}
			
			for($i = 1; $i < 11; $i+=2){
				if(substr($f, ($i-1), 1) == '0'){
  					$f1 = $fino ;
  				}else{
  					$f1 = $largo ;
  				}
  				
  				$impressao .= 'src="imagens/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
  				$impressao .= '<img ';
  				
  				if(substr($f, $i, 1) == '0'){
					$f2 = $fino ;
				}else{
					$f2 = $largo ;
				}
				
				$impressao .= 'src="imagens/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
				$impressao .= '<img ';
			}
		}
		$impressao .= 'src="imagens/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
		$impressao .= '<img src="imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$impressao .= '<img src="imagens/p.gif" width="1" height="'.$altura.'" border="0" />';
		
		return $impressao;
	}
	
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
	
	$nrcarga = $_POST[nrocarga];
	
	$usuario = $_SESSION['pedcdusuario'];
	echo "<h2> Bem vindo ".$usuario."</h2>";
	$nrol = 1;
	?>
	</br></br></br>
	</div>
	<div id="print" name="print">
	<form method="post" action="#" enctype="multipart/form-data" name="formaglojas" >
		<h1 class="lj">Relatório de Separação Pedidos Internos</h1></br></br>
		</br></br>
			</br></br>
				<?php
				require "bd.php"; 
			
				$sqlo = "select a.nrocarga,b.descsetor,a.seqproduto,c.desccompleta,sum(a.qtde) QTDE,d.embalagem QTDEMB,a.embalagem, 'R'||''||e.codrua||'-'||e.nropredio||'.'||e.nroapartamento||'.'||e.nrosala ENDERECO,e.codrua,e.nropredio,e.nroapartamento,e.nrosala from consinco.imp_pedcd_cargareq a, consinco.imp_pedcd_setores b, consinco.map_produto c, consinco.map_famembalagem d, consinco.mlo_endereco e where e.nroempresa = 990 and a.nrocarga = ".$nrcarga." and a.seqsetor = b.seqsetor and a.seqproduto = c.seqproduto and c.seqfamilia = d.seqfamilia and a.embalagem = d.qtdembalagem and a.seqproduto = e.seqproduto(+) and e.especieendereco = 'A'group by a.nrocarga,b.descsetor,a.seqproduto,c.desccompleta,d.embalagem,a.embalagem, 'R'||''||e.codrua||'-'||e.nropredio||'.'||e.nroapartamento||'.'||e.nrosala,e.codrua,e.nropredio,e.nroapartamento,e.nrosala order by b.descsetor, e.codrua,e.nropredio,e.nroapartamento,e.nrosala";
				$orareq1=oci_parse($conn,$sqlo);
				oci_execute($orareq1);
				$setor = 1;
				echo "<table border='1' frame='void' id='agendinserte'>";
				echo "<tr>";
				echo "<th colspan='6'>CARGA: ".$nrcarga."</th>";
				echo "</tr>";
				echo "<tr>";
				$auxseqendpad = 0;
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) {
					
					$descsetor = $r1['DESCSETOR'];
					$seqproduto = $r1['SEQPRODUTO'];
					$descproduto = $r1['DESCCOMPLETA'];
					$qtdpedida = $r1['QTDE'];
					$qtdembprod = $r1['QTDEMB'];
					$embprod = $r1['EMBALAGEM'];
					$end = $r1['ENDERECO'];
					if ($descsetor == "CENTRAL PRODUCAO PADARIA") {
						$sqlo2 = "select gg.seqendereco from consinco.mlo_endereco gg where gg.nroempresa = 990 and gg.codrua = '500' and gg.especieendereco = 'B' and gg.seqproduto = ".$seqproduto."";
					}
					else {
						$sqlo2 = "select gg.seqendereco from consinco.mlo_endereco gg where gg.nroempresa = 990 and gg.codrua = '500' and gg.especieendereco = 'D' and gg.seqproduto = ".$seqproduto."";
					}
					$orareq2=oci_parse($conn,$sqlo2);
					oci_execute($orareq2);
					$seqendpad = 0;
					while ($r2 = oci_fetch_array($orareq2, OCI_ASSOC+OCI_RETURN_NULLS)) {
						$seqendpad = $r2['SEQENDERECO'];
					}
					
					if ($descsetor == "CENTRAL PRODUCAO PADARIA") {
						if ($seqendpad == 0){
							$sqlo5 = "call consinco.imp_reservaendpad(".$seqproduto.")";
							$orareq5=oci_parse($conn,$sqlo5);
							$r5 =    oci_execute($orareq5);
							if ($r5 == 1){
								$sqlo3 = "select a.seqendereco from consinco.imp_pedcd_respad a where a.seqproduto =".$seqproduto."";
								$orareq3=oci_parse($conn,$sqlo3);
								oci_execute($orareq3);
								while ($r3 = oci_fetch_array($orareq3, OCI_ASSOC+OCI_RETURN_NULLS)) {
								$seqendpad = $r3['SEQENDERECO'];
								}
								if ($auxseqendpad == 0) {
								$auxseqendpad = $seqendpad;
								}
								else {
								$auxseqendpad = $auxseqendpad . "," . $seqendpad;
								}
							}
							else {
								echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na Geração da Separacao. Tente novamente. Em caso de erro, Contate a TI!" );location.href="rrelseparacao.php';
							}
						}
						else {
						
							if ($auxseqendpad == 0) {
								$auxseqendpad = $seqendpad;
							}
							else {
								$auxseqendpad = $auxseqendpad . "," . $seqendpad;
							}
						}
					}
					else {
						if ($seqendpad == 0){
							$sqlo5 = "call consinco.imp_reservaendout(".$seqproduto.")";
							$orareq5=oci_parse($conn,$sqlo5);
							$r5 =    oci_execute($orareq5);
							if ($r5 == 1){
								$sqlo3 = "select a.seqendereco from consinco.imp_pedcd_resout a where a.seqproduto =".$seqproduto."";
								$orareq3=oci_parse($conn,$sqlo3);
								oci_execute($orareq3);
								while ($r3 = oci_fetch_array($orareq3, OCI_ASSOC+OCI_RETURN_NULLS)) {
								$seqendpad = $r3['SEQENDERECO'];
								}
								if ($auxseqendpad == 0) {
								$auxseqendpad = $seqendpad;
								}
								else {
								$auxseqendpad = $auxseqendpad . "," . $seqendpad;
								}
							}
							else {
								echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na Geração da Separacao. Tente novamente. Em caso de erro, Contate a TI!" );location.href="rrelseparacao.php';
							}
						}
						else {
						
							if ($auxseqendpad == 0) {
								$auxseqendpad = $seqendpad;
							}
							else {
								$auxseqendpad = $auxseqendpad . "," . $seqendpad;
							}
						}
					}
					
					if ($setor == $descsetor){
						echo "<tr>";
						echo "<td> ".$seqproduto." </td>";
						echo "<td id='descesquerda'> ".$descproduto." </td>";
						echo "<td> ".$qtdpedida." </td>";
						echo "<td> ".$qtdembprod." </td>";
						echo "<td> ".$embprod." </td>";
						echo "<td id='seqend'> ".$end." </br>".geraCodigoBarra($seqendpad)."</br>".$seqendpad."</td>";
						echo "</tr>";
						$setor = $descsetor;
					}
					else {
						echo "<tr>";
						echo "<th colspan='6'>".$descsetor."</th>";
						echo "</tr>";
						echo "<th> SEQ_PRODUTO </th>";
						echo "<th id='descdoprod'> DESC_PRODUTO </th>";
						echo "<th> QTDE_PEDIDA </th>";
						echo "<th> EMB </th>";
						echo "<th> QTDE </th>";
						echo "<th> ENDERECO </th>";
						echo "</tr>";
						echo "<tr>";
						echo "<td> ".$seqproduto." </td>";
						echo "<td id='descesquerda'> ".$descproduto." </td>";
						echo "<td> ".$qtdpedida." </td>";
						echo "<td> ".$qtdembprod." </td>";
						echo "<td> ".$embprod." </td>";
						echo "<td id='seqend'> ".$end." </br>". geraCodigoBarra($seqendpad)."</br>".$seqendpad."</td>";
						echo "</tr>";
						$setor = $descsetor;
					}
					
				}
				
				
				?>
		</table>
	</div>	
	<div id="resultadoi">
	</br></br>
	<input id="imprime" type="button" name="print" value="" onclick="btimp()" >	
	</form>
	</div>
	</br></br>
	</br></br></br></br></br></br>
</div> 
</body>
</html> 