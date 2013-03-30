import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLDecoder;
import java.util.Scanner;

public class test extends JFrame {
    
    public test() {
        
        super("Revalidation Demo");
        setSize(300,150);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
        
        // Create a single button
        Font font = new Font("Dialog", Font.PLAIN, 10);
        final JButton b = new JButton("Add");
        b.setFont(font);
        
        Container c = getContentPane();
        c.setLayout(new FlowLayout());
        c.add(b);
        
        // Increase the size of the button's font each time it's clicked
        b.addActionListener(new ActionListener() {
            int size = 10;
            
            public void actionPerformed(ActionEvent ev) {
                b.setFont(new Font("Dialog", Font.PLAIN, ++size));
    
    // invalidates the button & validates its root pane
                b.revalidate();   
            }
        });
    }
    
    public static void main(String[] args) {
//        test re = new test();
//        re.setVisible(true);
    	
    	 String name;
         int age;
         Scanner in = new Scanner(System.in);

         // Reads a single line from the console 
         // and stores into name variable
         name = in.nextLine();

         // Reads a integer from the console
         // and stores into age variable
         
         in.close();            
		System.out.println(name);
		
    }
}

