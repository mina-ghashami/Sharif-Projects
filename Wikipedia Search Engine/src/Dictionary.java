import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Set;

import com.sun.xml.internal.bind.v2.runtime.RuntimeUtil.ToStringAdapter;


public class Dictionary {

	public HashMap<String, ArrayList<PostingElement>> terms;
	public HashMap<String,Boolean> stopWords ; 
	
	public Dictionary() {
		terms = new HashMap<String, ArrayList<PostingElement>>();
		DictionaryFile.loadDictionary(this);
		stopWords = new HashMap<String, Boolean>();
		DictionaryFile.loadStopWords(this);
	}
	
	
//	public ArrayList<Integer> getAllDoc_ids(){
//		ArrayList<Integer> result = new ArrayList<Integer>();
//		Set<String> keys = terms.keySet();
//		for (Iterator iterator = keys.iterator(); iterator.hasNext();) {
//			String t = (String) iterator.next();
//			ArrayList<Integer> temp = getDocIds(t);
//			for (int i = 0; i < temp.size(); i++) {
//				result.add(temp.get(i));
//			}
//			temp.clear();
//		}
//		return result;
//	}
	
	public int getTF(String term){
		ArrayList<PostingElement> pl = terms.get(term);
		if(pl == null)
			return 0;
		
		int counter = 0;
		for (int i = 0; i < pl.size(); i++) {
			ArrayList<Integer> pos = pl.get(i).getPosition();
			if(pos == null)
				continue;
			counter += pos.size();
		}
		return counter ;
	}
	
	public boolean isStopWord(String term){
		if(term.equalsIgnoreCase("و") || term.equalsIgnoreCase("با"))
			return true;
		return false;
	}
	
	
	public void addTokens(int doc_id , String content){
		Tokenizer t = new Tokenizer(content);
		ArrayList<String> tokens = t.tokenize();
		for (int i = 0; i < tokens.size(); i++) {
			if(! isStopWord(tokens.get(i)))
				addTokenToDic(doc_id, tokens.get(i), i+1);
		}
	}
	
	private void addTokenToDic(int doc_id , String token , int position) {
		ArrayList<PostingElement> postList = terms.get(token);
		PostingElement pe ;
		
		if (postList == null){
			
			postList = new ArrayList<PostingElement>();
			terms.put(token, postList);
			pe = new PostingElement(doc_id);  
			pe.addPosition(position);
			postList.add(pe);
		}	
		else{
			pe = findPostElement(doc_id, postList);
			if (pe == null ){
				pe = new PostingElement(doc_id);
				pe.addPosition(position);
				postList.add(pe);
				
			}else {
				pe.addPosition(position);
				
			}
		}		
	}
	
	private PostingElement findPostElement(int doc_id , ArrayList<PostingElement> postList){
		for (int i = 0; i < postList.size(); i++) {
			PostingElement pe = postList.get(i);
			if (pe.getDocument_id() == doc_id){
				return pe;
			}
		}
		return null;	
	}
	
	public ArrayList<Double> getDocVector(int doc_id , ArrayList<String> qTerms ){
		ArrayList<Double> docVector = new ArrayList<Double>();
		
		for (int  i = 0;  i < qTerms.size();  i++) {
			String term = qTerms.get(i);
			double tf = getTermFrequency(doc_id , term);
			if(tf != 0){
				tf = Math.log10(tf);
				//System.out.println("after logarithm : "+tf);
				double idf = getIDF(term);
				//System.out.println("idf si :"+idf);
				double d = (tf+1.0) * idf;
				//System.out.println(d);
				docVector.add( (tf+1.0) * idf );
			}
			else
				docVector.add(0.0);
		}
		return docVector; 
	}
	
	public ArrayList<Double> getQueryVector(ArrayList<String> qTerms){
		
		ArrayList<Double> qVector = new ArrayList<Double>();
		
		for (int  i = 0;  i < qTerms.size();  i++) {
			String term = qTerms.get(i);
			double idf = getIDF(term);
			qVector.add( idf );
		}
		return qVector;
		
	}
	
	public int getTermFrequency (int doc_id , String term){
		ArrayList<PostingElement> postList =  terms.get(term);
		if (postList == null ){
			//System.out.println("tf list is null");
			return 0 ; 
		}
		else {
			PostingElement pe = findPostElement(doc_id, postList);
			if(pe == null){
				return 0;
			}
			return pe.getNumOfPosition(); 
		}
	}
	
	public double getIDF(String term){
		ArrayList<PostingElement> postList =  terms.get(term);
		if (postList == null ){
			return 0; 
		}
		int df = postList.size(); 
		double temp = Coordinator.coordinator.documentCatalog.getNumberOfDocuemnt();
		
		if(temp == 0)
			return 0.0;
		
		temp = temp /(double) df; 
		double idf = Math.log10(temp) ; 
		return idf + 1; 
	}
	//*********************************is New************************************	
	public ArrayList<Integer> getDocIds (String term){
		ArrayList< PostingElement> postlist = terms.get(term);
		
		if ( postlist != null){
			
			ArrayList<Integer> docIds = new ArrayList<Integer>();
			for(int i = 0 ; i < postlist.size() ; i++ ){
				int doc_id = postlist.get(i).getDocument_id();
					docIds.add(new Integer(doc_id));
			}
			return docIds ; 
		}
		else return null;
	}
	public static ArrayList<Integer> getIntersect(ArrayList<Integer> a , ArrayList<Integer> b){
		// size min bayad male a bashe;
		ArrayList<Integer> intersect  = new ArrayList<Integer>();
		for (int i = 0 ; i < a.size(); i++){
			if ( doesContain(a.get(i),b) ){
				intersect.add(a.get(i));
			}
				
		}
		return intersect; 
		
	}
	
	public static boolean doesContain(int elem , ArrayList<Integer> array){
		for (int i = 0; i < array.size(); i++) {
			if (array.get(i) == elem){
				return true; 
			}
		}
		return false; 
	}
	
	ArrayList < ArrayList<Integer> > findTermPositions (int doc_id , ArrayList<String> phraseTerms ){
		ArrayList<ArrayList<Integer>> termsPosition = new ArrayList<ArrayList<Integer>>();
		
		for (int i = 0; i < phraseTerms.size(); i++) {
			if(isStopWord(phraseTerms.get(i))){
				ArrayList<Integer> arr = new ArrayList<Integer>();
				termsPosition.add(arr);
			}
			else{
				ArrayList<PostingElement> postList = terms.get(phraseTerms.get(i));
				PostingElement pe = findPostElement(doc_id, postList);
				termsPosition.add(pe.getPosition());
			}
		}
		return termsPosition;
	}
	//*********************************************************************
	public static void main(String[] args) {
		ArrayList<Integer> a = new ArrayList<Integer>();
		a.add(1); a.add(2);a.add(4);
		
		ArrayList<Integer> b = new ArrayList<Integer>();
		b.add(8);b.add(9);b.add(1);b.add(4);
		
		if (Dictionary.doesContain(2, b))
			System.out.println("yes");
		else 
				System.out.println("no");
		
		System.out.println("intereset");
		a = Dictionary.getIntersect(a, b);
		for (int i = 0 ; i < a.size() ; i++)
			System.out.println(a.get(i));
		
	}
	
}
