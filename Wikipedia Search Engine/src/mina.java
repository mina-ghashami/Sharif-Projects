import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URL;
import java.net.URLConnection;


public class mina {
	public static void main(String[] args) {
		mina m = new mina();
		String url = "http://fa.wikipedia.org/wiki/%D8%B1%D8%AF%D9%87:%D9%88%D8%B1%D8%B2%D8%B4_%D9%87%D8%A7%D9%8A_%D8%B2%D9%85%D8%B3%D8%AA%D8%A7%D9%86%D9%8A";
		String t = m.getUTF8Url(url);
		System.out.println(t);
	}
	
	mina(){
		
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
			e.printStackTrace();
		}
		return null;

}}
