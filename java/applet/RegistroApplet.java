package applet;

import keyParking.Usuario;
import keyParking.Rol;
import keyParking.Municipio;
import keyParking.Database;

import java.awt.BorderLayout;
import java.awt.Component;
import java.awt.Container;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.BoxLayout;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.SwingConstants;

public class RegistroApplet implements ActionListener{
	
	Usuario user;
	Rol ro;
	Municipio mu;
	Database dB;
	
	String nameFrame = "Registro";
	String titleR = "Registro de usuario";
	/*
	 * documento 0
	 * nombre 1
	 * apellido 2
	 * direccion 3
	 * telefono 4
	 * celular 5
	 * correo 6
	 * codigo 7
	 * password 8
	 */
	String datos[] = new String []{"Documento","Nombre(s)","Apellido(s)","Direccion",
			"Telefono","Celular","Correo","Codigo del usuario","Password"};
	String buttonS = "Registrar";
	
	JFrame frame;
	JLabel title;
	JLabel labelData [];
	JTextField fieldData []; // does not include the passwords
	JButton buttonSend;
	JPasswordField fieldPass;
	JPanel panel1,panel2,panelData[];
	
	RegistroApplet(){}
	
	protected void addComponentsToPane(Container pane) {
		pane.setLayout(new BoxLayout(pane, BoxLayout.Y_AXIS));
		
		panel1 = new JPanel();
		title = new JLabel(titleR);
		//title.setAlignmentX(Component.CENTER_ALIGNMENT);
		//title.setPreferredSize(new Dimension(450,15));
		//title.setMaximumSize(title.getMinimumSize());
		panel1.add(title);
		//title.setHorizontalAlignment(SwingConstants.CENTER);
		//title.setHorizontalTextPosition(SwingConstants.CENTER);
		pane.add(panel1);
		labelData = new  JLabel [datos.length];
		panelData = new JPanel [labelData.length];
		fieldData = new JTextField [datos.length-1];
		for(int i = 0; i < labelData.length; i++) {
			panelData[i] = new JPanel(new FlowLayout());
			labelData[i] = new JLabel(datos[i]);
			
			//labelData[i].setAlignmentX(Component.LEFT_ALIGNMENT);
			//labelData[i].setMaximumSize(labelData[i].getMinimumSize());
			//labelData[i].setPreferredSize(new Dimension(300,5));
			//pane.add(labelData[i]);
			panelData[i].add(labelData[i]);
			if(i == labelData.length-1) {
				fieldPass = new JPasswordField();
				fieldPass.setEchoChar('*');
				fieldPass.setPreferredSize(new Dimension(250,25));
				panelData[i].add(fieldPass);
			}
			else {
				fieldData[i] = new JTextField();
				fieldData[i].setPreferredSize(new Dimension(250,25));
				panelData[i].add(fieldData[i]);
			}
			//panelData[i].setPreferredSize(new Dimension(300,10));
			pane.add(panelData[i], BorderLayout.WEST);
		}
		buttonSend = new JButton(buttonS);
		buttonSend.addActionListener(this);
		
		pane.add(buttonSend);
	}
	
	private Component addComponents() {
		//panel1 = new JPanel();
		panel2 = new JPanel(new BoxLayout(frame.getContentPane(), BoxLayout.Y_AXIS));
		
		title = new JLabel(titleR);
		//panel1.add(title);
		
		labelData = new  JLabel [datos.length];
		for(int i = 0; i < (labelData.length-1); i++) {
			labelData[i] = new JLabel(datos[i]);
			panel2.add(labelData[i]);
		}
		return panel2;
	}
	
	private void setDataInput() { 
		user.setDocumento(fieldData[0].getText());
		user.setNombre(fieldData[1].getText());
		user.setApellido(fieldData[2].getText());
		user.setDireccion(fieldData[3].getText());
		user.setTelefono(fieldData[4].getText());
		user.setCelular(fieldData[5].getText());
		user.setCorreo(fieldData[6].getText());
		user.setCodigo(Integer.parseInt(fieldData[7].getText()));
		user.setPassword(String.valueOf(fieldPass.getPassword()));
	}
	
	public void actionPerformed(ActionEvent e) {
		String buttonAction = e.getActionCommand();
		// The user has send the information
		if(buttonS.equals(buttonAction)) {
			setDataInput();
			if(dB.insertUsuario(user, ro, mu)) {
				JOptionPane.showMessageDialog(frame, 
						"El usuario ha sido creado exitosamente");
			}
			frame.dispose();
			InicioApplet iA = new InicioApplet();
			iA.executeF();
			//if (isPasswordCorrect()) {
				//JOptionPane.showMessageDialog(frame, messageSuccess);
				
			//}
			//else {
				//JOptionPane.showMessageDialog(frame, messageUnsuccess, "Mensaje de error",
				//		JOptionPane.ERROR_MESSAGE);
			//}
		}
		else {
			// Applet to register the user
			JOptionPane.showMessageDialog(frame, "Opcion inexistente", "Mensaje de error",
					JOptionPane.ERROR_MESSAGE);
			//frame.dispose();
			//RegistroApplet rA = new RegistroApplet();
			//rA.executeF();
		}
	}
	
	private void createAndShowGUI() {
		frame = new JFrame(nameFrame);
		Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
		int height = screenSize.height * 2 / 3;
		int width = screenSize.width * 2 / 3;
		frame.setPreferredSize(new Dimension(width,height));
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		user = new Usuario();
		ro = new Rol();
		mu = new Municipio();
		dB = new Database();
		
		//frame.getContentPane().setLayout(new BoxLayout(frame.getContentPane(), BoxLayout.Y_AXIS));;
		//frame.add(addComponents());
		addComponentsToPane(frame.getContentPane());
		frame.pack();
		frame.setVisible(true);
	}
	
	protected void executeF() {
		javax.swing.SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				//RegistroApplet ap = new RegistroApplet();
				//ap.createAndShowGUI();
				createAndShowGUI();
			}
		});
	}
	
	public static void main(String [] args) {
		/*javax.swing.SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				RegistroApplet ap = new RegistroApplet();
				ap.createAndShowGUI();
			}
		});*/
		RegistroApplet ap = new RegistroApplet();
		ap.executeF();
	}

}
