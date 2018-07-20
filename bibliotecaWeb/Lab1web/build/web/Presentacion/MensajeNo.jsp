<%@page contentType="text/html" pageEncoding="UTF-8"%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Mensaje</title>
    </head>
    <body bgcolor="white">
        <table align="center">
            <tr>
                <td><img alt="" align="middle" src="/Lab1web/Imagenes/warning.png" width="30px" height="30px"/></td></tr>
            <tr>
                <td><h3 align="center"><%try {%>
                        <jsp:useBean id="mensaje" scope="request" type="java.lang.String"/>
                        <%=mensaje%>
                        <%} catch (Exception e) {
                                    }%>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <img alt="" align="left" onclick="window.history.go(-1);" src="/Lab1web/Imagenes/flecha.png" width="30px" height="30px"/>
                </td>
            </tr>
        </table>
    </body>
</html>

