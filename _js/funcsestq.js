var req;
// FUNÇÃO PARA BUSCA NOTICIA
function buscaestqprod(valor) {

// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
var vervalor = valor;
	vvlr = vervalor.split("|");
	vvlr01 = vvlr[0];
	vvlr02 = vvlr[1];
if(vvlr01==""){exit}
if(vvlr02==""){exit}
if(vvlr02==0){alert("Qtde Deve ser Maior que Zero (0)");
			document.getElementById('qtdsol').value = "";
			document.getElementById('qtdsol').focus();
			exit}
 //alert(valor); 
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "consestqprod.php?valor="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('resultado').innerHTML = 'Buscando Estoque Produto...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
	
	var qatend = resposta;
	//alert(qatend);
	
	if (qatend.trim() =="T") {
	alert("Produto Sem Estoque na Empresa 990!");
	document.getElementById('seqprod').value = "";
	document.getElementById('descprod').value = "";
	document.getElementById('embprod').value = "";
	document.getElementById('qembprod').value = "";
	document.getElementById('qtdsol').value = "";
	document.getElementById('qtdat').value = "";
	document.getElementById('seqprod').focus();
	}
	else {
		document.getElementById('qtdat').value = qatend.trim();
		//document.getElementById('binsertprod').focus();
	}
	
	//document.getElementById('resultado').innerHTML = resposta;
	}
}
req.send(null);
}