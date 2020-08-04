package com.blackjack;

import java.util.Scanner;
import java.sql.*;

public class Main {


    public static void main(String[] args) {
        String userin;
        Scanner input = new Scanner(System.in);
        System.out.println("Welcome to blackjeck statigy");
        System.out.println("enter g to play blackjack, enter s to use the statigy portion of the app");
        userin = input.next();

        if (userin.equals("g")){
         game launchgame = new game();
         launchgame.game();


        }else if(userin.equals("s")){
            Stratigy launchstratigy = new Stratigy();
            launchstratigy.Stratigy();

        }


    }

}
