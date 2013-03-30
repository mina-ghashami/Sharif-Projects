
// StringLengthComparator.java
import java.util.Comparator;

public class DocumentComparator implements Comparator<MyDocument>
{
    @Override
    public int compare(MyDocument x, MyDocument y)
    {
        // Assume neither string is null. Real code should
        // probably be more robust
    	
    	if (x.getScore() >  y.getScore())
    		return -1; 
    	if (x.getScore() < y.getScore())
    		return 1; 
    	return 0 ; 
    }
}
