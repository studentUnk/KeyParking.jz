package applet;

import keyParking.Usuario;
import keyParking.Database;

import java.awt.GridLayout;
import java.awt.Image;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.IOException;
import java.awt.Dimension;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.JFrame;
import javax.imageio.ImageIO;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.UIManager;
import javax.swing.SwingUtilities;

public class InicioApplet extends JPanel implements ActionListener{
	
	static Usuario u;
	static Database db;
	
	static String nameFrame = "Bienvenido a KeyParking.jz";
	String nombreUsuario = "Usuario(codigo)";
	String passUsuario = "Password";
	String botonEnviar = "Enviar";
	String botonRegistrar = "Registrar";
	
	String messageSuccess = "Ingreso exitoso";
	String messageUnsuccess = "Ingreso no valido";
	
	static JFrame frame;
	BufferedImage imageL;
	Image imageL2;
	
	JLabel labelUsuario, labelPass, imageLL;
	JTextField fieldUsuario;
	JPasswordField fieldPass;
	JPanel panelLabel, panelField, panelButton;
	JButton buttonSend, buttonRegister;
	
	public InicioApplet() {
			
		//just text
		labelUsuario = new JLabel (nombreUsuario); // label of the user code
		labelPass = new JLabel (passUsuario); // label for the password
		//label3 = new JLabel (icon);
		
		//tool tips for the heck of it 
		//label1.setToolTipText("A label of image and text");
		labelUsuario.setToolTipText("Nombre de usuario");
		labelPass.setToolTipText("Password del Usuario");
		//label3.setToolTipText("A label of image");
		
		// field
		fieldUsuario = new JTextField(); // Field for the user code
		fieldPass = new JPasswordField(10); // Field for the password
		fieldPass.setEchoChar('*'); // Set character to hide insert password
		fieldPass.setActionCommand(botonEnviar); // Action for send user
		fieldPass.addActionListener(this); 
		
		// button
		buttonSend = new JButton(botonEnviar); // Button "Enviar"
		buttonRegister = new JButton(botonRegistrar); // Button "Registrar"
		
		// image
		try {
			//imageL = ImageIO.read(new File("logoF.png"));
			imageL = ImageIO.read(this.getClass().getResource("logoF2.png"));
		} catch(IOException e) {
			System.out.println("Image not found");
			e.getStackTrace();
		}

		imageLL = new JLabel(new ImageIcon(imageL));
		
		//add the labels
		panelLabel = new JPanel(new GridLayout(0,1));
		panelLabel.add(labelUsuario);
		panelLabel.add(labelPass);
		
		panelField = new JPanel(new GridLayout(0,1));
		panelField.add(fieldUsuario);
		panelField.add(fieldPass);
		
		panelButton = new JPanel(new GridLayout(0,1));
		panelButton.add(buttonRegister);
		
		setBorder(BorderFactory.createEmptyBorder(20,20,20,20));
		
		// add items to the frame
		add(panelLabel);
		add(panelField);
		add(buttonSend);
		add(panelButton);
		add(imageLL);
		
		// action button
		buttonSend.addActionListener(this);
		buttonRegister.addActionListener(this);
	}
	
	private boolean isPasswordCorrect() {
		// FIX ==> check that the user are only numbers
		u.setPassword(String.valueOf(fieldPass.getPassword()));
		u.setCodigo(Integer.parseInt(fieldUsuario.getText())); // check first that are just numbers
		return db.userPassUsuario(u); // Send query to DB
	}
	
	public void actionPerformed(ActionEvent e) {
		String buttonAction = e.getActionCommand();
		// The user has send the information
		if(botonEnviar.equals(buttonAction)) {
			// dummy test
			if (isPasswordCorrect()) {
				JOptionPane.showMessageDialog(frame, messageSuccess);
				frame.dispose(); // Delete frame
				UsuarioApplet uA = new UsuarioApplet();
				int tu;
				switch(db.getRol(u)) { // Set type of user for the menu
					//case "Cliente": tu=1; break;
					case "Auxiliar": tu=2; break;
					case "Administrador": tu=3; break;
					default: tu=1; break;
				}
				uA.executeF(tu,fieldUsuario.getText()); // Start the menu of the user
			}
			else {
				JOptionPane.showMessageDialog(frame, messageUnsuccess, "Mensaje de error",
						JOptionPane.ERROR_MESSAGE);
			}
		}
		else {
			// Applet to register the user
			frame.dispose(); // delete frame
			RegistroApplet rA = new RegistroApplet(); 
			rA.executeF(); // Start the page for sign up
		}
	}
	
	protected static ImageIcon createImageIcon(String path, String description) {
		java.net.URL imgURL = InicioApplet.class.getResource(path);
		if(imgURL != null) {
			return new ImageIcon(imgURL, description);
		} else {
			System.err.println("Could not find file: " + path);
			return null;
		}
	}
	
	private static void createAndShowGUI() { // load the frame
		// create and set up window
		frame = new JFrame(nameFrame);
		Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
		int height = screenSize.height * 2 / 3;
		int width = screenSize.width * 2 / 3;
		frame.setPreferredSize(new Dimension(width,height));
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		u = new Usuario();
		db = new Database();
		// add content to the window
		frame.add(new InicioApplet());
		
		// display the window
		frame.pack();
		frame.setVisible(true);
	}
	
	public void executeF() { // This method would help others frames to come back
		SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				// turn off metal's use of bold fonts
				UIManager.put("swing.boldMetal", Boolean.FALSE);
				createAndShowGUI();
			}
		});
	}
	
	public static void main(String [] args) {
		SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				// turn off metal's use of bold fonts
				UIManager.put("swing.boldMetal", Boolean.FALSE);
				createAndShowGUI();
			}
		});
	}
}
