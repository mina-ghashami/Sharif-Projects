import java.util.HashMap;
import java.util.Iterator;
import java.util.Set;

import com.sun.xml.internal.bind.v2.runtime.Coordinator;


public class FeatureValueController {
	
	String labelValue [] = new String[6];
	
	public FeatureValueController(String token){
		String tokens[]  = token.split(" ");
		token = tokens[0];
		
		LearnCoordinator lc = LearnCoordinator.learncoordinator; 
		HashMap <String, CategoryElement[]> terms = lc.terms;
		
		Set<String> termsSet = terms.keySet();

		if ( termsSet != null ){
			if ( termsSet.contains(token) ){
				
				System.out.println("this term is in our set");
				for(int i = 1 ; i < 6 ; i++ ){
					Category c = lc.categoryCatalog.categories.get(i);
					c.refreshFeatures();
					c.makeFeatures(termsSet);
								
				}
				for( int i = 1 ; i < 6 ; i++ ){
					Category c = lc.categoryCatalog.categories.get(i);
					double d = c.calcScore(token);
					labelValue[c.id] = " : score is "+d ; 
					labelValue[c.id] += "    N00 is : "+lc.notCateg_notTerm(token, c.id);
					labelValue[c.id] += "    N01 is : "+lc.hasCateg_notTerm(token, c.id);  
					labelValue[c.id] += "    N10 is : "+lc.notCateg_hasTerm(token, c.id);  
					labelValue[c.id] += "    N11 is : "+lc.hasCateg_hasTerm(token, c.id);  
					//System.out.println("num of terms "+c.numOfTerms);
					System.out.println(" term is "+token+" term in category "+lc.terms.get(token)[i].term_freq);
					c.saveFeatures();
				}
				
				
			}else{
				System.out.println("this term is not in our set");
			}	
		}
		
		
		
	}

}
