package keyParking;

public class Factura {
	
	private String nT = "_Factura";
	public String nameS [] = new String [] {"codigo"+nT,"fecha"+nT,"precio"+nT,
			"cancelado"+nT}; 

	protected int codigo;
	protected double precio;
	protected String fecha,cancelado;
	
	Factura(){
		this.codigo = -1;
		this.fecha = "";
		this.cancelado = "";
		this.precio = -1;
	}
	
	Factura(int codigo, String fecha, String cancelado){
		this.codigo = codigo;
		this.fecha = fecha;
		this.cancelado = cancelado;
	}

	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	public String getFecha() {
		return fecha;
	}

	public void setFecha(String fecha) {
		this.fecha = fecha;
	}

	public String getCancelado() {
		return cancelado;
	}

	public void setCancelado(String cancelado) {
		this.cancelado = cancelado;
	}

	public double getPrecio() {
		return precio;
	}

	public void setPrecio(double precio) {
		this.precio = precio;
	}
	
}
