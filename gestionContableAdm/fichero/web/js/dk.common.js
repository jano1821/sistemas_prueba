/**
 * Funciones comunes
 *
 * @version 0.1
 */

/**
 * Agrega el m�todo trim a la clase String
 *
 * @addon
 */
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

/**
 * Agrega el m�todo capitalize a la clase String
 *
 * @ author Jonas Raoni Soares Silva
 * @link http://jsfromhell.com/string/capitalize [v1.0]
 * @version v1.0
 */
String.prototype.capitalize = function(){
    return this.replace(/^\w/, function($0) { return $0.toUpperCase(); })
}

/**
 * Verifica que el mail tenga formato v�lido
 *
 * @param {String} email direcci�n de email
 * @return resultado resultado de la verificaci�n
 * @type Boolean
 */
function hasEmailFormat(email){
    var emailReg = /^[a-z][a-z-_0-9\.]+@[a-z-_=>0-9\.]+\.[a-z]{2,3}$/i;
    return emailReg.test(email);
}

/**
 * Muestra un mensaje de confirmaci�n. En caso de aceptar, redirige a una URL.
 *
 * @param {String} message mensaje que mostrar� el confirm
 * @param {String} url URL hacia donde se dirigir� en caso de aceptar el confirm
 */
function confirmAction(message,url){
    if (confirm(message)){
        window.location.href = url;
    }
}

/**
 * Abre una p�gina en un popup
 *
 * @param {String} desktopURL url que abrir� en el popup
 * @param {Number} ancho ancho del popup
 * @param {Number} alto alto del popup
 * @param {String} resizable indica si ser� redimensionable [1|0]
 * @param {String} scrollbars indica si tendr� scrollbars [1|0]
 * @param {String} target nombre del target
 */
function popUp(desktopURL,ancho,alto,resizable,scrollbars,target){
    var x = parseInt((window.screen.width - ancho)/2);
    var y = parseInt((window.screen.height - alto)/2);
    var desktop = window.open(desktopURL,target, "left="+x+",top="+y+",width="+ancho+",height="+alto+",scrollbars="+scrollbars+",resizable="+resizable+"");
}

/**
 * Se usa para los links con im�genes que cambian en el onmouseover
 *
 * @param {String} flag id de la imagen
 * @param {Object} img imagen
 */
function permutImage(flag,img){
    if (document.images){
        if (document.images[img].permloaded){
            if (flag==1){
                document.images[img].src = document.images[img].perm.src;
            }else{
                document.images[img].src = document.images[img].perm.oldsrc;
            }
        }
    }
}

/**
 * Se usa para los links con im�genes que cambian en el onmouseover
 *
 * @param {Object} img imagen
 * @param {String} src src de la imagen que mostrar� en el evento mouseover
 */
function preLoadPermut(img,src){
    if (document.images){
        img.onload = null;
        img.perm = new Image();
        img.perm.oldsrc = img.src;
        img.perm.src = src;
        img.permloaded = true;
    }
}

/**
 * Crea el objeto para los request de AJAX
 *
 * @return objecto xmlhttp para obtener/manipular los request ajax
 * @type Object
 */
function initAjax(){


    var xmlHttp;

    // Firefox, Opera 8.0+, Safari
    try{
        xmlHttp = new XMLHttpRequest();
    }

    // Internet Explorer
    catch(e){
        try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                return false;
            }
        }
    }
    return xmlHttp;
}

/**
 * Setea una cookie
 *
 * @param {String} name nombre de la cookie
 * @param {String} value valor de la cookie
 * @param {String} expires d�as que durar� la cookie
 * @param {String} path ni idea
 * @param {String} domain ni idea
 * @param {String} secure ni idea
 */
function setCookie( name, value, expires, path, domain, secure ){
    // set time, it's in milliseconds
    var today = new Date();
    today.setTime( today.getTime() );

    /*
    if the expires variable is set, make the correct
    expires time, the current script below will set
    it for x number of days, to make it for hours,
    delete * 24, for minutes, delete * 60 * 24
    */
    if (expires){
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date( today.getTime() + (expires) );

    document.cookie = name + "=" +escape( value ) +
    ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
    ( ( path ) ? ";path=" + path : "" ) +
    ( ( domain ) ? ";domain=" + domain : "" ) +
    ( ( secure ) ? ";secure" : "" );
}

/**
 * Retorna una cookie
 *
 * @param {String} check_name nombre de la cookie.
 * @return cookie
 * @type Object
 */
function getCookie( check_name ) {
	// first we'll split this cookie up into name/value pairs
	// note: document.cookie only returns name=value, not the other components
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false; // set boolean t/f default f

	for(i = 0; i < a_all_cookies.length; i++){
		// now we'll split apart each name=value pair
		a_temp_cookie = a_all_cookies[i].split( '=' );
		// and trim left/right whitespace while we're at it
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');

		// if the extracted name matches passed check_name
		if (cookie_name == check_name){
			b_cookie_found = true;
			cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
			return cookie_value;
			break;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	if (!b_cookie_found){
		return null;
	}
}

/**
 * Indica si el navegador es el inefable "Microsoft Internet Explorer"
 *
 * @return resultado de la verificaci�n
 * @type Boolean
 */
function isMSIE(){
    return (navigator.appName == "Microsoft Internet Explorer" ? true : false);
}


/**
 *
 *
 */
var Fichero = {

    /**
     *
     *
     */
    redirect : function(url){
        document.location.href = url;
    }
}
