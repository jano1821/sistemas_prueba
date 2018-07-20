<%@page import="Control.Constantes"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registrar Prestamo</title>
    </head>
 <body bgcolor="white">
        <div>
            <div>
                <h2>Nuevo prestamo</h2>
            </div>
            <form name="formuPrestamo" method="post" action="/Lab1web/PrestamoControl?action=<%=Constantes.INSERTAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* Cedula del Estudiante:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id"></td>
                        </tr>
                        <tr>
                            <td align="left" id="cod">* Codigo del libro:</td>
                            <td width="60%"><input size="30" type="text" name="codLib" id="codLib"></td>
                        </tr>
                        <tr>
                            <td align="left" colspan="2">
                                <input size="30" type="submit" name="Enviar" value="Enviar">
                            </td>
                        </tr>
                        <td align="left">
                            <img alt=""  onclick="window.history.go(-1);" src="/Lab1web/Imagenes/flecha.png" width="30px" height="30px"/>
                        </td>
                    </table>
                </div>
            </form>
        </div>
    </body>
</html>

