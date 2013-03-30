import java.util.ArrayList;

import javax.swing.JFrame;


public class SearchController {
	
	
	public SearchController (String query ,Frame frame){
		int numOfDocs = Coordinator.coordinator.documentCatalog.numberOfDocuemnt;
		ArrayList<Integer> doc_ids = null ; 
		if ( isPhraseQuery(query)){
			System.out.println("is phrase query");
			SearchPhrase searchPhrase = new SearchPhrase(query);
			//System.out.println(searchPhrase.getQuery());
			doc_ids = searchPhrase.getTopDoc(10,numOfDocs);
			
		}else {
			
			Search search = new Search(query,numOfDocs);
			doc_ids = search.getTopKDoc(10);
					
			for (int i = 0; i <doc_ids.size(); i++) {
				System.out.println(doc_ids.get(i));
			}
			if(doc_ids.size() == 0)
				System.out.println("no results found");
			
			
			
		}
		ArrayList<Result> results;
		if( doc_ids == null){
			results = new ArrayList<Result>();
		}else {
			results = Coordinator.coordinator.documentCatalog.retrieveResults(doc_ids);
		}
		Util.makeHTMLfile(results);
		frame.showResults(results);
	}
	
	boolean isPhraseQuery(String q){
		if( q.charAt(0) == '"' && q.charAt(q.length()-1 ) == '"')
			return true; 
		return false; 
	}
	

}
