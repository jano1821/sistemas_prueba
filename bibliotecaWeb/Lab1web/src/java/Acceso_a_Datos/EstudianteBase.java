/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Acceso_a_Datos;

import Logica_de_Negocio.Estudiante;
import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author Alex
 * Clase que permite la conexion con la base para sacer los datos de estudiante
 */
public class EstudianteBase extends Conexion {

    /** Creates a new instance of EstudianteBase */
    private static final String INSERTARESTUDIANTE = "{call EstudianteInsertar(?,?,?,?,?,?)}";
    private static final String LISTARESTUDIANTE = "{call EstudianteListar(?)}";
    private static final String ACTUALIZARESTUDIANTE = "{call EstudianteActualizar(?,?,?,?,?,?)}";
    private static final String ELIMINARESTUDIANTE = "{call EstudianteEliminar(?)}";
    private static final String CONSULTARESTUDIANTE = "{call EstudianteBuscar(?)}";
    private static final String BUSCARCALIFICACION = "{call CalificacionListar(?)}";

    public EstudianteBase() {
    }
    /**
     * Ingresa un nuevo  estudiante a la BD
     * @param estudiante provee la informacion del estudiante
     */

    public void insertarEstudiante(Estudiante estudiante) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(INSERTARESTUDIANTE);
            pstmt.setString(1, estudiante.getId());
            pstmt.setInt(2, estudiante.getEdad());
            pstmt.setString(3, estudiante.getNombre());
            pstmt.setString(4, estudiante.getEmail());
            pstmt.setString(5, estudiante.getCarrera());
            pstmt.setString(6, estudiante.getDireccion());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo agregar el estudiante");
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

    public void actualizarEstudiante(Estudiante estudiante) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ACTUALIZARESTUDIANTE);
            pstmt.setString(1, estudiante.getId());
            pstmt.setInt(2, estudiante.getEdad());
            pstmt.setString(3, estudiante.getNombre());
            pstmt.setString(4, estudiante.getEmail());
            pstmt.setString(5, estudiante.getCarrera());
            pstmt.setString(6, estudiante.getDireccion());
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


    public void eliminarEstudiante(String estudiante) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ELIMINARESTUDIANTE);
            pstmt.setString(1, estudiante);
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

    public ArrayList<Estudiante> listarEstudiante(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionEstudiante = new ArrayList();
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTARESTUDIANTE);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Estudiante estudiante = new Estudiante(rs.getString("IdEstudiante"), rs.getInt("Edad"), rs.getString("Nombre"), rs.getString("Email"), rs.getString("Carrera"), rs.getString("Direccion"), rs.getFloat("PromedioPonderado"));
                coleccionEstudiante.add(estudiante);
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

        if (coleccionEstudiante == null || coleccionEstudiante.isEmpty()) {
            throw new NoDataException("Estudiante no existe o no hay estudiantes ingresados");
        }
        return coleccionEstudiante;

    }

    public Estudiante buscarEstudiante(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        Estudiante estudiante = new Estudiante("",0,"","","","",0.0);

        CallableStatement pstmt = null;
        try {

            pstmt = conexion.prepareCall(CONSULTARESTUDIANTE);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                estudiante = new Estudiante(rs.getString("IdEstudiante"), rs.getInt("Edad"), rs.getString("Nombre"), rs.getString("Email"), rs.getString("Carrera"), rs.getString("Direccion"), rs.getFloat("PromedioPonderado"));
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
        return estudiante;

    }

    public ArrayList<Estudiante> listarEstudiante2(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionEstudiante = new ArrayList();
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(BUSCARCALIFICACION);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Estudiante estudiante = new Estudiante(rs.getString("Estu"), rs.getInt("Codigo"), "", "", "", "", rs.getDouble("Nota"));
                coleccionEstudiante.add(estudiante);
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

        if (coleccionEstudiante == null || coleccionEstudiante.isEmpty()) {
            throw new NoDataException("Estudiante no existe o no hay estudiantes ingresados");
        }
        return coleccionEstudiante;

    }
}
