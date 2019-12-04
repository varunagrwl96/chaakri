package com.cfg.chaakri.chaakri;

import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class CustomerRegister extends AppCompatActivity {
    GPSTracker gps;
EditText cusername,cpass,cname,caddcust;
    Button registerbutton;
    double latitude, longitude;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_customer_register);
        cusername=(EditText)findViewById(R.id.cusername);
        cname = (EditText) findViewById(R.id.cname);
        cpass=(EditText)findViewById(R.id.cpass);
        caddcust = (EditText) findViewById(R.id.caddcust);

        registerbutton=(Button)findViewById(R.id.registerbutton);
        registerbutton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

               /* gps = new GPSTracker(CustomerRegister.this);
                if (gps.canGetLocation()) {
                    latitude = gps.getLatitude();
                    longitude = gps.getLongitude();
                }
                else
                {
                    Toast.makeText(CustomerRegister.this,"Unable to rtrieve loc",Toast.LENGTH_SHORT).show();
                } */
                String user=cusername.getText().toString();
                String nameu = cname.getText().toString();

                while(nameu.contains(" "))
                {
                    int ind=nameu.indexOf(" ");
                    nameu = nameu.substring(0,ind)+"_"+nameu.substring(ind+1);
                }

                String passw=cpass.getText().toString();
                String addrc=caddcust.getText().toString();

                while(addrc.contains(" "))
                {
                    int ind=addrc.indexOf(" ");
                    addrc = addrc.substring(0,ind)+"_"+addrc.substring(ind+1);
                }


                String message= user+","+passw+",2,"+latitude+","+longitude+","+nameu+","+addrc;

                SharedPreferences.Editor editor = getApplicationContext().getSharedPreferences("LoginPref", MODE_PRIVATE).edit();
                editor.putString("cAddress", addrc);
                editor.commit();

              //  Toast.makeText(CustomerRegister.this,message,Toast.LENGTH_SHORT).show();

                new RegUser(getApplicationContext()).execute(message);


            }
        });
    }
}
