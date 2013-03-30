import java.io.IOException;
import java.util.HashMap;
import java.util.Iterator;
import java.util.PriorityQueue;
import java.util.Scanner;
import java.util.Set;


public class MakeFeatureController {
	
	public MakeFeatureController(){
	
		LearnCoordinator lcoordinator = LearnCoordinator.learncoordinator; 
		HashMap <String, CategoryElement[]> terms = lcoordinator.terms;
		
		Set<String> termsSet = terms.keySet();
		
		if ( termsSet != null ){
			for(int i = 1 ; i < 6 ; i++ ){
				Category c = lcoordinator.categoryCatalog.categories.get(i);
				c.refreshFeatures();
				c.makeFeatures(termsSet);
							
			}
			for( int i = 1 ; i < 6 ; i++ ){
				Category c = lcoordinator.categoryCatalog.categories.get(i);
				c.saveFeatures();
			}
			
		}
		
		
		
	}

}
