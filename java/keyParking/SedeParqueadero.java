package keyParking;

public class SedeParqueadero {
	
	private String nT = "_SedeParqueadero";
	public String nameS [] = new String [] {"codigo"+nT,"nombre"+nT,"direccion"+nT,
			"apertura"+nT, "cierre"+nT};
	
	protected int codigo;
	String nombre, direccion, apertura, cierre;
	
	SedeParqueadero(){
		codigo = -1;
		nombre = direccion = apertura = cierre = "";
	}
	
	SedeParqueadero(int codigo, String nombre, String direccion, String apertura, String cierre){
		this.codigo = codigo;
		this.nombre = nombre;
		this.direccion = direccion;
		this.apertura = apertura;
		this.cierre = cierre;
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

	public String getApertura() {
		return apertura;
	}

	public void setApertura(String apertura) {
		this.apertura = apertura;
	}

	public String getCierre() {
		return cierre;
	}

	public void setCierre(String cierre) {
		this.cierre = cierre;
	}
	
}
