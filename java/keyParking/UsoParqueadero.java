package keyParking;

public class UsoParqueadero {
	
	private String nT = "_UsoParqueadero";
	public String nameS [] = new String [] {"codigo"+nT,"inicio"+nT,"fin"+nT};
	
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
	
	public int calcularTiempo(String timeS, String timeE) {
		//yyyy-mm-dd hh:mm:ss
		// solo calcula por dia!!! FIX!!!
		int y1,y2,m1,m2,d1,d2,h1,h2,mi1,mi2;
		y1 = Integer.valueOf(timeS.substring(0,4));
		y2 = Integer.valueOf(timeE.substring(0,4));
		m1 = Integer.valueOf(timeS.substring(5,7));
		m2 = Integer.valueOf(timeE.substring(5,7));
		d1 = Integer.valueOf(timeS.substring(8,10));
		d2 = Integer.valueOf(timeE.substring(8,10));
		h1 = Integer.valueOf(timeS.substring(11,13));
		h2 = Integer.valueOf(timeE.substring(11,13));
		mi1 = Integer.valueOf(timeS.substring(14,16));
		mi2 = Integer.valueOf(timeE.substring(14,16));

		int t = 0;
		int y,m,d,h,mi;
		y = y2-y1;
		m = m2-m1;
		d = d2-d1;
		h = h2-h1;
		mi = mi2-mi1;
		/**if(y2 > y1) {
			t += (360*(y2-y1));
			t += (y*)
		}else {
			
		}**/
		if(h > 0) {
			t += ((h-2)*60);
			t += ((60-m1)+m2);
		}
		else {
			t = mi;
		}
		return t;
	}

}
