<html>
    <head>
        <title>Juego 3 en raya</title>
        <SCRIPT type="text/javascript" LANGUAGE="JavaScript" SRC="/MyDA/js/dynlayer.js">
        </SCRIPT>
        <SCRIPT type="text/javascript" LANGUAGE="JavaScript" SRC="/MyDA/js/drag.js">
        </SCRIPT>
        <SCRIPT type="text/javascript" LANGUAGE="JavaScript">
            function init() {
                // inicializar capas
                f0 = new DynLayer("foto",null)
                f1 = new DynLayer("ficha1",null)
                f2 = new DynLayer("ficha2",null)
                f3 = new DynLayer("ficha3",null)
                f4 = new DynLayer("ficha4",null)
                f5 = new DynLayer("ficha5",null)
                f6 = new DynLayer("ficha6",null)

                // añadir las capas a mover al objeto drag
                drag.add(f1,f2,f3,f4,f5,f6)

                // inicializar eventos de ratón
                document.onmousedown = mouseDown
                document.onmousemove = mouseMove
                document.onmouseup = mouseUp
                if (is.ns) document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP)
            }

            function mouseDown(e) {
                if ((is.ns && e.which!=1) || (is.ie && event.button!=1)) return true
                var x = (is.ns)? e.pageX : event.x+document.body.scrollLeft
                var y = (is.ns)? e.pageY : event.y+document.body.scrollTop
                if (drag.mouseDown(x,y)) {
                    // escribir aquí el código para hacer cualquier cosa al comenzar a arrastrar
                    return false
                }
                else return true
            }
            function mouseMove(e) {
                var x = (is.ns)? e.pageX : event.x+document.body.scrollLeft
                var y = (is.ns)? e.pageY : event.y+document.body.scrollTop
                if (drag.mouseMove(x,y)) {
                    // escribir aquí el código para hacer cualquier cosa mientras arrastramos
                    return false
                }
                else return true
            }
            function mouseUp(e) {
                var x = (is.ns)? e.pageX : event.x+document.body.scrollLeft
                var y = (is.ns)? e.pageY : event.y+document.body.scrollTop
                if (drag.mouseUp()) {
                    // escribir aquí el código para hacer cualquier cosa al finalizar el arrastrar
                    return false
                }
                else return true
            }
        </SCRIPT>
        <STYLE TYPE="text/css">
            #texto {position: relative;  visibility: visible;  top: 20; z-index: 0; text-align:center}
            #foto {position: absolute;  visibility: visible;  left: 185; top: 130; z-index: 1; }
            #ficha1 {position: absolute;  visibility: visible; left: 450; top: 150; z-index: 7; }
            #ficha2 {position: absolute;  visibility: visible; left: 450; top: 200; z-index: 6; }
            #ficha3 {position: absolute;  visibility: visible; left: 450; top: 250; z-index: 5; }
            #ficha4 {position: absolute;  visibility: visible; left: 60; top: 150; z-index: 4; }
            #ficha5 {position: absolute;  visibility: visible; left: 60; top: 200; z-index: 3; }
            #ficha6 {position: absolute;  visibility: visible; left: 60; top: 250; z-index: 2; }
        </STYLE>
    </HEAD>

    <body bgcolor="#FFCC99" TEXT="#0F0000" LINK="#0F0000" ALINK="#0F0000" VLINK="#0F0000" onLoad="init()">

        <div id="texto"><FONT FACE="Comic Sans MS" SIZE="+3"><U><B>Diseño</B></U></FONT></div>

        <div id="foto"><IMG SRC="tablero.gif" WIDTH="180"HEIGHT="180"BORDER="0" ALT="tablero.gif - 1805 Bytes"></div>
        <div id="ficha1">Texto 1</div>
        <div id="ficha2">Texto 2</div>
        <div id="ficha3">Texto 3</div>
        <div id="ficha4">Texto 4</div>
        <div id="ficha5"><IMG SRC="cruz.gif" WIDTH=30 HEIGHT=30 BORDER=0></div>
        <div id="ficha6"><IMG SRC="cruz.gif" WIDTH=30 HEIGHT=30 BORDER=0></div>

        <P><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><CENTER><FORM><INPUT TYPE="Button" VALUE=Cerrar onClick=self.close()></FORM></CENTER>

    </body></html>
