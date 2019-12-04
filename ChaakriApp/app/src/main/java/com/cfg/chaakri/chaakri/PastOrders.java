package com.cfg.chaakri.chaakri;

import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.StrictMode;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

import cz.msebera.android.httpclient.HttpEntity;
import cz.msebera.android.httpclient.HttpResponse;
import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.client.methods.HttpGet;
import cz.msebera.android.httpclient.client.methods.HttpPost;
import cz.msebera.android.httpclient.impl.client.DefaultHttpClient;
import cz.msebera.android.httpclient.impl.client.HttpClientBuilder;

public class PastOrders extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_past_orders);


        SharedPreferences prefs = getSharedPreferences("LoginPref", MODE_PRIVATE);
        String usn = prefs.getString("Username", "NoUsername");


        if (android.os.Build.VERSION.SDK_INT > 9) {
            StrictMode.ThreadPolicy policy =
                    new StrictMode.ThreadPolicy.Builder().permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }


        String result = null;
        InputStream is = null;

        try{
            HttpClient httpclient = HttpClientBuilder.create().build();
            HttpPost httppost;

            httppost = new HttpPost("http://stylopolitan.com/chaakri/custhistory.php?cust_phone="+usn);

            HttpResponse response = httpclient.execute(httppost);
            HttpEntity entity = response.getEntity();
            is = entity.getContent();

            //   Log.e("log_tag", "connection success ");
            //   Toast.makeText(getApplicationContext(), "pass", Toast.LENGTH_SHORT).show();
        }
        catch(Exception e)
        {
            //   Log.e("log_tag", "Error in http connection "+e.toString());
            //  Toast.makeText(getApplicationContext(), "Connection fail", Toast.LENGTH_SHORT).show();

        }
        //convert response to string
        try
        {
            BufferedReader reader = new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
            StringBuilder sb = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null)
            {
                sb.append(line + "\n");
            }
            is.close();

            result=sb.toString();

        }
        catch(Exception e)
        {
            //   Log.e("log_tag", "Error converting result "+e.toString());
            //   Toast.makeText(getApplicationContext(), " Input reading fail", Toast.LENGTH_SHORT).show();
        }


        try
        {

            Log.e("result","Result string in jSON "+result);

            JSONArray jArray = new JSONArray(result);


            // String re=jArray.getString(jArray.length()-1);


            TableLayout tv=(TableLayout) findViewById(R.id.tablex);
            tv.removeAllViewsInLayout();

            int flag=1;

            for(int i=-1;i<jArray.length();i++)

            {




                TableRow tr=new TableRow(getApplicationContext());

                tr.setLayoutParams(new TableLayout.LayoutParams(
                        TableLayout.LayoutParams.MATCH_PARENT,
                        TableLayout.LayoutParams.WRAP_CONTENT));




                if(flag==1)
                {


                    TextView b19=new TextView(getApplicationContext());
                    b19.setPadding(10,0, 0, 0);
                    b19.setTextSize(20);
                    b19.setText("Flavour");
                    b19.setTextColor(Color.BLUE);
                    tr.addView(b19);


                    TextView b12=new TextView(getApplicationContext());
                    b12.setPadding(40,0, 0, 0);
                    b12.setTextSize(20);
                    b12.setText("Quantity");
                    b12.setTextColor(Color.BLUE);
                    tr.addView(b12);

                    TextView b69=new TextView(getApplicationContext());
                    b69.setPadding(40,0, 0, 0);
                    b69.setTextSize(20);
                    b69.setText("Order Date/Time");
                    b69.setTextColor(Color.BLUE);
                    tr.addView(b69);

                    TextView b69x=new TextView(getApplicationContext());
                    b69x.setPadding(40,0, 0, 0);
                    b69x.setTextSize(20);
                    b69x.setText("Status");
                    b69x.setTextColor(Color.BLUE);
                    tr.addView(b69x);

                    tv.addView(tr);

                    final View vline = new View(getApplicationContext());
                    vline.setLayoutParams(new TableRow.LayoutParams(TableRow.LayoutParams.MATCH_PARENT, 2));
                    vline.setBackgroundColor(Color.BLUE);



                    tv.addView(vline);
                    flag=0;


                }

                else
                {



                    JSONObject json_data = jArray.getJSONObject(i);


                    TextView b1=new TextView(getApplicationContext());
                    b1.setPadding(10, 0, 0, 0);
                    b1.setTextSize(20);
                    final String stime1=json_data.getString("inventory_id");
                    //Eventarr[x] = stime1;
                    //x++;
                    b1.setText(stime1);
                    b1.setTextColor(Color.RED);
                    tr.addView(b1);

                    TextView b2=new TextView(getApplicationContext());
                    b2.setPadding(40, 0, 0, 0);
                    String stime2=json_data.getString("quantity");
                    b2.setText(stime2);
                    b2.setTextColor(Color.RED);
                    b2.setTextSize(20);
                    tr.addView(b2);

                    TextView b3=new TextView(getApplicationContext());
                    b3.setPadding(40, 0, 0, 0);
                    String stime3=json_data.getString("orderTS");
                    b3.setText(stime3);
                    b3.setTextColor(Color.RED);
                    b3.setTextSize(20);
                    tr.addView(b3);


                    TextView b66y=new TextView(getApplicationContext());
                    b66y.setPadding(40, 0, 0, 0);
                    String stime66y=json_data.getString("status");
                    String seti = " ";
                    if(stime66y.equalsIgnoreCase("0"))
                        seti = "Not delivered";
                    else if(stime66y.equalsIgnoreCase("1"))
                        seti = "Delivered";
                    b66y.setText(seti);
                    b66y.setTextColor(Color.RED);
                    b66y.setTextSize(20);
                    tr.addView(b66y);


                    tv.addView(tr);




                    final View vline1 = new View(this);
                    vline1.setLayoutParams(new TableRow.LayoutParams(TableLayout.LayoutParams.MATCH_PARENT, 1));
                    vline1.setBackgroundColor(Color.WHITE);
                    tv.addView(vline1);


                }

            }



        }
        catch(JSONException e)
        {
            Log.e("log_tag", "Error parsing data "+e.toString());
           // Toast.makeText(this, "JsonArray fail", Toast.LENGTH_SHORT).show();
        }



    }
}
