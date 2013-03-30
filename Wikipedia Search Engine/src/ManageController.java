import java.util.Iterator;
import java.util.Set;

public class ManageController {
	 
	public ManageController(String url) {
		try {
			WikiUrl wikiUrl = new WikiUrl(url); // class id ro midim ta classify kone
			Set<String> innerUrls = wikiUrl.links;
			//System.out.println(url+" add shod .");
			int counter = 0;
			
			for (Iterator iterator = innerUrls.iterator(); iterator.hasNext();) {
				String innerUrl = (String) iterator.next();
				wikiUrl = new WikiUrl(innerUrl);
				counter ++ ;
				//System.out.println(innerUrl+" add shod .");
			}
			
			//System.out.println("counter is "+counter);
		} catch (Exception e) {
			e.printStackTrace();
		}
	
	}
}
