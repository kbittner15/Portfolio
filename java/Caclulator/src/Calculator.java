import java.util.Scanner;

public class Calculator {
 
	public static void main(String args[]) {
	
	String End = null;
	Scanner Input = new Scanner (System.in);
	double Fnum, Snum;
	String Choice;
	
	System.out.println("Welcome to the calculator Type stop to end the program");
	while(End != "stop") {
	System.out.println("Please enter an operator +,-,/,or * \nType stop to exit the program");
	Choice = Input.next();
	

	
	
	
	switch(Choice) {
	case "+" :
	System.out.println("Please enter the first integer, Enter stop to exit the program");
	Fnum = Input.nextDouble();
	System.out.println("Please enter a second integer");
	Snum = Input.nextDouble();	
	
	Fnum += Snum;
	System.out.println("The Answers is:");
	System.out.println(Fnum);
	break;
	
	case "-" :
	System.out.println("Please enter the first integer");
	Fnum = Input.nextDouble();
	System.out.println("Please enter a second integer");
	Snum = Input.nextDouble();
	
	Fnum -= Snum;
	System.out.printf("The Answers is:");
	System.out.println(Fnum);
		break;
		
	case "*" :
	System.out.println("Please enter the first integer");
	Fnum = Input.nextDouble();
	System.out.println("Please enter a second integer");
	Snum = Input.nextDouble();
		
	Fnum *= Snum;
	System.out.printf("The Answers is:");
	System.out.println(Fnum);
		break;
		
	case "/" :
	System.out.println("Please enter the first integer");
	Fnum = Input.nextDouble();
	System.out.println("Please enter a second integer");
	Snum = Input.nextDouble();
		
	Fnum /= Snum;
	System.out.printf("The Answers is:");
	System.out.println(Fnum);
		break;
		
	case "stop":
		System.exit(0);
	}
	
	}
	
	
 }
}
