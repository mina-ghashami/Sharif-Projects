import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.ArrayList;


public class Coordinator {
	
	public static Coordinator coordinator;
	public Dictionary dictionary;
	//public CategoryCatalog classCatalog ;
	public DocumentCatalog documentCatalog ;
	 
	public CategInfo[] categInfo; 
	public int allDocInLearnSample ; 
	public Integer pool[]; 
	
	
	
	public Coordinator() {
		 fillingPool();
		 //classCatalog = new CategoryCatalog();
		allDocInLearnSample = 0 ; 

		 categInfo = new CategInfo[6];
		 for(int i = 1 ; i < 6 ; i++){
			 categInfo [i] = new CategInfo(i);
			 allDocInLearnSample += categInfo[i].numOfDoc; 
		 }
		 
		 dictionary = new Dictionary();
		 documentCatalog = new DocumentCatalog();
		 System.out.println("num of all doc in sample "+allDocInLearnSample);
	}
	
	public void fillingPool(){
		pool = new Integer[1300];
		for (int i = 0; i < 1300; i++) {
			pool[i] = new Integer(i);
			
		}
	}
	public static void main(String[] args) {
		
		coordinator = new Coordinator();

		Frame inst = new Frame();
		inst.setLocationRelativeTo(null);
		inst.setVisible(true);
		
		inst.addWindowListener(new WindowAdapter() {
			public void windowClosing(WindowEvent evt){
				DictionaryFile.saveDictionary(coordinator.dictionary);
				coordinator.documentCatalog.saveURLFile();
				StopWord stopwords;
				if(coordinator.dictionary.terms.keySet().size() != 0)
					 stopwords = new StopWord(coordinator.dictionary);
				System.exit(0);
			}
		});
	}
}
