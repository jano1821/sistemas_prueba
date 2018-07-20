/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Control;

import Datos.PrestamoDatos;
import Logica_de_Negocio.Prestamo;
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
public class PrestamoControl extends HttpServlet {

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
                    this.InsertarPrestamo(request, response);
                    request.getRequestDispatcher("Presentacion/ListaPrestamos.jsp").forward(request, response);
                    break;
                }
                case Constantes.ACTUALIZAR: {
                    this.ActualizarPrestamo(request, response);
                    request.getRequestDispatcher("Presentacion/ListaPrestamos.jsp").forward(request, response);
                    break;
                }
                case Constantes.LISTAR: {
                    this.ListarPrestamo(request, response);
                    request.getRequestDispatcher("Presentacion/ListaPrestamos.jsp").forward(request, response);
                    break;
                }
                case Constantes.BUSCAR: {
                    this.BuscarPrestamo(request, response);
                    int a = Integer.parseInt(request.getParameter("a"));
                    request.setAttribute("a", a);
                    request.getRequestDispatcher("Presentacion/FormPrestamoConsultar.jsp").forward(request, response);
                    break;
                }
                case Constantes.ELIMINAR: {
                    this.EliminarPrestamo(request, response);
                    request.getRequestDispatcher("Presentacion/ListaPrestamos.jsp").forward(request, response);
                    break;
                }
            }

        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("Presentacion/MensajeNo.jsp").forward(request, response);
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

    private void InsertarPrestamo(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {           
            String estu = request.getParameter("id");
            String libro = request.getParameter("codLib");

            Prestamo prestamo = new Prestamo(0,estu,libro);
            PrestamoDatos.InsertarPrestamo(prestamo);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("Presentacion/MensajeNo.jsp").forward(request, response);
        }

    }

    private void ListarPrestamo(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            ArrayList<Prestamo> prestamos;
            prestamos = PrestamoDatos.ListarPrestamo(id);
            request.setAttribute("prestamos", prestamos);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarPrestamo(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {            
            String estu = request.getParameter("id");
            String libro = request.getParameter("codLib");

            Prestamo prestamo = new Prestamo(0,estu,libro);
            PrestamoDatos.ActualizarPrestamo(prestamo);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void BuscarPrestamo(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String cod = request.getParameter("id");
            Prestamo prestamo = PrestamoDatos.BuscarPrestamo(cod);
            request.setAttribute("Prestamo", prestamo);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void EliminarPrestamo(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String cod = request.getParameter("cod");
            PrestamoDatos.EliminarPrestamo(cod);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }
}
