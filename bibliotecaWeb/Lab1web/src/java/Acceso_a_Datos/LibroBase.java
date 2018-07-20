/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Acceso_a_Datos;

import Logica_de_Negocio.Libro;
import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author Alex
 */
public class LibroBase extends Conexion {

    /** Creates a new instance of LibroBase */
    private static final String INSERTARLIBRO = "{call LibroInsertar(?,?,?,?)}";
    private static final String LISTARLIBRO = "{call LibroListar(?)}";
    private static final String ACTUALIZARLIBRO = "{call LibroActualizar(?,?,?,?)}";
    private static final String ELIMINARLIBRO = "{call LibroEliminar(?)}";
    private static final String CONSULTARLIBRO = "{call LibroBuscar(?)}";
    private static final String INSERTARLIBRO2 = "{call LibroAutorInsertar(?,?)}";

    public void insertarLibro(Libro libro) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(INSERTARLIBRO);
            pstmt.setString(1, libro.getId());
            pstmt.setString(2, libro.getDescripcion());
            pstmt.setString(3, libro.getisbn());
            pstmt.setInt(4, libro.getCantidadEjemplares());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo agregar el libro");
            }

        } catch (SQLException e) {
            //e.printStackTrace();
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

    public void actualizarLibro(Libro libro) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ACTUALIZARLIBRO);
            pstmt.setString(1, libro.getId());
            pstmt.setString(2, libro.getDescripcion());
            pstmt.setString(3, libro.getisbn());
            pstmt.setInt(4, libro.getCantidadEjemplares());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar el libro");
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
    }

    public void eliminarLibro(String libro) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ELIMINARLIBRO);
            pstmt.setString(1, libro);
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar el libro");
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
    }

    public ArrayList<Libro> listarLibro(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionLibro = new ArrayList();
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTARLIBRO);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Libro libro = new Libro(rs.getString("IdLibro"), rs.getString("Descripcion"), rs.getString("ISBN"), rs.getInt("CantidadEjemplares"));
                coleccionLibro.add(libro);
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

        if (coleccionLibro == null || coleccionLibro.isEmpty()) {
            throw new NoDataException("Libro no existe o no hay libros registrados");
        }
        return coleccionLibro;

    }

    public Libro buscarLibro(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        Libro libro = new Libro("", "", "", 0);

        CallableStatement pstmt = null;
        try {

            pstmt = conexion.prepareCall(CONSULTARLIBRO);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                libro = new Libro(rs.getString("IdLibro"), rs.getString("Descripcion"), rs.getString("ISBN"), rs.getInt("CantidadEjemplares"));
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
        return libro;

    }

    public void actualizarLibro2(Libro libro) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(INSERTARLIBRO2);
            pstmt.setString(1, libro.getId());
            pstmt.setString(2, libro.getDescripcion());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar el libro");
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
    }
}
