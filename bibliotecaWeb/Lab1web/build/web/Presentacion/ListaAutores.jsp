
<%@page import="Logica_de_Negocio.Autor"%>
<%@page import="Control.Constantes"%>
<%@page import="Control.AutorControl"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lista de Autores</title>
    </head>
    <body bgcolor="white">
        <img alt="" align="right"src="/Lab1web/Imagenes/autor.png" width="100px" height="100px"/>
        <br>
        <form name="ListaAutores" id="LE" method="POST" action="/Lab1web/AutorControl?a=1&action=<%=Constantes.LISTAR%>">
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
                    <a href="/Lab1web/Presentacion/FormAutorAgregar.jsp" target="mostrar">
                        Agregar Autor
                    </a>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <br/>
        <table cellspacing="0" align="center" cellpadding="8px">
            <tr>
                <td colspan="5" align="center"><h2>Autores</h2></td></tr>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Consultar</td>
                <td>Modificar</td>
                <td>Eliminar</td>
            </tr>

            <jsp:useBean id="autores" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
            <%
                        Logica_de_Negocio.Autor autor;
                        for (int i = 0; i < autores.size(); i++) {
                            autor = (Logica_de_Negocio.Autor) autores.get(i);

            %>
            <tr>
                <td align="center"><%=autor.getId()%></td>
                <td align="center"><%=autor.getNombre()%></td>
                <td align="center">
                    <a href="/Lab1web/AutorControl?a=2&id=<%=autor.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/consultar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/AutorControl?a=1&id=<%=autor.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/modificar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/AutorControl?id=<%=autor.getId()%>&action=<%=Constantes.ELIMINAR%>">
                        <img alt="" src="/Lab1web/Imagenes/eliminar.png" width="30px" height="30px"/>
                    </a>
                </td>

            </tr>
            <%}%>
        </table>
        
    </body>
</html>
