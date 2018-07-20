<%@page import="Logica_de_Negocio.Estudiante"%>
<%@page import="Control.Constantes"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lista de Estudiantes</title>
    </head>
    <body bgcolor="white">
        <img alt="" align="right"src="/Lab1web/Imagenes/estudiantes.png" width="100px" height="100px"/>
        <br>
        <form name="ListaEstudiante" id="LE" method="POST" action="/Lab1web/EstudianteControl?action=<%=Constantes.LISTAR%>">
            <div>
                <table align="left">
                    <tr>
                        <td><input type="text" id="id" name="id" value=""/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="b" name="b" value="Buscar"/></td>
                    </tr>
                </table>
            </div>
        </form>
            <table align="center">
            <tr>
                <td>
                    <a href="/Lab1web/Presentacion/FormEstudianteAgregar.jsp" target="mostrar">
                        Agregar Estudiante
                    </a>
                </td>
            </tr>
        </table>
        <br/>
        <br>
        <br/>
        <table cellspacing="0" align="center" cellpadding="5px">
            <tr>
                <td colspan="5" align="center"><h2>Estudiantes</h2></td></tr>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Consultar</td>
                <td>Modificar</td>
                <td>Eliminar</td>
            </tr>

            <jsp:useBean id="estudiantes" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
            <%
                        Logica_de_Negocio.Estudiante estudiante;
                        for (int i = 0; i < estudiantes.size(); i++) {
                            estudiante = (Logica_de_Negocio.Estudiante) estudiantes.get(i);

            %>
            <tr>
                <td align="center"><%=estudiante.getId()%></td>
                <td align="center"><%=estudiante.getNombre()%></td>
                <td align="center">
                    <a href="/Lab1web/EstudianteControl?a=2&id=<%=estudiante.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/consultar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/EstudianteControl?a=1&id=<%=estudiante.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/modificar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/EstudianteControl?id=<%=estudiante.getId()%>&action=<%=Constantes.ELIMINAR%>">
                        <img alt="" src="/Lab1web/Imagenes/eliminar.png" width="30px" height="30px"/>
                    </a>
                </td>

            </tr>
            <%}%>
        </table>
        
    </body>
</html>
