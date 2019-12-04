package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class SakhiLogin extends AppCompatActivity {

    Button b1;
    EditText us,pw,tsl;
    int noback=0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sakhi_login);

        b1 = (Button) findViewById(R.id.button);
        us = (EditText) findViewById(R.id.editTextUser);
        pw = (EditText) findViewById(R.id.editTextPass);
        tsl = (EditText) findViewById(R.id.timeslot);

        String usn;

        String times = tsl.getText().toString();
        SharedPreferences.Editor editor = getSharedPreferences("LoginPref", MODE_PRIVATE).edit();
        editor.putString("Timeslot", times);
        editor.commit();


            b1.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    String user = us.getText().toString();
                    String psw = pw.getText().toString();
                    //String times = tsl.getText().toString();

                    String message = user + "," + psw + ",1";
                    Log.e("check", "message=" + message);

                    new CheckLogin(getApplicationContext()).execute(message);


                }
            });
        }

    @Override
    public void onBackPressed() {
        if(noback==1)
        {
        }
        else {
            super.onBackPressed();
        }
    }
}
