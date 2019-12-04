package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class SakhiFirst extends AppCompatActivity {

    Button login,register;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sakhi_first);

        login = (Button) findViewById(R.id.buttonSakhiLogin);
        register = (Button) findViewById(R.id.buttonSakhiRegister);

        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(SakhiFirst.this,SakhiLogin.class);
                startActivity(i);
            }
        });

        register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(SakhiFirst.this,SakhiRegister.class);
                startActivity(i);
            }
        });




    }
}
