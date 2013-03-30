
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.Iterator;
import java.util.PriorityQueue;
import java.util.Set;


public class Category {
	
	int id;
	String name;
	//ArrayList<String> features;
	Set <Integer> doc_ids;
	PriorityQueue<Feature> features; 
	int numOfTerms = 0 ;
	int B ;
	
	
	Category(int id , String name){
		this.name = name;
		this.id = id;
		this.B = 0;
		//features = new ArrayList<String>();
		//int numOfTerms = LearnCoordinator.learncoordinator.terms.size();
		features = new PriorityQueue<Feature>(1000,new FeatureComparator());
		doc_ids = new HashSet<Integer>();
	}
	public void refreshFeatures(){
		features = null; 
		features = new PriorityQueue<Feature>(1000,new FeatureComparator());
	}
	public void addDocument(int doc_id){
		doc_ids.add(doc_id);
	}
	public int getNumOfDoc(){
		return doc_ids.size();
	}
	public void addFeature(String term){
		double d = calcScore(term);
		
		Feature f = new Feature(term , d);
		features.add(f);
		//System.out.println(f);
		
	}
	public double calcScore (String term){
		LearnCoordinator lc = LearnCoordinator.learncoordinator;
		
		int N = lc.categoryCatalog.getNumOfAllDoc();
		int numOfDocument = lc.URLS.size();
		
		if (numOfDocument != N) System.out.println("inconsistancy in num of docs");
		
		double score = 0.0 ;
		int N00 = lc.notCateg_notTerm(term, this.id);
		int N01 = lc.hasCateg_notTerm(term, this.id);
		
		int N10 = lc.notCateg_hasTerm(term, this.id);
		int N11 = lc.hasCateg_hasTerm(term, this.id);
		
		int N_dot_1 = N01+N11;
		int N_dot_0 = N00+N10;
		
		int N_1_dot = N10+N11; 
		int N_0_dot = N00+N01; 
		
		/**
		System.out.println("N is "+N);
		System.out.println("N_0_dot "+N_0_dot);
		System.out.println("N_1_dot "+N_1_dot);
		System.out.println("N_dot_0 "+N_dot_0);
		System.out.println("N_dot_1 "+N_dot_1);
		/**/
		double E00 = (N00/(N+0.0))*getLog(N, N00, N_0_dot, N_dot_0); 
		double E10 = (N10/(N+0.0))*getLog(N, N10, N_1_dot, N_dot_0);
		double E01 = (N01/(N+0.0))*getLog(N, N01, N_0_dot, N_dot_1); 
		double E11 = (N11/(N+0.0))*getLog(N, N11, N_1_dot, N_dot_1); 
		/**
		System.out.println("N00 : "+N00 +" N10 : "+N10+" N01 : "+N01+" N11 : "+N11 );
		System.out.println("E00 : "+E00 +" E10 : "+E10+" E01 : "+E01+" E11 : "+E11 );
		/**/
		score = E00 + E01 + E10 + E11; 
		return score;
	}
	public static double getLog(int n , int nnn , int nnd , int ndn ){
		
		double sourat = n * nnn * 1.0 ; 
		double makhraj = nnd * ndn * 1.0;
		if (sourat == makhraj || sourat == 0 ){
			//System.err.println("getLog is zero.");
			return 0.0 ; 
		}
		if(makhraj == 0 ){
		//	System.err.println("makhraj is zero.");
			return 0.0 ; 
		}
		double d = Math.log(sourat/makhraj);
		//System.err.println("getLog result  " + d);
		return d;
		
	}
	
	public static void main(String[] args) {
		double d = getLog(71,62,66,66);
		System.out.println(d);
	}
	public void saveFeatures(){
		String filename = "category_"+id+".txt";
		File f = new File(filename);
		try {
			f.createNewFile();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		 
	    BufferedWriter out;
		try {
			out = new BufferedWriter(new OutputStreamWriter (new FileOutputStream(f),"UTF8"));
			out.append(this.B+"\n");
			out.append(this.doc_ids.size()+"\n");
			out.append(""+this.numOfTerms+"\n");
			
			String s =""; 
			int min = features.size();
			//min = 20; 
			min = Math.min(min, 60);
			System.out.println("size is "+min);
			for(int i = 0 ; i < min ; i++ ){
				Feature fe = features.poll();
				Feature next_fe = features.peek();
				
				if (fe.score < next_fe.score){
					System.out.println("some thing wrong");
				}
					
				LearnCoordinator lc = LearnCoordinator.learncoordinator;
				CategoryElement [] ce = lc.terms.get(fe.term);
				int termFreq_InCateg = 0 ; 
				if (ce != null){
					termFreq_InCateg = ce[id].term_freq; 
				}
				//s = s + fe.term + ":"+ fe.score+":"+termFreq_InCateg+"\n" ;  
				s = s + fe.term + ":"+termFreq_InCateg+"\n";
			}
			out.write(s);
			out.close();
		
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	 
	}
	public void makeFeatures(Set<String> termsSet) {
		for (Iterator iterator = termsSet.iterator(); iterator.hasNext();) {
			String term = (String) iterator.next();
			//System.out.println("term is added to feature " +term);
			addFeature(term);
		}

	}

		
	
}
