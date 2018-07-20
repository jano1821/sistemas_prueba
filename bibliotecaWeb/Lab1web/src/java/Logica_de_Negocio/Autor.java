/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Logica_de_Negocio;



/**
 *
 * @author Estudiante
 */
public class Autor extends Persona{
    private String AreaEspecialidad;
    private int cantidadPublicaciones;

    public Autor(String IdAutor, String Nombre, String AreaEspecialidad, int cantidadPublicaciones) {
        super(IdAutor, Nombre);
        this.AreaEspecialidad = AreaEspecialidad;
        this.cantidadPublicaciones = cantidadPublicaciones;
    }

    public Autor(){}

    public String getAreaEspecialidad() {
        return AreaEspecialidad;
    }

    public void setAreaEspecialidad(String AreaEspecialidad) {
        this.AreaEspecialidad = AreaEspecialidad;
    }

    public int getCantidadPublicaciones() {
        return cantidadPublicaciones;
    }

    public void setCantidadPublicaciones(int cantidadPublicaciones) {
        this.cantidadPublicaciones = cantidadPublicaciones;
    }



}
    