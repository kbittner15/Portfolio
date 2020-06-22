package employee;
public class Employee {

	   //instance variable
	   private String name;
	   private int idnumber;
	   private double salary;

	    //getters
	    public int getidnumber() {
	        return idnumber;
	    }
	    public String getName() {
	        return name;
	    }
	    public double getSalary() {
	        return salary;
	    }

	    public double raise(double salary)
	    {
	        this.salary = salary + (salary * 0.1); 
	        return this.salary;
	    }

	    //constructor
	    public Employee(String name, int idnumber, double salary){

	        this.name = name;
	        this.idnumber = idnumber;
	        this.salary = salary;

	    }

	}

