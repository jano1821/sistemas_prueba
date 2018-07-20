
<%@page import="Control.Constantes"%>
<%@page import="Logica_de_Negocio.Estudiante"%>
<%@page import="Control.EstudianteControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Consultar Estudiante</title>
        <jsp:useBean id="Estudiante" scope="request" type="Logica_de_Negocio.Estudiante" class="Logica_de_Negocio.Estudiante"/>
    </head>
    <body bgcolor="white">
        <div>
            <div>
                <h2>Estudiante</h2>
            </div>
            <form name="formuEstudiante" method="post" action="/Lab1web/EstudianteControl?action=<%=Constantes.ACTUALIZAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* ID:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id" readonly value="<jsp:getProperty name="Estudiante" property="id"/>"></td>
                        </tr>
                        <%
                                    if (Integer.parseInt(request.getParameter("a")) == 1) {
                        %>
                        <tr>
                            <td align="left" id="nom">* Nombre:</td>
                            <td width="60%"><input size="30" type="text" name="nombre" id="nombre" value="<jsp:getProperty name="Estudiante" property="nombre"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="edad">* Edad:</td>
                            <td><input size="30" type="text" name="edad" id="edad" value="<jsp:getProperty name="Estudiante" property="edad"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="correo">* Correo Electrónico:</td>
                            <td><input size="30" type="text" name="correo" id="correo" value="<jsp:getProperty name="Estudiante" property="email"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="car">* Carrera:</td>
                            <td><input size="30" type="text" name="car" id="car" value="<jsp:getProperty name="Estudiante" property="carrera"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="dir">* Dirección</td>
                            <td>
                                <textarea cols="25" rows="5"  id="direccion" name="direccion" onkeydown="if(this.value.length >= 50){return false; }"><jsp:getProperty name="Estudiante" property="direccion"/></textarea>
                            </td>
                        </tr>
                        <%} else {%>
                        <tr>
                            <td align="left" id="nom">* Nombre:</td>
                            <td width="60%"><input size="30" readonly type="text" name="nombre" id="nombre" value="<jsp:getProperty name="Estudiante" property="nombre"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="edad">* Edad:</td>
                            <td><input size="30" type="text" readonly name="edad" id="edad" value="<jsp:getProperty name="Estudiante" property="edad"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="correo">* Correo Electrónico:</td>
                            <td><input size="30" type="text" readonly name="correo" id="correo" value="<jsp:getProperty name="Estudiante" property="email"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="car">* Carrera:</td>
                            <td><input size="30" type="text" readonly name="car" id="car" value="<jsp:getProperty name="Estudiante" property="carrera"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="dir">* Dirección</td>
                            <td>
                                <textarea cols="25" rows="5"  readonly id="direccion" name="direccion" onkeydown="if(this.value.length >= 50){return false; }"><jsp:getProperty name="Estudiante" property="direccion"/></textarea>
                            </td>
                        </tr>
                        <%}%>
                        <tr>
                            <td align="left"id="Promedio">Promedio:</td>
                            <td><input size="30" type="text" name="edad" id="edad" readonly value="<jsp:getProperty name="Estudiante" property="promedio"/>"></td>
                        </tr>
                        <%
                                    if (Integer.parseInt(request.getParameter("a")) == 1) {
                        %>
                        <tr>
                            <td align="left" colspan="2">
                                <input size="30" type="submit" name="Enviar" value="Enviar">
                            </td>
                        </tr>
                        <%}%>
                        <td align="left">
                            <img alt=""  onclick="window.history.go(-1);" src="/Lab1web/Imagenes/flecha.png" width="30px" height="30px"/>
                        </td>
                    </table>
                </div>
            </form>
        </div>
    </body>
</html>
