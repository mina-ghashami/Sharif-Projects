import java.util.ArrayList;


public class interserct {
	
	public static void main(String[] args) {
		ArrayList<Integer> a = new ArrayList<Integer>();
		ArrayList<Integer> b = new ArrayList<Integer>();
			a.add(2);
			a.add(4);
			a.add(8);
			a.add(16);
			a.add(19);
			a.add(23);
			a.add(28);
			a.add(43);
			
			b.add(1); b.add(2);b.add(3);b.add(5);b.add(8);b.add(41);b.add(51);b.add(60);b.add(71);
			
		ArrayList<Integer> res = intersectWithSkip(a, b);
		for (int i = 0; i < res.size(); i++) {
			System.out.println(res.get(i));	
		}
		
//			if (a.get(0) == b.get(1))
//				System.out.println("equal");
		
	}
	public static ArrayList<Integer> intersectWithSkip(ArrayList<Integer>a , ArrayList<Integer> b){
		ArrayList<Integer> answer = new ArrayList<Integer>();
		// a and b are not null;
		int p_a [] = {0} ; 
		int p_b []= {0 }; 
		
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
