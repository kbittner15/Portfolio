package searchengine;
import searchengine.Website;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Engine {

    private static Scanner in = new Scanner(System.in);
   
    static List<Website> websites = new ArrayList<>();

    public static void main(String[] args) throws IOException {
        readFromFile();
        showMainMenu();
    }

    private static void findWebsite() throws IOException {
      
                    findBykey();
                 
    }

  

    private static void findBykey() {
        System.out.print("Search for a Website: ");
        String user = in.nextLine();
        int matches = 0;
        for(Website website : websites) {       
            if(website.search(user)>0) {
                System.out.println(website);
                matches++;
            }
        }
        if(matches<=0) {
            System.out.println("There is no website with this name ");
            for(Website website : websites) { 
            	System.out.println(website);
            }
        }
    }

   

   

    private static boolean readFromFile() throws IOException {
        try(BufferedReader input = new BufferedReader(new FileReader("/Users/kylebittner/Desktop/websites.txt"))) {
        	 String webSiteURL = null;
			 String webSiteDescription = null;
			 String[] webSiteKeywords = new String[20];
			 String str;
			 
			 while ((str = input.readLine()) != null) {
				 String[] tokens=str.split(",");
				 if (tokens.length>2)
				    {
				    webSiteURL = tokens[0];
				    webSiteDescription = tokens[1];
				    for (int i=2;i<tokens.length; i++)
				    	webSiteKeywords[i] = tokens[i];
				    }
                Website website = new Website(webSiteURL, webSiteDescription,tokens);
                websites.add(website);       
                input.readLine();                                 
            }
            return true;
        }
        catch ( IOException e) {
            System.out.println(e);
        }
        return false;
    }

    private static void showMainMenu() throws IOException {
      
       
                    findWebsite();
                   
    }
}