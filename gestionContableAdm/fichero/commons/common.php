<?php

################################################################################
require_once '../libs/Smarty.class.php';
require_once '../commons/fecha.php';
################################################################################
# Seteo el charset ISO-8859-1 (para request de AJAX)
header('content-type: text/html; charset=iso-8859-1');

# Seteo el locale
setlocale(LC_ALL,'es_AR');

/**
 * Seteo los path para las librerías PEAR
 *
 * @ignore
 */
define ('DB_DATAOBJECT_NO_OVERLOAD',1);
ini_set('include_path', '../pear' . PATH_SEPARATOR . ini_get('include_path'));


/**
 * Clase principal del framework. Principalmente es un container de funciones
 * estáticas.
 *
 * @package Fichero
 */
class Fichero{
    
    /**
     * Esta funcion es llamada para establecer una conexion con la base de datos.
     * Por defecto intenta abrir el ini "../DB.ini.local". Si no lo encuentra,
     * trata de abrir el "../DB.ini".
     *
     * @param string $iniPath path donde se encuentra el DB.ini
     * @static
     * @access public
     * @return void
     */
    public static function openDB($iniPath=null){
        require_once('DB/DataObject.php');
        if($iniPath===null){
            $iniPath='../DB.ini.local';
            if(!file_exists($iniPath)){
                $iniPath = '../DB.ini';
            }
        }
        $config = parse_ini_file($iniPath,TRUE);
        foreach($config as $class=>$values) {
            $options = &PEAR::getStaticProperty($class,'options');
            $options = $values;
        }
    }

    /**
     * Redirige la página a una URL. La función redirige a la URL pasada como parámetro.
     *
     * @param string $url URL a la que deseamos redirigir
     * @static
     * @access public
     * @return void
     */
    public static function redirect($url){
        header("Location: ".$url);
        header("URI: ".$url);
        exit;
    }

    /**
     * Obtiene el nombre de host utilizado en la url llamadora.
     * Ej: si se abre "http://example.com/index.php" esta funcion retorna "example.com"
     *
     * @static
     * @access public
     * @return string
     */
     public static function getHost() {
        return !empty ($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST'];
     }

    /**
     * Corrige la url del navegador para que siempre sea visible la que se desea.
     * Es útil para los casos en que hay más de un nombre de dominio apuntado al mismo sitio.
     * Además elimina los /web/ de las url y el /index.php para que los motores de búsqueda interpreten mejor el sitio.
     * Retorna false si el script fue llamado desde consola (no hay host involucrado)
     * Retorna true si no fue necesario corregir la url
     * Llama a Fichero::redirect si es necesario corregir la url del navegador
     *
     * @param string $desiredHost Nombre de host que se desea utilizar
     * @param array $allowedHosts Lista de nombres de host adicionales permitidos
     * @static
     * @access public
     * @return boolean
     */
    public static function fixUrl($desiredHost=null,$allowedHosts=array()){
        $httpHost = self::getHost();
        $httpArr = explode(':',$httpHost);
        $httpHost = $httpArr[0];

        if(empty($httpHost)){
            return false;
        }
        if(!empty($_POST) && count($_POST) > 0){
            return false;
        }
        if($desiredHost===null){
            $iniPath='../HOST.ini.local';
            if(!file_exists($iniPath)){
                $iniPath = '../HOST.ini';
            }
            if(file_exists($iniPath)){
                $hostPref=parse_ini_file($iniPath);
                $desiredHost=trim($hostPref['desired_host']);
                $allowedHosts=explode(",",str_replace("\t",'',str_replace(' ','',$hostPref['allowed_hosts'])));
            }
        }

        if($desiredHost!=null && $desiredHost!=$httpHost){
            $exists=false;
            $domainArr=explode('.',$httpHost,2);
            if(!empty($domainArr[1])){
                $domain='.'.$domainArr[1];
            }else{
                $domain=null;
            }
            foreach ($allowedHosts as $allowedHost){
                if($allowedHost == ''){
                    continue;
                }
                if( $httpHost==$allowedHost || ( $allowedHost[0]=='.' && $domain==$allowedHost ) ){
                    $exists=true;
                    break;
                }
            }
            if(!$exists){
                self::redirect("http://" . $desiredHost . $_SERVER['REQUEST_URI']);
            }
        }
        if($_SERVER['REQUEST_URI']=='/web/index.php' || $_SERVER['REQUEST_URI']=='/index.php'){
            self::redirect('http://'.$httpHost.'/');
        }
        if(strpos($_SERVER['REQUEST_URI'],'/web/')===0){
            self::redirect('http://'.$httpHost.substr($_SERVER['REQUEST_URI'],4,strlen($_SERVER['REQUEST_URI'])));
        }
        return true;
    }

    /**
     * Chequea que la dirección de mail pasada como parámetro tenga formato
     * correcto.
     *
     * @param string $email dirección de email
     * @static
     * @access public
     * @return boolean
     */
    public static function hasEmailFormat($email){
        return preg_match ( '/^[A-Z0-9._%\-]+@[A-Z0-9._%\-]+\.[A-Z]{2,4}$/i', $email);
    }

    /**
     * DEPRECADA: Obtiene la URL base del proyecto. Era util hasta que llego getBaseHref.
     * @deprecated 
     * @static
     * @access public
     * @return string
     */
    public static function getBaseUrl(){
        return Fichero::getBaseHref();
    }

    /**
     * Retorna la URL base del proyecto: Muy util para hacer el link al home en lugar de index.php,
     * para implementar el plugin f_basehref, para indicar el base href de un sitio, para
     * concatenar a las canonicals de un sitio, para colocar delante de un link javascript, etc. 
     * Contempla el caso de desarrollo en localhost vs. producción sin problemas. 
     * Con la primer llamada, cachea el resultado en una variable global para ahorrar procesamiento
     * en llamadas posteriores. 
     *
     * @static
     * @access public
     * @return string
    */
     public static function getBaseHref(){
        global $F_GET_BASE_HREF;
        if(!empty($F_GET_BASE_HREF)) return $F_GET_BASE_HREF;
        $link=!empty($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:$_SERVER['SCRIPT_NAME'];
        $link=str_replace('\\',"/",$link);
        if($link[strlen($link)-1]!='/'){
            $link=dirname($link);
            $link=str_replace('\\',"/",$link );
            if($link[strlen($link)-1]!='/'){
                $link.='/';
            }
        }
        $arr=explode("/web/",$link);
        $arr=explode("/index.php/",$arr[0]);
        $link='http://'.Fichero :: getHost().$arr[0];
        if($link[strlen($link)-1]!='/'){
            $link.='/';
        }
        return $F_GET_BASE_HREF=$link;
    }

    /**
     * Inicia la sesión del usuario.
     *
     * @static
     * @access public
     * @return void
     */
    public static function sessionStart(){
        if(session_id()==null){
            session_start();
        }
    }

    /**
     * Finaliza la sesión del usuario.
     *
     * @static
     * @access public
     * @return void
     */
    public static function sessionDestroy(){
        if(session_id()!=null){
            session_destroy();
        }
    }

     /**
     * Define el tiempo de timeout de la seccion.
     *
     * @static
     * @access public
     * @return void
     */
    public static function sessionTimeout($timeout = 0){
        if (empty($timeout)) return;
        // Controlo el tiempo de vida de la session. Si pasan X minutos, definidos en la constante SESSION_TIMEOUT, se reinicia la sección.
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
            Fichero::sessionDestroy();
            session_unset();     
            Fichero::sessionStart();
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    
    /**
     * Indica que el resultado no debe ser cacheado.
     *
     * @static
     * @access public
     * @return void
     */
    public static function noCache(){
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0',false);
        header('Pragma: no-cache',false);
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT',false);
    }

    /**
     * Devuelve la fecha actual en un string con el formato "año-mes-dia".
     *
     * @static
     * @access public
     * @return string
     */
    public static function curDate(){
        return date('Y-m-d');
    }

    /**
     * Devuelve la hora actual en un string con el formato "hora-minutos-segundos".
     *
     * @static
     * @access public
     * @return string
     */
    public static function curTime(){
        return date('H:i:s');
    }

    /**
     * Devuelve fecha y hora actual en un string con el formato TIMESTAMP.
     *
     * @static
     * @access public
     * @return string
     */
    public static function curTimestamp(){
        return date('Y-m-d H:i:s');
    }

    /**
     * Se le pasa un una cantidad de segundos y lo devuelve en un string
     * con el formato "#dias, #horas.#min:#seg".
     *
     * @param integer $secs cantidad de segundos
     * @static
     * @access public
     * @return string
     */
    public static function secsToDate($secs){
        $segundos=$secs%60;
        $secs=(int)($secs/60);
        $minutos=$secs%60;
        $secs=(int)($secs/60);
        $horas=$secs%24;
        $secs=(int)($secs/24);
        $dias=$secs%24;
        if($dias==0){
            $dias='';
        }else{
            $dias=$dias.' dias, ';
        }
        if($segundos<10){
            $segundos='0'.$segundos;
        }
        if($dias=='' && $horas==0){
            $horas='';
        }else{
            $horas=$horas.':';
        }
        if($horas!='' && $minutos<10){
            $minutos='0'.$minutos;
        }

        return $dias.$horas.$minutos.':'.$segundos;
    }

    /**
     * Resume un texto. Se le pasa un texto, un tamaño deseado y un
     * forma de terminación (por defecto ...), y toma solo la cantidad de
     * caracteres indicados del comienzo el texto, y le agrega la forma de
     * terminación.
     *
     * @param string $text texto a comprimir
     * @param integer $length cantidad de caracteres a tomar, por defecto 25
     * @param string $endWith forma de terminación, por defecto "..."
     * @static
     * @access public
     * @return string
     */
    public static function summaryText($text,$length=25,$endWith='...'){
        if (strlen($text)<=$length){
            return $text;
        }
        $length = $length-strlen($endWith);
        return substr($text,0,$length).$endWith;
    }

	/**
     * Calcula las dimensiones para crear la imagen con createImage.
     *
     * @param integer $realWidth alto de la imagen
     * @param integer $realHeight ancho de la imagen
     * @param integer $width nuevo alto de la imagen
     * @param integer $height nuevo ancho de la imagen
     * @param bool $crop activa el modo crop
     * @static
     * @access private
     * @return array
     */
    private static function calculateImageDimensions($realWidth,$realHeight,$width,$height,$crop){
        if(!$width && !$height){
            # asigno valores por defecto
            return array('width' => 60, 'height' => 60,'sx'=>0,'sy'=>0,'sw'=>$realWidth,'sh'=>$realHeight);
        }
        # En caso que sólo esté seteado el ancho
        if(!$height){
            $height = (int)(($realHeight * $width) / $realWidth);
            return array('width' => $width, 'height' => $height,'sx'=>0,'sy'=>0,'sw'=>$realWidth,'sh'=>$realHeight);
        }

        # En caso que sólo esté seteado el alto
        if(!$width){
            $width = (int)(($realWidth * $height) / $realHeight);
            return array('width' => $width, 'height' => $height,'sx'=>0,'sy'=>0,'sw'=>$realWidth,'sh'=>$realHeight);
        }

        # Si el alto y ancho de la imagen real son menores que los dados no hago nada
        if (($realHeight < $height)&& ($realWidth < $width)){
            return array('width' => $realWidth, 'height' => $realHeight,'sx'=>0,'sy'=>0,'sw'=>$realWidth,'sh'=>$realHeight);
        }
    	
        # Determino las proporciones del ancho y alto
    	$propWidth = $width/$realWidth;
    	$propHeight = $height/$realHeight;
    			
    	# Escalo la imagen segun la proporcion mas chica
        $esVertical=$propWidth <= $propHeight;
    	if( ($esVertical && !$crop) || (!$esVertical && $crop) ){
            $prop=$propWidth;
        }else{
            $prop=$propHeight;
        }
    	$w = $realWidth * $prop;
    	$h = $realHeight * $prop;
        if($crop) {
            $sx=($w-$width)/2/$prop;
            $sy=($h-$height)/2/$prop;
            return array('width' => $width, 'height' => $height,'sx'=>(int)$sx,'sy'=>(int)$sy,'sw'=>$realWidth-(int)(2*$sx),'sh'=>$realHeight-(int)(2*$sy));
        }
        return array('width' => $w, 'height' => $h,'sx'=>0,'sy'=>0,'sw'=>$realWidth,'sh'=>$realHeight);
    }

   /**
     * Crea una imagen a partir de otra. Retorna una imagen redimensionada al
     * tamaño y calidad indicado.
     *
     * @param image $image imagen a modificar
     * @param integer $width nuevo alto de la imagen
     * @param integer $height nuevo ancho de la imagen
     * @param integer $quality calidad deseada de la imagen
     * @param string $mimeType mime del archivo (opcional)
     * @param bool $crop activa el modo crop (por defecto false)
     * @static
     * @access public
     * @return image
     */
    public static function createImage(&$image,$width=null,$height=null,$quality=100,$mimeType=null,$crop=false){
        if($mimeType==null) $mimeType='image/jpeg';
        $image_path  = tempnam('directorio que no existe','LMS');
        $temp = tempnam('directorio que no existe','LMS');

        # Creo un archivo temporal con la imagen sacada de la base de datos
        $file = fopen($image_path,"w+");
        fwrite($file,$image);
        fclose($file);

        # Obtengo alto y ancho de la imagen
        # width: $datos[0]
        # height: $datos[1]
        $datos = getimagesize($image_path);
        $realWidth  = $datos[0];
        $realHeight = $datos[1];

        $dim=Fichero::calculateImageDimensions($realWidth,$realHeight,$width,$height,$crop);
        $width=$dim['width'];
        $height=$dim['height'];

        # Creo una imagen con el nuevo tamaño
        switch($mimeType){
        	case 'image/jpeg':
        	case 'image/pjpeg':
                $img = imagecreatefromjpeg($image_path);
                $thumb = imagecreatetruecolor($width,$height);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($image_path);
                $thumb = imagecreatetruecolor($width,$height);
                break;
            case 'image/png':
                $thumb = imagecreatetruecolor($width,$height);
                imagealphablending($thumb, false);
                imagesavealpha($thumb, true);  
                $img = imagecreatefrompng($image_path);
                imagealphablending($img, true);
                break;
            default:
                # En caso que el mime no esté soportado
                self::fatalError('El mime ('.$mimeType.') no es soportado para imágenes.');
        }

        # Copio la imagen original a la nueva cambiando el tamaño al nuevo
        imagecopyresampled($thumb,$img,0,0,$dim['sx'],$dim['sy'],$width,$height,$dim['sw'],$dim['sh']);

        # Creo y guardo la imagen en un archivo temporal
        switch($mimeType){
        	case 'image/jpeg':
        	case 'image/pjpeg': imagejpeg($thumb,$temp,$quality); break;
            case 'image/gif':   imagegif($thumb,$temp,$quality);  break;
            case 'image/png':
                $pngQuality = ($quality - 100) / (100/9); //Compresión PNG: 0 (sin comprimir) a 9. 
                $pngQuality = round(abs($pngQuality));
                imagepng($thumb,$temp,$pngQuality,PNG_ALL_FILTERS);
                break;
        }

        # retorno la imagen con el nuevo tamaño
        $foto = file_get_contents($temp);
        unlink($temp);        //delete($temp)
        unlink($image_path);  //delete($image_path)
        return $foto;
    }

    /**
     * Remueve un valor de un arreglo. Notar que esta función modifica el arreglo.
     *
     * @param string $value valor que remover
     * @param array $array arreglo en donde remover el valor
     * @static
     * @access public
     * @return boolean
     */
    public static function array_remval($value,&$array){
        $key = array_search($value,$array);
        if($key === false){
            return false;
        }
        unset($array[$key]);
        return true;
    }

    /**
     * Retorna una arreglo con sus claves renombradas a minúscula. El arreglo que
     * es recibido por parámetro no es modificado.
     *
     * @param array $array arreglo que tiene las claves
     * @static
     * @access public
     * @return array
     */
    public static function arrayChangeKeysToLowerCase($array){
        $result = array();
        foreach($array as $key => $value){
            $result[strtolower($key)] = is_array($value) ? self::arrayChangeKeysToLowerCase($value) : $value;
        }
        return $result;
    }

    /**
     * Indica si una variable es un entero.
     *
     * @param string $x numero que chequear
     * @static
     * @access public
     * @return boolean
     */
    public static function isInt($x){
        return (is_numeric($x) ? intval($x) == $x : false);
    }

    /**
     * Obtiene el bloque padre que contiene al actual tag.
     *
     * @param Smarty $smarty smarty donde aplicar la funcion
     * @param string $tag tag del cual quiere conocerse su padre
     * @static
     * @access public
     * @return string
     */
    public static function getSmartyParentTag(&$smarty,$tag){
        for($i = count($smarty->_tag_stack); $i >= 0; $i--){
            if(substr($smarty->_tag_stack[$i][0],0,strlen($tag)) == $tag){
                return self::toValidTagName($smarty->_tag_stack[$i][1]['name']);
            }
        }
        return null;
    }

    /**
     * Termina la ejecución de un script mostrando un mensaje de error.
     * Por lo general, se usa cuando en un plugin falta algún parámetro o su
     * valor es incorrecto.
     *
     * @param string $message mensaje de error que mostrar
     * @param string $plugin_name nombre del plugin que lanza el error
     * @static
     * @access public
     * @return void
     */
    public static function plugin_fatal_error($message,$plugin_name){
        trigger_error('Fichero error [in plugin: <b>'.$plugin_name.'</b>]: '.$message,E_USER_ERROR);
        exit;

    }

    /**
     * Agrega un mensaje para mostrar luego en el template. Los mensajes son
     * mostrados con el plugin Smarty f_showmessages. los arreglos replaces y
     * constantsse se utilizan cuando el texto del mensaje se obtiene desde un
     * archivo de configuraciones.
     *
     * @param string $type tipo de mensaje
     * @param string $key mensaje que se mostrará
     * @param array $replaces
     * @param array $constants
     * @static
     * @access public
     * @return void
     */
    public static function addMessage($type,$key,$replaces=array(),$constants=array()){
        if(!isset($GLOBALS['FICHERO_MSGS'])){
            $GLOBALS['FICHERO_MSGS'] = array();
        }
        if(!isset($GLOBALS['FICHERO_MSGS'][$type])){
            $GLOBALS['FICHERO_MSGS'][$type] = array();
        }
        $GLOBALS['FICHERO_MSGS'][$type][] = array('key'=>$key,'replaces'=>$replaces,'constants'=>$constants);
    }

    /**
     * Agrega un mensaje de ok para mostrar luego en el template
     *
     * @param string $key mensaje que se mostrará
     * @param array $replaces
     * @param array $constants
     * @see Fichero::addMessage()
     * @static
     * @access public
     * @return void
     */
    public static function addOkMessage($key,$replaces=array(),$constants=array()){
        self::addMessage('OK',$key,$replaces,$constants);
    }

    /**
     * Agrega un mensaje de error para mostrar luego en el template
     *
     * @param string $key mensaje que se mostrará
     * @param array $replaces
     * @param array $constants
     * @see Fichero::addMessage()
     * @static
     * @access public
     * @return void
     */
    public static function addErrorMessage($key,$replaces=array(),$constants=array()){
        self::addMessage('ERROR',$key,$replaces,$constants);
    }

    /**
     * Agrega un mensaje de alerta para mostrar luego en el template
     *
     * @param string $key mensaje que se mostrará
     * @param array $replaces
     * @param array $constants
     * @see Fichero::addMessage()
     * @static
     * @access public
     * @return void
     */
    public static function addWarningMessage($key,$replaces=array(),$constants=array()){
        self::addMessage('WARNING',$key,$replaces,$constants);
    }

    /**
     * Retorna si hay mensajes de algún tipo
     *
     * @param string $type tipo de mensaje
     * @return boolean
     * @see Fichero::addMessage()
     * @static
     * @access public
     * @return void
     */
    public static function hasMessages($type){
        return (isset($GLOBALS['FICHERO_MSGS'][$type]) && count($GLOBALS['FICHERO_MSGS'][$type]) > 0);
    }

    /**
     * Indica si se han agregado mensajes de ok.
     *
     * @see Fichero::hasMessages()
     * @static
     * @access public
     * @return boolean
     */
    public static function hasOkMessages(){
        return self::hasMessages('OK');
    }

    /**
     * Indica si se han agregado mensajes de error.
     *
     * @see Fichero::hasMessages()
     * @static
     * @access public
     * @return boolean
     */
    public static function hasErrorMessages(){
        return self::hasMessages('ERROR');
    }

    /**
     * Indica si se han agregado mensajes de alerta.
     *
     * @see Fichero::hasMessages()
     * @static
     * @access public
     * @return boolean
     */
    public static function hasWarningMessages(){
        return self::hasMessages('WARNING');
    }

    /**
     * Muestra un stream, creando un archivo temporal en el server.
     *
     * @param string &$content bloque que se desea mostrar
     * @param string $name nombre que se le dará al archivo temporal
     * @param string $mime mime del bloque
     * @static
     * @access public
     * @return void
     * @deprecated
     */
    public static function displayStream(&$stream,$name,$mime){
        require_once 'HTTP/Download.php';
        $dl = new HTTP_Download();
        $dl->setData($stream);
        $imgTmpName = 'temporal_content_'.$name;

        # Para que no cachee
        $dl->headers['Pragma'] = 'no-cache';
        $dl->headers['Cache-Control'] = 'no-store, no-cache, must-revalidate';
        $dl->headers['Expires'] = 'Mon, 26 Jul 1997 05:00:00 GMT';

        $dl->setContentDisposition(HTTP_DOWNLOAD_INLINE,$imgTmpName);
        $dl->setBufferSize(1024*80); // 100 K
        $dl->setThrottleDelay(1); // 1 sec
        $dl->setContentType($mime);
        $dl->send();
        exit(0);
    }

    /**
     * Verifica si una variable es un número flotante o entero válido
     *
     * @param string $float número flotante que verificar
     * @static
     * @access public
     * @return boolean
     */
    public static function isFloat($float){
        $regex = '/^(\-)?((\d+(\.\d*)?)|((\d*\.)?\d+))$/';
        return preg_match($regex,$float);
    }

    /**
     * Muestra un error y corta la ejecución
     *
     * @param string $message mensaje de error
     * @static
     * @access public
     * @return void
     */
    public static function fatalError($message){
        trigger_error('Fichero error: '.$message,E_USER_ERROR);
        exit;
    }

    /**
     * Retorna si una URL existe
     *
     * @param $string $url url
     * @author stuart
     * @link http://ar.php.net/manual/es/function.file-exists.php#84918
     * @static
     * @access public
     * @return boolean
     */
    public static function url_exists($url) {
        $hdrs = @get_headers($url);
        return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
    }

    /**
     * Aplica el trim, modificando el arreglo de caracteres permitidos
     *
     * @param string $string cadena a la cual aplicar el trim
     * @link http://ar.php.net/manual/es/function.trim.php
     * @link http://ar2.php.net/html_entity_decode
     * @static
     * @access public
     * @return string
     */
    public static function trim($string){

        # Listado de caracteres que eliminará el trim.
        # Sólamente fué agregado el caracter ASCII 160
        #
        # Descripción de los caracteres
        # ASCII 32 (0x20): un espacio en blanco.
        # ASCII 9 (0x09): un tabulador.
        # ASCII 10 (0x0A): una nueva linea.
        # ASCII 13 (0x0D): un retorno de carro.
        # ASCII 0 (0x00): el byte NULL.
        # ASCII 11 (0x0B): un tabulador vertical.
        # ASCII 160 (0xA0): al aplicar html_entity_decode, los espacios (&nbsp;) los reemplaza por ASCII 160 (0xa0) y no por ASCII 32 (0x20), debido a que usa el charset ISO 8859-1
        $charlist = "\x20\x09\x0A\x0D\x00\x0B\xA0";

        # Retorno el trim, usando el listado de caracteres
        return trim($string,$charlist);
    }

    /**
     * Convierte todos los caracteres de una cadena de texto a minúsculas
     *
     * @param string $string cadena de texto
     * @param string $charset charset
     * @static
     * @access public
     * @return string cadena de texto con todos los caracteres en minúsculas
     */
    public static function lower($string, $charset = 'ISO-8859-1'){
        return mb_convert_case($string,MB_CASE_LOWER,$charset);
    }

    /**
     * Convierte todos los caracteres de una cadena de texto a mayúsculas
     *
     * @param string $string cadena de texto
     * @param string $charset charset
     * @static
     * @access public
     * @return string cadena de texto con todos los caracteres en mayúsculas
     */
    public static function upper($string, $charset = 'ISO-8859-1'){
        return mb_convert_case($string,MB_CASE_UPPER,$charset);
    }

    /**
     * Pasa a mayúsculas la primera letra de cada palabra en cadena si dicho carácter es alfabético.
     *
     * @param string $string cadena que capitalizar
     * @param string $charset charset
     * @static
     * @access public
     * @return string
     */
    public static function capitalize($string, $charset = 'ISO-8859-1'){
        return mb_convert_case($string,MB_CASE_TITLE,$charset);
    }

    /**
     * Convierte a mayúscula el primer caracter de una cadena de texto
     *
     * @param string $string cadena que capitalizar
     * @param string $charset charset
     * @static
     * @access public
     * @return string cadena de texto con el primer caracter en mayúscula
     * @link http://docs.php.net/manual/en/function.ucfirst.php#84122
     */
    public static function ucfirst($string, $charset = 'ISO-8859-1'){
        return mb_strtoupper(mb_substr($string,0,1,$charset)).mb_substr($string,1,mb_strlen($string),$charset);
    }

    /**
     * Decodifica texto codificado con la función encodeURIComponent de javascript
     * Es útil para decodificar texto enviado vía ajax
     *
     * @param string $string cadena de texto
     * @static
     * @access public
     * @return string texto codificado con la función encodeURIComponent de javascript decodificado
     */
    public static function decodeURIComponent($string){
        return utf8_decode(rawurldecode($string));
    }

    /**
     * Codifica a UTF-8 los elementos de un arreglo
     *
     * @param array &$elem arreglo que codificar
     * @static
     * @access public
     * @return void
     */
    public static function arrayUtf8Encode(&$elem,$k=null){
        if(is_array($elem)){
            array_walk($elem,array('Fichero','arrayUtf8Encode'));
            return;
        }
        $elem=utf8_encode($elem);
    }

    /**
     * Decodifica a UTF-8 los elementos de un arreglo
     *
     * @param array &$elem arreglo que decodificar
     * @static
     * @access public
     * @return void
     */
    public static function arrayUtf8Decode(&$elem, $k=null){
        if(is_array($elem)){
            array_walk($elem,array('Fichero','arrayUtf8Decode'));
            return;
        }
        $elem = utf8_decode($elem);
    }

    /**
     * Convierte una URL a friendly URL
     *
     * @param string $string URL
     * @static
     * @access public
     * @return string friendly URL
     */
    public static function str_to_friendlyUrl($string){
        $string = strip_tags(str_replace(array("\r","\t","\n",'"',"'"," ","","","&","`","Ž","?","¿","%","/"),'-',$string));
        return Fichero::removeAccents(preg_replace('/[\-]{2,}/','-',$string));
    }

    /**
     * Obtiene un archivo de cache
     *
     * @param string $url URL
     * @param string $filename nombre de archivo
     * @param string $cache_time duración de la cache en segundos (default: 15 minutos)
     * @static
     * @access public
     * @return string contenido del archivo
     */
    public static function getCachedContent($url,$filename,$cache_time=900){
        $cache_file = 'templates_c/'.$filename.'.curl';
        if(!file_exists($cache_file) || (time()-filemtime($cache_file)) > $cache_time){
            file_put_contents($cache_file,file_get_contents($url));
        }
        return file_get_contents($cache_file);
    }

    /**
     * Valida que la IP pasada por parámetro posea un formato válido.
     * 
     * @param string $ip la IP que se desea validar.
     * @static
     * @access public
     * @return boolean
     */
    public static function validIP($ip) {
        if (!empty($ip) && ip2long($ip) != -1) {
            $reserved_ips = array (
                array('0.0.0.0','2.255.255.255'),
                array('10.0.0.0','10.255.255.255'),
                array('127.0.0.0','127.255.255.255'),
                array('169.254.0.0','169.254.255.255'),
                array('172.16.0.0','172.31.255.255'),
                array('192.0.2.0','192.0.2.255'),
                array('192.168.0.0','192.168.255.255'),
                array('255.255.255.0','255.255.255.255')
            );  
            foreach ($reserved_ips as $r) {
                $min = ip2long($r[0]);
                $max = ip2long($r[1]);
                if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
            }
            return true;
        } else {
            return false;
        }
    }   

    /**
     * Obtiene la IP desde donde se está accediendo al sistema.
     * 
     * @param boolean $allowForwardedHeader indica si debe considerarse HTTP_X_FORWARDED_FOR
     * @static
     * @access public
     * @return string IP desde donde se accede
     */
    public static function getIP($allowForwardedHeader = true) {
        if (isset($_SERVER["HTTP_CLIENT_IP"]) && Fichero::validIP($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        if ($allowForwardedHeader) {
    	    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    	        foreach (explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
    	            if (Fichero::validIP(trim($ip))) {
    	                return $ip;
    	            }
    	        }
    	    }
    	    if (isset($_SERVER["HTTP_X_FORWARDED"]) && Fichero::validIP($_SERVER["HTTP_X_FORWARDED"])) {
    	        return $_SERVER["HTTP_X_FORWARDED"];
    	    } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]) && Fichero::validIP($_SERVER["HTTP_FORWARDED_FOR"])) {
    	        return $_SERVER["HTTP_FORWARDED_FOR"];
    	    } elseif (isset($_SERVER["HTTP_FORWARDED"]) && Fichero::validIP($_SERVER["HTTP_FORWARDED"])) {
    	        return $_SERVER["HTTP_FORWARDED"];
    	    } elseif (isset($_SERVER["HTTP_X_FORWARDED"]) && Fichero::validIP($_SERVER["HTTP_X_FORWARDED"])) {
    	        return $_SERVER["HTTP_X_FORWARDED"];
    	    }
        }
        return $_SERVER["REMOTE_ADDR"];
    }

    /**
     * Valida que la IP desde donde se accede al sistema sea una IP permitida, de no ser
     * así se realiza un "Forbidden".
     *
     * @param string $validIPs contiene las IP's válidas, definidas por rangos, de acceder
     * al sistema. Si no está definida esta variable se buscará el grupo de IP's válidas
     * en la configuración "ip-access-filter".
     * @static
     * @access public
     * @return NULL
     */
    public static function accessFilter($validIPs = null) {

        # Se obtiene la IP actual y si se trata de localhost se finaliza la función.
        $actualIP = Fichero::getIP(false);
        if (empty($actualIP) || $actualIP == '127.0.0.1') return;
    	$actualIPLong = ip2long($actualIP);

        # Si no se definieron las IP's válidas por parámetro, se intenta recuperarlas
        # desde la configuración correspondiente.
    	if ($validIPs === null) {
            $validIPs = Fichero::getConfig('ip-access-filter');
    	}

    	# Si la IP se encuentra habilitada, se finaliza la función.
        foreach (explode(',', $validIPs) as $ip) {
        	$range = explode('/', $ip);
        	if (!isset($range[1])) { $range[1] = 32; }
        	$rangeLong = ip2long($range[0]);
       		$netmask_dec = bindec(str_pad('', $range[1], '1').str_pad('', 32-$range[1], '0'));
    		if (($actualIPLong & $netmask_dec) == ($rangeLong & $netmask_dec)) return; 
        }

        # Si se llega hasta este punto se realiza un exit para impedir de continuar.
        header('HTTP/1.0 403 Forbidden');
        exit;
    }


    /**
     * Retorna un texto sin acentos ni eñes.
     * 
     * @param string $cadena el string a procesar
     * @static
     * @access public
     * @return string la cadena sin acentos ni eñes
     */
    public static function removeAccents($cadena){
    	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
    	$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
		if(mb_check_encoding($cadena,'UTF-8')){
		    return utf8_encode(strtr(utf8_decode($cadena),$tofind,$replac));
		}
    	return(strtr($cadena,$tofind,$replac));
    }

    /**
     * Ofusca un texto y lo muestra por javascript - Sirve para que los spiders (o google) no vean unt exto en una web.
     *
     * @param string $string texto a ofuscar
     * @static
     * @access public
     * @return string
     */
    public static function jsHide($string){
        if(strlen($string)==0) return '';
        $charcode=ord($string[0]);
        for($i=1; $i<strlen($string); $i++){
            $charcode.=','.ord($string[$i]);
        }
        return '<script type="text/javascript">document.write(String.fromCharCode('.$charcode.'));</script>';
    }

   /**
    * Permite llevar facilmente un tracking del tiempo de ejecucion de un script PHP.
    * Cada timer o tracker se identifica con un nombre (el primer parametro, siempre presente).
    * Se debe ejecutar la primera vez siempre de la forma Fichero::timeTrack('NOMBRE DEL TIMER'); para inicializar
    * el timer y luego, se lo llama de la forma Fichero::timeTrack('NOMBRE DEL TIMER','Accion realizada'); para
    * obtener el tracking de cada accion.
    * Retorna el texto del tracking (NO LO MUESTRA POR PANTALLA).
	* Tambien muestra cuanta memoria consume el script.
    *
    * @param string $name Nombre del timer
    * @param string $msg Accion realizada en cada paso del timer
    * @static
    * @access public
    * @return string
    */
    public static function timeTrack($name,$msg=null){
        $mt=microtime(true);
        global $F_TIME_TRACK;
        if(!isset($F_TIME_TRACK)) $F_TIME_TRACK=array();
        if($msg==null){
            $F_TIME_TRACK[$name.'-init']=$F_TIME_TRACK[$name.'-last']=$mt;
            return '';
        }
        $res=sprintf("TimeTrack '$name' [Partial: %.4f - Total: %.4f - Mem: %.2fMB] - $msg\n",$mt-$F_TIME_TRACK[$name.'-last'],$mt-$F_TIME_TRACK[$name.'-init'],memory_get_usage(true)/(1024*1024));
        $F_TIME_TRACK[$name.'-last']=$mt;
        return $res;
    }
}

/**
 * SI ESTAN LAS MAGIC QUOTES DE PHP SE LAS DESACTIVO
 *
 * @ignore
 */
if (get_magic_quotes_gpc()) {

    set_magic_quotes_runtime(0);
    function stripslashes_array($data) {
       if (is_array($data)){
           foreach ($data as $key => $value){
               $data[$key] = stripslashes_array($value);
           }
           return $data;
       }else{
           return stripslashes($data);
       }
    }

   $_SERVER = stripslashes_array($_SERVER);
   $_GET = stripslashes_array($_GET);
   $_POST = stripslashes_array($_POST);
   $_COOKIE = stripslashes_array($_COOKIE);
   $_ENV = stripslashes_array($_ENV);
   $_REQUEST = stripslashes_array($_REQUEST);
   $HTTP_SERVER_VARS = stripslashes_array($HTTP_SERVER_VARS);
   $HTTP_GET_VARS = stripslashes_array($HTTP_GET_VARS);
   $HTTP_POST_VARS = stripslashes_array($HTTP_POST_VARS);
   $HTTP_COOKIE_VARS = stripslashes_array($HTTP_COOKIE_VARS);
   $HTTP_ENV_VARS = stripslashes_array($HTTP_ENV_VARS);
   if (isset($_SESSION)) {    #These are unconfirmed (?)
       $_SESSION = stripslashes_array($_SESSION, '');
       $HTTP_SESSION_VARS = stripslashes_array($HTTP_SESSION_VARS, '');
   }
}

# Se corrigen URLs
Fichero::fixUrl();

# Se abre la DB
Fichero::openDB();

################################################################################

