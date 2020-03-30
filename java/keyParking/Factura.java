package keyParking;

public class Factura {

	protected int codigo;
	protected String fecha,cancelado;
	
	Factura(){
		this.codigo = -1;
		this.fecha = "";
		this.cancelado = "";
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
	
}
