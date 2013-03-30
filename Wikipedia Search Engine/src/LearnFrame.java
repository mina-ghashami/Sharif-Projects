

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
import javax.swing.BorderFactory;
import javax.swing.ComboBoxModel;
import javax.swing.DefaultComboBoxModel;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JEditorPane;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTabbedPane;
import javax.swing.JTextField;

import javax.swing.WindowConstants;
import javax.swing.border.BevelBorder;
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
public class LearnFrame extends javax.swing.JFrame {
	private JTabbedPane tabbedPane;
	private JPanel learn;	
	private JLabel categ5;
	private JButton learnButton;
	private JTextField term;
	private JLabel categ4;
	private JLabel categ2;
	private JLabel categ3;
	private JLabel categ1;
	private JButton valueButoon;
	private JButton makeButton;
	private JComboBox categories;
	private JTextField url;
	private JPanel manage;
	

	public static void main(String[] args) {
		SwingUtilities.invokeLater(new Runnable() {
			public void run() {
				Frame inst = new Frame();
				inst.setLocationRelativeTo(null);
				inst.setVisible(true);
			}
		});
	}
	
	public LearnFrame() {
		super();
		initGUI();
	}
	
	
	private void initGUI() {
		try {
			AnchorLayout thisLayout = new AnchorLayout();
			getContentPane().setLayout(thisLayout);
			this.setTitle("یادگیری");
			{
				tabbedPane = new JTabbedPane();
				getContentPane().add(tabbedPane, new AnchorConstraint(12, 993, 976, 8, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
				tabbedPane.setPreferredSize(new java.awt.Dimension(834, 502));
				tabbedPane.setComponentOrientation(ComponentOrientation.RIGHT_TO_LEFT);
				{
					learn = new JPanel();
					AnchorLayout searchLayout1 = new AnchorLayout();
					learn.setLayout(searchLayout1);
					AnchorLayout searchLayout = new AnchorLayout();
					tabbedPane.addTab("یادبگیر", null, learn, null);
					{
						makeButton = new JButton();
						learn.add(makeButton, new AnchorConstraint(377, 370, 451, 188, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						makeButton.setText("\u0633\u0627\u062e\u062a\u0646 \u0641\u06cc\u0686\u0631\u0647\u0627");
						makeButton.setPreferredSize(new java.awt.Dimension(151, 35));
						makeButton.setFont(new java.awt.Font("Tahoma",0,14));
						makeButton.addActionListener(new ActionListener(){
							public void actionPerformed(ActionEvent arg0){
								new MakeFeatureController();
							}
						});

					}
					{
						learnButton = new JButton();
						learn.add(learnButton, new AnchorConstraint(225, 370, 299, 188, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						learnButton.setText("\u06cc\u0627\u062f\u0628\u06af\u06cc\u0631");
						learnButton.setPreferredSize(new java.awt.Dimension(151, 35));
						learnButton.setFont(new java.awt.Font("Tahoma",0,14));
						learnButton.addActionListener(new ActionListener() {
							public void actionPerformed(ActionEvent evt) {
								String urlText = url.getText();
								try {
									urlText = URLDecoder.decode(urlText, "UTF-8");
								} catch (UnsupportedEncodingException e) {

									e.printStackTrace();
								}
								int selected = categories.getSelectedIndex();
								System.out.println("selected index : "+selected);
								urlText = urlText.trim();
								if ( selected == 0 ){
									
									JOptionPane.showMessageDialog(null, "لطفاً یک رده را انتخاب کنید","خطا."
											,JOptionPane.INFORMATION_MESSAGE);
									
								}else if( urlText.length() == 0 ){
									JOptionPane.showMessageDialog(null, "لطفاً آدرس صفحه ی مورد نظر را وارد کنید","خطا."
											,JOptionPane.INFORMATION_MESSAGE);
								}
								else {
									new LearnController(urlText,selected);
								}
								
							}
						});
						
					}
					{
						ComboBoxModel categoriesModel = 
							new DefaultComboBoxModel(
									new String[] {"رده ها","ادبی و هنری","تاریخی","سیاسی","علمی","ورزشی"});
						categories = new JComboBox();
						learn.add(categories, new AnchorConstraint(79, 370, 149, 190, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						categories.setModel(categoriesModel);
						categories.setPreferredSize(new java.awt.Dimension(149, 33));
						categories.setComponentOrientation(ComponentOrientation.RIGHT_TO_LEFT);
						categories.setFont(new java.awt.Font("Tahoma",0,14));
					}
					{
						url = new JTextField();
						learn.add(url, new AnchorConstraint(79, 959, 149, 396, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						url.setPreferredSize(new java.awt.Dimension(467, 33));
						url.setFont(new java.awt.Font("Tahoma",0,14));
					}
					tabbedPane.setFont(new java.awt.Font("Tahoma",0,14));

				}
				{
					manage = new JPanel();
					AnchorLayout manageLayout = new AnchorLayout();
					manage.setLayout(manageLayout);
					tabbedPane.addTab("ارزش کلمات در هر رده", null, manage, null);
					manage.setFont(new java.awt.Font("Tahoma",0,14));
					{
						categ5 = new JLabel();
						manage.add(categ5, new AnchorConstraint(821, 941, 924, 216, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						categ5.setText("categ5");
						categ5.setPreferredSize(new java.awt.Dimension(602, 49));
						categ5.setBorder(BorderFactory.createBevelBorder(BevelBorder.LOWERED));
					}
					{
						categ4 = new JLabel();
						manage.add(categ4, new AnchorConstraint(679, 941, 776, 216, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						categ4.setText("categ4");
						categ4.setPreferredSize(new java.awt.Dimension(602, 46));
						categ4.setBorder(BorderFactory.createBevelBorder(BevelBorder.LOWERED));
					}
					{
						categ2 = new JLabel();
						manage.add(categ2, new AnchorConstraint(373, 941, 464, 216, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						categ2.setText("categ2");
						categ2.setPreferredSize(new java.awt.Dimension(602, 43));
						categ2.setBorder(BorderFactory.createBevelBorder(BevelBorder.LOWERED));
					}
					{
						categ3 = new JLabel();
						manage.add(categ3, new AnchorConstraint(529, 941, 624, 216, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						categ3.setText("categ3");
						categ3.setPreferredSize(new java.awt.Dimension(602, 45));
						categ3.setBorder(BorderFactory.createBevelBorder(BevelBorder.LOWERED));
					}
					{
						categ1 = new JLabel();
						manage.add(categ1, new AnchorConstraint(216, 941, 311, 216, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						categ1.setPreferredSize(new java.awt.Dimension(602, 45));
						categ1.setText("categ 1");
						categ1.setBorder(BorderFactory.createBevelBorder(BevelBorder.LOWERED));
					}
					{
						valueButoon = new JButton();
						manage.add(valueButoon, new AnchorConstraint(98, 652, 157, 429, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						valueButoon.setText("\u0627\u0631\u0632\u0634 \u062f\u0631 \u0647\u0631 \u062f\u0633\u062a\u0647 \u0631\u0627 \u0628\u062f\u0647");
						valueButoon.setPreferredSize(new java.awt.Dimension(185, 28));
						valueButoon.setFont(new java.awt.Font("tahoma",0,14));
						valueButoon.addActionListener(new ActionListener(){
							public void actionPerformed(ActionEvent arg0){
								String token = term.getText();
								token = token.trim();
								if ( token == null || token.length() == 0){
									JOptionPane.showMessageDialog(null, "لطفاً کلمه وارد کنید.","خطا."
											,JOptionPane.INFORMATION_MESSAGE);
									
								}else{
									FeatureValueController fvc = new FeatureValueController(token);
									updateLable(fvc.labelValue);
									
								}
							}

							private void updateLable(String[] labelValue) {
								categ1.setText(labelValue[1]);
								categ2.setText(labelValue[2]);
								categ3.setText(labelValue[3]);
								categ4.setText(labelValue[4]);
								categ5.setText(labelValue[5]);
							}
						});
					}
					{
						term = new JTextField();
						manage.add(term, new AnchorConstraint(98, 941, 157, 716, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL, AnchorConstraint.ANCHOR_REL));
						term.setPreferredSize(new java.awt.Dimension(187, 28));
						term.setHorizontalAlignment(JTextField.RIGHT);
						term.setFont(new java.awt.Font("tahoma",0,14));
					}

				}
			}
			pack();
			this.setSize(863, 557);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	
	
	
	
}
