import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class Calculator {

	private JFrame frame;
	private JTextField textField1;
	private JTextField textField2;
	private JTextField textField3;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Calculator window = new Calculator();
					window.frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public Calculator() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frame = new JFrame();
		frame.setBounds(100, 100, 450, 300);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		textField1 = new JTextField();
		textField1.setBounds(6, 22, 144, 48);
		frame.getContentPane().add(textField1);
		textField1.setColumns(10);
		
		textField2 = new JTextField();
		textField2.setColumns(10);
		textField2.setBounds(152, 22, 144, 48);
		frame.getContentPane().add(textField2);
		
		textField3 = new JTextField();
		textField3.setBounds(308, 22, 136, 48);
		frame.getContentPane().add(textField3);
		textField3.setColumns(10);
		
		JLabel lblNewLabel = new JLabel("=");
		lblNewLabel.setBounds(297, 38, 10, 16);
		frame.getContentPane().add(lblNewLabel);
		
		JButton btnSubtract = new JButton("-");
		btnSubtract.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					int num1,num2, answer;
					num1 =Integer.parseInt(textField1.getText());
					num2 =Integer.parseInt(textField2.getText());
					
					answer =num1-num2;
					textField3.setText(Integer.toString(answer));
					
				}
				catch(Exception e1) {
					JOptionPane.showMessageDialog(null,"Entered invalid number");
				}
				
				
			}
		});
		btnSubtract.setBounds(16, 110, 117, 29);
		frame.getContentPane().add(btnSubtract);
		
		JButton btnAdd = new JButton("+");
		btnAdd.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					int num1,num2, answer;
					num1 =Integer.parseInt(textField1.getText());
					num2 =Integer.parseInt(textField2.getText());
					
					answer =num1+num2;
					textField3.setText(Integer.toString(answer));
					
				}
				catch(Exception e1) {
					JOptionPane.showMessageDialog(null,"Entered invalid number");
				}
				
				
				
				
			}
		});
		btnAdd.setBounds(16, 82, 117, 29);
		frame.getContentPane().add(btnAdd);
		
		JButton btnMultiply = new JButton("*");
		btnMultiply.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					int num1,num2, answer;
					num1 =Integer.parseInt(textField1.getText());
					num2 =Integer.parseInt(textField2.getText());
					
					answer =num1*num2;
					textField3.setText(Integer.toString(answer));
					
				}
				catch(Exception e1) {
					JOptionPane.showMessageDialog(null,"Entered invalid number");
				}
				
			}
		});
		btnMultiply.setBounds(152, 82, 117, 29);
		frame.getContentPane().add(btnMultiply);
		
		JButton btnDivide = new JButton("/");
		btnDivide.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				try {
					int num1,num2, answer;
					num1 =Integer.parseInt(textField1.getText());
					num2 =Integer.parseInt(textField2.getText());
					
					answer =num1/num2;
					textField3.setText(Integer.toString(answer));
					
				}
				catch(Exception e1) {
					JOptionPane.showMessageDialog(null,"Entered invalid number");
				}
				
			}
		});
		btnDivide.setBounds(152, 110, 117, 29);
		frame.getContentPane().add(btnDivide);
	}
}
