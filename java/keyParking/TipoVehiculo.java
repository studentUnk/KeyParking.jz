package keyParking;

public class TipoVehiculo {
	
	private String nT = "_TipoVehiculo";
	public String nameS [] = new String [] {"codigo"+nT,"nombre"+nT,
			"cobroMinuto"+nT};	

		protected int codigo;
		protected String nombre;
		protected double cobro;
		
		public TipoVehiculo() {
			codigo = -1;
			nombre = "";
			cobro = -1;
		}
		
		public TipoVehiculo(int codigo, String nombre, double cobro) {
			this.codigo = codigo;
			this.nombre = nombre;
			this.cobro = cobro;
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

		public double getCobro() {
			return cobro;
		}

		public void setCobro(double cobro) {
			this.cobro = cobro;
		}
		
		public double calcularTotal(double time) {
			return cobro * time;
		}
		
}
