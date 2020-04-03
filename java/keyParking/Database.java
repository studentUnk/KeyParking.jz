// example buttons 
// https://docs.oracle.com/javase/tutorial/uiswing/examples/components/PasswordDemoProject/src/components/PasswordDemo.java

package keyParking;

import java.sql.*;
import java.util.ArrayList;

public class Database {
	
	protected Connection conDB;
	private Statement stmt;
	private String urlDB = "jdbc:mysql://localhost/keyparking";
	private String defaultUser = "root";
	private String nameDriver = "com.mysql.cj.jdbc.Driver";
	private String sqlQ;
	private String nT;
	private ResultSet rS;
	
	public Database(){ }
	
	public String getUrlDB() {
		return urlDB;
	}

	public void setUrlDB(String urlDB) {
		this.urlDB = urlDB;
	}

	public String getDefaultUser() {
		return defaultUser;
	}

	public void setDefaultUser(String defaultUser) {
		this.defaultUser = defaultUser;
	}

	private void connectToDB() {
		try {
			Class.forName(nameDriver);
			this.conDB = null;
			this.conDB = DriverManager.getConnection(urlDB,defaultUser,"");
			System.out.println("Database is connected");
			this.stmt = null;
			//conn.close();
		}
		catch(Exception e) {
			System.out.println(e.getMessage());
			System.out.println("Database not connected");
		}
	}
	
	private void closeDB() {
		try { 
			if(conDB != null) {
				this.conDB.close(); 
				System.out.println("Disconnected from database");
			}
		}
		catch (Exception e) {
			System.out.println(e.getMessage());
			System.out.println("Database can not be closed");
		}
	}
	
	public boolean userPassUsuario(Usuario u) {
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(u.nameS[7] + ", ");
		sqlQ = sqlQ.concat(u.nameS[8]);
		sqlQ = sqlQ.concat(" FROM Usuario ");
		sqlQ = sqlQ.concat("WHERE ");
		sqlQ = sqlQ.concat(u.nameS[7] + " = " + Integer.toString(u.getCodigo()) + " AND ");
		sqlQ = sqlQ.concat(u.nameS[8] + " = '" + u.getPassword() + "'");
		System.out.println(sqlQ);
		sendQueryExecute();
		if(isEmptyQ()) {
			closeDB();
			return false;
		} else {
			closeDB();
			return true;
		}
	}
	
	public boolean insertUsuario(Usuario u, Rol r, Municipio m) {
		//sqlQ = new String();
		sqlQ = "INSERT INTO Usuario (";
		sqlQ = sqlQ.concat(u.nameS[0]);
		for(int i = 1; i < u.nameS.length; i++) {
			sqlQ = sqlQ.concat(","+u.nameS[i]);
		}
		sqlQ = sqlQ.concat(","+r.nameS[0]);
		sqlQ = sqlQ.concat(","+m.nameS[1]);
		sqlQ = sqlQ.concat(") VALUES (");
		sqlQ = sqlQ.concat("'"+u.getDocumento()+"',");
		sqlQ = sqlQ.concat("'"+u.getNombre()+"',");
		sqlQ = sqlQ.concat("'"+u.getApellido()+"',");
		sqlQ = sqlQ.concat("'"+u.getDireccion()+"',");
		sqlQ = sqlQ.concat("'"+u.getTelefono()+"',");
		sqlQ = sqlQ.concat("'"+u.getCelular()+"',");
		sqlQ = sqlQ.concat("'"+u.getCorreo()+"',");
		sqlQ = sqlQ.concat(u.getCodigo()+",");
		sqlQ = sqlQ.concat("'"+u.getPassword()+"',");
		sqlQ = sqlQ.concat("'"+r.getNombre()+"',");
		sqlQ = sqlQ.concat(m.getCodigo()+")");
		System.out.println(sqlQ);
		sendQueryUpdate();
		return true;
	}
	
	public boolean insertVehiculo(String user, String brand, String type, Vehiculo v) {
		sqlQ = "INSERT INTO Vehiculo (";
		sqlQ = sqlQ.concat(v.nameS[1] + "," + v.nameS[2] + ",");
		sqlQ = sqlQ.concat("codigo_TipoVehiculo,codigo_MarcaVehiculo, codigo_Usuario) ");
		sqlQ = sqlQ.concat("VALUES (");
		sqlQ = sqlQ.concat("'" + v.getPlaca() + "',");
		sqlQ = sqlQ.concat("'" + v.getColor() + "',");
		sqlQ = sqlQ.concat(type + "," + brand + "," + user + ")");
		System.out.println(sqlQ);
		sendQueryUpdate();
		return true; // non sense
	}
	
	public boolean insertUsoParqueadero(String codigoV, String codigoS) {
		sqlQ = "INSERT INTO UsoParqueadero (";
		sqlQ = sqlQ.concat("codigo_Vehiculo,codigo_SitioParqueadero,inicio_UsoParqueadero)");
		sqlQ = sqlQ.concat(" VALUES (");
		sqlQ = sqlQ.concat(codigoV + ",'" + codigoS + "',CURDATE())");
		System.out.println(sqlQ);
		sendQueryUpdate();
		return true;
	}
	
	public boolean insertFacturaCancelada(String user, String precio) {
		sqlQ = "INSERT INTO Factura (";
		sqlQ = sqlQ.concat("fecha_Factura,precio_Factura,codigo_Usuario,cancelado_Factura) ");
		sqlQ = sqlQ.concat("VALUES (");
		sqlQ = sqlQ.concat("CURDATE()," + precio + "," + user + ", 'Si')");
		System.out.println(sqlQ);
		sendQueryUpdate();
		return true;
	};
	
	//public Factura insertFactura() {
		
	//	return true;
	//}
	
	public String getRol(Usuario u) {
		Rol r = new Rol();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(r.nameS[0]);
		sqlQ = sqlQ.concat(" FROM Usuario ");
		sqlQ = sqlQ.concat("WHERE ");
		sqlQ = sqlQ.concat(u.nameS[7] + " = " + Integer.toString(u.getCodigo()));
		sendQueryExecute();
		String ro = "";
		try {
			if(!isEmptyQ()) {
				//rS.next();
				ro = rS.getString(r.nameS[0]);
				System.out.println("Rol " + ro);
			}else {
				System.out.println("Rol not found");
			}
			
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return ro;
	}
	
	public String getSpecificStringTable(String nameTable, String nameValue, String nameCompare, String name) {
		String s = new String();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(name); 
		sqlQ = sqlQ.concat(" FROM " + nameTable);
		sqlQ = sqlQ.concat(" WHERE " + nameValue + " = '" + nameCompare + "'");
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				s = rS.getString(name);
			}else {
				System.out.println(name + " not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return s;
	}
	
	public ArrayList<String> getFacturasEnCurso(String user) {
		ArrayList<String> up = new ArrayList<String>(); // its better an array
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(" codigo_UsoParqueadero ");
		sqlQ = sqlQ.concat("FROM ");
		sqlQ = sqlQ.concat("UsoParqueadero,Vehiculo ");
		sqlQ = sqlQ.concat("WHERE ");
		sqlQ = sqlQ.concat("codigo_Usuario = " + user + " AND ");
		sqlQ = sqlQ.concat("UsoParqueadero.codigo_Vehiculo = Vehiculo.codigo_Vehiculo AND ");
		sqlQ = sqlQ.concat("fin_UsoParqueadero IS NULL");
		//sqlQ = sqlQ.concat();
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				up.add(rS.getString("codigo_UsoParqueadero"));
			}else {
				System.out.println("UsoParqueadero" + " not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		return up;
	}
	
	public String getTiempoInicial(String codigoUsoParqueadero) {
		String s = new String ();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat("inicio_UsoParqueadero ");
		sqlQ = sqlQ.concat("FROM UsoParqueadero ");
		sqlQ = sqlQ.concat("WHERE UsoParqueadero.codigo_UsoParqueadero = '" + Integer.parseInt(codigoUsoParqueadero) + "'");
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				s = rS.getString("inicio_UsoParqueadero");
			}else {
				System.out.println("TipoVehiculo" + " not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		return s;
	}
	
	public String getCobroTipoVehiculo(String codigoUsoParqueadero) {
		String s = new String ();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat("cobroMinuto_TipoVehiculo ");
		sqlQ = sqlQ.concat("FROM ");
		sqlQ = sqlQ.concat("TipoVehiculo, Vehiculo, UsoParqueadero ");
		sqlQ = sqlQ.concat("WHERE ");
		sqlQ = sqlQ.concat("codigo_UsoParqueadero = " + codigoUsoParqueadero + " AND ");
		sqlQ = sqlQ.concat("UsoParqueadero.codigo_Vehiculo = Vehiculo.codigo_Vehiculo AND ");
		sqlQ = sqlQ.concat("Vehiculo.codigo_TipoVehiculo = TipoVehiculo.codigo_TipoVehiculo");
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				s = rS.getString("cobroMinuto_TipoVehiculo");
			}else {
				System.out.println("TipoVehiculo" + " not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		return s;
	}
	
	public String getSpecificString2TableStr2Int1(String nameTable, String nameValue, String nameCompare,
			String nameTable2, String nameValue2, String nameCompare2, 
			String nameCompareT, String name) {
		String s = new String();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(name); 
		sqlQ = sqlQ.concat(" FROM " + nameTable + "," + nameTable2);
		sqlQ = sqlQ.concat(" WHERE " + nameValue + " = '" + nameCompare + "'");
		sqlQ = sqlQ.concat(" AND " + nameValue2 + " = '" + nameCompare2 + "'");
		sqlQ = sqlQ.concat(" AND " + nameTable + "." + nameCompareT + " = " + nameTable2 + "." + nameCompareT);
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				s = rS.getString(name);
			}else {
				System.out.println(name + " not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return s;
	}
	
	public String getSpecificStringTable2Int(String nameTable, String nameValue, String nameCompare, String name,
			String nameValue2, String nameCompare2) {
		String s = new String();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(name); 
		sqlQ = sqlQ.concat(" FROM " + nameTable);
		sqlQ = sqlQ.concat(" WHERE " + nameValue + " = '" + nameCompare + "'");
		sqlQ = sqlQ.concat(" AND " + nameValue2 + " = " + nameCompare2);
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				s = rS.getString(name);
			}else {
				System.out.println(name + " not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return s;
	}
	
	public ArrayList<String> getStringTable(String nameTable, String name) {
		ArrayList<String> sS = new ArrayList<String>();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(name); 
		sqlQ = sqlQ.concat(" FROM " + nameTable);
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				//int i = 0;
				do {
					//r[i] = new SedeParqueadero();
					//r[i].setNombre(rS.getString(name));
					sS.add(rS.getString(name));
					//i++;
				}while(rS.next());
				//r[i] = new SedeParqueadero();
				//r[] = rS.getString(r.nameS[0]);
				//System.out.println(" " + ro);
			}else {
				System.out.println("SedeParqueadero not found");
			}
			
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		//return r;
		return sS;
	}
	
	public Usuario getUsuario(String cod) {
		Usuario u = new Usuario();
		sqlQ = "SELECT * ";
		sqlQ = sqlQ.concat("FROM Usuario ");
		sqlQ = sqlQ.concat("WHERE " + cod + " = codigo_Usuario");
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				u.setDocumento(rS.getString(u.nameS[0]));
				u.setNombre(rS.getString(u.nameS[1]));
				u.setApellido(rS.getString(u.nameS[2]));
				u.setDireccion(rS.getString(u.nameS[3]));
				u.setTelefono(rS.getString(u.nameS[4]));
				u.setCelular(rS.getString(u.nameS[5]));
				u.setCorreo(rS.getString(u.nameS[6]));
				u.setPassword(rS.getString(u.nameS[8]));
			}else {
				System.out.println("SedeParqueadero not found");
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return u;
	}
	
	//public Vehiculo[] getVehiculoUsuario(String cu) {
	public ArrayList<ArrayList<String>> getVehiculoUsuario(String cu){
		//Vehiculo v [] = new Vehiculo[30]; // Fix!!! it might be fixed with ArrayList
		ArrayList<ArrayList<String>> v = new ArrayList<ArrayList<String>>();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat("placa_Vehiculo, nombre_TipoVehiculo ");
		sqlQ = sqlQ.concat("FROM Vehiculo, TipoVehiculo ");
		sqlQ = sqlQ.concat("WHERE ");
		sqlQ = sqlQ.concat("codigo_Usuario = " + cu + " AND ");
		sqlQ = sqlQ.concat("TipoVehiculo.codigo_TipoVehiculo = Vehiculo.codigo_TipoVehiculo");
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				do {
					ArrayList<String> tV = new ArrayList<String>();
					tV.add(rS.getString("placa_Vehiculo"));
					tV.add(rS.getString("nombre_TipoVehiculo"));
					v.add(tV);
				}while(rS.next());
			}else {
				System.out.println("Vehiculo not found");
			}
			
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return v;
	}
	
	public SedeParqueadero [] getSedeParqueadero(){
		SedeParqueadero r [] = new SedeParqueadero[10]; // Fix!!!! the size should not be limited
		SedeParqueadero tSP = new SedeParqueadero();
		//r[0] = new SedeParqueadero();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(tSP.nameS[1]); 
		sqlQ = sqlQ.concat(" FROM SedeParqueadero");
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				int i = 0;
				do {
					r[i] = new SedeParqueadero();
					r[i].setNombre(rS.getString(tSP.nameS[1]));
					i++;
				}while(rS.next());
				r[i] = new SedeParqueadero();
				//r[] = rS.getString(r.nameS[0]);
				//System.out.println(" " + ro);
			}else {
				System.out.println("SedeParqueadero not found");
			}
			
		} catch(Exception e) {
			e.printStackTrace();
		}
		closeDB();
		return r;
	}
	
	public SitioParqueadero [] getSitioParqueadero(String sede){
		SitioParqueadero s [] = new SitioParqueadero[30]; // Fix!!!! the size should not be limited
		SitioParqueadero tSP = new SitioParqueadero();
		//r[0] = new SedeParqueadero();
		sqlQ = "SELECT ";
		sqlQ = sqlQ.concat(tSP.nameS[1]); 
		sqlQ = sqlQ.concat(" FROM SitioParqueadero, SedeParqueadero");
		sqlQ = sqlQ.concat(" WHERE SedeParqueadero.nombre_SedeParqueadero = '" + sede +"'");
		sqlQ = sqlQ.concat(" AND SedeParqueadero.codigo_SedeParqueadero = SitioParqueadero.codigo_SedeParqueadero");
		System.out.println(sqlQ);
		sendQueryExecute();
		try {
			if(!isEmptyQ()) {
				int i = 0;
				do {
					s[i] = new SitioParqueadero();
					s[i].setUbicacion(rS.getString(tSP.nameS[1]));
					i++;
				}while(rS.next());
				s[i] = new SitioParqueadero();
			}else { System.out.println("SitioParqueadero not found"); }
		} catch(Exception e) { e.printStackTrace(); }
		closeDB();
		return s;
	}
	
	public void updateTableStrStr(String nameTable, String valueSet, String value, String valueCompare, String compare) {
		sqlQ = "UPDATE " + nameTable;
		sqlQ = sqlQ.concat("SET " + valueSet + " = '" + value + "' ");
		sqlQ = sqlQ.concat("WHERE " + valueCompare + " = '" + compare + "'");
		System.out.println(sqlQ);
		sendQueryUpdate();
	}
	
	public void updateTableStrInt(String nameTable, String valueSet, String value, String valueCompare, String compare) {
		sqlQ = "UPDATE " + nameTable + " ";
		sqlQ = sqlQ.concat("SET " + valueSet + " = '" + value + "' ");
		sqlQ = sqlQ.concat("WHERE " + valueCompare + " = " + compare);
		System.out.println(sqlQ);
		sendQueryUpdate();
	}
	
	public void updateFechaFinUsoParqueadero(String date, String codigoUso) {
		sqlQ = "UPDATE UsoParqueadero ";
		sqlQ = sqlQ.concat("SET fin_UsoParqueadero = " + date + " ");
		sqlQ = sqlQ.concat("WHERE codigo_UsoParqueadero = " + codigoUso);
		System.out.println(sqlQ);
		sendQueryUpdate();
	}
	
	private void sendQueryUpdate() {
		connectToDB();
		try {
			stmt = conDB.createStatement();
			stmt.executeUpdate(sqlQ);
		} catch(SQLException se) {
			se.printStackTrace();
		} catch(Exception e) {
			e.printStackTrace();
		} finally {
			closeDB();
		}
	}
	
	private void sendQueryExecute() {
		connectToDB();
		try {
			stmt = conDB.createStatement();
			this.rS = stmt.executeQuery(sqlQ);
		} catch(SQLException se) {
			se.printStackTrace();
		} catch(Exception e) {
			e.printStackTrace();
		} 
		//finally {
		//	closeDB();
		//}
	}
	
	private boolean isEmptyQ() {
		try{
			//System.out.println(rS.getString("codigo_Usuario")+" "+rS.getString("password_Usuario"));
			if(rS.next() == false) return true;
			else return false;
		}catch(Exception e) {
			e.printStackTrace();
		}
		return true;
	}
	
	public void testSQL(Usuario u) {
		connectToDB();
		nT = "_Usuario";
		sqlQ = "INSERT INTO Usuario " +
				"(nombre"+nT+",apellido"+nT+",direccion"+nT+
				",telefono"+nT+",celular"+nT+",codigo"+nT+
				",email"+nT+",password"+nT+",documento"+nT+
				",codigo_Municipio,nombre_Rol)"+
				"VALUES ('"+u.getNombre()+"','"+u.getApellido()+"','"+
				u.getDireccion()+"','"+u.getTelefono()+"','"+
				u.getCelular()+"','"+u.getCodigo()+"','"+
				u.getCorreo()+"','"+u.getPassword()+"','"+u.getDocumento()+
				"',1101,'Cliente')";
		System.out.println(sqlQ);
		try {
			stmt = conDB.createStatement();
			stmt.executeUpdate(sqlQ);
		} catch(SQLException se) {
			se.printStackTrace();
		} catch(Exception e) {
			e.printStackTrace();
		} finally {
			closeDB();
		}
	}
	
	public static void main(String args[]) {
		//ConnectToDB();
		Database db = new Database();
		db.connectToDB();
		db.closeDB();
	}
}
