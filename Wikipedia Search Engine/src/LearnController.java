import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.Set;

import org.htmlparser.parserapplications.StringExtractor;
import org.htmlparser.util.ParserException;



public class LearnController {
	
	String url ; 
	int cid ; 
	LearnCoordinator lcoordinator; 
	
	LearnController(String _url , int cid){
		this.url = _url ; 
		this.cid = cid ; 
		lcoordinator = LearnCoordinator.learncoordinator;
//		try {
//			this.url = URLDecoder.decode(url,"UTF-8");
//		} catch (UnsupportedEncodingException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}
		String c = Util.getContent(url);
		/**/
		if (c!= null ){
			lcoordinator.addContent(c, _url, cid);
		}	
		/**/	
	}
	
	
	
	public static void main(String[] args) {
		
	}
}
