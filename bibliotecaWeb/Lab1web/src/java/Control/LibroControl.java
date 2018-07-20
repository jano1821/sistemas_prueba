/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Control;

import Datos.LibroDatos;
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
public class LibroControl extends HttpServlet {

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
                    this.InsertarLibro(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaLibros.jsp").forward(request, response);
                    break;
                }
                case Constantes.ACTUALIZAR: {
                    int a = Integer.parseInt(request.getParameter("a"));
                    if (a == 1) {
                        this.ActualizarLibro(request, response);
                    } else {
                        this.ActualizarLibro2(request, response);
                    }
                    request.getRequestDispatcher("/Presentacion/ListaLibros.jsp").forward(request, response);
                    break;
                }
                case Constantes.LISTAR: {
                    this.ListarLibro(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaLibros.jsp").forward(request, response);
                    break;
                }
                case Constantes.BUSCAR: {
                    this.BuscarLibro(request, response);
                    int a = Integer.parseInt(request.getParameter("a"));
                    request.setAttribute("a", a);
                    request.getRequestDispatcher("/Presentacion/FormLibroConsultar.jsp").forward(request, response);
                    break;
                }
                case Constantes.ELIMINAR: {
                    this.EliminarLibro(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaLibros.jsp").forward(request, response);
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

    private void InsertarLibro(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            String isbn = request.getParameter("isbn");
            int can = Integer.parseInt(request.getParameter("can"));
            String des = request.getParameter("des");

            Libro libro = new Libro(id, des, isbn, can);
            LibroDatos.InsertarLibro(libro);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }

    }

    private void ListarLibro(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Libro> libros;
            String id = request.getParameter("id");
            libros = LibroDatos.ListarLibro(id);
            request.setAttribute("libros", libros);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarLibro(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            String isbn = request.getParameter("isbn");
            int can = Integer.parseInt(request.getParameter("can"));
            String des = request.getParameter("des");

            Libro libro = new Libro(id, des, isbn, can);
            LibroDatos.ActualizarLibro(libro);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }
    private void ActualizarLibro2(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String idA = request.getParameter("aut");
            String idL = request.getParameter("id");
            Libro libro = new Libro(idA, idL, "", 0);
            LibroDatos.ActualizarLibro2(libro);
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

    private void EliminarLibro(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            LibroDatos.EliminarLibro(id);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }
}
