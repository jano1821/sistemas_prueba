
<%@page import="Control.Constantes"%>
<%@page import="Control.LibroControl"%>
<%@page import="Control.AutorControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Consultar Libro</title>
        <jsp:useBean id="Libro" scope="request" type="Logica_de_Negocio.Libro" class="Logica_de_Negocio.Libro"/>
    </head>
    <body bgcolor="white">
        <div>
            <div>
                <h2>Libro</h2>
                <a href="/Lab1web/AutorControl?a=0&id=<%=Libro.getId()%>&action=<%=Constantes.BUSCAR%>">Ver Autores</a>
            </div>
            <form name="formuLibro" method="post" action="/Lab1web/LibroControl?a=1&action=<%=Constantes.ACTUALIZAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* ID:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id" readonly value="<jsp:getProperty name="Libro" property="id"/>"></td>
                        </tr>
                        <%
                                    if (Integer.parseInt(request.getParameter("a")) == 1) {
                        %>
                        <tr>
                            <td align="left" id="nom">* ISBN:</td>
                            <td width="60%"><input size="30" type="text" name="isbn" id="isbn" value="<jsp:getProperty name="Libro" property="isbn"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="can">* Cantidad de Ejemplares:</td>
                            <td><input size="30" type="text" name="can" id="can" value="<jsp:getProperty name="Libro" property="cantidadEjemplares"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="dir">* Descripcion:</td>
                            <td>
                                <textarea cols="25" rows="5"  id="des" name="des" onkeydown="if(this.value.length >= 50){return false; }"><jsp:getProperty name="Libro" property="descripcion"/></textarea>
                            </td>
                        </tr>
                        <%} else {%>
                        <tr>
                            <td align="left" id="nom">* ISBN:</td>
                            <td width="60%"><input size="30" readonly type="text" name="isbn" id="isbn" value="<jsp:getProperty name="Libro" property="isbn"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="can">* Cantidad de Ejemplares:</td>
                            <td><input size="30" type="text" readonly name="can" id="can" value="<jsp:getProperty name="Libro" property="cantidadEjemplares"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="dir">* Descripcion:</td>
                            <td>
                                <textarea cols="25" rows="5"  readonly id="des" name="des" onkeydown="if(this.value.length >= 50){return false; }"><jsp:getProperty name="Libro" property="descripcion"/></textarea>
                            </td>
                        </tr>
                        <%}
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
