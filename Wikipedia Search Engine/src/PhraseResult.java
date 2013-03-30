
public class PhraseResult {
	
	private int doc_id;
	private int frequency;
	
	PhraseResult(int docid , int freq){
		doc_id = docid; 
		frequency = freq; 
	}
	
	public int getDoc_id() {
		return doc_id;
	}
	public int getFrequency() {
		return frequency;
	}
	
}
