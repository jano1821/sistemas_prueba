/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Acceso_a_Datos;

import Logica_de_Negocio.Materia;
import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author Alex
 */
public class MateriaBase extends Conexion {

    /** Creates a new instance of MateriaBase */
    private static final String INSERTARMATERIA = "{call MateriaInsertar(?,?,?)}";
    private static final String LISTARMATERIA = "{call MateriaListar(?)}";
    private static final String ACTUALIZARMATERIA = "{call MateriaActualizar(?,?,?)}";
    private static final String ELIMINARMATERIA = "{call MateriaEliminar(?)}";
    private static final String CONSULTARMATERIA = "{call MateriaBuscar(?)}";
    private static final String INSERTARCALIFICACION = "{call CalificacionInsertar(?,?,?)}";
    private static final String ACTUALIZARCALIFICACION = "{call CalificacionActualizar(?,?,?)}";
    private static final String ELIMINARESTUDIANTE = "{call CalificacionEliminar(?)}";

    public void insertarMateria(Materia materia) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(INSERTARMATERIA);
            pstmt.setString(1, materia.getId());
            pstmt.setString(2, materia.getDescripcion());
            pstmt.setInt(3, materia.getCreditaje());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo agregar la materia");
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

    public void actualizarMateria(Materia materia) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ACTUALIZARMATERIA);
            pstmt.setString(1, materia.getId());
            pstmt.setString(2, materia.getDescripcion());
            pstmt.setInt(3, materia.getCreditaje());
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar la materia");
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

    public void eliminarMateria(String materia) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ELIMINARMATERIA);
            pstmt.setString(1, materia);
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

    public ArrayList<Materia> listarMateria(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        ArrayList coleccionMateria = new ArrayList();
        //cliente elCliente = null;
        CallableStatement pstmt = null;
        try {
            pstmt = conexion.prepareCall(LISTARMATERIA);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {

                Materia materia = new Materia(rs.getString("IdMateria"), rs.getString("Descripcion"), rs.getInt("Creditaje"));
                coleccionMateria.add(materia);
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

        if (coleccionMateria == null || coleccionMateria.isEmpty()) {
            throw new NoDataException("No existe la materia buscada o no hay materias registradas");
        }
        return coleccionMateria;

    }

    public Materia buscarMateria(String id) throws GlobalException, NoDataException {
        try {
            conectar();
        } catch (ClassNotFoundException ex) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException ex) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        ResultSet rs = null;
        Materia materia = new Materia("", "", 0);

        CallableStatement pstmt = null;
        try {

            pstmt = conexion.prepareCall(CONSULTARMATERIA);
            pstmt.setString(1, id);
            rs = pstmt.executeQuery();
            while (rs.next()) {
                materia = new Materia(rs.getString("IdMateria"), rs.getString("Descripcion"), rs.getInt("Creditaje"));
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
        return materia;

    }

    public void actualizarMateria(String idM, String idE) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(INSERTARCALIFICACION);
            pstmt.setString(1, idM);
            pstmt.setString(2, idE);
            pstmt.setDouble(3, 0);
//            pstmt.executeQuery();
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo Insertar al estudiante");
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

    public void actualizarNota(String id, String id2, double nota) throws GlobalException, NoDataException, SQLException {
        try {
            conectar();
        } catch (ClassNotFoundException e) {
            throw new GlobalException("No se ha localizado el driver");
        } catch (SQLException e) {
            throw new NoDataException("La base de datos no se encuentra disponible");
        }
        CallableStatement pstmt = null;

        try {

            pstmt = conexion.prepareCall(ACTUALIZARCALIFICACION);
            pstmt.setString(1, id);
            pstmt.setString(2, id2);
            pstmt.setDouble(3, nota);
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo actualizar la materia");
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

    public void eliminarEstudiante(int id) throws GlobalException, NoDataException, SQLException {
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
            pstmt.setInt(1, id);
            boolean resultado = pstmt.execute();
            if (resultado == true) {
                throw new NoDataException("No se pudo eliminar");
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
