package keyParking;

public class UsoParqueadero {
	
	protected int codigo;
	protected String fechaInicio, fechaFin;
	
	public UsoParqueadero() {
		codigo = -1;
		fechaInicio = fechaFin = "";
	}
	
	public UsoParqueadero(int codigo, String fechaInicio, String fechaFin) {
		this.codigo = codigo;
		this.fechaInicio = fechaInicio;
		this.fechaFin = fechaFin;
	}

	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	public String getFechaInicio() {
		return fechaInicio;
	}

	public void setFechaInicio(String fechaInicio) {
		this.fechaInicio = fechaInicio;
	}

	public String getFechaFin() {
		return fechaFin;
	}

	public void setFechaFin(String fechaFin) {
		this.fechaFin = fechaFin;
	}
	
	

}
