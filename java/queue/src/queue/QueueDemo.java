package queue;

import java.util.NoSuchElementException;

public class QueueDemo implements  Cloneable{
	
	   private Object[ ] data;
	   private int manyItems; 
	   private int front;
	   private int rear;
	   private int size;
	 
	   public QueueDemo( )
	   {
		   final int INITIAL_CAPACITY = 10; 
		  size = 3;
	      manyItems = 0;
	      data = new Object[INITIAL_CAPACITY];
	     front = -1;
	     rear = -1;
	   }

	   
	  
	   public QueueDemo(int INITIAL_CAPACITY)
	   {
	      if (INITIAL_CAPACITY < 0)
	         throw new IllegalArgumentException
	         ("initialCapacity is negative: " + INITIAL_CAPACITY);
	      manyItems = 0;
	      data = new Object[INITIAL_CAPACITY];

	   }

	  
	


	  
	   public int getCapacity( )   
	   {
	      return data.length;
	   }

	 
	  
	
	public void pop( )
	   {
	    
	   
	    	try{
	      if (manyItems == 0)
	    	  throw new NoSuchElementException("Underflow Exception");
	    	 
		      front = nextIndex(front);
		      manyItems--;
	    	}catch (NoSuchElementException e){
	    		System.err.println(e.getLocalizedMessage());
	    	}
	     }
	      
	    		
	   
	   
	   
	   
	   public void push(Object item)
	   {
		   if (rear == -1) 
	        {
	            front = 0;
	            rear = 0;
	            data[rear] = item;
	        }
	        else if (rear + 1 >= size){
	            System.out.println("Overflow!!, item popped");
	            front = nextIndex(front);
	  	      manyItems--;
	  	    data[++rear] = item;    
	        manyItems++ ;
	        }
	        else if ( rear + 1 < size)
	            data[++rear] = item;    
	        manyItems++ ;    
	   }
	              

	 
	   public boolean isEmpty( )
	   {
	      return (manyItems == 0);
	   }


	   private int nextIndex(int i)
	   
	   {
	      if (++i == data.length)
	         return 0;
	      else
	         return i;
	   }

	       
	
	
	   public int size( )   
	   {
	      return manyItems;
	   }

	 
	   public void trimToSize( )
	   {
	      Object trimmedArray[ ];
	      int n1, n2;
	      
	      if (data.length == manyItems)
	        
	         return;
	      else if (manyItems == 0)
	         
	         data = new Object[0];
	      else if (front <= rear)
	      {  
	         trimmedArray = new Object[manyItems];
	         System.arraycopy(data, front, trimmedArray, front, manyItems);
	         data = trimmedArray;
	      }
	      else
	      {  
	         trimmedArray = new Object[manyItems];
	         n1 = data.length - front;
	         n2 = rear + 1;
	         System.arraycopy(data, front, trimmedArray, 0, n1);
	         System.arraycopy(data, 0, trimmedArray, n1, n2);
	         front = 0;
	         rear = manyItems-1;  
	         data = trimmedArray;
	      }
	   }
	   public void display()
	    {
	        System.out.print("\nQueue = ");
	        if (manyItems < 1)
	        {
	            System.out.print("Empty\n");
	            return ;
	        }
	        for (int i = front; i <= rear; i++)
	            System.out.print(data[i]+" ");
	        System.out.println();        
	    }
	
	   }
	   
	