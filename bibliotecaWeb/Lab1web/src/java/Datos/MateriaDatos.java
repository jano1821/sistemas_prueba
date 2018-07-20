/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Datos;

import Acceso_a_Datos.MateriaBase;
import Logica_de_Negocio.Materia;
import java.util.ArrayList;

/**
 *
 * @author Alex
 */
public class MateriaDatos {

     public static void InsertarMateria(Materia e) throws Exception {
        MateriaBase est = new MateriaBase();
        est.insertarMateria(e);
    }

    public static void ActualizarMateria(Materia e) throws Exception {
        MateriaBase est = new MateriaBase();
        est.actualizarMateria(e);
    }

    public static void EliminarMateria(String e) throws Exception {
        MateriaBase est = new MateriaBase();
        est.eliminarMateria(e);
    }

    public static ArrayList<Materia> ListarMateria(String id) throws Exception {
        MateriaBase est = new MateriaBase();
        return est.listarMateria(id);
    }

    public static Materia BuscarMateria(String id) throws Exception {
        MateriaBase est = new MateriaBase();
        return est.buscarMateria(id);
    }

    public static void ActualizarMateria(String idM, String idE) throws Exception {
        MateriaBase est = new MateriaBase();
        est.actualizarMateria(idM,idE);
    }

    public static void ActualizarNota(String id, String id2, double nota)throws Exception {
        MateriaBase est = new MateriaBase();
        est.actualizarNota(id,id2,nota);
    }

    public static void EliminarEstudiante(int id)throws Exception {
       MateriaBase est = new MateriaBase();
        est.eliminarEstudiante(id);
    }
}
