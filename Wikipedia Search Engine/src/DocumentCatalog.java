import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Set;
import java.net.URLConnection;

import javax.annotation.processing.FilerException;


public class DocumentCatalog {
	
	public HashMap<String, Integer> URLs;
	int numberOfDocuemnt ;
	
	
	public DocumentCatalog() {
		URLs = new HashMap<String, Integer>();
		numberOfDocuemnt = 0;
		loadURLFile();
	}
	
	
	int addDocument(String url , String content){
		//url = getUTF8Url(url);
		Integer val = URLs.get(url);
		if(val == null){
			numberOfDocuemnt ++;
			URLs.put(url, numberOfDocuemnt );
			createDocument( numberOfDocuemnt , content , url);
			return numberOfDocuemnt ;
		}
		else{
			return -1;
		}
	}
	
		private String getUTF8Url(String url) {
		
		URL webpage;
		try {
			webpage = new URL(url);
	        URLConnection yc = webpage.openConnection();
	        BufferedReader in = new BufferedReader(new InputStreamReader(yc.getInputStream()));
	        String inputLine;
	        
	        String content = "";

	        while ((inputLine = in.readLine()) != null) 
	            content += inputLine ;
	        in.close();
	        
	        int beginindex = content.indexOf("wgPageName=") + 12;
	        int endindex = content.indexOf("wgTitle") - 2;
	        content = content.substring(beginindex, endindex);
	        System.out.println("mina content is : "+content);
	        if(content.contains("\u200c")){
	        	content = content.replaceAll("\u200c", "‌");
	        	System.out.println("in if , content si : "+content);
	        }
	        url = "http://fa.wikipedia.org/wiki/"+content;
	        System.out.println("url is : "+url);
	        return url;
	        
		} catch (Exception e) {
			System.out.println("in getUTF8URL exception happened");
			return url;
		}
		
	}



	public int getNumberOfDocuemnt() {
		return numberOfDocuemnt;
	}

	public void loadURLFile(){
		
		try{
		   	File URLFile = new File("URLs.txt");
		   	if(URLFile.exists()){
			    FileInputStream fstream = new FileInputStream("URLs.txt");
			    
			    DataInputStream in = new DataInputStream(fstream);
			    BufferedReader br = new BufferedReader(new InputStreamReader(in));
			    String  doc_id , url;
			    
			    while( (url = br.readLine()) != null ){
			    	doc_id = br.readLine();
			    	URLs.put(url, Integer.parseInt(doc_id));
			    	numberOfDocuemnt ++;
			    }
			    in.close();
		   	}
		   	else{
		   		URLFile.createNewFile();
		   	}
		}
		catch(Exception e){
			e.printStackTrace();
		}
	}
	
	public void saveURLFile(){
		FileWriter fs;
		try {
			File URLFile = new File("URLs.txt");
			fs = new FileWriter("URLs.txt");
			BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(
					new FileOutputStream(URLFile),"UTF8"));
			
			Set<String> keys = URLs.keySet();
			if(keys.size() == 0)
				return ;
			for (Iterator iterator = keys.iterator(); iterator.hasNext();) {
				String key = (String) iterator.next();
				int doc_id = URLs.get(key);
				bw.append(key);
				bw.append("\n");
				bw.append(doc_id+"\n");
				
			}
			bw.close();
			
		} catch (IOException e) {
		
			e.printStackTrace();
		}	
	}
	
	public void createDocument(int id , String content ,String url){
		String summary = "";
		try {
			summary = createSummary(url);
			
		} catch (Exception e1) {
			e1.printStackTrace();
		}
		try {
			File file = new File(id+".txt");
			BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(file),"UTF8"));
			bw.write(url+"\n");
			bw.append(summary);
			bw.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	private String getBodyContent(String url) {
		try{
			URL webpage = new URL(url);
	        URLConnection yc = webpage.openConnection();
	        BufferedReader in = new BufferedReader(new InputStreamReader(yc.getInputStream()));
	        String inputLine;        
	        String content = "";
	        while ((inputLine = in.readLine()) != null) 
				    content += inputLine ;
			
	        in.close();
	        int index = content.indexOf("<body");
	        content = content.substring(index);
	        index = content.indexOf("<p>")+3;
	        content = content.substring(index);	        
	        content = removeTags(content);
	        content = removeAmp(content); // &
	        
	        return content;
		}
		catch(Exception e){
			return "";
		}
	}
	
	private String removeAmp(String content){
		int begin , end ;
		String t , pre, post;
		
		while(content.contains("&")){
			begin = content.indexOf("&");
			end = content.indexOf(";");
			
			if(begin >=0 && end>=0 && begin < end){
				t = content.substring(begin, end);
				pre = content.substring(0, begin);
				post = content.substring(end+1);
				content = pre + post;
			}
			else
				break;
		}
		return content;
	}
	
	private String removeTags(String content){
		int begin , end ;
		String t , pre, post;
		
		while(content.contains("<")){
			begin = content.indexOf("<");
			end = content.indexOf(">");
			if(begin >=0 && end>=0){
				t = content.substring(begin, end);
				pre = content.substring(0, begin);
				post = content.substring(end+1);
				content = pre + post;
			}
		}
		return content;
	}
	
	public String createSummary(String url ){
		
		String bodycontent = getBodyContent(url);
		
		if(bodycontent != ""){
			String str = "http://fa.wikipedia.org/wiki/";
			String title = url.substring(str.length());
			Tokenizer tt = new Tokenizer(title);
			ArrayList<String> titletTokens = tt.tokenize();
			Tokenizer t = new Tokenizer(bodycontent);
			ArrayList<String> tokens = t.tokenize();
			
			String summary = "" , pre = "", post = "";
			int i;
			
			for (int k = 0; k < titletTokens.size(); k++) {
				
				title = titletTokens.get(k);
				for (i = 0; i < tokens.size(); i++) {
					if(tokens.get(i).equalsIgnoreCase(title)){
						break;
					}
				}
				if(i<tokens.size()){
					for (int j = i+1; j < Math.min(20, tokens.size()); j++) { // j == 0 booda , i+1 kardamesh
						post = post + tokens.get(j) + " ";
					}
					summary = title +" "+ post;
					
					for (int j = i - 1 ; j >= Math.max(i-20, 0); j--) {
						pre = tokens.get(j)+ " " +pre ;
					}
					break;
				}
			}
			summary = pre + summary;
			return summary;
		}
		else{
			return createAnotherSummary();
		}
	}
	
	public String createAnotherSummary(){
		return "another symmary";
	}
	
	public ArrayList<Result> retrieveResults(ArrayList<Integer> doc_ids){
		ArrayList<Result> results = new ArrayList<Result>();
		Result r; 
		for (int i = 0 ; i < doc_ids.size() ; i++ ){
			r = new Result(doc_ids.get(i));
			results.add(r);
		}
		return results; 
	}	
}
