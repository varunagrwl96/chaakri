package com.cfg.chaakri.chaakri;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.InputStreamReader;

import cz.msebera.android.httpclient.HttpResponse;
import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.client.methods.HttpGet;
import cz.msebera.android.httpclient.impl.client.DefaultHttpClient;

import static android.content.Context.MODE_PRIVATE;


class RegUser extends AsyncTask<String, Void, String> {
    Context ctx;
    String us,pw,userlvl,lat,longi,nameu,addr;

    public RegUser(Context context)
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

            lat = rec[3];
            longi = rec[4];

            nameu = rec[5];

            addr = rec[6];


            Log.e("Taghere","us="+us+",pw="+pw+",userlvl="+userlvl+",Name:"+nameu);

            httpclient = new DefaultHttpClient();
            request = new HttpGet("http://stylopolitan.com/chaakri/register.php?mobile_no=" + us + "&password=" + pw + "&user_type=" + userlvl + "&lat=" + lat + "&lng=" + longi + "&name=" + nameu + "&address=" + addr);
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
            Log.e("Exception",e.toString());
            result = "Check Internet Connectivity!";
        }
        return result;
    }

    protected void onPostExecute(String result) {

        Log.e("Result", "Result" + result);

        if (result.equalsIgnoreCase("success"))
        {
            /*SharedPreferences.Editor editor = ctx.getSharedPreferences("LoginPref", MODE_PRIVATE).edit();
            editor.putString("Username", us);
            editor.putString("Password", pw);
            editor.putString("Name",result);
            editor.putString("text","YES");
            editor.commit(); */

            Intent i = new Intent(ctx,MainActivity.class);
            if (userlvl.equalsIgnoreCase("1"))
                i = new Intent(ctx,SakhiLogin.class);
            else if (userlvl.equalsIgnoreCase("2"))
                i = new Intent(ctx,CustomerLogin.class);
            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            ctx.startActivity(i);
        }
        else if (result.trim()=="already_registered")
        {

        }
        else {
          //  Toast.makeText(ctx,"Unable to register",Toast.LENGTH_LONG).show();
        }

    }
}

