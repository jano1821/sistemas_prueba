/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Control;

import Datos.AutorDatos;
import Datos.LibroDatos;
import Logica_de_Negocio.Autor;
import Logica_de_Negocio.Libro;
import java.io.IOException;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Alex
 */
public class AutorControl extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code> methods.
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        int action = Integer.parseInt(request.getParameter("action"));
        try {
            switch (action) {
                case Constantes.INSERTAR: {
                    this.InsertarAutor(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaAutores.jsp").forward(request, response);
                    break;
                }
                case Constantes.ACTUALIZAR: {
                    this.ActualizarAutor(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaAutores.jsp").forward(request, response);
                    break;
                }
                case Constantes.LISTAR: {
                    int a = Integer.parseInt(request.getParameter("a"));
                    if (a == 1) {
                        this.ListarAutor(request, response);
                        request.getRequestDispatcher("/Presentacion/ListaAutores.jsp").forward(request, response);
                    } else {
                        this.ListarAutor2(request, response);
                        request.getRequestDispatcher("/Presentacion/ListaLibrosAutores.jsp").forward(request, response);
                    }
                    break;
                }
                case Constantes.BUSCAR: {
                    int a = Integer.parseInt(request.getParameter("a"));
                    if (a == 0) {
                        this.BuscarLibro(request, response);
                        request.getRequestDispatcher("/Presentacion/ListaLibrosAutores.jsp").forward(request, response);
                    } else {
                        if (a == 4) {
                            this.BuscarLibro(request, response);
                            this.BuscarAutores(request, response);
                            request.getRequestDispatcher("/Presentacion/FormAgregarL_A.jsp").forward(request, response);
                        } else {
                            this.BuscarAutor(request, response);
                            request.setAttribute("a", a);
                            request.getRequestDispatcher("/Presentacion/FormAutorConsultar.jsp").forward(request, response);
                        }
                    }
                    break;
                }
                case Constantes.ELIMINAR: {
                    this.EliminarAutor(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaAutores.jsp").forward(request, response);
                    break;
                }
            }

        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

    private void InsertarAutor(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String nombre = request.getParameter("nombre");
            String id = request.getParameter("id");
            int can = Integer.parseInt(request.getParameter("can"));
            String area = request.getParameter("area");

            Autor autor = new Autor(id, nombre, area, can);
            AutorDatos.InsertarAutor(autor);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }

    }

    private void ListarAutor(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Autor> autores;
            String id = request.getParameter("id");
            autores = AutorDatos.ListarAutor(id);
            request.setAttribute("autores", autores);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ListarAutor2(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Autor> autores;
            String id = request.getParameter("id");
            autores = AutorDatos.ListarAutor2(id);
            request.setAttribute("autores", autores);
            Libro libro = LibroDatos.BuscarLibro(id);
            request.setAttribute("Libro", libro);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarAutor(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String nombre = request.getParameter("nombre");
            String id = request.getParameter("id");
            int can = Integer.parseInt(request.getParameter("can"));
            String area = request.getParameter("area");

            Autor autor = new Autor(id, nombre, area, can);
            AutorDatos.ActualizarAutor(autor);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void BuscarAutor(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            Autor autor = AutorDatos.BuscarAutor(id);
            request.setAttribute("Autor", autor);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void EliminarAutor(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            AutorDatos.EliminarAutor(id);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void BuscarLibro(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            Libro libro = LibroDatos.BuscarLibro(id);
            request.setAttribute("Libro", libro);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void BuscarAutores(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Autor> autores;
            autores = AutorDatos.ListarAutor("");
            request.setAttribute("autores", autores);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }
}
