/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Datos;

import Acceso_a_Datos.PrestamoBase;
import Logica_de_Negocio.Prestamo;
import java.util.ArrayList;

/**
 *
 * @author Berny Ruiz
 */
public class PrestamoDatos {

    public static void InsertarPrestamo(Prestamo e) throws Exception {
        PrestamoBase est = new PrestamoBase();
        est.insertarPrestamo(e);
    }

    public static void ActualizarPrestamo(Prestamo e) throws Exception {
        PrestamoBase est = new PrestamoBase();
        est.actualizarPrestamo(e);
    }

    public static void EliminarPrestamo(String e) throws Exception {
        PrestamoBase est = new PrestamoBase();
        est.eliminarPrestamo(e);
    }

    public static ArrayList<Prestamo> ListarPrestamo(String id) throws Exception {
        PrestamoBase est = new PrestamoBase();
        return est.listarPrestamo(id);
    }

    public static Prestamo BuscarPrestamo(String id) throws Exception {
        PrestamoBase est = new PrestamoBase();
        return est.buscarPrestamo(id);
    }
}

