
<%@page import="Logica_de_Negocio.Prestamo"%>
<%@page import="Control.Constantes"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lista de Prestamos</title>
    </head>
    <body bgcolor="white">
        <img alt="" align="right"src="/Lab1web/Imagenes/prestamo.png" width="100px" height="100px"/>
        <br>
        <form name="ListaPrestamo" id="LE" method="POST" action="/Lab1web/PrestamoControl?action=<%=Constantes.LISTAR%>">
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
                    <a href="/Lab1web/Presentacion/FormAgregarPrestamo.jsp" target="mostrar">
                        Realizar prestamo
                    </a>
                </td>
            </tr>
        </table>
        <br/>
        <br>
        <br/>
        <table cellspacing="0" align="center" cellpadding="5px">
            <tr>
                <td colspan="6" align="center"><h2>Prestamos</h2></td></tr>
            <tr>
                <td>Codigo</td>
                <td>Estudiante</td>
                <td>Libro</td>
                <td>Consultar</td>
                <td>Modificar</td>
                <td>Eliminar</td>
            </tr>

            <jsp:useBean id="prestamos" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
            <%
                        Logica_de_Negocio.Prestamo prestamo;
                        for (int i = 0; i < prestamos.size(); i++) {
                            prestamo = (Logica_de_Negocio.Prestamo) prestamos.get(i);

            %>
            <tr>
                <td align="center"><%=prestamo.getCodigo()%></td>
                <td align="center"><%=prestamo.getEstudiante()%></td>
                <td align="center"><%=prestamo.getLibro()%></td>
                <td align="center">
                    <a href="/Lab1web/PrestamoControl?a=2&id=<%=prestamo.getCodigo()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/consultar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                   <a href="/Lab1web/PrestamoControl?a=1&id=<%=prestamo.getCodigo()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/modificar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/PrestamoControl?id=<%=prestamo.getCodigo()%>&action=<%=Constantes.ELIMINAR%>">
                        <img alt="" src="/Lab1web/Imagenes/eliminar.png" width="30px" height="30px"/>
                    </a>
                </td>

            </tr>
            <%}%>
        </table>

    </body>
</html>
