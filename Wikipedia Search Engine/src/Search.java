import java.util.ArrayList;
import java.util.Iterator;
import java.util.PriorityQueue;

import com.sun.org.apache.xalan.internal.xsltc.dom.MultiValuedNodeHeapIterator.HeapNode;


public class Search {
	
	String query ; 
	int numOfDocs ; 
	ArrayList<String> qterms ;
	PriorityQueue<MyDocument> maxheap ; 

	public Search(String query, int sizeDic){
		
		numOfDocs = sizeDic; 
		maxheap = new PriorityQueue<MyDocument>(numOfDocs,new DocumentComparator());
		this. query = query ;  
		getTerms();	
		buildHeap();
	}
	
	private void getTerms() {
		
		Tokenizer t = new Tokenizer(query);
		qterms = t.tokenize(); 
	}
	
	public void buildHeap (){
		for (int i = 1; i <= numOfDocs; i++) {
			double score = calcSimilarity(i);
			maxheap.add(new MyDocument(i,score));
		}
	}
	
	public double calcSimilarity(int doc_id ){
		ArrayList<Double> docVector =  Coordinator.coordinator.dictionary.getDocVector(doc_id, qterms);
		
		
		docVector = normalizeVector(docVector);
		
		ArrayList<Double> queryVector = Coordinator.coordinator.dictionary.getQueryVector(qterms);
		
		int dimention = qterms.size(); 
		double score = 0 ; 
		
		for (int i = 0; i < dimention; i++) {
			score += docVector.get(i) * queryVector.get(i);
		}
		return score; 
	}
	
	public ArrayList<Integer> getTopKDoc (int topK){
		ArrayList<Integer> topK_ids = new ArrayList<Integer>();
		
		MyDocument d ;
		for (int i = 0 ; i < Math.min(topK ,numOfDocs) ; i++) {
			d = maxheap.remove();
			if(d.getScore() == 0)
				break;
			topK_ids.add(d.getId());
		}
		return topK_ids;
	}
	
	public ArrayList<Double> normalizeVector(ArrayList<Double> docVector){
		double length = 0.0 ; 
		for (int i = 0; i < docVector.size(); i++) {
			double temp = docVector.get(i);
			length += temp * temp  ;  
			
		}
		length = Math.sqrt(length);
		//System.out.println("len is :"+length);
		if(length == 0)
			return docVector;
		
		ArrayList<Double> temp = new ArrayList<Double>();
		for (int i = 0; i < docVector.size(); i++) {
			//System.out.println("docVector.get(i)/length is "+docVector.get(i)/length);
			temp.add(docVector.get(i)/length);
		}
		return temp;
	}
}
