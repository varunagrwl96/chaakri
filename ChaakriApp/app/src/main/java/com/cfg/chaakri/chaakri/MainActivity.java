package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {
Button customerloginbutton,sakhiloginbutton;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        customerloginbutton=(Button)findViewById(R.id.customerloginbutton);
        sakhiloginbutton=(Button)findViewById(R.id.sakhiloginbutton);

      /*  SharedPreferences prefs = getSharedPreferences("LoginPref", MODE_PRIVATE);
         String restoredText = prefs.getString("text", null);
        if (restoredText != null) {
            String userlvl = prefs.getString("Userlevel","0"); //0 is the default value.
            if (userlvl == "1") {
                Toast.makeText(getApplicationContext(),"Sakhi logged in!",Toast.LENGTH_SHORT).show();
                Intent i = new Intent(MainActivity.this, NavActivitySakhi.class);
                startActivity(i);
            } else if (userlvl == "2") {
                Toast.makeText(getApplicationContext(),"Customer logged in!",Toast.LENGTH_SHORT).show();
                Intent i = new Intent(MainActivity.this, CustomerOrder.class);
                startActivity(i);
            }
        } */

        customerloginbutton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MainActivity.this,CustomerFirst.class);
                startActivity(intent);

            }
        });
        sakhiloginbutton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(getApplicationContext(),SakhiFirst.class);
                startActivity(intent);

            }
        });
    }
}
