package com.blackjack;

import java.util.Scanner;
// time to bug test

public class game {



    public static void game() {
        Deck deck = new Deck();
        String[] ShuffledDeck = deck.Deck();
        int playertotal = 0;
        int dealertotal =0;
        int[] Player = new int[52];
        int[] Dealer = new int[52];
        Scanner input = new Scanner(System.in);
        String userin = null;
        String[] DealerCards = new String[52];
        String[] PlayerCards = new String[52];
        String dealertemp = null;
        String playertemp = null;
       int dealerCardcounter=0;
       int playerCardcounter=0;
        int deckcounter = 0;

        System.out.println("welcome to blackjack, rules: dealer must stand on 17\nDoubles are aloud");
       for (int i=0; i<2; i++) {

           DealerCards[dealerCardcounter] = ShuffledDeck[deckcounter];
           dealertemp = DealerCards[dealerCardcounter].replaceAll("([a-z])", "");

           if (dealertemp.equals("K")||dealertemp.equals("Q")||dealertemp.equals("J")){
               dealertemp="10";
           }
          else if (dealertemp.equals("A")){
               dealertemp="11";
           }

           Dealer[dealerCardcounter] = Integer.parseInt(dealertemp);
           dealerCardcounter++;
           deckcounter++;


           PlayerCards[playerCardcounter] = ShuffledDeck[deckcounter];
           playertemp = PlayerCards[playerCardcounter].replaceAll("([a-z])", "");
           if (playertemp.equals("K")||playertemp.equals("Q")||playertemp.equals("J")){
               playertemp="10";
           }

          else if(playertemp.equals("A")){
               playertemp="11";
           }
           Player[playerCardcounter] = Integer.parseInt(playertemp);
           playerCardcounter++;
           deckcounter++;
       }
       System.out.println("Your Cards:" + PlayerCards[0]+" "+PlayerCards[1]);
       if (Player[0] == 11 && Player[1] == 11){
         playertotal = 12;
       }else {
           playertotal = Player[0] + Player[1];
       }
       System.out.println("your total:" + playertotal);
        System.out.println("Dealer Card:" + DealerCards[0]);
        System.out.println("Dealer total:" +Dealer[0]);



        do{
           System.out.println("Select your move, H for hit, S for stand");
           userin = input.next();

           userin = userin.toUpperCase();

           if(userin.equals("H") || userin.equals("h")){
               PlayerCards[playerCardcounter] = ShuffledDeck[deckcounter];
               playertemp = PlayerCards[playerCardcounter].replaceAll("([a-z])", "");
               if (playertemp.equals("K")||playertemp.equals("Q")||playertemp.equals("J")){
                   playertemp="10";
               }

               else if(playertemp.equals("A") && playertotal>=11){
                   playertemp="1";
               }
               else if(playertemp.equals("A") && playertotal<11){
                   playertemp="11";
               }

               Player[playerCardcounter] = Integer.parseInt(playertemp);
               playertotal = playertotal+Player[playerCardcounter];
               System.out.println("Your new total:" +playertotal);
               playerCardcounter++;
               deckcounter++;
           }


       }while(!userin.equals("S") && playertotal < 22);


            if (Dealer[0] == 11 && Dealer[1] == 11){
                dealertotal = 12;
            }else {
                dealertotal = Dealer[0]+Dealer[1];
            }


            System.out.println("dealertotal:"+dealertotal);

            while(dealertotal < 17 && dealertotal < 21){
                DealerCards[dealerCardcounter] = ShuffledDeck[deckcounter];
                dealertemp = DealerCards[dealerCardcounter].replaceAll("([a-z])", "");
                if (dealertemp.equals("K")||dealertemp.equals("Q")||dealertemp.equals("J")){
                    dealertemp="10";
                }

                else if(dealertemp.equals("A") && dealertotal>=11){
                    dealertemp="1";
                }
                else if(dealertemp.equals("A") && dealertotal<11){
                    dealertemp="11";
                }

                Dealer[dealerCardcounter] = Integer.parseInt(dealertemp);
                dealertotal = dealertotal+Dealer[dealerCardcounter];
                System.out.println("Dealer total:" +dealertotal);
                dealerCardcounter++;
                deckcounter++;

            }

    /*   deckcounter=0;
        int dealer = 0;
        int player = 0;

        for(int i = 0; i < Dealer.length; i++){
            dealer = dealer + Dealer[dealerCardcounter];
            dealerCardcounter++;

        }
        deckcounter =0;
        for(int P: Player){
            player = player + Player[playerCardcounter];
            playerCardcounter++;
        }
*/
        if (playertotal > 21){
            System.out.println("Dealer wins, player busted");
        }
        else if(dealertotal > 21){
            System.out.println("Player wins, the dealer busted");
        }
        else if(dealertotal>playertotal){
            System.out.println("Dealer wins");
        }else if(playertotal>dealertotal){
            System.out.println("Player wins");
        }


    }

}