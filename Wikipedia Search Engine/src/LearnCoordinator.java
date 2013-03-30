
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Set;

public class LearnCoordinator {
	
	public static LearnCoordinator learncoordinator;
	public static CategoryCatalog categoryCatalog; 
	public static HashMap<String, CategoryElement[]> terms; 
	public static HashMap<String, Integer> URLS;
	
	public LearnCoordinator() {
		 terms = new HashMap<String, CategoryElement[]>();
		 URLS = new HashMap<String, Integer>();
		categoryCatalog = new CategoryCatalog();
		
		 // baraye har term bayad yek arraye E az category element 5 tayi bashad.
		 
	}
	
	public void setB(int i){
		Set<String> keys = terms.keySet();

		for (Iterator iterator = keys.iterator(); iterator.hasNext();) {

		String key = (String) iterator.next();
		CategoryElement[] temp = terms.get(key);
		if(temp[i].docIds.size() != 0){
		categoryCatalog.categories.get(i).B++;
		}
	}
}

	
	
	public static void main(String[] args) {
		
		learncoordinator = new LearnCoordinator();
		System.out.println("util was called");
		Util.loadLinks(learncoordinator);
		System.out.println("end of util calling");
		for (int i = 1; i < 6; i++) {
			learncoordinator.setB(i);
		}
		
		LearnFrame inst = new LearnFrame();
		inst.setLocationRelativeTo(null);
		inst.setVisible(true);
		
		inst.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent evt){
				
				System.exit(0);
			}
		});

	}
	
	public int addUrl(String url){
		Integer doc_id = URLS.get(url);
		if (doc_id == null){
			int size = URLS.size()+1;// az 1 shorou mishe!
			URLS.put(url, size);
			return -1;
			
		}else {
			return doc_id; 
		}
	}
	
	public void addTokensToTerms(Tokenizer t , int doc_id , int category_id){
		
		ArrayList<String> tokens = t.tokenize();
		Category c = this.categoryCatalog.categories.get(category_id);
		c.numOfTerms += tokens.size();
		
		
		for (int i = 0; i < tokens.size(); i++) {
			
			String key = tokens.get(i);
			//System.out.println("in addTokensToTerms " +key);
			CategoryElement[] ce = terms.get(key);
			if ( ce == null ){
				ce = new CategoryElement[6];
				for(int j = 0 ; j < 6 ; j++){
					ce[j] = new CategoryElement(j);
				}
				
				terms.put(key, ce);
				// notic docIds is set , tekari beshe irad nadare!
				ce[category_id].docIds.add(doc_id);
				ce[category_id].term_freq++;
				//System.out.println(key+" "+ce[category_id].term_freq);
			}else{
				ce[category_id].docIds.add(doc_id);
				ce[category_id].term_freq++;
				//System.out.println(key+" "+ce[category_id].term_freq);
			}
			
		}
	}
	
	public int hasCateg_hasTerm(String term , int category_id ){
		if (category_id == 0 ) System.err.println("danger category is 0");
		
		CategoryElement [] ce = terms.get(term);
		if (ce == null ){
			System.err.println("اینجا نباید به وقوع بپیونده.");
			return 0; 
		}
		return ce[category_id].docIds.size();
	}
	
	public int hasCateg_notTerm(String term , int category_id ){
		if (category_id == 0 ) System.err.println("danger category is 0");
		int numOfDocInCateg = categoryCatalog.categories.get(category_id).getNumOfDoc();
		int numOfDocInCateg_HasTerm = hasCateg_hasTerm(term, category_id) ;
		int temp = 0 ;
		temp =  numOfDocInCateg - numOfDocInCateg_HasTerm;
		if ( temp < 0 ){
			System.err.println("hasCateg_notTerm ");
		}
		return temp ; 	
	}
	
	public int notCateg_hasTerm(String term , int category_id ){
		if (category_id == 0 ) System.err.println("danger category is 0");
		
		CategoryElement [] ce = terms.get(term);
		if(ce == null){
			System.err.println("اینجا نباید به وقوع بپیونده.");
			return 0 ; 
		}else{
			int n = 0 ; 
			for (int i = 1 ; i < 6 ; i++ ){
				if ( i == category_id ){
					continue;
				}else {
					n = n + ce[i].docIds.size();
				}
			}
			return n; 
		}
		
	}
	
	public int notCateg_notTerm(String term , int category_id ){
		if (category_id == 0 ) System.err.println("danger category is 0");
		int numofAllDoc = categoryCatalog.getNumOfAllDoc();
		int temp = numofAllDoc - (hasCateg_hasTerm(term, category_id)+
								  hasCateg_notTerm(term, category_id)+
								  notCateg_hasTerm(term, category_id));
		return temp ; 
		
	}
	public void addContent(String content,String url,int category_id){
		System.out.println("content is Not NULL -> "+content.length());
		if (content != null ){
			int hasUrl = addUrl(url);
			// hasUrl is also doc_id of new url
			
			if (hasUrl == -1 ){
				
				System.out.println("a new url was founds with id : "+URLS.size());
				int doc_id = URLS.size();
				categoryCatalog.addDocToCategory(doc_id, category_id);
				//String content = getContent(s);
				Tokenizer t = new Tokenizer(content);
				
				addTokensToTerms(t, doc_id, category_id);
			}else {
				System.out.println(" the url is already in sets");
			}
		}
	}
}
