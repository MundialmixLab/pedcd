var req;
// FUNÇÃO PARA BUSCA NOTICIA
function buscadescprod(valor) {
 //alert("jj");
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 //alert(valor);
 //alert(valor.length);
 //if(valor.length < 5){exit}
 if(valor.length < 5){document.getElementById('resultado').innerHTML = "";exit}
 if(valor==""){exit}
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "consdescprod.php?valor="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('resultado').innerHTML = 'Buscando Produto...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
	
	var produto = resposta;
	vaprod = produto.split("|");
	vseqprod = vaprod[0];
	vdescprod = vaprod[1];
	vembprod = vaprod[2];
	vqembprod = vaprod[3];
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
	//document.getElementById('seqprod').value = vseqprod;
	//document.getElementById('descprod').value = vdescprod;
	//document.getElementById('embprod').value = vembprod;
	//document.getElementById('qembprod').value = vqembprod;
	//document.getElementById('qtdsol').focus();
	document.getElementById('resultado').innerHTML = resposta;
	}
	//document.getElementById('resultado').innerHTML = resposta;
	}
}
req.send(null);
}