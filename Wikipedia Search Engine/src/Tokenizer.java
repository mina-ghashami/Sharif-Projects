import java.util.ArrayList;


public class Tokenizer {
	private ArrayList<String> tokens;
	private String content;
	private char[] delimiters = {' ','.',',','؟','?','،','/','\\',':','{','}','#','$','%','@',
			'~','^','&','*','(',')','_','-','=','+',';','|','<','>','\'','"','!','\n','\t','؛',
			'»','«','•','®'};
	
	public Tokenizer(String content) {
		this.content = content;
		tokens = new ArrayList<String>();
	}
	
	public ArrayList<String> tokenize(){
		//System.out.println("content is : "+content);
		
		while(content != ""){
			String s = nextToken();
			tokens.add(s);
		}
		return tokens;
	}
	
	
	// if delimiter is . ,check prior/post characters for number 
	private String nextToken(){
		int i = 0;
		int beginIndex = 0;
		String token = "";
		//content = content.trim();
		
		while(i < content.length() && isDelimiter(content.charAt(i))){
			i++;
		}
		if(i < content.length())
			beginIndex = i;
		
		while(i < content.length() && !isDelimiter(content.charAt(i))){
			i++;
		}
		token = content.substring(beginIndex,i);
		
		if(i < content.length())
			content = content.substring(i+1);
		else
			content = "";
		
		return token.trim();
	}
	
	private boolean isDelimiter(char c){
		for (int i = 0; i < delimiters.length; i++) {
			if(c == delimiters[i])
				return true;
		}
		return false;	
	}
}
