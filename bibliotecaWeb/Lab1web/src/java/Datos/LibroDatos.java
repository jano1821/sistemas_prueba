/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Datos;

import Acceso_a_Datos.LibroBase;
import Logica_de_Negocio.Libro;
import java.util.ArrayList;

/**
 *
 * @author Alex
 */
public class LibroDatos {

    public static void InsertarLibro(Libro e) throws Exception {
        LibroBase est = new LibroBase();
        est.insertarLibro(e);
    }

    public static void ActualizarLibro(Libro e) throws Exception {
        LibroBase est = new LibroBase();
        est.actualizarLibro(e);
    }

    public static void EliminarLibro(String e) throws Exception {
        LibroBase est = new LibroBase();
        est.eliminarLibro(e);
    }

    public static ArrayList<Libro> ListarLibro(String id) throws Exception {
        LibroBase est = new LibroBase();
        return est.listarLibro(id);
    }

    public static Libro BuscarLibro(String id) throws Exception {
        LibroBase est = new LibroBase();
        return est.buscarLibro(id);
    }

    public static void ActualizarLibro2(Libro libro) throws Exception{
        LibroBase est = new LibroBase();
        est.actualizarLibro2(libro);
    }
}
