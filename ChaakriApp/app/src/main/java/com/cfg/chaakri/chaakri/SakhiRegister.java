package com.cfg.chaakri.chaakri;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class SakhiRegister extends AppCompatActivity {
    GPSTracker gps;
    EditText cusernamesakhi,cpasssakhi,cnamesakhi,caddsakhi;
    Button registerbuttonsakhi;
    double latitudesakhi, longitudesakhi;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sakhi_register);

        cusernamesakhi=(EditText)findViewById(R.id.cusernamesakhi);
        cnamesakhi = (EditText) findViewById(R.id.cnamesakhi);
        cpasssakhi=(EditText)findViewById(R.id.cpasssakhi);
        caddsakhi = (EditText) findViewById(R.id.caddsakhi);
        registerbuttonsakhi=(Button)findViewById(R.id.buttonSakhiRegister);

        registerbuttonsakhi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

               /* gps = new GPSTracker(SakhiRegister.this);
                if (gps.canGetLocation()) {
                    latitudesakhi = gps.getLatitude();
                    longitudesakhi = gps.getLongitude();
                }
                else
                {
                    Toast.makeText(SakhiRegister.this,"Unable to rtrieve loc",Toast.LENGTH_SHORT).show();
                } */

                String user=cusernamesakhi.getText().toString();
                String nameu = cnamesakhi.getText().toString();

                 while(nameu.contains(" "))
                {
                    int ind=nameu.indexOf(" ");
                    nameu = nameu.substring(0,ind)+"_"+nameu.substring(ind+1);
                }

                String passw=cpasssakhi.getText().toString();
                String addsak = caddsakhi.getText().toString();

                while(addsak.contains(" "))
                {
                    int ind=addsak.indexOf(" ");
                    addsak = addsak.substring(0,ind)+"_"+addsak.substring(ind+1);
                }

                String message= user+","+passw+",1,"+latitudesakhi+","+longitudesakhi+","+nameu+","+addsak;

              //  Toast.makeText(SakhiRegister.this,message,Toast.LENGTH_SHORT).show();

                new RegUser(getApplicationContext()).execute(message);


            }
        });
    }
}
