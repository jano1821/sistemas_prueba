/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Logica_de_Negocio;

/**
 *
 * @author Alex
 */
public class Persona {
    private String id;
    private String nombre;

    public Persona(String id, String nombre) {
        this.id = id;
        this.nombre = nombre;
    }

    public Persona(){}
    
    public String getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setId(String id) {
        this.id = id;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    
}
