<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <title>Pedidos Logistica Grupo MundialMix</title>
    <link rel="stylesheet" type="text/css"  href="_css/estilosmenu.css" /> 
	<script src="_js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="_js/jquery.mask.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(function($){
		$("input#usuario").focus();			
        });
	</script>
</head>

<body>
<div id="formulario">
	<h1>Login - Pedidos Logística Grupo MundialMix</h1>
	<form action="login.php" method="POST" id="login">
		USUARIO<br> <input type="text" name="usuario" id="usuario" class="mediocomp" onkeypress="return SomenteEnter(event)"/><br><br><br>
		SENHA<br> <input type="password" name="senha" id="senha" class="mediocomp" onkeypress="return SomenteEnter(event)"/><br><br><br>
		<script type="text/javascript">
			$('input,select').on('keydown',function(e){
			var keyCode = e.keyCode || e.which;
			if(e.keyCode === 13) {
				e.preventDefault();
			$('input,select')[$('input,select').index(this)+1].focus();
			}
			});
		</script>
	<input id="botao" type="submit" name="Submit" value="ENTRAR" />
	</form>
</div> 


</body>
</html> 