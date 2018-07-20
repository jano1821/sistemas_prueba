/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Datos;

import Acceso_a_Datos.AutorBase;
import Logica_de_Negocio.Autor;
import java.util.ArrayList;

/**
 *
 * @author Alex
 */
public class AutorDatos {

    public static void InsertarAutor(Autor e) throws Exception {
        AutorBase est = new AutorBase();
        est.insertarAutor(e);
    }

    public static void ActualizarAutor(Autor e) throws Exception {
        AutorBase est = new AutorBase();
        est.actualizarAutor(e);
    }

    public static void EliminarAutor(String e) throws Exception {
        AutorBase est = new AutorBase();
        est.eliminarAutor(e);
    }

    public static ArrayList<Autor> ListarAutor(String id) throws Exception {
        AutorBase est = new AutorBase();
        return est.listarAutor(id);
    }

    public static Autor BuscarAutor(String id) throws Exception {
        AutorBase est = new AutorBase();
        return est.buscarAutor(id);
    }

    public static ArrayList<Autor> ListarAutor2(String id) throws Exception{
        AutorBase est = new AutorBase();
        return est.listarAutor2(id);
    }
}
