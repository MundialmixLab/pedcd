<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Pedidos Logística Grupo MundialMix</title>
    <link rel="stylesheet" type="text/css" href="_css/estilos.css" />
    <script src="_js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="_js/jquery.mask.min.js" type="text/javascript"></script>
    <script src="_js/funcs.js" type="text/javascript"></script>
    <script language="javascript">
        function confirma(valor) {
            if (confirm('Tem certeza que deseja sair?'))
                self.location.href = 'sair.php';
            else
                location.href = "menu.php";
        }
    </script>
</head>

<body">
    <div id="lateral">
        <div id="menu">
            <h3 class="link-titulo">Pedidos</h3>
            <ul class="box">
                <li><a href="menu.php">Inicio</a></li>
                <?php
                session_start();
                $niveluser = $_SESSION['pedcdniveluser'];
                if ($niveluser == 5) {
                    echo "<li><a href='pedinc.php' >Nova Requisição</a></li>";
                    echo "<li><a href='pedseparacao.php' >Gera Requisições</a></li>";
                    echo "<li><a href='gerrelsep.php' >Rel Separação</a></li>";
                    echo "<li><a href='manutreq.php' >Manut. Requisições</a></li>";
                    echo "<li><a href='conspedidos.php' >Consulta Requisições</a></li>";
                    echo "<li><a href='coletor.php' >Reiniciar Coletores</a></li>";
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

        $usuario = $_SESSION['pedcdusuario'];
        echo "<h2> Bem vindo " . $usuario . "</h2>";
        $nrol = 1;
        ?>
        </br></br></br>
        <h1 class="lj">Reinciar Coletores</h1></br></br>
        <input type="button" value="REINICIA COLETOR" class="new" name="btcoletor" id="btcoletor" onclick="reiniciacoletor()"/>
    </div>
</body>

</html>