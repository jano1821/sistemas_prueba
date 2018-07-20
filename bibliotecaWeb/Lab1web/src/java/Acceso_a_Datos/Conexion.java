package Acceso_a_Datos;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

//import java.sql.Connection;
//
//import javax.sql.DataSource;
//
//import com.mysql.jdbc.jdbc2.optional.MysqlConnectionPoolDataSource;

public class Conexion {

    protected Connection conexion = null;

    public Conexion() {
    }

    protected void conectar() throws SQLException, ClassNotFoundException {
        Class.forName("com.mysql.jdbc.Driver");
        // try {
        conexion = DriverManager.getConnection("jdbc:mysql://localhost:3306/biblioteca","root","root");
        //conexion = getJdbcMydbsource();
       /* } catch (NamingException ex) {
        ex.printStackTrace();
        }*/

    }

    protected void desconectar() throws SQLException {
        if (!conexion.isClosed()) {
            conexion.close();
        }
    }

    private Connection getJdbcMydbsource() throws NamingException {
        Context c = new InitialContext();
        try {
            return ((DataSource) c.lookup("jdbc/Mydbsource")).getConnection();
        } catch (NamingException ex) {
            ex.printStackTrace();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return null;
    }
//    private static DataSource connectionFactory = null;
//
//    static {
//        MysqlConnectionPoolDataSource connectionFactoryTmp = new MysqlConnectionPoolDataSource();
//        connectionFactoryTmp.setServerName("localhost");
//        connectionFactoryTmp.setDatabaseName("biblioteca");
//        connectionFactoryTmp.setUser("root");
//        //connectionFactoryTmp.setPassword("root");
//        connectionFactory = connectionFactoryTmp;
//    }
//
//    public static DataSource getConnectionFactory() {
//        return connectionFactory;
//    }
//
//    public Connection getConnection() throws Exception {
//        Connection resultado;
//        try {
//            resultado = DataBase.getConnectionFactory().getConnection();
//            resultado.setAutoCommit(false); // begin transaction
//            return resultado;
//        } catch (Exception e) {
//            throw new Exception("Error de conexion a la base de datos.");
//        }
//    }
}
