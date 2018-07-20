<%--
    Document   : FormEstudiante
    Created on : 19-feb-2012, 11:08:43
    Author     : Alex
--%>

<%@page import="Control.Constantes"%>
<%@page import="Control.MateriaControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Agregar Estudiante a Materia</title>
        <jsp:useBean id="Materia" scope="request" type="Logica_de_Negocio.Materia" class="Logica_de_Negocio.Materia"/>
    </head>
    <body bgcolor="white">
        <div>
            <div>
                <h2>Agregar Estudiante a Materia</h2>
            </div>
            <form name="formuMateria" method="post" action="/Lab1web/MateriaControl?a=2&action=<%=Constantes.ACTUALIZAR%>">
                <div>
                    <table border="0" align="center" width="600px">
                        <tr>
                            <td align="left" id="id">* ID:</td>
                            <td width="60%"><input size="30" type="text" name="id" id="id" readonly value="<jsp:getProperty name="Materia" property="id"/>"></td>
                        </tr>
                        <tr>
                            <td align="left"id="can">* Creditaje:</td>
                            <td><input size="30" readonly type="text" name="cre" id="cre" value="<jsp:getProperty name="Materia" property="creditaje"/>"></td>
                        </tr>
                        <tr>
                            <td align="left" id="dir">* Descripcion:</td>
                            <td>
                                <textarea readonly cols="25" rows="5"  id="des" name="des" onkeydown="if(this.value.length >= 50){return false; }"><jsp:getProperty name="Materia" property="descripcion"/></textarea>
                            </td>
                        </tr>
                        <tr><td>Lista de estudiantes:</td>
                            <td>
                                <jsp:useBean id="estudiantes" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
                                <select name="est" id="est">
                                    <%
                                                Logica_de_Negocio.Estudiante estudiante;
                                                for (int i = 0; i < estudiantes.size(); i++) {
                                                    estudiante = (Logica_de_Negocio.Estudiante) estudiantes.get(i);

                                    %>
                                    <option value="<%=estudiante.getId()%>"><%=estudiante.getNombre()%></option>
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
