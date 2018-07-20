<%--
    Document   : FormEstudiante
    Created on : 19-feb-2012, 11:08:43
    Author     : Alex
--%>

<%@page import="Control.Constantes"%>
<%@page import="Control.LibroControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lista de autores</title>
        <jsp:useBean id="Libro" scope="request" type="Logica_de_Negocio.Libro" class="Logica_de_Negocio.Libro"/>
    </head>
    <body bgcolor="white">
        <div>
            <div>
                <h2>Lista de autores a ingresar:</h2>
            </div>
            <form name="formuMateria" method="post" action="/Lab1web/LibroControl?a=2&action=<%=Constantes.ACTUALIZAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* ID:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id" readonly value="<jsp:getProperty name="Libro" property="id"/>"></td>
                        </tr>
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
                        <tr><td>Lista de autores:</td>
                            <td>
                                <jsp:useBean id="autores" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
                                <select name="aut" id="aut">
                                    <%
                                                Logica_de_Negocio.Autor autor;
                                                for (int i = 0; i < autores.size(); i++) {
                                                    autor = (Logica_de_Negocio.Autor) autores.get(i);

                                    %>
                                    <option value="<%=autor.getId()%>"><%=autor.getNombre()%></option>
                                    <%}%>
                                </select>
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
