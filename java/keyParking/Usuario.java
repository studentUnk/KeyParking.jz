package keyParking;

public class Usuario{
	
	protected int codigo;
	protected String documento,nombre,apellido,direccion,telefono,celular;
	private String password;
	
	Usuario(){
		codigo = -1;
		documento=nombre=apellido=direccion=telefono=celular=password="";
	}
	
	Usuario(int codigo, String documento, String nombre, String apellido, String direccion, String telefono, String celular, String password){
		this.codigo = codigo;
		this.documento = documento;
		this.nombre = nombre;
		this.apellido = apellido;
		this.direccion = direccion;
		this.telefono = telefono;
		this.celular = celular;
		this.password = password;
	}
	
	protected int getCodigo() {
		return codigo;
	}

	protected void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	protected String getDocumento() {
		return documento;
	}

	protected void setDocumento(String documento) {
		this.documento = documento;
	}

	protected String getNombre() {
		return nombre;
	}

	protected void setNombre(String nombre) {
		this.nombre = nombre;
	}

	protected String getApellido() {
		return apellido;
	}

	protected void setApellido(String apellido) {
		this.apellido = apellido;
	}

	protected String getDireccion() {
		return direccion;
	}

	protected void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	protected String getTelefono() {
		return telefono;
	}

	protected void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	protected String getCelular() {
		return celular;
	}

	protected void setCelular(String celular) {
		this.celular = celular;
	}

	protected String getPassword() {
		return password;
	}

	protected void setPassword(String password) {
		this.password = password;
	}
	
}