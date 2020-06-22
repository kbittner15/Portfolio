package searchengine;

import java.util.Arrays;

public class Website {
    static int id = Engine.websites.size();
    private String url;
    private String description;
    private String[] keyword;
    

    Website(String Url, String Description, String[] Keyword) {
    	this.url = Url;
        this.description = Description;
        this.keyword = Keyword;
        id++;
    }

    String getUrl() {
        return url;
    }

    String getDescription() {
        return description;
    }

   
    
    public int search(String input)
    {
    	
    	for (int i = 0; i < keyword.length; i++)
    	    keyword[i] = keyword[i].trim();
    	
    	if(Arrays.asList(keyword).contains(input)){
    		return 1;
    }
		return 0;
        
    }
    
  String getKeyword() {
      
    	return Arrays.toString(keyword);
    }
    
    @Override
    public String toString() {
        return "\n\nURL: " + getUrl() + "\nDescription: " + getDescription();
               
    }
    }

