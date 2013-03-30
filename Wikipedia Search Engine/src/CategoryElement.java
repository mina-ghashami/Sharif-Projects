import java.util.HashSet;
import java.util.Set;

public class CategoryElement {
	int categoryId; 
	HashSet<Integer> docIds; 
	int term_freq ; 
	
	
	public CategoryElement(int categoryid) {
		term_freq = 0 ; 
		categoryId = categoryid; 
		docIds = new HashSet<Integer>();
	}
		
	public static void main(String[] args) {
		CategoryElement ce = new CategoryElement(1);
		ce.docIds.add(1);
		ce.docIds.add(2);
		ce.docIds.add(1);
		System.out.println(ce.docIds.size());
		
	}
	

}
