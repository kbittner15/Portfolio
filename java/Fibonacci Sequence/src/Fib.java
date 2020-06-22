import java.util.*;


public class Fib
{
public static void main (String [] args)
{
	
	Scanner input = new Scanner (System.in);
	
	int a;
	
	System.out.println("enter an ammount of occurrences for the sequence to run");
	a = input.nextInt();
	
	fibonacci(a);
}
	
public static void fibonacci(int a) 
{
	
	int f[] = new int[a+2];
	int b;
	int i = 2;
	
	
	f[0] = 0;
	f[1] = 1;
		
	for(int c=0; c<i; c++ ) {
		System.out.println(f[c]);
	}
	
	for (b=2; b<=a; b++)
	{
		f[b] = f[b-1]+f[b-2];
		System.out.println(f[b]);
		
	}
	
		
}

}

