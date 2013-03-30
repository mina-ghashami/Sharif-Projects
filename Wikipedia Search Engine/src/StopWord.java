import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.OutputStreamWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.PriorityQueue;
import java.util.Set;


public class StopWord {
	
	PriorityQueue<Word> q ;
	Dictionary dictionary ;
	
	StopWord(Dictionary dic){
		this.dictionary = dic ;
		q = new PriorityQueue<Word>(dictionary.terms.size(),new WordComparator());
		
		Set<String> set = dic.terms.keySet();
		
		for (Iterator iterator = set.iterator(); iterator.hasNext();) {
			String item = (String) iterator.next();
			int tf = dic.getTF(item);
			Word w = new Word(item , tf);
			q.add(w);
			
		}
		print();
	}
	
	public void print(){
		
		FileWriter fs;
		try {
			File swFile = new File("stopWords2.txt");
			fs = new FileWriter("stopWords2.txt");
			BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(
					new FileOutputStream(swFile),"UTF8"));
	
			int size = q.size();
			for (int i = 0; i < size ; i++) {
				Word w = q.poll();
				bw.append(w.term+" : "+w.tf+"\n");
			}
			bw.close();
		}
		catch (Exception e) {
			
		}
	}
}
