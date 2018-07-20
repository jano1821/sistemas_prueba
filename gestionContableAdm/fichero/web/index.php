<?php

require_once 'common.php';
checkUserLogged();
################################################################################
$smarty = new Smarty();
$smarty->display('listar_personas.tpl');


