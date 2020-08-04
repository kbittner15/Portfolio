#include<iostream>
#include <sstream> 
#include <string>
#include <afxwin.h>
#include <mysql.h>

using namespace std;

//functions used to grab the move needed from the server 
void Pairs(string PlayerCard1, string PlayerCard2, string DealerCard) {
    cout << "Pairs";
    string query = "SELET Move FROM PairCards WHERE PlayerCard1 =" + PlayerCard1 + "AND PlayerCard2 =" + PlayerCard2 + "AND DealerCard=" + DealerCard;
    const char* q = query.c_str();
    qstate = mysql_query(conn, q);
    if (!qstate) {
        res = mysql_store_result(conn);
        while (row = mysql_fetch_row(res)) {
            printf(row[0]);
            if (row[0] == "Hit") {
                string NewTotal;
                cout << "Enter new your total: ";
                cin >> NewTotal;
                HardTotals(NewTotal, DealerCard);
            }
        }
    }

}

void SoftTotals(string PlayerCard1, string PlayerCard2, string DealerCard) {
    cout << "Soft";
    string query = "SELET Move FROM SoftCards WHERE PlayerCard1 =" + PlayerCard1 + "AND PlayerCard2 =" + PlayerCard2 + "AND DealerCard=" + DealerCard;
    const char* q = query.c_str();
    qstate = mysql_query(conn, q);
    if (!qstate) {
        res = mysql_store_result(conn);
        while (row = mysql_fetch_row(res)) {
            printf(row[0]);
            if (row[0] == "Hit") {
                string NewTotal;
                cout << "Enter new your total: ";
                cin >> NewTotal;
                HardTotals(NewTotal, DealerCard);
            }
        }
    }

}

void HardTotals(int PlayerCard, string DealerCard) {
    cout << "Hard";
    string query = "SELET Move FROM HardCards WHERE PlayerTotal =" + PlayerCard + "AND DealerCard=" + DealerCard;
    const char* q = query.c_str();
    qstate = mysql_query(conn, q);
    if (!qstate) {
        res = mysql_store_result(conn);
        while (row = mysql_fetch_row(res)) {
            printf(row[0]);
            if (row[0] == "Hit") {
                string NewTotal;
                cout << "Enter new your total: ";
                cin >> NewTotal;
                HardTotals(NewTotal, DealerCard);
            }
        }
    }

}


// main function
int main() {

    // connect to server
    MYSQL* conn;
    MYSQL_ROW row;
    MYSQL_RES* res;
    conn = mysql_init(0)

        conn = mysql_real_connect(conn, "localhost", "root", "12345678", "Blackjack", 3306, null, 0);

    if (conn) {
        puts("successfull connection");
    }
    else {
        puts("error connecting to database");
    }

    string DealerCard;
    string PlayerCard1;
    string PlayerCard2;
    cout << "Enter Dealers card: ";
    cin >> DealerCard;
    cout << "Enter Your First Card:";
    cin >> PlayerCard1;
    cout << "Enter Your Second Card:";
    cin >> PlayerCard2;

    // set values for kings and queens 
    if (PlayerCard1 == "J" || PlayerCard1 == "Q" || PlayerCard1 == "K" || PlayerCard1 == "j" || PlayerCard1 == "q" || PlayerCard1 == "k") {
        PlayerCard1 = "10";
    }

    if (PlayerCard2 == "J" || PlayerCard2 == "Q" || PlayerCard2 == "K" || PlayerCard2 == "j" || PlayerCard2 == "q" || PlayerCard2 == "k") {
        PlayerCard2 = "10";
    }


    if (DealerCard == "J" || DealerCard == "Q" || DealerCard == "K" || DealerCard == "j" || DealerCard == "q" || DealerCard == "k") {
        DealerCard = "10";
    }



    // select function to be used
    if (PlayerCard1 == PlayerCard2) {
        Pairs(PlayerCard1, PlayerCard2, DealerCard);
    }
    else if (PlayerCard1 == "A" || PlayerCard2 == "A") {
        SoftTotals(PlayerCard1, PlayerCard2, DealerCard);
    }
    else if (PlayerCard1 == "a") {
        PlayerCard1 = "A";
        SoftTotals(PlayerCard1, PlayerCard2, DealerCard);
    }
    else if (PlayerCard2 == "a") {
        PlayerCard2 = "A";
        SoftTotals(PlayerCard1, PlayerCard2, DealerCard);
    }
    else {
        // add both cards to create a total
        int x;
        int y;
        int total;

        stringstream card1(PlayerCard1);
        stringstream card2(PlayerCard2);

        card1 >> x;
        card2 >> y;

        total = x + y;

        HardTotals(total, DealerCard);
        // use hard totals 
    }

    return 0;

}


