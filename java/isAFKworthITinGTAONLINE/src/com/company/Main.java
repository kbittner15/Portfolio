package com.company;

public class Main {

    public static void main(String[] args) throws InterruptedException {
        int money_out=0;
        int money_in=0;
     for (int i=0; i<13; i++) {


         Thread.sleep(45);
         money_out = money_out + 25000;
         Thread.sleep(15);
         money_in =money_in + 41570;


     }

     int answer = money_in-money_out+135000;
    System.out.println(answer);
     System.out.println("the answer is no absulutely not");

   }
}
