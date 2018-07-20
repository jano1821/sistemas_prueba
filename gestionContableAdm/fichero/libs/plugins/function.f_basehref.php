<?php
/**
 * Fichero Smarty plugin
 * @package Fichero
 * @subpackage plugins
 */

/**
 * Inny Smarty {f_basehref} function plugin
 *
 * Type: function
 * <br>
 * Name: f_basehref
 * <br>
 * Purpose: Obtiene el host base del sitio
 * <br>
 * Example:
 * <pre>
 *     <base href="{f_basehref}" />
 * </pre>
 *
 * @param array $params parámetros
 * @param Smarty &$smarty instancia de Smarty
 * @return string
 */
################################################################################
function smarty_function_f_basehref($params, &$smarty){
    return Fichero::getBaseHref();
}
################################################################################
?>
