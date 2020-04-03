package applet;

import keyParking.*;

import javax.swing.*;
import java.awt.BorderLayout;
import java.awt.Choice;
import java.awt.Color;
import java.awt.Container;
import java.awt.Dimension;
import java.awt.GridLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class UsuarioApplet implements ActionListener {
	
	String nameFrame [] = new String [] {
			"Menu de cliente",
			"Menu de auxiliar",
			"Menu de administrador"
	};
	
	String buttonMenuUA[][] = new String [][] {
		{
			"Solicitar cupo",
			"Pagar factura",
			"Facturas pagadas",
			"Alternativas parqueadero",
			"Modificar datos",
			"Agregar vehiculo"
		},
		{
			"Usuario",
			"Sedes",
			"Sedes alternas",
			"Vehiculos"
		},
		{
			"Usuario",
			"Rol",
			"Sedes",
			"Sede alterna",
			"Marcas",
			"Tipo vehiculo",
			"Ciudad",
			"Departamento",
			"Desarrollador"
		}		
	};
	
	String labelOpcionUsuario [][] = new String[][] {
		{"Sede","Sitios disponibles","Vehiculo"},
		{"Facturas en curso"},
		{"Codigo","Fecha factura","Precio","Vehiculo","Fecha inicio","Fecha fin"},
		{"Sede"},
		{"Documento","Nombre","Apellido","Direccion","Telefono","Celular","Correo","Password"},
		{"Tipo de vehiculo", "Marca", "Placa", "Color"}
	};
	
	String strButtonS = "Solicitar";
	String strButtonP = "Pagar";
	String strButtonC = "Cargar";
	String strButtonRC = "Realizar cambios";
	String strButtonCS = "Cerrar sesion";
	String strButtonA = "Agregar";
	
	String nameUser;
	
	int typeUser;
	int optionP;
	int optionC=0;
	int optionSede=0;
	
	SedeParqueadero sP, sP2[];
	SitioParqueadero siP, siP2[];
	Vehiculo vH, vH2[];
	MarcaVehiculo mV, mV2[];
	TipoVehiculo tV, tV2[];
	Usuario uS, uS2[];
	UsoParqueadero uP;
	
	Database db;
	
	String tS [];
	ArrayList <String> sL;
	ArrayList <ArrayList<String>> sL2;
	SimpleDateFormat formatD;
	Date date;
	
	Boolean RIGHT_TO_LEFT = false;
	
	Dimension dTF = new Dimension(250,25);
	Dimension dC = new Dimension(100,25);
	
	JFrame frame;
	JLabel labelUsuario []; 
	JTextField fieldUsuario [];
	JTextField txtF1,txtF2,txtF3,txtF4,txtF5,txtF6,txtF7,txtF8;
	JButton buttonMenu [];
	JButton buttonS,buttonS2,closeS;
	JPanel panelMenu;
	JPanel panelOptions;
	Choice choi1,choi2,choi3;
	
	UsuarioApplet(){}
	
	private void setMyDate() {
		formatD = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		date = new Date();
		//formatD.format(date);
	}
	
	private void addButtonsMenu(String bM[]) {
		buttonMenu = new JButton [bM.length];
		for(int i = 0; i < bM.length; i++) {
			buttonMenu[i] = new JButton(bM[i]);
			buttonMenu[i].addActionListener(this);
			panelMenu.add(buttonMenu[i],BorderLayout.CENTER);
		}
	}
	
	public void actionPerformed(ActionEvent e) {
		String buttonAction = e.getActionCommand();
		for(int i = 0; i < buttonMenuUA[typeUser].length; i++) {
			if(buttonAction.equals(buttonMenuUA[typeUser][i]) && i != optionC) {
				optionP = optionC;
				optionC = i;
				panelOptions.removeAll();
				frame.getContentPane().remove(panelOptions);
				addOptionsMenu();
				frame.getContentPane().add(panelOptions);
				frame.getContentPane().revalidate();
				frame.getContentPane().repaint();
				break;
			}
		}
		
	}
	
	private void addOptionsMenu() {
		int sz = labelOpcionUsuario[optionC].length; // amount of options
		panelOptions = new JPanel(); /// this might be a problem
		if(optionC == 0 || optionC == 1 || optionC == 4 || optionC == 5) {
			panelOptions.setLayout(new GridLayout(sz+1,1));
		}
		else {
			panelOptions.setLayout(new GridLayout(sz,1));
		}
		
		JPanel panelOM [] = new JPanel [sz]; // set panel
		for(int i = 0 ; i < sz; i++) {
			panelOM[i] = new JPanel();
			//if(optionC == 0) {
			//	panelOM[i].setLayout(new GridLayout(1,2));
			//}
		}
		
		labelUsuario = new JLabel [sz];
		for(int i = 0; i < sz; i++) { // set label
			labelUsuario[i] = new JLabel(labelOpcionUsuario[optionC][i]);
			panelOM[i].add(labelUsuario[i]); // first position => the labels
		}
		
		switch(optionC) {
			case 0:
				choi1 = new Choice(); // Sede choice
				choi1.setPreferredSize(dC);
				sP2 = db.getSedeParqueadero();
				for(int i = 0; sP2[i].getNombre() != ""; i++){
					choi1.add(sP2[i].getNombre());
				}
				/**sL = db.getStringTable("SedeParqueadero", "nombre_SedeParqueadero");
				tS = new String [1];
				tS[0] = new String();
				String sTT;
				for(int i = 0; i < sL.size(); i++) {
					//tS[0] = sL.get(i);
					sTT = sL.get(i);
					choi1.add(sTT);
				}*/
				//choi1.add("1"); // load file with the array Sede
				//choi1.add("2");
				panelOM[0].add(choi1); // First option
				buttonS2 = new JButton(strButtonC);
				buttonS2.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						if(choi1.getSelectedIndex() != optionSede) {
							choi2.removeAll();
							siP2 = db.getSitioParqueadero(choi1.getSelectedItem());
							for(int i = 0; siP2[i].getUbicacion() != ""; i++){
								choi2.add(siP2[i].getUbicacion());
							}
							optionSede = choi1.getSelectedIndex();
							choi2.repaint();
							JOptionPane.showMessageDialog(frame, "Sitios disponibles actualizados");
						}
					}
				});
				panelOM[0].add(buttonS2);
				choi2 = new Choice(); // this needs to be constantly updated
				choi2.setPreferredSize(dC);
				siP2 = db.getSitioParqueadero(sP2[0].getNombre());
				for(int i = 0; siP2[i].getUbicacion() != ""; i++){
					choi2.add(siP2[i].getUbicacion());
				}
				panelOM[1].add(choi2); // Second option
				choi3 = new Choice();
				//v.setBounds(100,100,75,75);
				choi3.setPreferredSize(dC);
				sL2 = db.getVehiculoUsuario(nameUser);
				for(int i = 0; i < sL2.size(); i++) {
					//String t = sL2.get(i).get(0) + "-" + sL2.get(i).get(1);
					choi3.add(sL2.get(i).get(0));
				}
				panelOM[2].add(choi3); // Third option
				break;
			case 1:
				choi1 = new Choice();
				choi1.setPreferredSize(dC);
				sL = db.getFacturasEnCurso(nameUser);
				for(int i = 0; i < sL.size(); i++) {
					choi1.add(sL.get(i));
				}
				panelOM[0].add(choi1);
				break;				
			case 2:
				txtF1 = new JTextField();
				txtF1.setPreferredSize(dTF);
				panelOM[0].add(txtF1);
				buttonS = new JButton(strButtonC);
				buttonS.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						JOptionPane.showMessageDialog(frame, "Nada por ahora");
					}
				});
				panelOM[0].add(buttonS);
				break;
			case 3:
				choi1 = new Choice();
				choi1.setPreferredSize(dC);
				sP2 = db.getSedeParqueadero();
				for(int i = 0; sP2[i].getNombre() != ""; i++){
					choi1.add(sP2[i].getNombre());
				}
				panelOM[0].add(choi1);
				buttonS = new JButton(strButtonC);
				buttonS.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						JOptionPane.showMessageDialog(frame, "Nada por ahora");
					}
				});
				panelOM[0].add(buttonS);
				break;
			case 4:
				uS = db.getUsuario(nameUser);
				txtF1 = new JTextField(uS.getDocumento()); // documento
				txtF1.setPreferredSize(dTF);
				panelOM[0].add(txtF1);
				txtF2 = new JTextField(uS.getNombre()); // nombre
				txtF2.setPreferredSize(dTF);
				panelOM[1].add(txtF2);
				txtF3 = new JTextField(uS.getApellido()); // apellido
				txtF3.setPreferredSize(dTF);
				panelOM[2].add(txtF3);
				txtF4 = new JTextField(uS.getDireccion()); // direccion
				txtF4.setPreferredSize(dTF);
				panelOM[3].add(txtF4);
				txtF5 = new JTextField(uS.getTelefono()); // telefono
				txtF5.setPreferredSize(dTF);
				panelOM[4].add(txtF5);
				txtF6 = new JTextField(uS.getCelular()); // celular
				txtF6.setPreferredSize(dTF);
				panelOM[5].add(txtF6);
				txtF7 = new JTextField(uS.getCorreo()); // correo
				txtF7.setPreferredSize(dTF);
				panelOM[6].add(txtF7);
				txtF8 = new JTextField(uS.getPassword()); // password
				txtF8.setPreferredSize(dTF);
				panelOM[7].add(txtF8);
				break;
			case 5:
				choi1 = new Choice(); // tipo de vehiculo
				choi1.setPreferredSize(dC);
				sL = db.getStringTable("TipoVehiculo", "nombre_TipoVehiculo");
				for(int i = 0; i < sL.size(); i++) {
					choi1.add(sL.get(i));
				}
				panelOM[0].add(choi1);
				choi2 = new Choice(); // marca
				choi2.setPreferredSize(dC);
				sL = db.getStringTable("MarcaVehiculo", "nombre_MarcaVehiculo");
				for(int i = 0; i < sL.size(); i++) {
					choi2.add(sL.get(i));
				}
				panelOM[1].add(choi2);
				txtF1 = new JTextField(); // placa
				txtF1.setPreferredSize(dTF);
				panelOM[2].add(txtF1);
				txtF2 = new JTextField(); // color
				txtF2.setPreferredSize(dTF);
				panelOM[3].add(txtF2);
				break;
			default: break;
		}
		
		for(int i = 0; i < sz; i++) {
			panelOptions.add(panelOM[i]);
		}
		if(optionC == 0 || optionC == 1 || optionC == 4 || optionC == 5) {
			if(optionC == 0) {
				buttonS = new JButton(strButtonS);
				buttonS.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						formatD = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
						date = new Date();
						db.insertUsoParqueadero(
								db.getSpecificStringTable2Int(
										"Vehiculo", 
										"placa_Vehiculo", choi3.getSelectedItem(),
										"codigo_Vehiculo", 
										"codigo_Usuario", nameUser), 
								db.getSpecificString2TableStr2Int1(
										"SitioParqueadero", "ubicacion_SitioParqueadero", choi2.getSelectedItem(), 
										"SedeParqueadero", "nombre_SedeParqueadero", choi1.getSelectedItem(), 
										"codigo_SedeParqueadero", "codigo_SitioParqueadero") 
								//formatD.format(date));
								);
						JOptionPane.showMessageDialog(frame, "Solicitud enviada");
					}
				});
				buttonS.setBackground(Color.lightGray);
				panelOptions.add(buttonS);
			}
			if(optionC == 1) {
				buttonS = new JButton(strButtonP);
				buttonS.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						Double t = Double.valueOf(db.getCobroTipoVehiculo(choi1.getSelectedItem()));
						tV = new TipoVehiculo();
						tV.setCobro(t);
						setMyDate();
						String tdate = formatD.format(date);
						uP = new UsoParqueadero();
						String s = String.valueOf(tV.calcularTotal(
								uP.calcularTiempo(
										db.getTiempoInicial(choi1.getSelectedItem()),
										tdate)
								));
						db.updateTableStrInt("UsoParqueadero", 
								"fin_UsoParqueadero", tdate, 
								"codigo_UsoParqueadero", choi1.getSelectedItem());
						db.insertFacturaCancelada(nameUser, s);
						JOptionPane.showMessageDialog(frame, "El monto de $" + s + " ha sido pagado");
					}
				});
				buttonS.setBackground(Color.lightGray);
				//buttonS.setPreferredSize(new Dimension(25,25));
				panelOptions.add(buttonS);
			}
			if(optionC == 4) {
				buttonS = new JButton(strButtonRC);
				buttonS.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						JOptionPane.showMessageDialog(frame, "Nada por ahora");
					}
				});
				buttonS.setBackground(Color.lightGray);
				panelOptions.add(buttonS);
			}
			if(optionC == 5) {
				buttonS = new JButton(strButtonA);
				buttonS.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						vH = new Vehiculo();
						vH.setPlaca(txtF1.getText());
						vH.setColor(txtF2.getText());
						db.insertVehiculo(
								nameUser, 
								db.getSpecificStringTable("MarcaVehiculo", "nombre_MarcaVehiculo",
										choi2.getSelectedItem(), "codigo_MarcaVehiculo"),
								db.getSpecificStringTable("TipoVehiculo", "nombre_TipoVehiculo",
										choi1.getSelectedItem(), "codigo_TipoVehiculo"), 
								vH);
						JOptionPane.showMessageDialog(frame, "El vehiculo ha sido agregado");
					}
				});
				buttonS.setBackground(Color.lightGray);
				panelOptions.add(buttonS);
			}
		}
	}
	
	private void addComponentsMenu() {
		panelMenu = new JPanel();
		panelMenu.setLayout(new GridLayout(buttonMenuUA[typeUser].length,1));
		
		addButtonsMenu(buttonMenuUA[typeUser]);
		
		/**panelOptions = new JPanel();
		panelOptions.setLayout(new GridLayout(labelOpcionUsuario[optionC].length,1));
		
		labelUsuario = new JLabel [labelOpcionUsuario.length];
		labelUsuario[0] = new JLabel(labelOpcionUsuario[0][0]);
		panelOptions.add(labelUsuario[0]);
		**/
	}
	
	private void addComponentsToPane(Container pane) {
		if(!(pane.getLayout() instanceof BorderLayout)) {
			pane.add(new JLabel("Container doesn't use BorderLayout!"));
			return;
		}
		if (RIGHT_TO_LEFT) {
			pane.setComponentOrientation(
					java.awt.ComponentOrientation.RIGHT_TO_LEFT);
		}
		
		addComponentsMenu();
		addOptionsMenu();
		
		closeS = new JButton(strButtonCS);
		closeS.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JOptionPane.showMessageDialog(frame, "Se ha cerrado la sesion");
				frame.dispose();
				InicioApplet iA = new InicioApplet();
				iA.executeF();
			}
		});
		pane.add(closeS, BorderLayout.NORTH);
		pane.add(panelMenu, BorderLayout.WEST);
		pane.add(panelOptions, BorderLayout.CENTER);
	}
	
	public void createAndShowGUI() {
		// check what kind of user has enter!!!!
		frame = new JFrame(nameFrame[typeUser]);
		Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
		int height = screenSize.height * 2 / 3;
		int width = screenSize.width * 2 / 3;
		frame.setPreferredSize(new Dimension(width,height));
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		//Set up the content pane
		addComponentsToPane(frame.getContentPane());
		
		frame.pack();
		frame.setVisible(true);
	}
	
	protected void executeF(int tu, String nameU) {
		try {
			UIManager.setLookAndFeel("javax.swing.plaf.metal.MetalLookAndFeel");
		}catch (Exception e) {
			e.printStackTrace();
		}
		db = new Database();
		// Turn off metal's use bold fonts		
		UIManager.put("Swing.boldMetal", Boolean.FALSE);
		javax.swing.SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				//UsuarioApplet ua = new UsuarioApplet();
				//ua.typeUser = 3;
				typeUser = tu-1;
				nameUser = nameU;
				//ua.createAndShowGUI();
				createAndShowGUI();
			}
		});
	}
	
	protected void executeF(int tu) {
		try {
			UIManager.setLookAndFeel("javax.swing.plaf.metal.MetalLookAndFeel");
		}catch (Exception e) {
			e.printStackTrace();
		}
		db = new Database();
		// Turn off metal's use bold fonts		
		UIManager.put("Swing.boldMetal", Boolean.FALSE);
		javax.swing.SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				//UsuarioApplet ua = new UsuarioApplet();
				//ua.typeUser = 3;
				typeUser = tu-1;
				//ua.createAndShowGUI();
				createAndShowGUI();
			}
		});
	}
	
	public static void main(String [] args) {
		UsuarioApplet uA = new UsuarioApplet ();
		uA.executeF(1);
	}
	
}
