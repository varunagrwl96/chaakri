package com.cfg.chaakri.chaakri;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebView;

public class TechWeb extends AppCompatActivity {

    WebView wvT;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tech_web);

        wvT = (WebView) findViewById(R.id.webViewTech);
        wvT.getSettings().setJavaScriptEnabled(true);
        wvT.loadUrl("https://ayushkhanvilkar96.github.io/CaseyNeistatWebsite/");

    }
}
