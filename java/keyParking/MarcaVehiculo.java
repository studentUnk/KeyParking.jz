package keyParking;

public class MarcaVehiculo {
	
	protected int codigo;
	protected String nombre;
	
	public MarcaVehiculo() {
		this.codigo = -1;
		this.nombre = "";
	}
	
	public MarcaVehiculo(int codigo, String nombre) {
		this.codigo = codigo;
		this.nombre = nombre;
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
	
}
