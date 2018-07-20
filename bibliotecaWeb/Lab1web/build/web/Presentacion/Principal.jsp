
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Biblioteca WEB</title>
        <link href="Estilo/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="/Imagenes/sumbleupon_48.png"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="wrapper2">
                <div id="header">
                    <div id="logo">
                        <h1>Biblioteca web</h1>
                    </div>
                    <div id="menu">
                        <ul>
                            <li>
                                <a href="Presentacion/ListaEstudiantes.jsp" target="mostrar">Estudiantes</a>
                            </li>
                            <li>
                                <a href="Presentacion/ListaAutores.jsp" target="mostrar">Autores</a>
                            </li>
                            <li>
                                <a href="Presentacion/ListaLibros.jsp" target="mostrar">Libros</a>
                            </li>
                            <li>
                                <a href="Presentacion/ListaMaterias.jsp" target="mostrar">Materias</a>
                            </li>
                            <li>
                                <a href="Presentacion/ListaPrestamos.jsp" target="mostrar">Prestamos</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="page">
                    <div id="content">
                        <div class="post">
                            <iframe name="mostrar" src="Presentacion/ListaEstudiantes.jsp" height="500" width="100%"></iframe>
                        </div>
                    </div>
                    <div id="sidebar">
                        <ul>
                            <li id="search">
                                <h3>Estudiantes</h3>
                            </li>
                            <li id="search">
                                <h3>Autores</h3>
                            </li>
                            <li id="search">
                                <h3>Libros</h3>
                            </li>
                            <li id="search">
                                <h3>Materias</h3>
                            </li>
                            <li id="search">
                                <h3>Prestamos</h3>
                            </li>
                            <br>
                            <br>
                            <br>
                            <br>
                            <li>
                                <h3>Realizado por:</h3>
                                <p>
                                    Hernán Fallas<br>
                                    Berny Ruiz<br>
                                    Gabriela Mena
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div style="clear: both;">&nbsp;</div>

                    <div style="clear: both;">&nbsp;</div>
                </div>
            </div>
            <div id="footer">
                <p>Biblioteca Web</p>
            </div>
        </div>
    </body>
</html>
