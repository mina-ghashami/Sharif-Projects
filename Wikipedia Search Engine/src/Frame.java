import com.cloudgarden.layout.AnchorConstraint;
import com.cloudgarden.layout.AnchorLayout;

import java.awt.ComponentOrientation;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLDecoder;
import java.sql.ResultSet;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JEditorPane;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTabbedPane;
import javax.swing.JTextField;

import javax.swing.WindowConstants;
import javax.swing.SwingUtilities;
import javax.swing.event.HyperlinkEvent;
import javax.swing.event.HyperlinkListener;


/**
* This code was edited or generated using CloudGarden's Jigloo
* SWT/Swing GUI Builder, which is free for non-commercial
* use. If Jigloo is being used commercially (ie, by a corporation,
* company or business for any purpose whatever) then you
* should purchase a license for each developer using Jigloo.
* Please visit www.cloudgarden.com for details.
* Use of Jigloo implies acceptance of these licensing terms.
* A COMMERCIAL LICENSE HAS NOT BEEN PURCHASED FOR
* THIS MACHINE, SO JIGLOO OR THIS CODE CANNOT BE USED
* LEGALLY FOR ANY CORPORATE OR COMMERCIAL PURPOSE.
*/
public class Frame extends javax.swing.JFrame implements HyperlinkListener{
	private JTabbedPane tabbedPane;
	private JPanel search;
	private JPanel categorize; 
	private JButton searchButton;
	private JLabel jLabel1;
	private JButton find;
	private JTextField jTextField1;
	private JLabel message;
	private JEditorPane jEditorPane1;
	private JScrollPane jscrollpane;
	private JButton addButton;
	private JTextField addUrl;
	private JPanel manage;
	private JTextField url;
	private int i = 1; 
	
	private ManageController manageController ;
	private SearchController searchController ; 

	public static void main(String[] args) {
		SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				Frame inst = new Frame();
				inst.setLocationRelativeTo(null);
				inst.setVisible(true);
			}
		});
	}
	
	public Frame() {
		super();
		initGUI();
	}
	
	
	private void initGUI() {
		try {
			AnchorLayout thisLayout = new AnchorLayout();
			getContentPane().setLayout(thisLayout);
			this.setTitle("موتور جستجو");
			{
				tabbedPane = new JTabbedPane();
				getContentPane().add(tabbedPane, new AnchorConstraint(11, 993, 975, 9, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
				tabbedPane.setPreferredSize(new java.awt.Dimension(1000, 700));
				tabbedPane.setComponentOrientation(ComponentOrientation.RIGHT_TO_LEFT);
				{
					search = new JPanel();
					AnchorLayout searchLayout1 = new AnchorLayout();
					search.setLayout(searchLayout1);
					AnchorLayout searchLayout = new AnchorLayout();
					tabbedPane.addTab("جستجو", null, search, null);
					search.setFont(new java.awt.Font("Tahoma",0,14));
					{
						message = new JLabel();
						search.add(message, new AnchorConstraint(150, 969, 215, 439, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						message.setPreferredSize(new java.awt.Dimension(354, 27));
						message.setHorizontalAlignment(JLabel.RIGHT);
						message.setFont(new java.awt.Font("Tahoma",0,14));
						
					}
					{
						jscrollpane = new JScrollPane();
						search.add(jscrollpane, new AnchorConstraint(243, 969, 972, 32, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						jscrollpane.setPreferredSize(new java.awt.Dimension(626, 303));
						{
							URL url = new URL("file:///C:/Users/MiNa/Desktop/Darsi/MIR/project/workspace/Wiki%20Engine-V3/results.html");
							jEditorPane1 = new JEditorPane();
							jscrollpane.setViewportView(jEditorPane1);
							//jEditorPane1.setText("resultPane");
							jEditorPane1.setComponentOrientation(ComponentOrientation.RIGHT_TO_LEFT);
							jEditorPane1.setAlignmentX(JEditorPane.RIGHT_ALIGNMENT);
							jEditorPane1.addHyperlinkListener(this);
							jEditorPane1.setEditable(false);
							jEditorPane1.setFont(new java.awt.Font("tahoma",0,12));
						}
					}
					tabbedPane.setFont(new java.awt.Font("Tahoma",0,14));
					tabbedPane.setSize(1000, 700);
					{
						searchButton = new JButton();
						search.add(searchButton, new AnchorConstraint(58, 269, 134, 122, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						searchButton.setText("\u062c\u0633\u062a\u062c\u0648");
						searchButton.setPreferredSize(new java.awt.Dimension(122, 36));
						searchButton.setFont(new java.awt.Font("Tahoma",0,14));
						searchButton.addMouseListener(new MouseAdapter() {
							public void mouseClicked(MouseEvent evt) {
								searchButtonMouseClicked(evt);
							}
						});
					}
					{
						url = new JTextField();
						search.add(url, new AnchorConstraint(58, 969, 121, 349, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						url.setPreferredSize(new java.awt.Dimension(414, 26));
						url.setComponentOrientation(ComponentOrientation.RIGHT_TO_LEFT);
						url.setFont(new java.awt.Font("Tahoma",0,14));
					}

				}
				{
					categorize = new JPanel();
					AnchorLayout categorizeLayout = new AnchorLayout();
					categorize.setLayout(categorizeLayout);
					tabbedPane.addTab("رده بندی", null, categorize, null);
					{
						jLabel1 = new JLabel();
						categorize.add(jLabel1, new AnchorConstraint(269, 935, 349, 520, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						jLabel1.setPreferredSize(new java.awt.Dimension(344, 38));
					}
					{
						find = new JButton();
						categorize.add(find, new AnchorConstraint(102, 333, 178, 181, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						find.setText("\u062a\u0639\u06cc\u06cc\u0646 \u0631\u062f\u0647");
						find.setPreferredSize(new java.awt.Dimension(126, 36));
						find.setFont(new java.awt.Font("tahoma",0,14));
						find.addActionListener(new ActionListener(){
							public void actionPerformed(ActionEvent arg0){
								String url = jTextField1.getText(); 
								if (url.length()!= 0 ){
									CategorizeController c = new CategorizeController(url);
									String category_name = c.categorize();
									jLabel1.setText(category_name);
									jLabel1.setFont(new java.awt.Font("Tahoma" , 0 ,14));
								}else {
									// to write a joption pane ; 
								}
							}
						});
					}
					{
						jTextField1 = new JTextField();
						categorize.add(jTextField1, new AnchorConstraint(102, 941, 178, 381, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						jTextField1.setPreferredSize(new java.awt.Dimension(464, 36));
					}
				}
				{
					manage = new JPanel();
					AnchorLayout manageLayout = new AnchorLayout();
					manage.setLayout(manageLayout);
					tabbedPane.addTab("مديريت موتور جستجو", null, manage, null);
					manage.setFont(new java.awt.Font("Tahoma",0,14));
					{
						addButton = new JButton();
						manage.add(addButton, new AnchorConstraint(87, 219, 142, 84, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						addButton.setText("\u0627\u0636\u0627\u0641\u0647 \u06a9\u0646");
						addButton.setPreferredSize(new java.awt.Dimension(90, 23));
						addButton.setFont(new java.awt.Font("Tahoma",0,14));
						addButton.addMouseListener(new MouseAdapter() {
							public void mouseClicked(MouseEvent evt) {
								addButtonMouseClicked(evt);
							}
						});
					}
					{
						addUrl = new JTextField();
					
						manage.add(addUrl, new AnchorConstraint(82, 936, 142, 273, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						addUrl.setPreferredSize(new java.awt.Dimension(443, 25));
						addUrl.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
					}
				}
			}
			pack();
			this.setSize(863, 557);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	
	private void addButtonMouseClicked(MouseEvent evt) {
		String urlText = addUrl.getText();
		try {
			urlText = URLDecoder.decode(urlText, "UTF-8");
		} catch (UnsupportedEncodingException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		this.manageController = new ManageController(urlText);
		
	}
	
	private void searchButtonMouseClicked(MouseEvent evt) {
	
		String query = url.getText();
		this.searchController = new SearchController(query,this);
	}
	public void showResults(ArrayList<Result> results){
		if ( results == null || results.size()== 0 ){
			message.setText("سندي پيدا نشد.");
			try {
				jEditorPane1.setPage("file:///C:/Users/MiNa/Desktop/Darsi/MIR/project/workspace/Wiki%20Engine%20_V8/result.html");
				//C:\Users\MiNa\Desktop\Darsi\MIR\project\workspace\Wiki Engine _V8\result.html
				//file:///C:/Users/MiNa/Desktop/Darsi/MIR/project/workspace/Wiki%20Engine%20_V8/result.html
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
		else {
			message.setText(results.size()+" سند پيدا شد.");
			try {
				i = (i%2)+1;
				jEditorPane1.setPage("file:///C:/Users/MiNa/Desktop/Darsi/MIR/project/workspace/Wiki%20Engine%20_V8/results"+i+".html");
				
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		
		
		
	}
	  public void hyperlinkUpdate(HyperlinkEvent event) {
		  if (event.getEventType() == HyperlinkEvent.EventType.ACTIVATED) {
	      try {
	    	  System.out.println(event.getURL());
	    	  	jEditorPane1.setPage(event.getURL());
		        //htmlPane.setPage(event.getURL());
		        //urlField.setText(event.getURL().toExternalForm());
		      } catch(IOException ioe) {
		        
		      }
		    }
		  }

	
	
}
