package keyParking;

public class Departamento {
	
	private String nT = "_Departamento";
	public String nameS [] = new String [] {"codigo"+nT,"nombre"+nT}; 
	
	protected String nombre;
	protected int codigo;
	
	Departamento(){
		nombre = "";
		codigo = -1;
	}
	
	Departamento(String nombre, int codigo){
		this.nombre = nombre;
		this.codigo = codigo;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public int getCodigo() {
		return codigo;
	}

	public void setCodigo(int codigo) {
		this.codigo = codigo;
	}

}
