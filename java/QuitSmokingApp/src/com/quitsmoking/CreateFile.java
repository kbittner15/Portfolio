package com.quitsmoking;
import java.io.*;
import java.lang.*;
import java.util.*;

 public class CreateFile {

    private Formatter StartDate;
    private Formatter Day1;
    private Formatter Day2;
    private Formatter initializepuffs;
     private FileWriter writer = null;


// working
    public void openFileInitializedate(){
        try{
            StartDate = new Formatter ("StartDate.txt");
        }
        catch (Exception e){
            System.out.println("Error creating file");
        }
    }

    //working
    public void addRecords(Date one){
        StartDate.format("%s", one);

    }
//working
    public void closeFile(){
        StartDate.close();
    }


    public void Day1(long daysbetween){
        try{
            Day1 = new Formatter ("Day1.txt");
        }
        catch (Exception e){
            System.out.println("Error creating file");
        }
        Day1.format("%s", Long.toString(daysbetween));
        Day1.close();
    }
    public void Day2(long daysbetween){
        try{
            Day2 = new Formatter ("Day2.txt");
        }
        catch (Exception e){
            System.out.println("Error creating file");
        }
        Day2.format("%s", Long.toString(daysbetween));
        Day2.close();
    }

    public void createInitializepuffs(){
        try{
            initializepuffs = new Formatter ("Initializepuffs.txt");
        }
        catch (Exception e){
            System.out.println("Error creating file");
        }


    }
    public void AddInitializepuffs(int totalsmoke){
        initializepuffs.format("%s",Integer.toString(totalsmoke));

    }
    public void closeInitializepuffs(){

        initializepuffs.close();
    }

    public void replaceInitialize (int before, int after){

        String fileContents = Integer.toString(before);
        fileContents = fileContents.replaceAll(Integer.toString(before), Integer.toString(after));

        try {
            writer = new FileWriter("Initializepuffs.txt");
            writer.append(fileContents);
            writer.flush();
        } catch (IOException e) {
            e.printStackTrace();
        }

    }


}
