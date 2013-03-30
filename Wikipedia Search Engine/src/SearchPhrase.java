import java.util.ArrayList;
import java.util.PriorityQueue;


public class SearchPhrase {
	
	private String query ; 
	private PriorityQueue<PhraseResult> max_heap; 
	
	public SearchPhrase(String query){
		int end = query.length(); 
		System.out.println("query is: "+query);
		//System.out.println(end);
		this.query = query.substring(1, end-1);
		System.err.println(this.query);
	}
	
	public static void main(String[] args) {
		SearchPhrase sp = new SearchPhrase("\"merhab\"");
		System.out.println(sp.query);
	}
	public String getQuery() {
		return query;
	}
	
	public ArrayList<Integer> getTopDoc(int topK, int numOfDocs){
		
		Tokenizer t = new Tokenizer(query);
		ArrayList<String> terms = t.tokenize();
		ArrayList<Integer> doc_ids = new ArrayList<Integer>();
		
		if ( terms != null || terms.size() == 0){
			doc_ids = getDocContainAllTerms(terms);
			System.out.println("size of all word"+doc_ids.size());
			
			if (doc_ids != null && doc_ids.size() != 0 ){
				//System.out.println("doc_ids.size() is : "+doc_ids.size());
				max_heap = new PriorityQueue<PhraseResult>(doc_ids.size(), new PhraseComparator());
				
				for (int i = 0; i < doc_ids.size(); i++) {
					ArrayList<ArrayList<Integer> > doc_terms_pos =
						Coordinator.coordinator.dictionary.findTermPositions(doc_ids.get(i), terms);
					
					int phraseOccurance = findNumOfOccurance(terms,doc_terms_pos);
					System.out.println("doc id is : "+ doc_ids.get(i)+ "  occurance : "+phraseOccurance);
					PhraseResult  pr = new PhraseResult(doc_ids.get(i),phraseOccurance);
					if(phraseOccurance > 0)
						max_heap.add(pr);
					
					// in int bayad baraye har doc negahdashte beshe; 
				}
				// to get the first top k document
				
				
				int size = Math.min(topK, max_heap.size());
				doc_ids = new ArrayList<Integer>();
				
				for(int i = 0 ; i < size ; i++)
					doc_ids.add(max_heap.poll().getDoc_id());
			}
		}
		return doc_ids;  
	}
	
	
	public int findNumOfOccurance (ArrayList<String> terms, ArrayList<ArrayList<Integer>> doc_terms_pos){
		int counter = 0;
		String term = terms.get(0);
		int k = 0 ;
		while(k < terms.size() && Coordinator.coordinator.dictionary.isStopWord(term) ){
			k++;
			term = terms.get(k);
		}
		if(k >= terms.size())
			return 0;
		
		ArrayList<Integer> posOfFirstTerm = doc_terms_pos.get(k);
		
		for(int i = 0 ; i < posOfFirstTerm.size() ; i++){
			int offset = posOfFirstTerm.get(i);
			boolean flag = true; 
			// bayd doc_terms_pos.size == terms.size
			for(int j = k+1 ; j < doc_terms_pos.size() ; j++){
				if(Coordinator.coordinator.dictionary.isStopWord(terms.get(j)))
					continue ;
				ArrayList<Integer> pos_of_term_j = doc_terms_pos.get(j);
				if ( containThisPos(offset+j, pos_of_term_j) == false){
					flag = false; 
					break; 
				}
			}
			if (flag == true)
				counter++; 
		}
		
		return counter; 
	}
	public ArrayList<Integer> getDocContainAllTerms(ArrayList<String> terms){
		
		String term = terms.get(0);
		int k =0 ;
		while(k < terms.size() && Coordinator.coordinator.dictionary.isStopWord(term)){
			k++;
			term = terms.get(k);
		}
		
		if(k >= terms.size())
			return new ArrayList<Integer>();
		
		ArrayList<PostingElement> a = Coordinator.coordinator.dictionary.terms.get(terms.get(k));
		ArrayList<Integer>  a_doc_id = PostingListComparator.getDocId(a);
		ArrayList<PostingElement> b ;
		ArrayList<Integer> b_doc_id;
		
	
		for (int i = k+1 ; i < terms.size() ; i++){
			b = Coordinator.coordinator.dictionary.terms.get(terms.get(i));
			b_doc_id = PostingListComparator.getDocId(b);
			a_doc_id = PostingListComparator.intersectWithSkip(a_doc_id, b_doc_id);
		}
		
		return a_doc_id;
 
	}
	
	boolean containThisPos(int pos , ArrayList<Integer> array){
		
		for (int i = 0; i < array.size(); i++) {
			if ( pos == array.get(i)){
				return true;
			}
			
		}
		return false; 
	}

	
	
}
