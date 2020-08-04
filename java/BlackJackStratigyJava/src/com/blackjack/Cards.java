package com.blackjack;


// suspect problems here
public class Cards {
    public String[] colors = new String[2];
    public String [] suits = new String[4];
    public String [] values = new String[15];


    public String[] Colors(){
    colors [0] = "black";
    colors [1] = "red";
    return colors;
    }
    public String[] Suits(){
        suits [0] = "clubs";
        suits [1] = "diamonds";
        suits [2] = "hearts";
        suits [3] = "spades";
        return suits;
    }
    public String[] Value(){
        values[0]="A";
       int startint = 2;
       int b = 1;
        for (int i=1;i<10;i++){
            values[b] = Integer.toString(startint);
            b++;
            startint++;
        }
        values[10] = "J";
        values[11] = "K";
        values[12] = "Q";
        return values;
    }

    public String[][][] cards(String[]colors, String[]suits, String[]values){
        String[][][] cards = new String[2][4][20];
        int t=0;
        for (int i=0; i<13 ; i++){
            cards[0][0][t] = (colors[0] + suits[0] + values[t]);
            t++;
        }


        t=0;
        for (int i=0; i<13 ; i++){
            cards[1][0][t] = (colors[1] + suits[0] + values[t]);
            t++;
        }

        t=0;
        for (int i=0; i<13 ; i++){
            cards[0][1][t] = (colors[0] + suits[1] + values[t]);
            t++;
        }

        t=0;
        for (int i=0; i<13 ; i++){
            cards[1][1][t] = (colors[1] + suits[1] + values[t]);
            t++;
        }
        t=0;
        for (int i=0; i<13 ; i++){
            cards[0][2][t] = (colors[0] + suits[2] + values[t]);
            t++;
        }
        t=0;
        for (int i=0; i<13 ; i++){
            cards[1][2][t] = (colors[1] + suits[2] + values[t]);
            t++;
        }
        t=0;
        for (int i=0; i<13 ; i++){
            cards[0][3][t] = (colors[0] + suits[3] + values[t]);
            t++;
        }
        t=0;
        for (int i=0; i<13 ; i++){
            cards[1][3][t] = (colors[1] + suits[3] + values[t]);
            t++;
        }
return cards;
    }
}
