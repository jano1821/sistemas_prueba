
<%@page import="Control.Constantes"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registrar Estudiante</title>
    </head>
 <body bgcolor="white">
        <div>
            <div>
                <h2>Nuevo estudiante</h2>
            </div>
            <form name="formuEstudiante" method="post" action="/Lab1web/EstudianteControl?action=<%=Constantes.INSERTAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* ID:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id"></td>
                        </tr>
                        <tr>
                            <td align="left" id="nom">* Nombre:</td>
                            <td width="60%"><input size="30" type="text" name="nombre" id="nombre"></td>
                        </tr>
                        <tr>
                            <td align="left"id="edad">* Edad:</td>
                            <td><input size="30" type="text" name="edad" id="edad"></td>
                        </tr>
                        <tr>
                            <td align="left"id="correo">* Correo Electrónico:</td>
                            <td><input size="30" type="text" name="correo" id="correo"></td>
                        </tr>
                        <tr>
                            <td align="left" id="car">* Carrera:</td>
                            <td><input size="30" type="text" name="car" id="car"></td>
                        </tr>
                        <tr>
                            <td align="left" id="dir">* Dirección</td>
                            <td>
                                <textarea cols="25" rows="5"  id="direccion" name="direccion" onkeydown="if(this.value.length >= 50){return false; }"></textarea>
                            </td>
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
