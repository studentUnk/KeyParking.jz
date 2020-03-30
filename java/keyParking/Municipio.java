package keyParking;

public class Municipio{
	protected int codigo;
	protected String nombre;
	
	public Municipio(){ // clase vacia
		codigo = -1;
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