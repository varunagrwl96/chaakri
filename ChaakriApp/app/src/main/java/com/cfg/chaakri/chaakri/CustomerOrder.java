package com.cfg.chaakri.chaakri;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.annotation.IdRes;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

public class CustomerOrder extends AppCompatActivity {
    RadioGroup type,location;
    EditText quantity,locationtext;
    RadioButton r1,r2,r3,r4,r5,r6,r7,r8,r9,l1,l2;
    Button orderbutton;
    int flag;
    String x="";
    String y="";
    String send="";
    @Override
    protected void onCreate(final Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_customer_order);
        type=(RadioGroup)findViewById(R.id.type);
        quantity=(EditText)findViewById(R.id.quantity);
        locationtext=(EditText)findViewById(R.id.locationtext);
        location=(RadioGroup)findViewById(R.id.location);
        r1=(RadioButton)findViewById(R.id.radiobutton1);
        r2=(RadioButton)findViewById(R.id.radiobutton2);
        r3=(RadioButton)findViewById(R.id.radiobutton3);
        r4=(RadioButton)findViewById(R.id.radiobutton4);
        r5=(RadioButton)findViewById(R.id.radiobutton5);
        r6=(RadioButton)findViewById(R.id.radiobutton6);
        r7=(RadioButton)findViewById(R.id.radiobutton7);
        r8=(RadioButton)findViewById(R.id.radiobutton8);
        r9=(RadioButton)findViewById(R.id.radiobutton9);
        l1=(RadioButton)findViewById(R.id.homelocation);
        l2=(RadioButton)findViewById(R.id.otherlocation);
        /*location.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup radioGroup, @IdRes int i) {
                int id=radioGroup.getCheckedRadioButtonId();
                if(id==1)
                    y="0";
                else{
                    y="1"+quantity.getText().toString();
                }
            }
        });
        type.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup radioGroup, @IdRes int i) {
                int id=radioGroup.getCheckedRadioButtonId();
                x=""+id;
            }
        });*/
        orderbutton=(Button)findViewById(R.id.orderbutton);
        orderbutton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                //send=x+" "+quantity.getText().toString();
                //send+=" "+y;
               /* if(y.equals("0"))
                {
                    send+=" "+y;
                }
                else send+=" 1 "+quantity.getText().toString();*/

                //Toast.makeText(CustomerOrder.this,send,Toast.LENGTH_SHORT).show();

               int typeid=type.getCheckedRadioButtonId();
                int locationid=location.getCheckedRadioButtonId();
                switch(typeid)
                {
                    case (R.id.radiobutton1) :
                        x="1";
                        break;
                    case (R.id.radiobutton2) :
                        x="2";
                        break;
                    case (R.id.radiobutton3) :
                        x="3";
                        break;
                    case (R.id.radiobutton4) :
                        x="4";
                        break;
                    case (R.id.radiobutton5) :
                        x="5";
                        break;
                    case (R.id.radiobutton6) :
                        x="6";
                        break;
                    case (R.id.radiobutton7) :
                        x="7";
                        break;
                    case (R.id.radiobutton8) :
                        x="8";
                        break;
                    case (R.id.radiobutton9) :
                        x="9";
                        break;
                }
                switch(locationid)
                {
                    case (R.id.homelocation):
                        y="0";
                        break;
                    case (R.id.otherlocation):
                        y="1";
                }
                if(y.equals("1"))
                {
                    flag=1;
                    y+=" "+locationtext.getText().toString();
                }

                send= x+ ","+quantity.getText().toString()+","+y;
              //  Toast.makeText(CustomerOrder.this,send,Toast.LENGTH_SHORT).show();

                SharedPreferences prefs = getSharedPreferences("LoginPref", MODE_PRIVATE);
                String cnum = prefs.getString("Username","Nousername");
                String flv = x;
                String caddr = prefs.getString("cAddress","NoAddress");
                String quan = quantity.getText().toString();
                String snum = "0";

                String send = flv + "," +quan+ "," +cnum+ "," +snum ;
                if(y.equalsIgnoreCase("0"))
                {
                    send = send +","+caddr;
                }
                else if(flag==1)
                {
                    send = send +","+locationtext.getText().toString();
                }

                while(send.contains(" "))
                {
                    int ind=send.indexOf(" ");
                    send = send.substring(0,ind)+"_"+send.substring(ind+1);
                }


                new OrderAdd(getApplicationContext()).execute(send);


            }
        });


    }
}
