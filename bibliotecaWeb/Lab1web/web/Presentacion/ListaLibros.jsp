
<%@page import="Logica_de_Negocio.Libro"%>
<%@page import="Control.Constantes"%>
<%@page import="Control.LibroControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lista de Libros</title>
    </head>
    <body bgcolor="white">
        <img alt="" align="right"src="/Lab1web/Imagenes/biblioteca.png" width="100px" height="100px"/>
        <br>
        <form name="ListaLibros" id="LE" method="POST" action="/Lab1web/LibroControl?action=<%=Constantes.LISTAR%>">
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
                    <a href="/Lab1web/Presentacion/FormLibroAgregar.jsp" target="mostrar">
                        Agregar Libro
                    </a>
                </td>
            </tr>
        </table>
        <br/>
        <br>
        <br/>
        <table cellspacing="0" align="center" cellpadding="12px">
            <tr>
                <td colspan="5" align="center"><h2>Libros</h2></td></tr>
            <tr>
                <td>ID</td>
                <td>ISBN</td>
                <td>Consultar</td>
                <td>Modificar</td>
                <td>Eliminar</td>
            </tr>

            <jsp:useBean id="libros" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
            <%
                        Logica_de_Negocio.Libro libro;
                        for (int i = 0; i < libros.size(); i++) {
                            libro = (Logica_de_Negocio.Libro) libros.get(i);

            %>
            <tr>
                <td align="center"><%=libro.getId()%></td>
                <td align="center"><%=libro.getisbn()%></td>
                <td align="center">
                    <a href="/Lab1web/LibroControl?a=2&id=<%=libro.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/consultar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/LibroControl?a=1&id=<%=libro.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/modificar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/LibroControl?id=<%=libro.getId()%>&action=<%=Constantes.ELIMINAR%>">
                        <img alt="" src="/Lab1web/Imagenes/eliminar.png" width="30px" height="30px"/>
                    </a>
                </td>

            </tr>
            <%}%>
        </table>
        
    </body>
</html>
