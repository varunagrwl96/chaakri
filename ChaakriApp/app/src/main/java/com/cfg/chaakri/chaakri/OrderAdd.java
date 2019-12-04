package com.cfg.chaakri.chaakri;


import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.StrictMode;
import android.util.Log;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

import cz.msebera.android.httpclient.HttpResponse;
import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.client.methods.HttpGet;
import cz.msebera.android.httpclient.impl.client.DefaultHttpClient;

import static android.content.Context.MODE_PRIVATE;

class OrderAdd extends AsyncTask<String, Void, String> {
    Context ctx;
    String flv,qnt,cnum,snum,addr;

    public OrderAdd(Context context)
    {
        ctx = context;
    }


    protected String doInBackground(String... message) {
        HttpClient httpclient;
        HttpGet request;
        HttpResponse response = null;
        String result = "";
        try {
            String send = message[0];

            Log.e("Sent txt:",send);
            String[] rec = send.split(",");
            flv = rec[0];

            qnt = rec[1];

            cnum = rec[2];

            snum = rec[3];

            addr = rec[4];

            Log.e("rec[4]",rec[4]);

            httpclient = new DefaultHttpClient();
            request = new HttpGet("http://stylopolitan.com/chaakri/orders.php?inv_id=" + flv + "&quantity=" + qnt + "&cust_phone=" +cnum+ "&sakhi_phone=" +snum+ "&address=" +addr);
            response = httpclient.execute(request);
        } catch (Exception e) {
            result = "error1";
        }

        try {
            BufferedReader rd = new BufferedReader(new InputStreamReader(
                    response.getEntity().getContent()));
            String line = "";
            while ((line = rd.readLine()) != null) {
                result = result + line;
            }
        } catch (Exception e) {
            result = "Check Internet Connectivity!";
        }
        return result;
    }

    protected void onPostExecute(String result) {

        Log.e("Result", "Result" + result);

        SharedPreferences prefs = ctx.getSharedPreferences("LoginPref", MODE_PRIVATE);
        String lvl = prefs.getString("Userlevel","No level");


        if (result.equalsIgnoreCase("inserted"))
        {
          //  Toast.makeText(ctx,"Order Added Successfully!",Toast.LENGTH_SHORT).show();
            Intent i = new Intent(ctx,MainActivity.class);
            if(lvl.equalsIgnoreCase("1")) {
                i = new Intent(ctx, NavActivitySakhi.class);
            }
            else if(lvl.equalsIgnoreCase("2")) {
                i = new Intent(ctx,CustFront.class);
            }
            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            ctx.startActivity(i);
        }
        else {
          //  Toast.makeText(ctx,"Unable to add order!",Toast.LENGTH_LONG).show();
        }

    }
}
