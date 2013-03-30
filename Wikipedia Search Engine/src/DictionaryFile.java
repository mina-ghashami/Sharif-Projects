import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.Reader;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Set;


public class DictionaryFile {

	public static void main(String[] args) {
		Dictionary d = new Dictionary();
		//loadDictionary(d);
		System.out.println("before save");
		saveDictionary(d);
		
	}
	
	public static boolean hasFile(String name){
		File f = new File(name+".txt");
		return f.exists();
		
	}
	
	public static void loadDictionary(Dictionary dictionary){
		File f = new File("dictionary.txt");
		if (f.exists()){
			System.out.println("in load dictioanry, dictionary file already exist.");
			BufferedReader in;
			try {
				in = new BufferedReader(new FileReader(f));
				String strLine = "";
				try {
					while( (strLine = in.readLine())!= null ){
						
						String res [] =  strLine.split(":");
						String positions [] = res[2].split(",");
						
						PostingElement pe = new PostingElement(Integer.parseInt(res[1]));
						for(int i = 0 ; i < positions.length ; i++){
							pe.addPosition( Integer.parseInt(positions[i]));
						}
						ArrayList<PostingElement> postlist = dictionary.terms.get(res[0]);
						if (postlist == null ){
							postlist = new ArrayList<PostingElement>();
							postlist.add(pe);
							dictionary.terms.put(res[0], postlist);
						}
						else{
							postlist.add(pe);
						}
						
						
					}
					in.close();
				} catch (Exception e) {

				} 
				
			
			} catch (FileNotFoundException e) {	}
			
		}else {
			
			try {
				System.out.println("in load dictioanry, a new dictionary file created.");
				f.createNewFile();
			} 
			catch (IOException e) {
				System.out.println("in load dictioanry, unable to create a new dictionary file");
			}
		}
	}

	//_______________________________________________________________________
	public static void loadStopWords(Dictionary dictionary){
		
	
		File f = new File("stopWords.txt");
		if (f.exists()){
			
			BufferedReader in;
			try {
				in = new BufferedReader(new FileReader(f));
				String strLine; 
		    
				    while( (strLine = in.readLine()) != null ){
				    	strLine = new String(strLine.getBytes(),"UTF-8");
				    	strLine = strLine.trim();
				    	dictionary.stopWords.put(strLine, true);
				    }
				
				    in.close();
			}catch(Exception e){}
		}else{
			   	try {
					f.createNewFile();
				} catch (IOException e) { }
			   	System.out.println("stop words not exists!");
		}
		
	}
	public static void saveDictionary(Dictionary dictionary){
		FileWriter fs;
		try {
			File dictionaryFile = new File("dictionary.txt");
			fs = new FileWriter("dictionary.txt");
			BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(
					new FileOutputStream(dictionaryFile),"UTF8"));
			
			HashMap< String, ArrayList<PostingElement>> terms = dictionary.terms; 
			
			Set<String> keys = terms.keySet();
			
			if(keys.size() == 0)
				return ;
			
			for (Iterator iterator = keys.iterator(); iterator.hasNext();) {
		
				String key = (String) iterator.next();
				ArrayList<PostingElement> postList = terms.get(key);
				
				for (int i = 0; i < postList.size(); i++) {
					PostingElement pe = postList.get(i);
					int docId = pe.getDocument_id();
					ArrayList<Integer> positions = pe.getPosition();
					String line = key + ":" + docId + ":";
					for (int j = 0; j < positions.size(); j++) {
						line = line + positions.get(j)+",";
						
					}
					line = line.substring(0, line.length()-1);
					line = line+"\n";
					bw.append(line);
				}
			}
			
			bw.close();
			System.out.println("dictionary saved in exit");
			
		} catch (IOException e) {
		
			e.printStackTrace();
		}
		
	}
	
}
