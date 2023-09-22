var req;
// FUNÇÃO PARA BUSCA NOTICIA
function buscaprod(vlr) {
//alert(valor)	;

 if (vlr == ''){
     exit;
 }
 else {
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
//alert(valor)	;
if(vlr==""){
	document.getElementById('descprod').focus();
	exit;
}
else {
	document.getElementById('qtdsol').focus();
}

//alert(vlr);
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "consseqprod.php?valor="+vlr;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
//alert(req.onreadystatechange);
//alert(req.readyState);
//	alert(valor);	
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1 ) {
		document.getElementById('resultado').innerHTML = 'Buscando Produto...';
		
	}
	//alert(req.responseText);
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
	var produto = resposta;
	vaprod = produto.split("|");
	vdescprod = vaprod[0];
	vembprod = vaprod[1];
	vqembprod = vaprod[2];
	//alert(vdescprod);
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	 //alert(vdescprod);
	

	if(vdescprod == 0) {
		alert("Produto Nao Cadastrado ou Inativo para Compra. Verifique com PCE Logística!")
		document.getElementById('seqprod').value = "";
		document.getElementById('descprod').value = "";
		document.getElementById('embprod').value = "";
		document.getElementById('qtdsol').value = "";
		document.getElementById('qtdat').value = "";
		document.getElementById('qembprod').value = "";
		document.getElementById('seqprod').focus();
	}
	else {
	document.getElementById('descprod').value = vdescprod;
	document.getElementById('embprod').value = vembprod;
	document.getElementById('qembprod').value = vqembprod;
	document.getElementById('qtdsol').focus();
	}
	//document.getElementById('resultado').innerHTML = resposta;
	}
}
//alert("hh");
req.send(null);
 }
}