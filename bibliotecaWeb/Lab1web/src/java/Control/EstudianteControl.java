/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Control;

import Datos.EstudianteDatos;
import Logica_de_Negocio.Estudiante;
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
public class EstudianteControl extends HttpServlet {

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
                    this.InsertarEstudiante(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaEstudiantes.jsp").forward(request, response);
                    break;
                }
                case Constantes.ACTUALIZAR: {
                    this.ActualizarEstudiante(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaEstudiantes.jsp").forward(request, response);
                    break;
                }
                case Constantes.LISTAR: {
                    this.ListarEstudiante(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaEstudiantes.jsp").forward(request, response);
                    break;
                }
                case Constantes.BUSCAR: {
                    this.BuscarEstudiante(request, response);
                    int a = Integer.parseInt(request.getParameter("a"));
                    request.setAttribute("a", a);
                    request.getRequestDispatcher("/Presentacion/FormEstudianteConsultar.jsp").forward(request, response);
                    break;
                }
                case Constantes.ELIMINAR: {
                    this.EliminarEstudiante(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaEstudiantes.jsp").forward(request, response);
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

    private void InsertarEstudiante(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String nombre = request.getParameter("nombre");
            String carrera = request.getParameter("car");
            String id = request.getParameter("id");
            String correo = request.getParameter("correo");
            int edad = Integer.parseInt(request.getParameter("edad"));
            String direccion = request.getParameter("direccion");

            Estudiante estudiante = new Estudiante(id, edad, nombre, correo, carrera, direccion, 0);
            EstudianteDatos.InsertarEstudiante(estudiante);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }

    }

    private void ListarEstudiante(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            ArrayList<Estudiante> estudiantes;
            estudiantes = EstudianteDatos.ListarEstudiante(id);
            request.setAttribute("estudiantes", estudiantes);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarEstudiante(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String nombre = request.getParameter("nombre");
            String carrera = request.getParameter("car");
            String id = request.getParameter("id");
            String correo = request.getParameter("correo");
            int edad = Integer.parseInt(request.getParameter("edad"));
            String direccion = request.getParameter("direccion");

            Estudiante estudiante = new Estudiante(id, edad, nombre, correo, carrera, direccion, 0);
            EstudianteDatos.ActualizarEstudiante(estudiante);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void BuscarEstudiante(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            Estudiante estudiante = EstudianteDatos.BuscarEstudiante(id);
            request.setAttribute("Estudiante", estudiante);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void EliminarEstudiante(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            EstudianteDatos.EliminarEstudiante(id);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }
}
