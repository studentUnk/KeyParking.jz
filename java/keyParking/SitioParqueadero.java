package keyParking;

public class SitioParqueadero {
	
	protected int codigo;
	protected String ubicacion,disponibilidad;
	
	public SitioParqueadero () {
		codigo = -1;
		ubicacion = disponibilidad = ""; 
	}
	
	public SitioParqueadero (int codigo, String ubicacion, String disponibilidad) {
		this.codigo = codigo;
		this.ubicacion = ubicacion;
		this.disponibilidad = disponibilidad;
	}

	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	public String getUbicacion() {
		return ubicacion;
	}

	public void setUbicacion(String ubicacion) {
		this.ubicacion = ubicacion;
	}

	public String getDisponibilidad() {
		return disponibilidad;
	}

	public void setDisponibilidad(String disponibilidad) {
		this.disponibilidad = disponibilidad;
	}
	
	
	
}
