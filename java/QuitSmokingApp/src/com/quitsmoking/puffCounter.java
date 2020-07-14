



// prints new in initializepuffs2 then sits there
package com.quitsmoking;

import java.io.File;
import java.io.FileWriter;
import java.util.Formatter;
import java.util.Scanner;

public class puffCounter {
    private Formatter x;
    private Scanner day1;
    private Scanner day2;
    private Scanner initializepuffs;
    private Scanner initializepuffs2;
    private Scanner initializepuffs3;
    public int Day1[] = new int[2];
    public int Day2[] = new int[2];
    public int InitializePuffs[] = new int[2];
    public int InitializePuffs3[] = new int[2];
    public String stringarray[] = new String[2];
    private  FileWriter writer;




   public void IsEqual(int[] Day1, int[] Day2, int[] InitializePuffs) {

       try {
           initializepuffs2 = new Scanner(new File("Initializepuffs2.txt"));
       } catch (Exception e) {


           int puffs2 = InitializePuffs[0];

           try {
               x = new Formatter("Initializepuffs2.txt");
           } catch (Exception t) {
               System.out.println("Error creating file");
           }
           x.format("%s", Integer.toString(puffs2));
           x.close();

       }
       try {
           initializepuffs2 = new Scanner(new File("Initializepuffs2.txt"));
       } catch (Exception s) {
           System.out.println("Error Reading File");
       }

       int i = 0;
       do {
           stringarray[i] = initializepuffs2.next();
           i++;
       } while (initializepuffs2.hasNext());


       if (stringarray[0].equals("new")) {

           int puffs2 = InitializePuffs[0];

           try {
               x = new Formatter("Initializepuffs2.txt");
           } catch (Exception t) {
               System.out.println("Error creating file");
           }
           x.format("%s", Integer.toString(puffs2));
           x.close();
           try {
               initializepuffs2 = new Scanner(new File("Initializepuffs2.txt"));
           } catch (Exception s) {
               System.out.println("Error Reading File");
           }
          IsEqual(Day1, Day2,InitializePuffs);

       }else {
           Scanner input = new Scanner(System.in);
           int intCounter = Integer.parseInt(stringarray[0]);
           int op = 1;
           System.out.println(intCounter);
           for (int q = 0; q < InitializePuffs[0]; q++) {
               System.out.println("enter p when you smoke");
               String userinput = input.next();
               if (userinput.equals("p")) {


                   int Counted = intCounter - op;
                   System.out.println(Counted);
                   op++;

                   try {

                       String oldContent = Integer.toString(intCounter);
                       String fileContents = oldContent;
                       fileContents = fileContents.replaceAll(oldContent, Integer.toString(Counted));

                       writer = new FileWriter("InitializePuffs2.txt");
                       writer.append(fileContents);
                       writer.flush();

                   } catch (Exception e) {
                       System.out.println("error");
                   }
                    if(intCounter == 0){
                        System.out.println("Your Done Smoking for the day, please wait until tomorrow!");
                    }
               }

           }


       }
   }
   public void isGreaterthen(int[] Day1, int[] Day2, int[] InitializePuffs) {

       int subtractOriginal = InitializePuffs[0];
       int subtracted = subtractOriginal - 2;

       if (subtracted <= 0) {
           System.out.println("I hope this app helped you quite smoking");
           System.out.println("Thank your for trying it out");
           File a= new File("StartDate.txt");
           File b= new File("Day1.txt");
           File c= new File("Day2.txt");
           File d= new File("Initializepuffs.txt");
           File e= new File("InitializePuffs2.txt");
           a.delete();
           b.delete();
           c.delete();
           d.delete();
           e.delete();

       } else {

           try {

               String oldContent = Integer.toString(subtractOriginal);
               String newContent = Integer.toString(subtracted);
               String fileContents = oldContent;
               fileContents = fileContents.replaceAll(oldContent, newContent);


               writer = new FileWriter("Initializepuffs.txt");
               writer.append(fileContents);
               writer.flush();

           } catch (Exception e) {
               System.out.println("error");
           }


           try {

               String oldContent = Integer.toString(Day1[0]);
               String fileContents = oldContent;
               fileContents = fileContents.replaceAll(oldContent, Integer.toString(Day2[0]));

               writer = new FileWriter("Day1.txt");
               writer.append(fileContents);
               writer.flush();

           } catch (Exception e) {
               System.out.println("error");
           }
           try {
               x = new Formatter("Initializepuffs2.txt");
           } catch (Exception t) {
               System.out.println("Error creating file");
           }
           x.format("%s", "new");
           x.close();

           try {
               initializepuffs3 = new Scanner(new File("Initializepuffs.txt"));
           } catch (Exception e) {
               System.out.println("error in is greater then");
           }
           int i = 0;
           do {
               InitializePuffs3[i] = Integer.parseInt(initializepuffs3.next());
               i++;
           } while (initializepuffs3.hasNext());

           puffCounter sendtoIsEqual = new puffCounter();
           sendtoIsEqual.IsEqual(Day1, Day2, InitializePuffs3);


       }

   }
           public void puffCounter() {

       // turn documents to arrays
        try {
            day1 = new Scanner(new File("Day1.txt"));
        } catch (Exception e) {
            System.out.println("Error Reading File");
        }
        try {
            day2 = new Scanner(new File("Day2.txt"));
        } catch (Exception e) {
            System.out.println("Error Reading File");
        }
        try {
            initializepuffs = new Scanner(new File("Initializepuffs.txt"));
        } catch (Exception e) {
            System.out.println("Error Reading File");
        }

        int i=0;
        do{
            Day1[i] = Integer.parseInt(day1.next());
            i++;
        }while (day1.hasNext());

        i=0;
        do{
            Day2[i] = Integer.parseInt(day2.next());
            i++;
        }while (day2.hasNext());

        i=0;
        do{
            InitializePuffs[i] = Integer.parseInt(initializepuffs.next());
            i++;
        }while (initializepuffs.hasNext());




        // if days are the same
       if (Day1[0] == Day2[0]){
           IsEqual(Day1, Day2, InitializePuffs);
        }
        // if yesterday is less then today
        else if (Day1[0] < Day2[0]) {
            isGreaterthen(Day1, Day2, InitializePuffs);
        }

   }

}