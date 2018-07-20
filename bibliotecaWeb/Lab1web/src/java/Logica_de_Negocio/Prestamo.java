/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Logica_de_Negocio;

public class Prestamo {
    private String estudiante;
    private String libro;
    private int codigo;

    public Prestamo(int codigo,String estudiante, String libro) {
        this.estudiante = estudiante;
        this.libro = libro;
        this.codigo = codigo;
    }

    public Prestamo() {
    }

    public String getEstudiante() {
        return estudiante;
    }

    public void setEstudiante(String estudiante) {
        this.estudiante = estudiante;
    }

    public String getLibro() {
        return libro;
    }

    public void setLibro(String libro) {
        this.libro = libro;
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    
}
