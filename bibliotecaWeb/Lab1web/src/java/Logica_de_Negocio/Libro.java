/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Logica_de_Negocio;

/**
 *
 * @author Estudiante
 */
public class Libro extends Base{

    private String ISBN;
    private int CantidadEjemplares;

    public Libro(String IdLibro, String Descripcion, String ISBN, int CantidadEjemplares) {
        super(IdLibro, Descripcion);
        this.ISBN = ISBN;
        this.CantidadEjemplares = CantidadEjemplares;
    }

    public Libro(){}

    public int getCantidadEjemplares() {
        return CantidadEjemplares;
    }

    public void setCantidadEjemplares(int CantidadEjemplares) {
        this.CantidadEjemplares = CantidadEjemplares;
    }

    public String getisbn() {
        return ISBN;
    }

    public void setISBN(String ISBN) {
        this.ISBN = ISBN;
    }
}
