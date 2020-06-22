import java.util.*;

public class TreesMain {	
	
public static void main (String []args) {
	
	Scanner input = new Scanner(System.in);
	
	TreesMain tree = new TreesMain();
	
	int t;
	int search;
	
	System.out.println("Welcome to the binary tree application");
	
	for (t=0; t<8; t++ ) {
	System.out.println("enter 8 digit to add to the tree ");
	t = input.nextInt();
	
		tree.insert(t);
	}

	
	System.out.println("Ordered Tree:");
	tree.inorder();
	
	
}

public class Node {
	 
	int key; 
     Node left, right; 

     public Node(int item) { 
         key = item; 
         left = right = null; 
     } 

}
 
 Node root; 


TreesMain() {  
    root = null;
}

void insert(int key) { 
    root = insertRec(root, key); 
 } 
   
 
 Node insertRec(Node root, int key) { 

     
     if (root == null) { 
         root = new Node(key); 
         return root; 
     } 

     
     if (key < root.key) 
         root.left = insertRec(root.left, key); 
     else if (key > root.key) 
         root.right = insertRec(root.right, key); 

    
     return root; 
 } 
 void inorder()  { 
     inorderRec(root); 
     Scanner i = new Scanner(System.in);
     int search;
     Node temp;
     System.out.println("enter digit to search");
 	 search = i.nextInt();
    temp = search(root,search);
   System.out.println("Your Search was found:");
    System.out.println(temp.key);
     
  } 

  
  void inorderRec(Node root) { 
      if (root != null) { 
          inorderRec(root.left); 
          System.out.println(root.key); 
          inorderRec(root.right); 
      } 
  }
  public Node search(Node root, int key) 
  { 
      
      if (root==null || root.key==key) 
          return root; 
    
     
      if (root.key > key) 
          return search(root.left, key); 
    
    
      return search(root.right, key); 
  } 
 


}
