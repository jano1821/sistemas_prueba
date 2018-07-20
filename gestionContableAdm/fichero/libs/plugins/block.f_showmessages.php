<?php
/**
 * Fichero Smarty plugin
 * @package Fichero
 * @subpackage plugins
 */

/**
 * Fichero Smarty {f_showmessages} block plugin
 *
 * Type: block
 * <br>
 * Name: f_showmessages
 * <br>
 * Purpose: Muestra mensajes de error, ok y alerta
 * <br>
 * Input:
 * <br>
 * - Opcionales
 *   - type = Tipo de mensaje que se desea mostrar ('ERROR', 'OK' o 'WARNING').
 *           Si no está seteado este parámetro mostrará todos los mensajes, sin importar el tipo.
 * <br>
 * Examples:
 * <pre>
 * {f_showmessages}
 *   {if $f_type == "OK"}
 *     <span class="message_ok">{$f_message}</span>
 *   {elseif $f_type == "ERROR"}
 *     <span class="message_error">{$f_message}</span>
 *   {else}
 *     <span class="message_warning">{$f_message}</span>
 *   {/if}
 * {/f_showmessages}
 *
 * {f_showmessages type="ERROR"}
 *   <span class="message_error">{$f_message}</span>
 * {/f_showmessages}
 * </pre>
 *
 * @param array $params parámetros
 * @param string $content En caso de que la etiqueta sea de apertura, este será null, si la etiqueta es de cierre el valor será del contenido del bloque del template
 * @param Smarty &$smarty instancia de Smarty
 * @param boolean &$repeat es true en la primera llamada de la block-function (etiqueta de apertura del bloque) y false en todas las llamadas subsecuentes
 * @return string
 */
################################################################################
function smarty_block_f_showmessages($params,$content,&$smarty,&$repeat){

    $msgType = null;

    # En caso que pasen el parámetro 'type'
    if(!empty($params['type'])){

        # Convierto en mayúsculas el tipo de error
        $type = strtoupper($params['type']);

        # Verifico que si pasan el parámetro 'type' sea el correcto
        if(!in_array($params['type'],array('OK','WARNING','ERROR'))){
            Fichero::plugin_fatal_error('el parámetro <b>type</b> es incorrecto','f_showmessages');
        }

        # Guardo el tipo de mensaje que debo mostrar
        else{
            $msgType = Fichero::hasMessages($type) ? $type : null;
        }
    }

    # Verifico que haya mensajes cargados para mostrar
    else{
        $msgType = Fichero::hasMessages('ERROR') ? 'ERROR' : (Fichero::hasMessages('OK') ? 'OK' : (Fichero::hasMessages('WARNING') ? 'WARNING' : null ));
    }

    # En caso que no queden mensajes por mostrar
    if ($msgType === null){
        $repeat = false;
        return $content;
    }

    else{

        $f_msgPack = array_shift($GLOBALS['FICHERO_MSGS'][$msgType]);

        # En caso que no queden más mensajes por mostrar en el próximo ciclo del loop
        if(count($GLOBALS['FICHERO_MSGS'][$msgType]) == 0){
            unset($GLOBALS['FICHERO_MSGS'][$msgType]);
        }

        # Seteo el tipo de Mensaje:
        $smarty->assign('f_type',$msgType);
        $f_message = smartyGetConfig($f_msgPack['key'],$smarty);

        # Reemplazo los valores en el arreglo 'replaces' [claves de archivo config]
        if(count($f_msgPack['replaces']) > 0){
            foreach($f_msgPack['replaces'] as $key => $replace){
                $f_message = str_replace($key,smartyGetConfig($replace,$smarty),$f_message);
            }
        }

        # Reemplazo los valores en el arreglo 'constants' [constantes]
        if(count($f_msgPack['constants']) > 0){
            foreach($f_msgPack['constants'] as $key => $constant){
                $f_message = str_replace($key,$constant,$f_message);
            }
        }

        # Asigno al template la cadena resultado
        $smarty->assign('f_message',$f_message);
        $repeat = true;
        return $content;
    }
}
################################################################################
function smartyGetConfig($key,&$smarty){
    $value = $smarty->get_config_vars($key);
    return ($value ? $value : $key);
}
################################################################################
?>
