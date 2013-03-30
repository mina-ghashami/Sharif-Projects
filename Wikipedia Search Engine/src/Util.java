import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLDecoder;
import java.util.ArrayList;

import org.htmlparser.parserapplications.StringExtractor;
import org.htmlparser.util.ParserException;


public class Util {
	
	public static void makeHTMLfile(ArrayList<Result> res){
		
		System.out.println("in make html , result size is : "+res.size());
		String filepath = "results1.html";
		String filepath2 = "results2.html";
		
		String newLine = "\n";
		String s ="<html>";
		s = s + newLine + "<head>"+"<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />"+"</head>";
		s = s + newLine + "<body dir=\"rtl\">"	;
		if(res.size() == 0)
			s = s + "لطفا دوباره جستجو کنيد.";
		for(int i = 0 ; i < res.size() ; i++){
			Result r = res.get(i);
			try {
				String m = URLDecoder.decode(r.url, "UTF-8");
				int tempindex = m.indexOf("http://fa.wikipedia.org/wiki/")+29;
				r.title = m.substring(tempindex);
				
			} catch (UnsupportedEncodingException e) {
				e.printStackTrace();
			}
			
			s = s + newLine + "<b><a href="+r.url+">"+r.title+"</a>" +"</b>";
			s = s + newLine + "<br>" + r.summary;
			//urlText = URLDecoder.decode(urlText, "UTF-8");
			try {
				s = s + newLine + "<br>" +"<div style=\"font-family:arial;color:green;\">" +URLDecoder.decode(r.url, "UTF-8")+"</div>";
			} catch (UnsupportedEncodingException e) {
				e.printStackTrace();
			}
			s = s + newLine + "<br><br>";
		}
		
		s = s + newLine + "</body>"	;
		s = s + newLine + "</html>"	;
		

		File file = new File(filepath);
		File file2 = new File(filepath2);
		try {
			file.createNewFile();
			file2.createNewFile();
		} catch (IOException e1) {
			System.out.println("unnable to create a new  html file ");
		}
		
		try{
		    
		    BufferedWriter out = new BufferedWriter(new OutputStreamWriter 
		                                 (new FileOutputStream(file),"UTF8"));
		    BufferedWriter out2 = new BufferedWriter(new OutputStreamWriter 
                    (new FileOutputStream(file2),"UTF8"));
		    out.write(s);
		    out2.write(s);
		    
		    out.close();
		    out2.close();
		    file = null;
		    file2 = null;
		    System.out.println("Written Process Completed.");
		    
		 
		}  catch(Exception e){
		 	System.out.println("error in make html file ");
		 
		}
		
	}
	public static void loadLinks(LearnCoordinator lc){
		int size = lc.categoryCatalog.classNames.length;
		//System.out.println("size of class names is : "+size);
		
		for (int i = 1 ; i < size ; i++ ){
			loadLink_Category(i , lc);
		}
	}
	public static void loadLink_Category(int category_id , LearnCoordinator lc){
		
		File f = new File("category_link_"+category_id+".txt");
		if(f.exists()){
			BufferedReader in;
			try {
				in = new BufferedReader(new FileReader(f));
				String s; 				
					while( (s = in.readLine()) != null) {// s is url; 	
						//s = URLDecoder.decode(s,"UTF-8");
						
						String c = getContent(s);
						//System.out.println("url is "+s);
						//System.out.println("content is "+c);
						
						/**/
						if (c != null){
							lc.addContent(c,s,category_id);
						}else {
							System.err.println("content of url is null url->"+s);
						}
						/**/
					}
				
			} catch (Exception e) {	System.out.println("unable to load "+f.getName()); }

		}
	}
		
		public static String getContent(String url){
			String content=""; 

			try {
				StringExtractor se = new StringExtractor(url);
				content = se.extractStrings(false);

				if(content.contains("org.htmlparser.util.ParserException:")){
					//System.exit(0);
					return null; 
				}
				
				return content;
			} catch (Exception e) {
				System.out.println("content is : null");
				return null; 
			}	 
		}
		
		public static void main(String[] args) {
			String url = "http://fa.wikipedia.org/wiki/%DA%A9%D8%A7%D8%A8%DB%8C%D9%86%D9%87";
			StringExtractor se = new StringExtractor(url);
			try {
				String content = se.extractStrings(false);
				System.out.println(content);
			} catch (ParserException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
}
