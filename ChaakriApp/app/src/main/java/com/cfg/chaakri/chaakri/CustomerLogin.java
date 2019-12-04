package com.cfg.chaakri.chaakri;

import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class CustomerLogin extends AppCompatActivity {
EditText editTextUser,editTextPass;
    Button button;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_customer_login);
        editTextUser=(EditText)findViewById(R.id.editTextUser);
        editTextPass=(EditText)findViewById(R.id.editTextPass);
        button=(Button)findViewById(R.id.button);

            button.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    String user = editTextUser.getText().toString();
                    String psw = editTextPass.getText().toString();

                    String message = user + "," + psw + ",2";
                    new CheckLogin(getApplicationContext()).execute(message);
                }
            });
        }
}
