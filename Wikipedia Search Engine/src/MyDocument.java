
public class MyDocument {
   
    private int id;
    private double score;
    public MyDocument(int id , double score) {
        this.score = score;
        this.id = id;
    }
   
    public int getId() {
        return id;
    }
    public double getScore() {
        return score;
    }	
}