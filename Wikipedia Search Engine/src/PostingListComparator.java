import java.util.ArrayList;


public class PostingListComparator {
	
	public static ArrayList<Integer> intersectPostList( ArrayList<PostingElement> a ,
						ArrayList<PostingElement> b){
		ArrayList<Integer> a_docids = getDocId(a);
		ArrayList<Integer> b_docids = getDocId(b);
		
		ArrayList<Integer>  intersection = intersectWithSkip(a_docids, b_docids);
		return intersection;
	}
	
	
	public static ArrayList<Integer> getDocId(ArrayList<PostingElement> a){
		ArrayList<Integer> doc_ids = new ArrayList<Integer>();
		if( a != null){
			for (int i = 0; i < a.size(); i++) {
				doc_ids.add(a.get(i).getDocument_id());
			}
		}
		return doc_ids;
	}
	
	
	public static ArrayList<Integer> intersectWithSkip(ArrayList<Integer>a , ArrayList<Integer> b){
		ArrayList<Integer> answer = new ArrayList<Integer>();
		// a and b are not null;
		int p_a [] = {0} ; 
		int p_b []= {0 }; 
		
		if( a == null || b == null)
			return answer ;
		
		while( isNotNull(p_a, a) && isNotNull(p_b, b)){
			if (a.get(p_a[0]) == b.get(p_b[0])){
				
				answer.add(a.get(p_a[0]));
				p_a[0]++;
				p_b[0]++; 
			}else if ( a.get(p_a[0]) < b.get(p_b[0]) ){
				
				if( hasSkip(p_a, a) && ( a.get(skip(p_a, a)) < b.get(p_b[0]))    ){
					
					p_a[0] = skip(p_a, a);
					while( hasSkip(p_a, a) && ( a.get(skip(p_a, a)) < b.get(p_b[0])) ){
						p_a[0]= skip(p_a, a);
						
					}
					
				}else {
					p_a[0]++;
				}
			}else{
				if (hasSkip(p_b, b) && (b.get(skip(p_b, b)) < a.get(p_a[0]) ) ){
					
					p_b [0] = skip(p_a, b);
					
					while( hasSkip(p_b, b) && (b.get(skip(p_b, b)) < a.get(p_a[0]) )  ){
						p_b[0] = skip(p_b, b);
					}
					
				}else{
					p_b[0]++;
				}
			}
		}
		
		return answer;
		
	}
	public static boolean isNotNull(int []index , ArrayList<Integer> list){
		if (index[0] < list.size())
			return true; 
		return false; 
	}
	public static boolean hasSkip(int []index , ArrayList<Integer> list){
		
		int size = list.size(); 
		int skip_len = (int)Math.sqrt(size);
		if (index[0] + skip_len< size && skip_len != 0){
			return true; 
			
		}
		return false; 
		
	}
	public static int skip(int index [], ArrayList<Integer> list){
		int size = list.size();
		int skip_len = (int)Math.sqrt(size);
		return  index[0] + skip_len ;
		//return index[0];
	}


}
