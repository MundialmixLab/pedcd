<?php

session_start();

unset($_SESSION['pedcdusuario']);
session_destroy($_SESSION['pedcdusuario']);
unset($_SESSION['pedcdniveluser']);
session_destroy($_SESSION['pedcdniveluser']);
unset($_SESSION['pedcdnropedido']);
session_destroy($_SESSION['pedcdnropedido']);
unset($_SESSION['pedcdqtdped']);
session_destroy($_SESSION['pedcdqtdped']);
unset($_SESSION['pedcdqtdmanut']);
session_destroy($_SESSION['pedcdqtdmanut']);
echo '<script type="text/JavaScript">location.href="index.php"</script>';
?>