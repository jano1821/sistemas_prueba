<%@page import="Logica_de_Negocio.Estudiante"%>
<%@page import="Control.Constantes"%>
<%@page import="Control.MateriaControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Notas</title>
        <jsp:useBean id="Materia" type="Logica_de_Negocio.Materia" scope="session"/>
    </head>
    <body bgcolor="white">
        <img alt="" align="right"src="/Lab1web/Imagenes/paper.png" width="70px" height="70px"/>
        <br>
        <div>
            <h2>Materia <jsp:getProperty name="Materia" property="id"/></h2>
        </div>
        <br/>
        <table cellspacing="0" align="center" cellpadding="20">
            <tr>
                <td colspan="4" align="center"><h2>Estudiantes</h2></td></tr>
            <tr>
                <td align="center">ID</td>
                <td align="center">Nota</td>
                <td align="center">Modificar</td>
                <td align="center">Eliminar Estudiante</td>
            </tr>

            <jsp:useBean id="estudiantes" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
            <%
                        Logica_de_Negocio.Estudiante estudiante;
                        for (int i = 0; i < estudiantes.size(); i++) {
                            estudiante = (Logica_de_Negocio.Estudiante) estudiantes.get(i);

            %>
            <tr>
                <td align="center"><%=estudiante.getId()%></td>
                <td align="center"><%=estudiante.getPromedio()%></td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=5&id=<%=estudiante.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/modificar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=4&id=<%=estudiante.getEdad()%>&action=<%=Constantes.ELIMINAR%>">
                        <img alt="" src="/Lab1web/Imagenes/userx.png" width="30px" height="30px"/>
                    </a>
                </td>
            </tr>
            <%}%>
            <td align="left">
                <img alt=""  onclick="window.history.go(-1);" src="/Lab1web/Imagenes/flecha.png" width="30px" height="30px"/>
            </td>
        </table>

    </body>
</html>
