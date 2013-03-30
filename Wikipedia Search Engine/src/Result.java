import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.InputStreamReader;
import java.util.regex.Matcher;
import java.util.regex.Pattern;


public class Result {
	String title; 
	String url; 
	String summary; 
	
	public Result(int doc_id){
		loadResult(doc_id);
		setTitle();
	}
	
	private void loadResult(int doc_id){
		String fName = doc_id+".txt";
		 FileInputStream fstream;
		try {
			fstream = new FileInputStream(fName);
			DataInputStream in = new DataInputStream(fstream);
		    BufferedReader br = new BufferedReader(new InputStreamReader(in));
		    String strLine;
		    url = br.readLine();
		    summary = "";
		    while( (strLine = br.readLine()) != null ){
		    	summary =  strLine;
		    	//summary = summary + strLine + "\n";
		    }
		    
		} catch (Exception e) {
			
			e.printStackTrace();
		}
		    
		
	}
	
	private void setTitle (){
		String regex = "http://fa.wikipedia.org/wiki/(.*)?";
		Pattern p = Pattern.compile(regex,Pattern.UNICODE_CASE);
		Matcher m = p.matcher(url);
		title = "";
		if (m.find()){
			title = m.group(1);
			title = title.trim();
			if (title.contains("\n"))
					System.out.println("new line");
			else System.out.println("no new line");
		}
		
	}
	
	public static void main(String[] args) {
	
//		String regex = "http://fa.wikipedia.org/wiki/(.*)?";
//		Pattern p = Pattern.compile(regex,Pattern.UNICODE_CASE);
//		String url = "http://fa.wikipedia.org/wiki/مهرداد_عالیخانی"; 
//		Matcher m = p.matcher(url);
//		
//		if(m.find())
//			String s = m.group(1);
	
		Result r = new Result(2);
		System.out.println(r.title);
		System.out.println(r.summary);
	}
	public String toString(){
		String s = "";
		s = s + this.title + "\n"; 
		s = s + this.summary + "\n";
		s = s + this.url;
		return s; 
		
	}
}
