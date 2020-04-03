package keyParking;

public class Rol {
	
	private String nT = "_Rol";
	public String nameS [] = new String [] {"nombre"+nT,"descripcion"+nT}; 
	
	protected String nombre;
	protected String descripcion;
	
	public Rol(){
		this.nombre = "Cliente";
		this.descripcion = "";
	}
	
	public Rol(String nombre, String descripcion){
		this.nombre = nombre;
		this.descripcion = descripcion;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}
}
