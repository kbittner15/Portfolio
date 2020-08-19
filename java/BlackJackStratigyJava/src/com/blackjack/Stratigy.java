package com.blackjack;

import java.sql.*;
import java.util.Scanner;

public class Stratigy {
    public static Statement stmt = null;
    public static Connection con = null;

    public static void Stratigy(){

        String url = "jdbc:mysql://localhost:3306/Blackjack?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";
        String username = "root";
        String password = "12345678";



        try{
            con = DriverManager.getConnection(url, username, password);
            System.out.println("connected to server");
        }catch(Exception e){
            System.out.println("error connecting to server");
            System.err.println("SQL exception: " + e.getMessage());
        }




        Scanner input = new Scanner (System.in);
        String DealerCard;
        String PlayerCard1;
        String PlayerCard2;

        System.out.println("Enter the dealer's card: ");
        DealerCard = input.next();
        System.out.println("Enter your first card: ");
        PlayerCard1 = input.next();
        System.out.println("Enter your second card: ");
        PlayerCard2 = input.next();


        if(DealerCard.equals("a")){
            DealerCard = DealerCard.toUpperCase();
        }
        if(PlayerCard1.equals("a")){
            PlayerCard1 = PlayerCard1.toUpperCase();
        }
        if(PlayerCard2.equals("a")){
            PlayerCard2 = PlayerCard2.toUpperCase();
        }

// set values for kings and queens
        if (PlayerCard1.equals("J") || PlayerCard1.equals("Q") || PlayerCard1.equals("K") || PlayerCard1.equals("j") || PlayerCard1.equals("q") || PlayerCard1.equals("k")) {
            PlayerCard1 = "10";
        }

        if (PlayerCard2.equals("J") || PlayerCard2.equals("Q") || PlayerCard2.equals("K") || PlayerCard2.equals("j") || PlayerCard2.equals("q") || PlayerCard2.equals("k")) {
            PlayerCard2 = "10";
        }


        if (DealerCard.equals("J") || DealerCard.equals("Q") || DealerCard.equals("K") || DealerCard.equals("j") || DealerCard.equals("q") || DealerCard.equals("k")) {
            DealerCard = "10";
        }


// select function to be used
        if (PlayerCard1.equals(PlayerCard2)) {
            Pairs(PlayerCard1, PlayerCard2, DealerCard);
        }else if (PlayerCard1.equals("A") || PlayerCard2.equals("A")) {
            SoftTotals(PlayerCard1, PlayerCard2, DealerCard);
        }else if(PlayerCard1.equals("a")){
            PlayerCard1 = "A";
            SoftTotals(PlayerCard1, PlayerCard2, DealerCard);
        }else if(PlayerCard2.equals("a")){
            PlayerCard2 = "A";
            SoftTotals(PlayerCard1,PlayerCard2,DealerCard);
        }
        else {
            // add both cards to create a total
            int x;
            int y;
            int total;

            x = Integer.parseInt(PlayerCard1);
            y = Integer.parseInt(PlayerCard2);

            total = x + y;

            HardTotals(total, DealerCard);
// use hard totals
        }




    }
    //functions used to grab the move needed from the server
    static void Pairs( String PlayerCard1, String PlayerCard2, String DealerCard) {
        Scanner input = new Scanner (System.in);
        try {
            stmt = con.createStatement();
            String sqlStatment = "SELECT Move FROM PairCards WHERE PlayerCard1 = "+PlayerCard1+" AND PlayerCard2 = "+PlayerCard2+" AND DealerCard = "+DealerCard;
            ResultSet rs = stmt.executeQuery(sqlStatment);
            while(rs.next()) {
                String Move = rs.getString("Move");
                System.out.println("Move: " + Move);

                if (Move.equals("Stand")) {

                } else {
                    System.out.println("enter new total");
                    int newTotal = input.nextInt();
                    if (newTotal < 7) {
                        System.out.println("Move: Hit\nenter new total");
                        int secondnewtotal = input.nextInt();
                        HardTotals(secondnewtotal, DealerCard);

                    } else {
                        HardTotals(newTotal, DealerCard);
                    }
                }
            }


        }
        catch (Exception e){
            System.err.println("Error:  " + e.getMessage());

        }

    }

    static void SoftTotals(String PlayerCard1, String PlayerCard2, String DealerCard) {
        Scanner input = new Scanner (System.in);
        try {
            stmt = con.createStatement();
            String sqlStatment = "SELECT Move FROM SoftCards WHERE PlayerCard1 = "+PlayerCard1+" AND PlayerCard2 = "+PlayerCard2+" AND DealerCard = "+DealerCard;
            ResultSet rs = stmt.executeQuery(sqlStatment);
            while(rs.next()) {
                String Move = rs.getString("Move");
                System.out.println("Move: " + Move);

                if (Move.equals("Stand")) {

                } else {
                    System.out.println("enter new total");
                    int newTotal = input.nextInt();
                    if (newTotal < 7) {
                        System.out.println("Move: Hit\nenter new total");
                        int secondnewtotal = input.nextInt();
                        HardTotals(secondnewtotal, DealerCard);

                    } else {
                        HardTotals(newTotal, DealerCard);
                    }
                }
            }


        }
        catch (Exception e){
            System.err.println("Error:  " + e.getMessage());

        }
    }

    static void HardTotals(int PlayerTotal, String DealerCard) {
        Scanner input = new Scanner (System.in);

        try {
            stmt = con.createStatement();
            String sqlStatment = "SELECT Move FROM HardCards WHERE PlayerTotal = "+PlayerTotal+" AND DealerCard = "+DealerCard;
            ResultSet rs = stmt.executeQuery(sqlStatment);
            while(rs.next()) {
                String Move = rs.getString("Move");
                System.out.println("Move: " + Move);

                if (Move.equals("Stand")) {

                } else {
                    System.out.println("enter new total");
                    int newTotal = input.nextInt();
                    if (newTotal < 7) {
                        System.out.println("Move: Hit\nenter new total");
                        int secondnewtotal = input.nextInt();
                        HardTotals(secondnewtotal, DealerCard);

                    } else {
                        HardTotals(newTotal, DealerCard);
                    }
                }
            }


        }
        catch (Exception e){
            System.err.println("Error:  " + e.getMessage());

        }
    }
}
