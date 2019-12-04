package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class CustomerFirst extends AppCompatActivity {
Button buttoncustomerlogin,buttoncustomerregister;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_customer_first);

        buttoncustomerlogin = (Button) findViewById(R.id.buttoncustomerlogin);
        buttoncustomerregister = (Button) findViewById(R.id.buttoncustomerregister);

        buttoncustomerlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(CustomerFirst.this,CustomerLogin.class);
                startActivity(intent);
            }
        });
        buttoncustomerregister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(CustomerFirst.this,CustomerRegister.class);
                startActivity(intent);
            }
        });
    }
}
