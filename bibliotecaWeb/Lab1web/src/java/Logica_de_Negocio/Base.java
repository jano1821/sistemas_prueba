/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Logica_de_Negocio;

/**
 *
 * @author Alex
 */
public class Base {
    private String id;
    private String descripcion;

    public Base(String id, String descripcion) {
        this.id = id;
        this.descripcion = descripcion;
    }

    public Base(){}
    public String getDescripcion() {
        return descripcion;
    }

    public String getId() {
        return id;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public void setId(String id) {
        this.id = id;
    }

}
