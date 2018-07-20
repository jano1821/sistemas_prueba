/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Control;

import Datos.EstudianteDatos;
import Datos.MateriaDatos;
import Logica_de_Negocio.Estudiante;
import Logica_de_Negocio.Materia;
import java.io.IOException;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author Alex
 */
public class MateriaControl extends HttpServlet {

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
                    this.InsertarMateria(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaMaterias.jsp").forward(request, response);
                    break;
                }
                case Constantes.ACTUALIZAR: {
                    int a = Integer.parseInt(request.getParameter("a"));
                    if (a == 0) {
                        this.ActualizarCalificacion(request, response);
                    } else {
                        if (a == 1) {
                            this.ActualizarMateria(request, response);
                        } else {
                            this.ActualizarAlumno(request, response);
                        }
                    }
                    request.getRequestDispatcher("/Presentacion/ListaMaterias.jsp").forward(request, response);
                    break;
                }
                case Constantes.LISTAR: {
                    this.ListarMateria(request, response);
                    request.getRequestDispatcher("/Presentacion/ListaMaterias.jsp").forward(request, response);
                    break;
                }
                case Constantes.BUSCAR: {
                    this.BuscarMateria(request, response);
                    int a = Integer.parseInt(request.getParameter("a"));
                    switch (a) {
                        case 0: {
                            this.ListarAlumno(request, response);
                            request.getRequestDispatcher("/Presentacion/ListaCalificaciones.jsp").forward(request, response);
                            break;
                        }
                        case 1: {
                            request.setAttribute("a", a);
                            request.getRequestDispatcher("/Presentacion/FormMateriaConsultar.jsp").forward(request, response);
                            break;
                        }
                        case 2: {
                            request.setAttribute("a", a);
                            request.getRequestDispatcher("/Presentacion/FormMateriaConsultar.jsp").forward(request, response);
                            break;
                        }
                        case 3: {
                            this.ListarMateriaE(request, response);
                            request.getRequestDispatcher("/Presentacion/FormAgregarM_E.jsp").forward(request, response);
                            break;
                        }
                        case 4: {
                            this.ListarMateriaE(request, response);
                            request.getRequestDispatcher("/Presentacion/FormAgregarM_E.jsp").forward(request, response);
                            break;
                        }
                        case 5: {
                            this.ConsultarMateria(request, response);
                            request.getRequestDispatcher("/Presentacion/FormAgregarCalificacion.jsp").forward(request, response);
                            break;
                        }
                    }
                    break;
                }
                case Constantes.ELIMINAR: {
                    int a = Integer.parseInt(request.getParameter("a"));
                    if (a == 4) {
                        this.EliminarEstudiante(request, response);
                    } else {
                        this.EliminarMateria(request, response);
                    }
                    request.getRequestDispatcher("/Presentacion/ListaMaterias.jsp").forward(request, response);
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

    private void InsertarMateria(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            int cre = Integer.parseInt(request.getParameter("cre"));
            String des = request.getParameter("des");

            Materia materia = new Materia(id, des, cre);
            MateriaDatos.InsertarMateria(materia);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }

    }

    private void ListarMateria(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Materia> materias;
            String id = request.getParameter("id");
            materias = MateriaDatos.ListarMateria(id);
            request.setAttribute("materias", materias);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarMateria(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            int cre = Integer.parseInt(request.getParameter("cre"));
            String des = request.getParameter("des");

            Materia materia = new Materia(id, des, cre);
            MateriaDatos.ActualizarMateria(materia);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void BuscarMateria(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            Materia materia = MateriaDatos.BuscarMateria(id);
            request.setAttribute("Materia", materia);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void EliminarMateria(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            MateriaDatos.EliminarMateria(id);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarAlumno(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String idM = request.getParameter("id");
            String idE = request.getParameter("est");
            MateriaDatos.ActualizarMateria(idM, idE);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ListarMateriaE(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Estudiante> estudiantes;
            estudiantes = EstudianteDatos.ListarEstudiante("");

            request.setAttribute("estudiantes", estudiantes);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ListarAlumno(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            ArrayList<Estudiante> estudiantes;
            String id = request.getParameter("id");
            estudiantes = EstudianteDatos.ListarEstudiante2(id);
            Materia materia = MateriaDatos.BuscarMateria(id);
            HttpSession s = null;
            s = request.getSession(true);
            s.setAttribute("Materia", materia);
            request.setAttribute("estudiantes", estudiantes);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ActualizarCalificacion(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            double nota = Double.parseDouble(request.getParameter("nota"));
            HttpSession s = null;
            s = request.getSession(true);
            Materia materia = (Materia) s.getAttribute("Materia");
            MateriaDatos.ActualizarNota(id, materia.getId(), nota);

        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void ConsultarMateria(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            String id = request.getParameter("id");
            Estudiante estudiante = EstudianteDatos.BuscarEstudiante(id);
            request.setAttribute("Estudiante", estudiante);
            HttpSession s = null;
            s = request.getSession(true);
            Materia materia = (Materia) s.getAttribute("Materia");
            s.setAttribute("Materia", materia);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }

    private void EliminarEstudiante(HttpServletRequest request, HttpServletResponse response) throws Exception {
        try {
            int id = Integer.parseInt(request.getParameter("id"));
            MateriaDatos.EliminarEstudiante(id);
        } catch (Exception e) {
            request.setAttribute("mensaje", e.getMessage());
            request.getRequestDispatcher("/Presentacion/MensajeNo.jsp").forward(request, response);
        }
    }
}
