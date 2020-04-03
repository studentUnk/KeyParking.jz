package keyParking;

public class Municipio{
	
	private String nT = "_Municipio";
	public String nameS [] = new String [] {"nombre"+nT,"codigo"+nT}; 
	
	protected int codigo;
	protected String nombre;
	
	public Municipio(){
		codigo = 1101; // Bogota
		nombre = "";
	}
	
	public Municipio(int codigo, String nombre){
		this.codigo = codigo;
		this.nombre = nombre;
	}
	
	protected int getCodigo () {
		return this.codigo;
	}
	
	protected String getNombre() {
		return this.nombre;
	}
	
	protected void setCodigo(int codigo) {
		this.codigo = codigo;
	}
	
	protected void setNombre(String nombre) {
		this.nombre = nombre;
	}
	
}