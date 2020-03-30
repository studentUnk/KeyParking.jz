package applet;

import java.awt.GridLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.awt.BorderLayout;
import java.awt.Dimension;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.JFrame;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFormattedTextField;
import javax.swing.UIManager;
import javax.swing.SwingUtilities;

public class InicioApplet extends JPanel implements ActionListener{
	
	static String nameFrame = "Bienvenido a KeyParking.jz";
	String nombreUsuario = "Usuario";
	String passUsuario = "Password";
	String botonEnviar = "Enviar";
	String botonRegistrar = "Registrar";
	
	String messageSuccess = "Ingreso exitoso";
	String messageUnsuccess = "Ingreso no valido";
	
	static JFrame frame;
	JLabel labelUsuario, labelPass;
	JTextField fieldUsuario;
	JPasswordField fieldPass;
	JPanel panelLabel, panelField, panelButton;
	JButton buttonSend, buttonRegister;
	
	public InicioApplet() {
		//super(new GridLayout(3,2)); // 3 rows x 2 column
		//super(new BorderLayout());	
		//ImageIcon icon = createImageIcon("images/middle.gif", "meaningless");
		//create label
		//label1 = new JLabel("Image and text", icon, JLabel.CENTER);
		//set position of text
		//label1.setVerticalTextPosition(JLabel.BOTTOM);
		//label1.setHorizontalTextPosition(JLabel.CENTER);
		
		//just text
		labelUsuario = new JLabel (nombreUsuario);
		labelPass = new JLabel (passUsuario);
		//label3 = new JLabel (icon);
		
		//tool tips for the heck of it
		//label1.setToolTipText("A label of image and text");
		labelUsuario.setToolTipText("Nombre de usuario");
		labelPass.setToolTipText("Password del Usuario");
		//label3.setToolTipText("A label of image");
		
		// field
		fieldUsuario = new JTextField();
		fieldPass = new JPasswordField(10);
		fieldPass.setEchoChar('*');
		fieldPass.setActionCommand(botonEnviar);
		fieldPass.addActionListener(this);
		
		// button
		buttonSend = new JButton(botonEnviar);
		buttonRegister = new JButton(botonRegistrar);
		
		//add the labels
		//add(label1);
		//add(labelUsuario);
		//add(labelPass);
		//add(label3);
		panelLabel = new JPanel(new GridLayout(0,1));
		panelLabel.add(labelUsuario);
		panelLabel.add(labelPass);
		
		panelField = new JPanel(new GridLayout(0,1));
		panelField.add(fieldUsuario);
		panelField.add(fieldPass);
		
		panelButton = new JPanel(new GridLayout(0,1));
		panelButton.add(buttonRegister);
		
		setBorder(BorderFactory.createEmptyBorder(20,20,20,20));
		
		//add(panelLabel,BorderLayout.CENTER);
		//add(panelField,BorderLayout.LINE_END);
		add(panelLabel);
		add(panelField);
		add(buttonSend);
		add(panelButton);
	}
	
	private boolean isPasswordCorrect() {
		String inputPass = String.valueOf(fieldPass.getPassword());
		String inputUser = fieldUsuario.getText();
		return inputPass.equals("dummy") && inputUser.equals("user");
	}
	
	public void actionPerformed(ActionEvent e) {
		String buttonAction = e.getActionCommand();
		// The user has send the information
		if(botonEnviar.equals(buttonAction)) {
			// dummy test
			if (isPasswordCorrect()) {
				JOptionPane.showMessageDialog(frame, messageSuccess);
			}
			else {
				JOptionPane.showMessageDialog(frame, messageUnsuccess, "Mensaje de error",
						JOptionPane.ERROR_MESSAGE);
			}
		}
		else {
			// Applet to register the user
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
	
	private static void createAndShowGUI() {
		// create and set up window
		frame = new JFrame(nameFrame);
		Dimension screenSize = Toolkit.getDefaultToolkit().getScreenSize();
		int height = screenSize.height * 2 / 3;
		int width = screenSize.width * 2 / 3;
		frame.setPreferredSize(new Dimension(width,height));
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		// add content to the window
		frame.add(new InicioApplet());
		
		// display the window
		frame.pack();
		frame.setVisible(true);
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
