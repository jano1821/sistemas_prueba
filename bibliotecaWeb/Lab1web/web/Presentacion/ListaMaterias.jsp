<%@page import="Logica_de_Negocio.Materia"%>
<%@page import="Control.Constantes"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lista de Materias</title>
    </head>
    <body bgcolor="white" >
        <img alt="" align="right"src="/Lab1web/Imagenes/materias.png" width="100px" height="100px"/>
        <br>
        <form name="ListaMaterias" id="LE" method="POST" action="/Lab1web/MateriaControl?action=<%=Constantes.LISTAR%>">
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
                    <a href="/Lab1web/Presentacion/FormMateriaAgregar.jsp" target="mostrar">
                        Agregar Materia
                    </a>
                </td>
            </tr>
        </table>
        <br/>
        <br/>
        <br/>

        <table cellspacing="1" align="center" cellpadding="5px">
            <tr>
                <td colspan="7" align="center"><h2>Materias</h2></td></tr>
            <tr>
                <td>    ID    </td>
                <td>    Descripcion    </td>
                <td>    Consultar    </td>
                <td>    Modificar    </td>
                <td>    Eliminar Materia    </td>
                <td>    Agregar Estudiante    </td>
                <td>    Notas    </td>
            </tr>

            <jsp:useBean id="materias" scope="request" type="java.util.ArrayList" class="java.util.ArrayList" />
            <%
                        Logica_de_Negocio.Materia materia;
                        for (int i = 0; i < materias.size(); i++) {
                            materia = (Logica_de_Negocio.Materia) materias.get(i);

            %>
            <tr>
                <td align="center"><%=materia.getId()%></td>
                <td align="center"><%=materia.getDescripcion()%></td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=2&id=<%=materia.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/consultar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=1&id=<%=materia.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/modificar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=0&id=<%=materia.getId()%>&action=<%=Constantes.ELIMINAR%>">
                        <img alt="" src="/Lab1web/Imagenes/eliminar.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=3&id=<%=materia.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/user.png" width="30px" height="30px"/>
                    </a>
                </td>
                <td align="center">
                    <a href="/Lab1web/MateriaControl?a=0&id=<%=materia.getId()%>&action=<%=Constantes.BUSCAR%>">
                        <img alt="" src="/Lab1web/Imagenes/nota.png" width="30px" height="30px"/>
                    </a>
                </td>


            </tr>
            <%}%>
        </table>

    </body>
</html>
