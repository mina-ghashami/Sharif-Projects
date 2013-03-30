
import java.util.ArrayList;


public class CategoryCatalog {
	
	ArrayList<Category> categories = new ArrayList<Category>();
	int numOfTerms; 
	String[] classNames = {"رده ها","ادبی و هنری","تاریخی","سیاسی","علمی","ورزشی"};
							//5      4        3      2           1          0
	
	public CategoryCatalog() {
		
		for (int i = 0; i < classNames.length; i++) {
			Category c = new Category(i , classNames[i]);
			categories.add(c);
		}	
	}
	
	public void addDocToCategory(int doc_id , int category_id){
		categories.get(category_id).addDocument(doc_id);
	}
	
	public int getNumOfAllDoc(){
		int temp = 0 ; 
		for (int i = 1; i < 6 ; i++) {
			temp += categories.get(i).getNumOfDoc();
			
		}
		return temp ; 
	}
	
//	public ArrayList<Integer> hasClass_hasTerm(int cid , String term){ // N11
//		ArrayList<Integer> classDocs = classes.get(cid).doc_ids;
//		ArrayList<PostingElement> postList = Coordinator.coordinator.dictionary.terms.get(term);
//		ArrayList<Integer> termDocs = PostingListComparator.getDocId(postList);
//		ArrayList<Integer> intersect = new ArrayList<Integer>();
//		
//		int i=0 ,j=0;
//		int classDocsSize = classDocs.size();
//		int termDocsSize = termDocs.size();
//		
//		while(i < classDocsSize && j < termDocsSize){
//			if(classDocs.get(i) == termDocs.get(j)){
//				intersect.add(classDocs.get(i));
//				i++; j++;
//			}
//			if(i>= classDocsSize || j>= termDocsSize)
//				break;
//			
//			if(classDocs.get(i) < termDocs.get(j)){
//				while(i < classDocsSize && classDocs.get(i) < termDocs.get(j)){
//					i++;
//				}
//			}
//			if(i>= classDocsSize || j>= termDocsSize)
//				break;
//			
//			if(classDocs.get(i) > termDocs.get(j)){
//				while(j < termDocsSize && classDocs.get(i) > termDocs.get(j)){
//					j++;
//				}
//			}
//			if(i>= classDocsSize || j>= termDocsSize)
//				break;
//		}
//		return intersect ;
//	}
//	
//	
//	public ArrayList<Integer> hasClass_notTerm(int cid , String term){ // N01
//		ArrayList<Integer> intersect = hasClass_hasTerm(cid, term);
//		ArrayList<Integer> classDocs = classes.get(cid).doc_ids;
//		ArrayList<Integer> tafazol = new ArrayList<Integer>();
//		
//		for (int k = 0; k < classDocs.size(); k++) {
//			if(! intersect.contains(classDocs.get(k)))
//				tafazol.add(classDocs.get(k));
//		}
//		return tafazol;
//	}
//	
//	public ArrayList<Integer> notClass_hasTerm(int cid , String term){ // N10
//		ArrayList<PostingElement> postList = Coordinator.coordinator.dictionary.terms.get(term);
//		ArrayList<Integer> termDocs = PostingListComparator.getDocId(postList);
//		
//		ArrayList<Integer> classDocs = classes.get(cid).doc_ids;
//		ArrayList<Integer> result = new ArrayList<Integer>();
//		
//		for (int k = 0; k < termDocs.size(); k++) {
//			if(! classDocs.contains(termDocs.get(k)))
//				result.add(termDocs.get(k));
//		}
//		return result;
//	}
//	
//	public ArrayList<Integer> notClass_notTerm(int cid , String term){ // N00
//		ArrayList<PostingElement> postList = Coordinator.coordinator.dictionary.terms.get(term);
//		ArrayList<Integer> termDocs = PostingListComparator.getDocId(postList);
//		ArrayList<Integer> classDocs = classes.get(cid).doc_ids;
//		ArrayList<Integer> result = new ArrayList<Integer>();
//		
//		for (int k = 1; k <= Coordinator.coordinator.documentCatalog.numberOfDocuemnt; k++) {
//			if(! classDocs.contains(k))
//				if(! termDocs.contains(k))
//					result.add(k);
//		}
//		return result;
//	}
//	
	
	public static void main(String[] args) {
		
		ArrayList<Integer> intersect = new ArrayList<Integer>();
		ArrayList<Integer> classDocs = new ArrayList<Integer>();
		ArrayList<Integer> tafazol = new ArrayList<Integer>();
		classDocs.add(1);classDocs.add(3);classDocs.add(5);classDocs.add(8);classDocs.add(12);
		classDocs.add(15);classDocs.add(21);
		
		intersect.add(1);intersect.add(4);intersect.add(5);intersect.add(7);intersect.add(12);
		intersect.add(17);
		
		for (int k = 0; k < classDocs.size(); k++) {
			if(! intersect.contains(classDocs.get(k))){
				tafazol.add(classDocs.get(k));
				System.out.println(classDocs.get(k));
			}
		}
		System.out.println(tafazol.size());
//		if(classDocs.)
//			System.out.println("i");
	}

}
