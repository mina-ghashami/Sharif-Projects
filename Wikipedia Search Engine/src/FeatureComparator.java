import java.util.Comparator;


public class FeatureComparator implements Comparator<Feature> {
	public int compare(Feature x , Feature y){
		if(x.score < y.score)
			return 1 ; 
		if(x.score > y.score)
			return -1; 
		return 0 ; 
	}

}
