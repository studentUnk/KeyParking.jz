package keyParking;

import java.sql.*;

public class Database {
	
	protected Connection conDB;
	private String urlDB = "jdbc:mysql://localhost/keyparking";
	private String defaultUser = "root";
	
	Database(){
		connectToDB();
	}
	
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
			Class.forName("com.mysql.cj.jdbc.Driver");
			this.conDB = null;
			this.conDB = DriverManager.getConnection(urlDB,defaultUser,"");
			System.out.println("Database is connected");
			//conn.close();
		}
		catch(Exception e) {
			System.out.println(e.getMessage());
			System.out.println("Database not connected");
		}
	}
	
	private void closeDB() {
		try { 
			this.conDB.close(); 
			System.out.println("Disconnected from database");
		}
		catch (Exception e) {
			System.out.println(e.getMessage());
			System.out.println("Database can not be closed");
		}
	}
	
	public static void main(String args[]) {
		//ConnectToDB();
		Database db = new Database();
		db.closeDB();
	}
}
