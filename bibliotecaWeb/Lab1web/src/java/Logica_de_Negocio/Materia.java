/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Logica_de_Negocio;

/**
 *
 * @author Estudiante
 */
public class Materia extends Base{

    private int Creditaje;

    public Materia(String IdMateria, String Descripcion,  int Creditaje) {
        super(IdMateria, Descripcion);
        this.Creditaje = Creditaje;
    }

    public Materia(){}

    public int getCreditaje() {
        return Creditaje;
    }

    public void setCreditaje(int Creditaje) {
        this.Creditaje = Creditaje;
    }
}
