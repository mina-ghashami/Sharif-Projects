
public class Feature {
	String term; 
	double score;
	
	Feature(String term , double score){
		this.term = term; 
		this.score = score; 
	}

	public String toString (){
		return "term is : "+term + " score is :  "+ score; 
	}
}
