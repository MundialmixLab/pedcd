var req;
 
// FUNÇÃO PARA BUSCA NOTICIA
function buscarReq(valor) {
//alert(valor);
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}


// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "cons_req_detalher.php?valor="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('resultado').innerHTML = 'Buscando Requisicoes...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
	
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('resultado').innerHTML = resposta;
	document.getElementById("nrocarga").value= valor.trim(); 
	document.getElementById("nrocarga").focus(); 
	//alert("t");
	}
}
req.send(null);
}