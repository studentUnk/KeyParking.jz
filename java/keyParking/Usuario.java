package keyParking;

public class Usuario{
	
	private String nT = "_Usuario";
	public String nameS [] = new String [] {"documento"+nT,"nombre"+nT,"apellido"+
			nT,"direccion"+nT,"telefono"+nT,"celular"+nT,"email"+nT,"codigo"+
			nT,"password"+nT}; 
	
	protected int codigo;
	protected String documento,nombre,apellido,direccion,telefono,celular,correo;
	private String password;
	
	public Usuario(){
		codigo = -1;
		documento=correo=nombre=apellido=direccion=telefono=celular=password="";
	}
	
	public Usuario(int codigo, String documento, String nombre, String apellido, String direccion, String telefono, String celular, String correo, String password){
		this.codigo = codigo;
		this.documento = documento;
		this.nombre = nombre;
		this.apellido = apellido;
		this.direccion = direccion;
		this.telefono = telefono;
		this.celular = celular;
		this.correo = correo;
		this.password = password;
	}
	
	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

	public String getDocumento() {
		return documento;
	}

	public void setDocumento(String documento) {
		this.documento = documento;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getApellido() {
		return apellido;
	}

	public void setApellido(String apellido) {
		this.apellido = apellido;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getCelular() {
		return celular;
	}

	public void setCelular(String celular) {
		this.celular = celular;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getCorreo() {
		return correo;
	}

	public void setCorreo(String correo) {
		this.correo = correo;
	}
	
}