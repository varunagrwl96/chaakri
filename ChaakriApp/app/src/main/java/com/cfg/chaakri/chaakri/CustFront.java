package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class CustFront extends AppCompatActivity {

    Button b1,b2,b3;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cust_front);


        b1 = (Button) findViewById(R.id.buttonaddcust);
        b2 = (Button) findViewById(R.id.buttontechsup);
        b3 = (Button) findViewById(R.id.buttonhistory);

        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(CustFront.this,CustomerOrder.class);
                startActivity(i);
            }
        });

        b2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(CustFront.this,TechWeb.class);
                startActivity(i);
            }
        });

        b3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(CustFront.this,PastOrders.class);
                startActivity(i);
            }
        });


    }
}
