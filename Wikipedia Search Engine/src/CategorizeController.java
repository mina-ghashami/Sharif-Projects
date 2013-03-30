import java.util.Iterator;
import java.util.Set;

public class CategorizeController {

	int category_id ; 

	public CategorizeController(String url ){
		
		try {
			WikiUrl wikiUrl = new WikiUrl(url);
			
			Integer doc_id = Coordinator.coordinator.documentCatalog.URLs.get(url);
			System.out.println("doc_id "+doc_id);
			
			
			
			
			if (doc_id != null ){
				CategInfo [] categInfo = Coordinator.coordinator.categInfo;
				/**
				for(int i = 1 ; i < 6 ; i++){
					System.out.println("Categ "+i);
					Set<String> s = categInfo[i].features.keySet();
					for (Iterator iterator = s.iterator(); iterator.hasNext();) {
						String string = (String) iterator.next();
						System.out.println(string +": freq "+categInfo[i].features.get(string));
					}
				}
				/**/
				//double max = Double.NEGATIVE_INFINITY ;
				int categ_id = 1; 
				double max = -(categInfo[1].relevance(doc_id));
				int i;
				for (i = 2 ; i < 6 ; i++){
					double temp = -(categInfo[i].relevance(doc_id));
					if ( temp > max ){
						max = temp ; 
						categ_id = i; 
					}		
				}
				System.out.println("mina id is : "+categ_id);
				category_id = categ_id ;
			}else{
				category_id = 6 ; 
			}
			
		} catch (Exception e) {
			
			e.printStackTrace();
		} 

	}

	public String categorize() {
		if (category_id == 6 )
			return "url was not added";
		else if (category_id == 0 ){
			return "unable to categorize";
		}
		return CategInfo.name[category_id];
		
	}
}
