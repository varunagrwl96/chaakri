package com.cfg.chaakri.chaakri;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebView;

public class RecomActivity extends AppCompatActivity {

    WebView wvT1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recom);

        wvT1 = (WebView) findViewById(R.id.RecWeb);
        wvT1.getSettings().setJavaScriptEnabled(true);
        wvT1.loadUrl("https://ayushkhanvilkar96.github.io/recc/");


    }
}
