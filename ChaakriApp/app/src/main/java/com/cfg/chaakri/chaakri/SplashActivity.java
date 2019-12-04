package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Toast;

public class SplashActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        SharedPreferences prefs = getSharedPreferences("LoginPref", MODE_PRIVATE);
        String restoredText = prefs.getString("text", null);
        if (restoredText != null) {
            String userlvl = prefs.getString("Userlevel","0"); //0 is the default value.
            if (userlvl.equalsIgnoreCase("1")) {
               // Toast.makeText(getApplicationContext(),"Sakhi logged in!",Toast.LENGTH_SHORT).show();
                Intent i = new Intent(SplashActivity.this, NavActivitySakhi.class);
                startActivity(i);
            } else if (userlvl.equalsIgnoreCase("2")) {
               // Toast.makeText(getApplicationContext(),"Customer logged in!",Toast.LENGTH_SHORT).show();
                Intent i = new Intent(SplashActivity.this, CustFront.class);
                startActivity(i);
            }
            else
            {
                Intent i = new Intent(SplashActivity.this,MainActivity.class);
                startActivity(i);
            }
        }
        else
        {
            Intent i = new Intent(SplashActivity.this,MainActivity.class);
            startActivity(i);
        }




    }
}
