import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Set;



public class CategInfo {
	
	public static String [] name = {"رده ها","ادبی و هنری","تاریخی","سیاسی","علمی","ورزشی"};
	int id ; 
	int numOfDoc = 0 ; 
	int numOfTerms = 0 ; 
	int B;
	HashMap<String,Integer> features; 
	
	CategInfo(int id ){
		this.id = id;
		features = new HashMap<String,Integer>();
		load();

	}
	
	public double relevance(int doc_id ){
		
		int allDoc_inSample = Coordinator.coordinator.allDocInLearnSample; 
		double prob_categ = getLog(numOfDoc, allDoc_inSample)  ; // probability of category
		
		double score = 0.0; 
		Set<String> keys = features.keySet();
		
		score = prob_categ; 
		for (Iterator iterator = keys.iterator(); iterator.hasNext();) {
			String term = (String) iterator.next();
			int termFreq_inCateg = features.get(term);
			double d = getLog(termFreq_inCateg +1 , numOfTerms + B);
			d = d*Coordinator.coordinator.dictionary.getTermFrequency(doc_id, term);
			score += d; 
		}
		System.out.println("doc_id is "+doc_id+" & score is "+score);
		return score; 
	}
	
	
	double getLog(int sourat , int makhraj){
		double d = (sourat +0.0 )/(makhraj + 0.0);
		d = Math.log10(d);
		return d; 
	}
	
	public void load (){
		String filename = "category_"+id+".txt";  
		BufferedReader in;
		try {
			in = new BufferedReader(new FileReader(filename));
			
			String s; 
			try {
				s = in.readLine();
				B = Integer.parseInt(s);
				
				s = in.readLine(); 
				numOfDoc = Integer.parseInt(s);
				
				s = in.readLine(); 
				numOfTerms = Integer.parseInt(s);
				
				int counter = 0 ; 
				while( (s = in.readLine()) != null && counter < 20) {
					counter++; 
					String UTF8Str = new String(s.getBytes(),"UTF-8");
					String[] temp = s.split(":");
					
					Integer t  = Integer.parseInt(temp[1]);
					if (t == null ) t = 0; 
					features.put(temp[0], t);
				}
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		System.out.println("feature are now loaded");
		
	}
	

}
