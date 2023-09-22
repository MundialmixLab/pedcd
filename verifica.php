<?php 
// Inicia sessões 

session_start(); 

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["pedcdusuario"]) || !isset($_SESSION["pedcdusuario"])) 
{ 
// Usuário não logado! Redireciona para a página de login 
echo '<script type="text/JavaScript">alert( "Usuario nao esta Logado!" );location.href="index.php"</script>';
exit; 
} 

// Verifica se $_SESSION['ultimoClick'] esta setada e não esta vazia.
// Caso esteja, ele verifica o tempo que o usuario levou entre um clique e outro.
// Caso não, ele seta a sessão e dá o valor do tempo time() atual.
if ( isset($_SESSION['ultimoClick']) AND !empty($_SESSION['ultimoClick']) ) {

$tempoAtual = time();

// Faz uma condição entre o tempo do ultimo click e o tempo atual.
// Caso dê maior que 60 segundos, redireciona para a pagina desejada.
// Caso não de maior, apenas atualiza o valor do ultimo clique para o valor atual.

if ( ($tempoAtual - $_SESSION['ultimoClick']) > '8800' ) {
	
session_destroy();
echo '<script type="text/JavaScript">alert( "Tempo Limite de Execução Esgotado!" );location.href="index.php"</script>';
exit; 

}else{

$_SESSION['ultimoClick'] = time();

}

}else{

$_SESSION['ultimoClick'] = time();

}
?> 