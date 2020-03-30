package keyParking;

public class TipoVehiculo {

		protected int codigo;
		protected String nombre;
		
		public TipoVehiculo() {
			codigo = -1;
			nombre = "";
		}
		
		public TipoVehiculo(int codigo, String nombre) {
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
