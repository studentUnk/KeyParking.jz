package keyParking;

public class Vehiculo {
	
	protected int codigo;
	protected String placa;
	protected String color;
	
	public Vehiculo(){
		codigo = -1;
		placa = color = "";
	}
	
	public Vehiculo(int codigo, String placa, String color) {
		this.codigo = codigo;
		this.placa = placa;
		this.color = color;
	}

	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	public String getPlaca() {
		return placa;
	}

	public void setPlaca(String placa) {
		this.placa = placa;
	}

	public String getColor() {
		return color;
	}

	public void setColor(String color) {
		this.color = color;
	}
	
	

}
