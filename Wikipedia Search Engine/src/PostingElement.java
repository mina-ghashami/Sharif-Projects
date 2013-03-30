import java.util.ArrayList;


public class PostingElement {
	private int document_id;
	private ArrayList<Integer> positions;
	
	public PostingElement(int id) {
		document_id = id;
		positions = new ArrayList<Integer>();

	}
	public void addPosition(int position){
//		if (position <1300){
//			positions.add(Coordinator.coordinator.pool[position]);
//		}else {
//			positions.add(position);
//		}
		positions.add(position);
		
	}
	public int getDocument_id() {
		return document_id;
	}
	public ArrayList<Integer> getPosition(){
		return positions;
	}
	public int getNumOfPosition(){
		return positions.size();
	}
	
}
