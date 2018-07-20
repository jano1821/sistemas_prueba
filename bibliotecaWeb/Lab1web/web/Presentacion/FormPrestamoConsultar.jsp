<%@page import="Control.Constantes"%>
<%@page import="Logica_de_Negocio.Prestamo"%>
<%@page import="Control.PrestamoControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Consultar Prestamo</title>
        <jsp:useBean id="Prestamo" scope="request" type="Logica_de_Negocio.Prestamo" class="Logica_de_Negocio.Prestamo"/>
    </head>
    <body bgcolor="white">
        <div>
            <div>
                <h2>Prestamo</h2>
            </div>
            <form name="formuPrestamo" method="post" action="/Lab1web/PrestamoControl?action=<%=Constantes.ACTUALIZAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* Cedula del Estudiante:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id" readonly value="<jsp:getProperty name="Prestamo" property="estudiante"/>"></td>
                        </tr>
                        <%
                                    if (Integer.parseInt(request.getParameter("a")) == 1) {
                        %>
                        <tr>
                            <td align="left" id="codLib">* Codigo del libro:</td>
                            <td width="60%"><input size="30" type="text" name="codLib" id="codLib" value="<jsp:getProperty name="Prestamo" property="libro"/>"></td>
                        </tr>
                        <%} else {%>
                        <tr>
                            <td align="left" id="codLib">* Codigo del libro:</td>
                            <td width="60%"><input size="30" readonly type="text" name="codLib" id="codLib" value="<jsp:getProperty name="Prestamo" property="libro"/>"></td>
                        </tr>
                        <%}%>
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

