import java.util.*;

public class Arrays {

public static void main (String []args) {
	
	int length, Choice1, Choice2;
	
	 
	 
	
	 Scanner Input = new Scanner(System.in);
	 
	 System.out.println("how many integers do you want to enter");
	 length = Input.nextInt();
	 
	 int[] array = new int[length];
	 
	 for(int i = 0; i < length; i++ ) {
		 System.out.println("enter an integer");
		 array[i] = Input.nextInt();
	 }
	 //prints the array as entered
	 System.out.println("Entered array:");
     printArray(array); 
	 System.out.println("Choise a sorting method");
	 System.out.println("Options are:\n1: Bubble Sort\n2: Merge Sort\nor 3: Insertion Sort");
	 Choice1 = Input.nextInt();
	 
	 switch(Choice1) {
	 case 1:
		 if(array.length <= 1) {
			 for(int i = 0; i < length; i++ ) {
				 System.out.println(array[i]);
			 }
		 }
		 Arrays arrayBubbleSort = new Arrays(); 
		 arrayBubbleSort.BubbleSort(array); 
	        System.out.println("Bubble Sort"); 
	        printArray(array); 
	        break;
	 // merge sort
	 case 2:
		 if(array.length <= 1) {
			 for(int i = 0; i < length; i++ ) {
				 System.out.println(array[i]);
			 }
		 }
		 Arrays arrayMergeSort = new Arrays(); 
	        arrayMergeSort.MergeSort(array, 0, array.length-1); 
	        System.out.println("Merge Sort"); 
	        printArray(array); 
	 break;
	 //Insertion Sort       
	 case 3: 
		 if(array.length <= 1) {
			 for(int i = 0; i < length; i++ ) {
				 System.out.println(array[i]);
			 }
		 }
		 Arrays arrayInsterionSort = new Arrays(); 
		 arrayInsterionSort.InsertionSort(array); 
	        System.out.println("Insertion Sort"); 
	        printArray(array); 
		 break;
	 }
	
	 // search array 
	 System.out.println("Choose a Search method\n1: Sequential\n2: Binary");
	 Choice2 = Input.nextInt();
	 
	
	switch(Choice2) {
	 // Linear Search
	 case 1:
		 int Userin;
		 System.out.println("Enter an Integer you want to search for:");
		 Userin=Input.nextInt();
		 int SeqSearch = SequentialSearch(array,Userin);
		 if (SeqSearch == -1) 
	            System.out.println("Number was not found"); 
	        else
	            System.out.println("Number was found at index  " +  
	            		SeqSearch); 
		 break;
	     
	  //Binary Search
	 case 2:
        System.out.println("Enter an Integer you want to search for:");
        Userin=Input.nextInt();
        Arrays BinarySearch = new Arrays();
        int result = BinarySearch.binarySearch(array,0,array.length-1,Userin); 
        if (result == -1) 
            System.out.println("Number was not found"); 
        else
            System.out.println("Number was found at index " +   result); 
	 break;
	 }
}


	
int binarySearch(int array[], int left, int right, int input) 
{ 
    if (right>=left) 
    { 
        int middle = left + (right - left)/2; 

        
        if (array[middle] == input) 
           return middle; 

       
        if (array[middle] > input) 
           return binarySearch(array, left, middle-1, input); 

        
        return binarySearch(array, middle+1, right, input); 
    } 

   
    return -1; 
}

public static int SequentialSearch(int[] array, int input)
{
   for (int j = 0; j < array.length; j++)
   {
      if (array[j] == input)
      {
         return j;
      }
  }
  return -1;
}


void BinarySearch(int array[]) {
	
	
}


void BubbleSort(int array[]) 
{
	boolean sorted = false;
	int temp;
	
	 while(sorted == false) {
		 sorted=true;
	
		 for(int i = 0; i < array.length-1; i++ ) {
	
			 if(array[i] > array[i+1]) {
				 temp = array [i+1];
				 array[i+1] = array [i];
				 array[i]=temp;
				 sorted=false;
	 }
	 }
	 
	 
}
}

void InsertionSort(int array[]) 
{ 
    int n = array.length; 
    for (int i = 1; i < n; ++i) { 
        int key = array[i]; 
        int j = i - 1; 

       
        while (j >= 0 && array[j] > key) { 
            array[j + 1] = array[j]; 
            j = j - 1; 
        } 
        array[j + 1] = key; 
    } 
} 

void MergeSort(int array[], int left, int right) 
{ 
    if (left < right) 
    {  
        int midpoint = (left+right)/2; 

        MergeSort(array, left, midpoint); 
        MergeSort(array , midpoint+1, right); 

        
        merge(array, left, midpoint, right); 
    } 
} 

void merge(int array[], int left, int midpoint, int right) 
{ 
   
    int n1 = midpoint - left + 1; 
    int n2 = right - midpoint; 

    
    int TempL[] = new int [n1]; 
    int TempR[] = new int [n2]; 

    
    for (int i=0; i<n1; ++i) 
        TempL[i] = array[left + i]; 
    for (int j=0; j<n2; ++j) 
        TempR[j] = array[midpoint + 1+ j]; 


    

    
    int i = 0, j = 0; 

   
    int k = left; 
    while (i < n1 && j < n2) 
    { 
        if (TempL[i] <= TempR[j]) 
        { 
            array[k] = TempL[i]; 
            i++; 
        } 
        else
        { 
            array[k] = TempR[j]; 
            j++; 
        } 
        k++; 
    } 

    while (i < n1) 
    { 
        array[k] = TempL[i]; 
        i++; 
        k++; 
    } 

   
    while (j < n2) 
    { 
        array[k] = TempR[j]; 
        j++; 
        k++; 
    } 
} 
static void printArray(int array[]) 
{ 
    int n = array.length; 
    for (int i=0; i<n; ++i) 
        System.out.print(array[i] + " "); 
    System.out.println(); 
} 


}	

	 

