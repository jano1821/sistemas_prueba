/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Logica_de_Negocio;

/**
 *
 * @author Estudiante
 */
public class Estudiante extends Persona{
    private int Edad;
    private String Direccion;
    private String Email;
    private String Carrera;
    private double Promedio;

    public Estudiante(String IdEstudiante, int Edad, String Nombre,  String Email, String Carrera, String Direccion,double Promedio) {
        super(IdEstudiante, Nombre);
        this.Edad = Edad;
        this.Direccion = Direccion;
        this.Email = Email;
        this.Carrera = Carrera;
        this.Promedio = Promedio;
    }

    public Estudiante(){}

    public String getCarrera() {
        return Carrera;
    }

    public void setCarrera(String Carrera) {
        this.Carrera = Carrera;
    }

    public String getDireccion() {
        return Direccion;
    }

    public void setDireccion(String Direccion) {
        this.Direccion = Direccion;
    }

    public int getEdad() {
        return Edad;
    }

    public void setEdad(int Edad) {
        this.Edad = Edad;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String Email) {
        this.Email = Email;
    }

    public double getPromedio() {
        return Promedio;
    }

    public void setPromedio(double Promedio) {
        this.Promedio = Promedio;
    }
}
