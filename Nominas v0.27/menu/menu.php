    	<script>
			var el = document.getElementsByTagName("body")[0];
			el.className = "";
		</script>
        <noscript>
        	<!--[if IE]>
            	<link rel="stylesheet" href="css/ie.css">
            <![endif]-->
        </noscript>
		<nav id="topNav">
        	<ul>
        	     <?php
    				 if ($_SESSION['MENUBUSQUEDA'] == '1'){
          		echo('<li><a href="#" title="Busqueda">Busqueda</a><ul>');
								if ($_SESSION['TABBEMP'] == '1'){
    							echo('<li><a href="buscaremp.php" title="Empleados">Empleados</a></li>');
    							}

						    if ($_SESSION['TABBNOM'] == '1'){
						    	echo('<li><a href="buscarnom.php" title="Nominas">Nominas</a></li>');
						    }

						    if ($_SESSION['TABBSOL'] == '1'){
						    	echo('<li><a href="buscarsol.php" title="Solicitudes">Solicitudes</a></li>');
						    }

						    if ($_SESSION['TABBAUS'] == '1'){
						    	echo('<li><a href="buscaraus.php" title="Ausencias">Ausencias</a></li>');
						    }

							if ($_SESSION['TABBCONT'] == '1'){
						    	echo('<li class="last"><a href="buscarcont.php" title="Contratos">Contratos</a></li>');
						    }
                 echo('</ul> </li>');
               }
              ?>
               <?php
    				 if ($_SESSION['MENUCREACION'] == '1'){       
          			 echo('<li><a href="#" title="Creacion">Creacion</a><ul>');
          			 
					    if ($_SESSION['TABNEMP'] == '1'){
					    	echo('<li><a href="nuevoemp.php" title="Empleados">Empleados</a></li>');
					    }
					    
					    if ($_SESSION['TABNNOM'] == '1'){
					    	echo('<li><a href="nuevonom.php" title="Nominas">Nominas</a></li>');
					    }

						 if ($_SESSION['TABNSOL'] == '1'){
					    	echo ('<li><a href="nuevasolicitud.php" title="Solicitudes">Solicitudes</a></li>');
					    }

					    if ($_SESSION['TABNAUS'] == '1'){
					    	echo('<li><a href="nuevaausencia.php" title="Ausencias">Ausencia</a></li>');
					    }

					    if ($_SESSION['TABNCON'] == '1'){
					    	echo('<li class="last"><a href="nuevocontrato.php" title="Contratos">Contratos</a></li>');
					    }
                 echo('</ul> </li>');
               }
              ?>
                <?php
	 				if ($_SESSION['MENUCONSULTAS'] == '1'){
                	echo('<li><a href="#" title="Consultas">Consultas</a><ul>');
                	if ($_SESSION['TABRUNREPORTE'] == '1'){
                		echo('<li><a href="reportes.php" title="Ejecutar Reporte">Ejecutar Reporte</a></li>');
                	}
	 					if ($_SESSION['TABSTATS'] == '1'){
          				echo('<li class="last"><a href="estadisticas.php" title="Estadisticas">Estadisticas</a></li> ');  
                  }
    					echo('</ul></li>');
    				}
    			   ?>   
    			  <?php
	 				if ($_SESSION['MENUGESTIONCRM'] == '1'){
                			echo('<li><a href="#" title="Gestion CRM">Gestion CRM</a><ul>');
                			if ($_SESSION['TABADMINEMPS'] == '1'){
                		 		echo('<li><a href="adminemps.php" title="Estados Empleado">Estados Empleado</a></li>');
                		 	}
                		 	if ($_SESSION['TABADMINTSOL'] == '1'){
                		  		echo('<li><a href="admintsol.php" title="Tipo Solicitudes">Tipo Solicitudes</a></li>');
                		  	}
                		  	if ($_SESSION['TABADMINTAUS'] == '1'){
                		  		echo('<li><a href="admintaus.php" title="Tipo Ausencia">Tipo Ausencia</a></li>');
                		  	}
                		  	if ($_SESSION['TABADMINAUSS'] == '1'){
                		  		echo('	<li><a href="adminauss.php" title="Estados Ausencias">Estados Ausencias</a></li>');
                		  	}
		                	if ($_SESSION['TABADMINTCONT'] == '1'){	  	
                		  		echo('<li><a href="admintcont.php" title="Tipo Contrato">Tipo Contrato</a></li>');
                		  	}
                		  	if ($_SESSION['TABADMINCONTS'] == '1'){
                		 		echo('<li><a href="adminconts.php" title="Estados Contratos">Estados Contratos</a></li>');
                		 	}
                		 	if ($_SESSION['TABADMINCONTFIN'] == '1'){
                		 		echo('<li><a href="admincontfin.php" title="Motivo Fin Contrato">Motivo Fin Contrato</a></li>');
                		 	}
	 							if ($_SESSION['TABINST'] == '1'){
     									echo('<li><a href="instalar.php" title="Instalar"> Instalar </a></li>');
    							}
    							if ($_SESSION['TABADMINNOMCON'] == '1'){
     									echo('<li><a href="adminnomconp.php" title="Conceptos Nominas"> Conceptos Nominas </a></li>');
    							}
	 							if ($_SESSION['TABUSERA'] == '1'){
                       			echo('<li class="last"><a href="adminuser.php" title="Usuarios y Permisos">Usuarios y Permisos</a></li>');
                      	}
                 echo('</ul> </li>');
                 }
    			   ?> 			

          		<li><a href="#" title="Preferencias">Preferencias</a>
                	<ul>
                    	<li><a href="index.php" title="Cambiar Password">Cambiar Password</a></li>
                        <li class="last"><a href="login/logout.php" title="Salir">Salir</a></li>
                    </ul>        
                </li>  
          </ul>
        </nav>
   	<script src="menu/js/jquery.js"></script>
		<script>
			(function($){
				
				//cache nav
				var nav = $("#topNav");
				
				//add indicator and hovers to submenu parents
				nav.find("li").each(function() {
					if ($(this).find("ul").length > 0) {
						$("<span>").text("v").appendTo($(this).children(":first"));

						//show subnav on hover
						$(this).mouseenter(function() {
							$(this).find("ul").stop(true, true).slideDown();
						});
						
						//hide submenus on exit
						$(this).mouseleave(function() {
							$(this).find("ul").stop(true, true).slideUp();
						});
					}
				});
			})(jQuery);
		</script>