import java.util.Comparator;


public class WordComparator implements Comparator<Word>{
	
	public int compare(Word a , Word b){
		if(a.tf > b.tf)
			return -1;
		
		if(a.tf < b.tf)
			return 1;
		
		return 0;
	}
}
