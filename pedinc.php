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
	<script src="_js/funcbuscadescprod.js" type="text/javascript"></script>
	<script src="_js/funcselseqprod.js" type="text/javascript"></script>
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

function so_nro5(e,args)
{			
if (document.all){
	var evt=event.keyCode;
}
else {
	var evt = e.charCode;
}
var valid_chars = '0123456789';
var chr= String.fromCharCode(evt);
alert(chr);
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
	unset($_SESSION['pedcdnropedido']);
	session_destroy($_SESSION['pedcdnropedido']);
	
	$usuario = $_SESSION['pedcdusuario'];
	echo "<h2> Bem vindo ".$usuario."</h2>";
	
	?>
	</br></br></br>
	<form method="post" action="pedincbanco.php" enctype="multipart/form-data" name="formlojas" >
		<h1 class="lj">Nova Requisição</h1></br></br>
		</br></br>
			<label id="setor"> SETOR</label>
			<select name='box' id='box'  class='boxe' onkeypress="return so_enter(event);"required>
				<option  selected="selected"></option>
				<?php
				require "bd.php"; 
				
				$sqlo = "select descsetor from consinco.imp_pedcd_setores order by 1";
				$orareq1=oci_parse($conn,$sqlo);
				oci_execute($orareq1);
				while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) {
					$setor = $r1['DESCSETOR'];
					echo "<option> ".$setor." </option>";
				}
				?>
			</select>
		</br></br></br></br></br>
		<label id="lseqprod"> COD_PRODUTO</label>
		<label id="ldescprod"> DESC_PRODUTO</label>
		<label id="lembprod"> EMB</label>
		<label id="lsolprod"> QTDE_SOL</label>
		<label id="latprod"> QTDE_ATEND </label>
		</br></br>
		<input type="text" class="fpequeno" name="seqprod" id="seqprod" onkeypress="return so_nro(event);" onblur="buscaprod(this.value)"   />
		<script type="text/javascript">
			$('input,select').on('keydown',function(e){
			var keyCode = e.keyCode || e.which;
			if(e.keyCode === 13) {
				e.preventDefault();
			$('input,select')[$('input,select').index(this)+1].focus();
			}
			});
		</script>
		<input type="text" class="fgrande" name="descprod" id="descprod" autocomplete="off" onkeyup="buscadescprod(this.value)"/>
		<input type="text" class="femb" name="embprod" id="embprod" readonly="true" />
		<input type="text" class="femb" name="qembprod" id="qembprod" readonly="true"/>
		<input type="text" class="fpequeno" name="qtdsol" id="qtdsol"  onkeypress="return so_nro2(event);" onblur="buscaestqprod(document.getElementById('seqprod').value+'|'+this.value+'|'+document.getElementById('qembprod').value)" />
		<input type="text" class="fpequeno" name="qtdat" id="qtdat" readonly="true" />
		<input type="button" class="binsertprod" name="binsertprod" id="binsertprod" onclick="insertprod(document.getElementById('box').value+'|'+document.getElementById('seqprod').value.trim()+'|'+document.getElementById('qembprod').value.trim()+'|'+document.getElementById('qtdat').value.trim())"/>
		</br>
		<label id="comentdescprod">Digite o código do Produto ou Digitar no Minimo 5 caracteres para buscar o Produto pela Descrição</label>
		
	</br></br></br></br>
	<div id="resultado"></div></br></br></br></br>
	<div id="bt">
	</div></br></br>
	<input id ="finped" type="submit" value="FINALIZAR PEDIDO" class="new"/>
	
	</form>
	</br></br>
	
	</br></br></br></br></br></br>
</div> 
</body>
</html> 