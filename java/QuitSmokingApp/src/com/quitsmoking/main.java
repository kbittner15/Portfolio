


package com.quitsmoking;

import java.io.File;
import java.util.Date;
import java.util.Scanner;

public class main {
private Scanner Scanner1;
private Scanner Scanner2;
private Scanner Scanner3;


    public static void main(String[] Args) {
        System.out.println("Welcome to the quit smoking app");
        System.out.println("Please open this app every day and record the ammount of times you smoke");
        main checker = new main();
        int check = checker.checkFile();
      if (check == 0) {
           CreateFile g = new CreateFile();
            Date initializeDate = new Date();
            g.openFileInitializedate();
            g.addRecords(initializeDate);
            g.closeFile();
            ReadFile f = new ReadFile();
            Date nowDate = new Date();
            f.openFile();
            f.readFile();
            f.compair(nowDate);

        } else {
            ReadFile f = new ReadFile();
            Date nowDate = new Date();
            f.openFile();
            f.readFile();
            f.compair(nowDate);


        }

    }



    public void start(long days) {
        if (days == 0) {
            main Initialize = new main();
            main checkinitializefile = new main();
            CreateFile g = new CreateFile();
            g.Day1(days);
            g.Day2(days);
            int check = checkinitializefile.checkInitializePuffs();
            if (check == 0) {
                CreateFile initializepuffs = new CreateFile();
                initializepuffs.createInitializepuffs();
                initializepuffs.AddInitializepuffs(0);
                initializepuffs.closeInitializepuffs();
                Initialize.initializepuffs();

            }
            else {
                Initialize.initializepuffs();
            }
// possibly broken
        } else if(days == 1) {
            CreateFile g = new CreateFile();
            puffCounter p = new puffCounter();
            g.Day1(days);
            g.Day2(days);
            p.puffCounter();
        } else if (days > 1){
            CreateFile g = new CreateFile();
            puffCounter p = new puffCounter();
            g.Day2(days);
            p.puffCounter();
        }

    }


    public int checkFile() {

        try {
            Scanner1 = new Scanner(new File("StartDate.txt"));
        } catch (Exception e) {
            return 0;
        }

        return 1;
    }
    public int checkInitializePuffs() {

        try {
            Scanner1 = new Scanner(new File("Initializepuffs.txt"));
        } catch (Exception e) {
            return 0;
        }

        return 1;
    }


    public void initializepuffs() {

            int[] addpuffs = new int[2];
            int i=0;

           try {
                Scanner3 = new Scanner(new File("Initializepuffs.txt"));
           } catch (Exception e) {
                System.out.println("Failure in main");
            }

            do {
               addpuffs[i] = Integer.parseInt(Scanner3.next());
               System.out.println(addpuffs[i]);
               i++;
            } while (Scanner3.hasNext());


            Scanner userin = new Scanner(System.in);
            CreateFile g = new CreateFile();
            int initializepuffsBefore = addpuffs[0];
            int initializepuffsAfter = initializepuffsBefore;
           System.out.println("Enter p when you smoke");
            String input = userin.nextLine();
            if (input.equals("p")) {
               initializepuffsAfter++;
                g.replaceInitialize(initializepuffsBefore, initializepuffsAfter);
                initializepuffs();
           } else {
                initializepuffs();
            }

        }


    }

