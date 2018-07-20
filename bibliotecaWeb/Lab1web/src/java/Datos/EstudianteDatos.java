/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Datos;

import Acceso_a_Datos.EstudianteBase;
import Logica_de_Negocio.Estudiante;
import java.util.ArrayList;

/**
 *
 * @author Berny Ruiz
 */
public class EstudianteDatos {

    public static void InsertarEstudiante(Estudiante e) throws Exception {
        EstudianteBase est = new EstudianteBase();
        est.insertarEstudiante(e);
    }

    public static void ActualizarEstudiante(Estudiante e) throws Exception {
        EstudianteBase est = new EstudianteBase();
        est.actualizarEstudiante(e);
    }

    public static void EliminarEstudiante(String e) throws Exception {
        EstudianteBase est = new EstudianteBase();
        est.eliminarEstudiante(e);
    }

    public static ArrayList<Estudiante> ListarEstudiante(String id) throws Exception {
        EstudianteBase est = new EstudianteBase();
        return est.listarEstudiante(id);
    }

    public static Estudiante BuscarEstudiante(String id) throws Exception {
        EstudianteBase est = new EstudianteBase();
        return est.buscarEstudiante(id);
    }

    public static ArrayList<Estudiante> ListarEstudiante2(String id) throws Exception{
        EstudianteBase est = new EstudianteBase();
        return est.listarEstudiante2(id);
    }
}
