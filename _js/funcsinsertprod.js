var req;
// FUNÇÃO PARA BUSCA NOTICIA
function insertprod(valor) {

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
	vvlr03 = vvlr[2];
	vvlr04 = vvlr[3];
if(vvlr01==""){alert("Primeiro Selecione o Setor");
			document.getElementById('box').focus();
			exit;}
if(vvlr02==""){alert("Primeiro Informe o Produto Desejado!");
			document.getElementById('seqprod').focus();
			exit;}
if(vvlr03==""){alert("Embalagem do Pedido Não Informada. Verifique!");
			document.getElementById('qembprod').focus();
			exit;}
if(vvlr04==""){alert("Qtde Atendida não Informada! Verifique!");
			document.getElementById('qtdsol').focus();
			exit;}

 //alert(valor); 
 //exit;
// Arquivo PHP juntamente com o valor digitado no campo (método GET)

var url = "insertpedcd.php?valor="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('resultado').innerHTML = 'Inserindo Produto...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
	
	var sucesso = resposta;
	
	if (sucesso == "0") {
	alert("Produto Não Encontrado na Empresa 990! Verifique novamente ou contato a TI!");
	}
	else {	
	document.getElementById('resultado').innerHTML = resposta;
	document.getElementById('seqprod').value = "";
	document.getElementById('descprod').value = "";
	document.getElementById('embprod').value = "";
	document.getElementById('qtdsol').value = "";
	document.getElementById('qtdat').value = "";
	document.getElementById('qembprod').value = "";
	document.getElementById('box').disabled = true;
	document.getElementById('seqprod').focus();
	}
	}
}
req.send(null);
}