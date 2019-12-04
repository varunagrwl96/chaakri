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

class CheckLogin extends AsyncTask<String, Void, String> {
    Context ctx;
    String us,pw,userlvl;

    public CheckLogin(Context context)
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
            String[] rec = send.split(",");
            us = rec[0];

            pw = rec[1];

            userlvl = rec[2];

            Log.e("Check", "us=" + us + " pass=" + pw + "ok");


            httpclient = new DefaultHttpClient();
            request = new HttpGet("http://stylopolitan.com/chaakri/login.php?mobile_no=" + us + "&password=" + pw + "&user_type=2");
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

        if (result.equalsIgnoreCase("success"))
        {
            // Toast.makeText(ctx,"Login success uslvl="+userlvl,Toast.LENGTH_SHORT).show();

            SharedPreferences.Editor editor = ctx.getSharedPreferences("LoginPref", MODE_PRIVATE).edit();
            editor.putString("Username", us);
            editor.putString("Password", pw);
            editor.putString("Userlevel",userlvl);
            editor.putString("text","YES");
            editor.commit();

            Intent i = new Intent(ctx,MainActivity.class);
            if (userlvl.equalsIgnoreCase("1"))
            i = new Intent(ctx,NavActivitySakhi.class);
            else if(userlvl.equalsIgnoreCase("2")) {
                i = new Intent(ctx, CustFront.class);
                new AddressRet(ctx).execute(us);
            }

            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            ctx.startActivity(i);
        }
        else {
          //  Toast.makeText(ctx,"Invalid ID or PASSWORD",Toast.LENGTH_LONG).show();
        }

    }
}
