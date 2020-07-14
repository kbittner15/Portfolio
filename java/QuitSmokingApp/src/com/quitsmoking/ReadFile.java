package com.quitsmoking;

import java.io.*;
import java.util.*;

public class ReadFile {

private Scanner x;
public String array[] = new String [7];
public int i = 0;

//working
public void openFile(){

    try{
        x= new Scanner(new File("StartDate.txt"));
    }
    catch(Exception e){
        System.out.println("Error Reading File");
    }
}
//working
public void readFile(){
    do{
        array[i] = x.next();;
        i++;
    }while (x.hasNext());


}

public void closeFile(){
    x.close();
}

public void compair(Date nowDate){



    String timeArray[] = new String[3];

    int Month = 0;
    int Year =Integer.parseInt(array[5]);
    int Day = Integer.parseInt(array[2]);

    String time = (array[3]);
     timeArray = time.split(":");
        int Hour = Integer.parseInt(timeArray[0]);
        int Minute = Integer.parseInt(timeArray[1]);
        int Second = Integer.parseInt(timeArray[2]);



    String stringMonth = array[1];

    if(stringMonth.equals("Jan")) {
        Month = 0;
    }else if(stringMonth.equals("Feb")) {
        Month = 1;
    }else if(stringMonth.equals("Mar")) {
        Month = 2;
    }else if(stringMonth.equals("Apr")) {
        Month = 3;
    }else if(stringMonth.equals("May")) {
        Month = 4;
    }else if(stringMonth.equals("Jun")){
        Month = 5;
    }else if(stringMonth.equals("July")) {
        Month = 6;
    }else if(stringMonth.equals("Aug")) {
        Month = 7;
    }else if(stringMonth.equals("Sep")) {
        Month = 8;
    }else if(stringMonth.equals("Oct")) {
        Month = 9;
    }else if(stringMonth.equals("Nov")) {
        Month = 10;
    }else if(stringMonth.equals("Dec")){
        Month = 11;

    } else{
        System.out.println("error");
    }



    Calendar myNextCalendar = Calendar.getInstance();
    myNextCalendar.set(Year,Month,Day, Hour,Minute,Second);

    Date initializeDate = myNextCalendar.getTime();
    ReadFile object = new ReadFile();




    long days = object.checkDay(initializeDate,nowDate);
    main f = new main();

    x.close();
    f.start(days);



}
    public long checkDay(Date one, Date two){

        long difference = (one.getTime()-two.getTime())/86400000;
        return Math.abs(difference);


    }
}
