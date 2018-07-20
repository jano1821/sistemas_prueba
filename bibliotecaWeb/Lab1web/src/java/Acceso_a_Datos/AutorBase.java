/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Acceso_a_Datos;

import Logica_de_Negocio.Autor;
import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author Alex
 */
public class AutorBase extends Conexion {

    /** Creates a new instance of EstudianteBase */
    private static final String INSERTARAUTOR = "{call AutorInsertar(?,?,?,?)}";
    private static final String LISTARAUTOR = "{call AutorListar(?)}";
    private static final String ACTUALIZARAUTOR = "{call AutorActualizar(?,?,?,?)}";
    private static final String ELIMINARAUTOR = "{call AutorEliminar(?)}";
    private static final String CONSULTARAUTOR = "{call AutorBuscar(?)}";
    private static final String LISTARAUTOR2 = "{call LibroAutorBuscar(?)}";

    public AutorBase() {
    }

    public void insertarAutor(Autor autor) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(INSERTARAUTOR);
            pstmt.setString(1, autor.getId());
            pstmt.setString(2, autor.getNombre());
            pstmt.setString(3, autor.getAreaEspecialidad());
            pstmt.setInt(4, autor.getCantidadPublicaciones());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo agregar el autor");
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

    public void actualizarAutor(Autor autor) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ACTUALIZARAUTOR);
            pstmt.setString(1, autor.getId());
            pstmt.setString(2, autor.getNombre());
            pstmt.setString(3, autor.getAreaEspecialidad());
            pstmt.setInt(4, autor.getCantidadPublicaciones());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar el autor");
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

    public void eliminarAutor(String autor) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ELIMINARAUTOR);
            pstmt.setString(1, autor);
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar el autor");
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

    public ArrayList<Autor> listarAutor(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionAutor = new ArrayList();
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTARAUTOR);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Autor autor = new Autor(rs.getString("IdAutor"), rs.getString("Nombre"), rs.getString("Area"), rs.getInt("CantidadPublicaciones"));
                coleccionAutor.add(autor);
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

        if (coleccionAutor == null || coleccionAutor.isEmpty()) {
            throw new NoDataException("Autor no existe o no hay autores ingresados");
        }
        return coleccionAutor;

    }

    public Autor buscarAutor(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        Autor autor = new Autor("","","",0);
        CallableStatement pstmt = null;
        try {

            pstmt = conexion.prepareCall(CONSULTARAUTOR);
            pstmt.setString(1,id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                autor = new Autor(rs.getString("IdAutor"), rs.getString("Nombre"), rs.getString("Area"), rs.getInt("CantidadPublicaciones"));
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
        return autor;

    }

    public ArrayList<Autor> listarAutor2(String id) throws GlobalException, NoDataException{
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionAutor = new ArrayList();
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTARAUTOR2);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Autor autor = new Autor(rs.getString("Aut"), rs.getString("Lib"),"", rs.getInt("Codigo"));
                coleccionAutor.add(autor);
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

        if (coleccionAutor == null || coleccionAutor.isEmpty()) {
            throw new NoDataException("Autor no existe o no hay autores ingresados");
        }
        return coleccionAutor;

    }
}
