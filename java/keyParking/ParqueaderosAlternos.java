package keyParking;

public class ParqueaderosAlternos {
	
	protected int codigo;
	protected String nombre, direccion;
	
	public ParqueaderosAlternos() {
		codigo = -1;
		nombre = direccion = "";
	}
	
	public ParqueaderosAlternos(int codigo, String nombre, String direccion) {
		this.codigo = codigo;
		this.nombre = nombre;
		this.direccion = direccion;
	}

	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}
	
	
}
