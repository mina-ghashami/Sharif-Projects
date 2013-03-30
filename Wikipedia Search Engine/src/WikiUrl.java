import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLDecoder;
import java.util.HashSet;
import java.util.Set;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.htmlparser.parserapplications.StringExtractor;

public class WikiUrl {
	 
	Set<String> links ;
	String content ; 
	
	public WikiUrl(String url ) throws Exception {
		
		links = new HashSet<String>();
		setContent(url);
		if(! content.contains("org.htmlparser.util.ParserException")){
			int id =  Coordinator.coordinator.documentCatalog.addDocument(url , content);
			//System.out.println("id is : "+id);
			if(id != -1){
				Coordinator.coordinator.dictionary.addTokens(id,content);
				//Coordinator.coordinator.classCatalog.classes.get(cid).doc_ids.add(id);
			}
		}
		else{
			System.out.println("yes dare");
		}
	}
	
	private void setContent(String url) throws Exception{

		StringExtractor se = new StringExtractor(url);
		String temp = se.extractStrings(true);
		extractLinks(temp);
		content = se.extractStrings(false); 
	}
	
	private void extractLinks(String temp){
		
		String regex = "<http://fa.wikipedia.org/wiki/([^>]*)>";
		Pattern p = Pattern.compile(regex,Pattern.UNICODE_CASE);
		Matcher m = p.matcher(temp);
	
		while (m.find()) {
			String str = m.group();
			String link = str.substring(1,str.length()-1);
			try {
				link = URLDecoder.decode(link, "UTF-8");
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			if(! isLocal(link))
				links.add(link);
		}
	}
	
	boolean isLocal(String link){
		if(link.contains("#"))
			return true;
		return false;
	}
}
