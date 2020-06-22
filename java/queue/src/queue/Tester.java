package queue;

public class Tester {
public static void main(String[] args){
	
	QueueDemo Demo = new QueueDemo();

	Demo.pop();
	Demo.push(23);
	Demo.display();
	Demo.push(2);
	Demo.display();
	Demo.push(73);
	Demo.display();
	Demo.push(21);
	Demo.display();
	Demo.pop();
	Demo.display();
	Demo.pop();
	Demo.display();
	Demo.pop();
	Demo.display();
	
	
	
}
}
