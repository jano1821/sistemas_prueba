/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Acceso_a_Datos;

import Logica_de_Negocio.Prestamo;
import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author Berny
 * Clase que permite la conexion con la base para sacer los datos de estudiante
 */
public class PrestamoBase extends Conexion {

    /** Creates a new instance of EstudianteBase */
    private static final String INSERTARPRESTAMO = "{call PrestamoInsertar(?,?)}";
    private static final String LISTARPRESTAMO  = "{call PrestamoListar(?)}";
    private static final String ACTUALIZARPRESTAMO  = "{call PrestamoActualizar(?,?)}";
    private static final String ELIMINARPRESTAMO  = "{call PrestamoEliminar(?)}";
    private static final String CONSULTARPRESTAMO  = "{call PrestamosBuscar(?)}";

    public PrestamoBase() {
    }
    /**
     * Ingresa un nuevo  estudiante a la BD
     * @param estudiante provee la informacion del estudiante
     */

    public void insertarPrestamo(Prestamo prestamo) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(INSERTARPRESTAMO);
            pstmt.setString(1, prestamo.getEstudiante());
            pstmt.setString(2, prestamo.getLibro());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo agregar el prestamo");
            }

        } catch (SQLException e) {
            e.printStackTrace();
            throw new GlobalException("Llave duplicada");
        } finally {
            try {
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
    }

    public void actualizarPrestamo(Prestamo prestamo) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ACTUALIZARPRESTAMO);
            pstmt.setString(1, prestamo.getEstudiante());
            pstmt.setString(2, prestamo.getLibro());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar el estudiante");
            }

        } catch (SQLException e) {
        } finally {
            try {
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
    }/*
     * Elimina el estudiante
     * @param estudiante es el id del estudiante a ser eliminado
     */


    public void eliminarPrestamo(String prestamo) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ELIMINARPRESTAMO);
            pstmt.setString(1, prestamo);
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo eliminar el estudiante");
            }

        } catch (SQLException e) {
        } finally {
            try {
                if (pstmt != null) {
                    /*
                     * Cierra la conexion de la base
                     */
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
    }
    /*
     * regresa un ArrayList de tipo Estudiante
     */

    public ArrayList<Prestamo> listarPrestamo(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionPrestamo = new ArrayList();
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTARPRESTAMO);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Prestamo prestamo = new Prestamo(rs.getInt("Codigo"), rs.getString("Estu"), rs.getString("Lib"));
                coleccionPrestamo.add(prestamo);
            }
        } catch (SQLException ex) {
            throw new GlobalException("Sentencia no valida");
        } finally {
            try {
                if (rs != null) {
                    rs.close();
                }
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }

        if (coleccionPrestamo == null || coleccionPrestamo.isEmpty()) {
            throw new NoDataException("Prestamo no existe o no hay prestamos ingresados");
        }
        return coleccionPrestamo;

    }

    public Prestamo buscarPrestamo(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        Prestamo prestamo = new Prestamo(0,"","");

        CallableStatement pstmt = null;
        try {

            pstmt = conexion.prepareCall(CONSULTARPRESTAMO);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                prestamo = new Prestamo(rs.getInt("Codigo"), rs.getString("Estu"), rs.getString("Lib"));
            }
        } catch (SQLException ex) {
            throw new GlobalException("Sentencia no valida");
        } finally {
            try {
                if (rs != null) {
                    rs.close();
                }
                if (pstmt != null) {
                    pstmt.close();
                }
                desconectar();
            } catch (SQLException e) {
                throw new GlobalException("Estatutos invalidos o nulos");
            }
        }
        return prestamo;
    }    
}

