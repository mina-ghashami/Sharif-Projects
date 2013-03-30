


import java.util.Comparator;

public class PhraseComparator implements Comparator<PhraseResult>
{
    @Override
    public int compare(PhraseResult x, PhraseResult y)
    {
        // Assume neither string is null. Real code should
        // probably be more robust
    	
    	if (x.getFrequency() >  y.getFrequency())
    		return -1; 
    	if (x.getFrequency() < y.getFrequency())
    		return 1; 
    	return 0 ; 
    }
}
