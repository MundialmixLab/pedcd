<?php 

session_start(); 
$usuario = mb_strtoupper($_POST["usuario"]);
$senha = mb_strtoupper($_POST["senha"]);

require "bd.php"; 

	
$sqlo = "select count(*) as existe from consinco.ge_usuario a where a.codusuario = '". $usuario ."' and a.nivel != 0";
$orareq1=oci_parse($conn,$sqlo);
		 oci_execute($orareq1);
		 while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
				$existe = $r1['EXISTE'];
		}
	
		if ($existe == 0) {
			echo '<script type="text/JavaScript">alert( "Usuario nao Cadastrado ou Bloqueado!" );location.href="index.php"</script>';
		}
		else {
				if (empty($senha)) {
					echo '<script type="text/JavaScript">alert( "Senha não pode Estar em Branco!" );location.href="index.php"</script>';
				}
					else {
							$sqlo = "select consinco.pkg_c5seguranca.decodificar(senha) senha from consinco.ge_usuario where codusuario  = '". $usuario ."'";

							$orareq1=oci_parse($conn,$sqlo);
							oci_execute($orareq1);
							while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
									$senhab = $r1['SENHA'];
							}
						if ($senhab == $senha) {
							$sqlo = "select count(*) existe from consinco.imp_userpedcd a where a.codusuario = '". $usuario ."'";
							$orareq1=oci_parse($conn,$sqlo);
							oci_execute($orareq1);
							while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
								   $existe = $r1['EXISTE'];
							}
							if ($existe == 0){
								echo '<script type="text/JavaScript">alert( "Usuario Sem Permissao. Verifique com Gerente de Logistica!" );location.href="index.php"</script>';
							}
							else {
								$sqlo = "select count(*) existe from consinco.imp_userpedcdlog a where a.codusuario = '". $usuario ."'";
								$orareq1=oci_parse($conn,$sqlo);
								oci_execute($orareq1);
								while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
								   $existe = $r1['EXISTE'];
								}
								if ($existe == 0){
									$sqlo = "select count(*) existe from consinco.imp_userpedcdinc a where a.codusuario = '". $usuario ."'";
									$orareq1=oci_parse($conn,$sqlo);
									oci_execute($orareq1);
									while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) { 
										$existe = $r1['EXISTE'];
									}
									if ($existe == 0){
										echo '<script type="text/JavaScript">alert( "Usuario Sem Permissao. Verifique com Gerente de Logistica!" );location.href="index.php"</script>';
									}
									else {
										$_SESSION["pedcdniveluser"] = 3;
										$_SESSION["pedcdusuario"] = $usuario;
										echo '<script type="text/JavaScript">location.href="menu.php"</script>';
									}
								}
								else {
									$_SESSION["pedcdniveluser"] = 5;
									$_SESSION["pedcdusuario"] = $usuario;
									echo '<script type="text/JavaScript">location.href="menu.php"</script>';
								}
								
							}
							
						}
						else {
								echo '<script type="text/JavaScript">alert( "Senha Incorreta. Verifique se o CapsLock nao esta ligado!" );location.href="index.php"</script>';
						}
					}
		}

	




  

   
?>