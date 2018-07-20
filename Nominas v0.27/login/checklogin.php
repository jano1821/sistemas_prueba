<?php
	//iniciar una sesion para guardar las coockies
	session_start();
	//realizar la conexión a la base de datos
	require_once('../conectarbbdd.php');
	//recoger los valores de username y password
	$username = $_POST['username'];
	$password = $_POST['password'];
	//realizar el query
	$qry="SELECT * FROM  `miembros` WHERE  `usuario` LIKE  '$username' AND  `userpass` LIKE  '$password'";
	//guardar resultado de la query
	$result=mysql_query($qry);
	//comprobar si he conseguido algún valor, ni no he conseguido nada seguramente ha fallado el enlace a la BD
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Me he logado correctamente, ahora me falta cargar los pemisos
			//crear una sesesion (cookie) para guardar los datos)
			session_regenerate_id();
			//acceder al array de los datos obtenidos de la base de datos
			while ($member = mysql_fetch_array($result, MYSQL_NUM)) {
			//guardar en la sesión con id desconocido, diferentes variables, con diferentes permisos (0,1)
				$_SESSION['SESS_MEMBER_ID'] = $member[0];
				$_SESSION['SESS_USERNAME'] = $member[1];
				$_SESSION['SESS_PASSWORD'] = $member[2];
				$_SESSION['NOTIFICACIONES'] = $member[3];
				
				//cargar todos los tipos de permisos
				$options2 = array();
				$sqltipoperm="SELECT * FROM  `t_tipoperm`";
				$resultipo=mysql_query($sqltipoperm);
				while ($tpermiso = mysql_fetch_array($resultipo, MYSQL_NUM)) {
					//guardar en un array todos los tipos de permisos
						$options2[]= $tpermiso[1];
						//inicialmente todos los permisos estan negados, es decir no existen o son 0
						$_SESSION[$tpermiso[1]] = 0;
				}
				// cargar permisos del usuario
				$sqlperm="SELECT * FROM  `permisos` WHERE  `idmiembro` LIKE  '$member[0]'";
				$resulperm=mysql_query($sqlperm);
				echo ('1');
				while ($miembro = mysql_fetch_array($resulperm, MYSQL_NUM)) {
					//cargar los permisos que existen y asignarlos a 1
					$_SESSION[$options2[$miembro[2]-1]] = 1;
					//echo ('Mi variable es:'.$options2[$miembro[2]-1]);
				}
				/*
				$_SESSION['TABBEMP'] = $member[4];
				$_SESSION['TABBNOM'] = $member[5];
				$_SESSION['TABBSOL'] = $member[6];
				$_SESSION['TABBAUS'] = $member[7];
				$_SESSION['TABNEMP'] = $member[8];
				$_SESSION['TABNNOM'] = $member[9];
				$_SESSION['TABSTATS'] = $member[10];
				$_SESSION['TABUSERA'] = $member[11];
				$_SESSION['TABINST'] = $member[12];
				$_SESSION['TABNSOL'] = $member[13];
				$_SESSION['TABNAUS'] = $member[14];
				$_SESSION['TABNCON'] = $member[15];
				$_SESSION['BTNDELEMP'] = $member[16];
				$_SESSION['BTNMODEMP'] = $member[17];
				$_SESSION['BTNIMPEMP'] = $member[18];
				$_SESSION['BTNNEWNOM'] = $member[19];
				$_SESSION['BTNIMPNOM'] = $member[20];
				$_SESSION['BTNXLSNOM'] = $member[21];*/
			}
			//finalizar la sesión de creación de cookies
			session_write_close();
			//si me he logado bien, ir directamente a la pagina index
			header("location: ../index.php");
			exit();
		}else {
		   //si me he logado mal ir de nuevo a la pagina de logueo
			header("location: login.php");
			exit();
		}
	}else {
		//Si no consigo conectarme a la base de datos (lo dudo), mostrar error
		die("Fallo de Conexión a la BD");
	}
?>