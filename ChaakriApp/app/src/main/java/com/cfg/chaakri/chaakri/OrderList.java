package com.cfg.chaakri.chaakri;

import android.content.Context;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.net.Uri;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.v4.app.Fragment;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
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

import static android.R.attr.x;
import static android.content.Context.MODE_PRIVATE;


/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link OrderList.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link OrderList#newInstance} factory method to
 * create an instance of this fragment.
 */
public class OrderList extends Fragment {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    String timesl;

    private OnFragmentInteractionListener mListener;

    public OrderList() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment OrderList.
     */
    // TODO: Rename and change types and number of parameters
    public static OrderList newInstance(String param1, String param2) {
        OrderList fragment = new OrderList();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_order_list, container, false);


        // NOTE : We are calling the onFragmentInteraction() declared in the MainActivity
        // ie we are sending "Fragment 1" as title parameter when fragment1 is activated
        if (mListener != null) {
            mListener.onFragmentInteraction("Order List");
        }

        SharedPreferences prefs = getContext().getSharedPreferences("LoginPref", MODE_PRIVATE);
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

            httppost = new HttpPost("http://stylopolitan.com/chaakri/order_listing.php?sakhi_phone="+usn);

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


            TableLayout tv=(TableLayout) view.findViewById(R.id.table2);
            tv.removeAllViewsInLayout();

            int flag=1;

            for(int i=-1;i<jArray.length();i++)

            {




                TableRow tr=new TableRow(getContext());

                tr.setLayoutParams(new TableLayout.LayoutParams(
                        TableLayout.LayoutParams.MATCH_PARENT,
                        TableLayout.LayoutParams.WRAP_CONTENT));




                if(flag==1)
                {

                    TextView b6=new TextView(getContext());
                    b6.setPadding(0,0,0,0);
                    b6.setText("ID");
                    b6.setTextColor(Color.BLUE);
                    b6.setTextSize(20);
                    tr.addView(b6);


                    TextView b19=new TextView(getContext());
                    b19.setPadding(40,0, 0, 0);
                    b19.setTextSize(20);
                    b19.setText("Flavour");
                    b19.setTextColor(Color.BLUE);
                    tr.addView(b19);


                    TextView b12=new TextView(getContext());
                    b12.setPadding(40,0, 0, 0);
                    b12.setTextSize(20);
                    b12.setText("Quantity");
                    b12.setTextColor(Color.BLUE);
                    tr.addView(b12);

                    TextView b69=new TextView(getContext());
                    b69.setPadding(40,0, 0, 0);
                    b69.setTextSize(20);
                    b69.setText("Delivery Address");
                    b69.setTextColor(Color.BLUE);
                    tr.addView(b69);

                    TextView b69x=new TextView(getContext());
                    b69x.setPadding(40,0, 0, 0);
                    b69x.setTextSize(20);
                    b69x.setText("Delivery Mode");
                    b69x.setTextColor(Color.BLUE);
                    tr.addView(b69x);

                    tv.addView(tr);

                    final View vline = new View(getContext());
                    vline.setLayoutParams(new TableRow.LayoutParams(TableRow.LayoutParams.MATCH_PARENT, 2));
                    vline.setBackgroundColor(Color.BLUE);



                    tv.addView(vline);
                    flag=0;


                }

                else
                {



                    JSONObject json_data = jArray.getJSONObject(i);


                    TextView b1=new TextView(getContext());
                    b1.setPadding(10, 0, 0, 0);
                    b1.setTextSize(20);
                    final String stime1=json_data.getString("id");
                    //Eventarr[x] = stime1;
                    //x++;
                    b1.setText(stime1);
                    b1.setTextColor(Color.RED);
                    tr.addView(b1);

                    TextView b2=new TextView(getContext());
                    b2.setPadding(40, 0, 0, 0);
                    String stime2=json_data.getString("inventory_id");
                    b2.setText(stime2);
                    b2.setTextColor(Color.RED);
                    b2.setTextSize(20);
                    tr.addView(b2);

                    TextView b3=new TextView(getContext());
                    b3.setPadding(40, 0, 0, 0);
                    String stime3=json_data.getString("quantity");
                    b3.setText(stime3);
                    b3.setTextColor(Color.RED);
                    b3.setTextSize(20);
                    tr.addView(b3);

                    TextView b66=new TextView(getContext());
                    b66.setPadding(40, 0, 0, 0);
                    String stime66=json_data.getString("delivery_address");
                    b66.setText(stime66);
                    b66.setTextColor(Color.RED);
                    b66.setTextSize(20);
                    tr.addView(b66);

                    TextView b66y=new TextView(getContext());
                    b66y.setPadding(40, 0, 0, 0);
                    String stime66y=json_data.getString("delivery_mode");
                    String seti = " ";
                    if(stime66y.equalsIgnoreCase("1"))
                        seti = "Pickup";
                    else if(stime66y.equalsIgnoreCase("0"))
                        seti = "Delivery";
                    b66y.setText(seti);
                    b66y.setTextColor(Color.RED);
                    b66y.setTextSize(20);
                    tr.addView(b66y);

                    tr.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {

                            SharedPreferences prefs = getContext().getSharedPreferences("LoginPref", MODE_PRIVATE);
                            timesl = prefs.getString("Timeslot", "Noslot");

                            AlertDialog alertDialog = new AlertDialog.Builder(getContext()).create();

                            alertDialog.setTitle("Change Delivery Status");

                            alertDialog.setMessage("Click to alter delivery status");

                            alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE, "Pick-Up", new DialogInterface.OnClickListener() {

                                public void onClick(DialogInterface dialog, int id) {

                                  //  Toast.makeText(getContext(),stime1+" Pickup",Toast.LENGTH_SHORT).show();

                                    String url = "http://stylopolitan.com/chaakri/order_allot.php?order_id="+stime1+"&status=pickup&times="+timesl;
                                    HttpClient client = new DefaultHttpClient();

                                    try {
                                        client.execute(new HttpGet(url));
                                    } catch(IOException e) {
                                        Log.e("Errorr","Error");
                                        //do something here
                                    }


                                } });

                            alertDialog.setButton(AlertDialog.BUTTON_POSITIVE, "Delivery", new DialogInterface.OnClickListener() {

                                public void onClick(DialogInterface dialog, int id) {

                                 //   Toast.makeText(getContext(),stime1+" Delivery",Toast.LENGTH_SHORT).show();

                                    String url = "http://stylopolitan.com/chaakri/order_allot.php?order_id="+stime1+"&status=delivery&times="+timesl;
                                    HttpClient client = new DefaultHttpClient();

                                    try {
                                        client.execute(new HttpGet(url));
                                    } catch(IOException e) {
                                        //do something here
                                    }

                                }});

                            alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, "Cancel Order", new DialogInterface.OnClickListener() {

                                public void onClick(DialogInterface dialog, int id) {

                                //    Toast.makeText(getContext(),stime1+" Cancel",Toast.LENGTH_SHORT).show();

                                    String url = "http://stylopolitan.com/chaakri/order_allot.php?order_id="+stime1+"&status=cancel&times="+timesl;
                                    HttpClient client = new DefaultHttpClient();

                                    try {
                                        client.execute(new HttpGet(url));
                                    } catch(IOException e) {
                                        //do something here
                                    }

                                }});

                            alertDialog.show();
                        }
                    });




                    tv.addView(tr);




                    final View vline1 = new View(getContext());
                    vline1.setLayoutParams(new TableRow.LayoutParams(TableLayout.LayoutParams.MATCH_PARENT, 1));
                    vline1.setBackgroundColor(Color.WHITE);
                    tv.addView(vline1);


                }

            }



        }
        catch(JSONException e)
        {
            Log.e("log_tag", "Error parsing data "+e.toString());
          //  Toast.makeText(getContext(), "JsonArray fail", Toast.LENGTH_SHORT).show();
        }




        return view;

    }

    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction("Order List");
        }
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        } else {
            throw new RuntimeException(context.toString()
                    + " must implement OnFragmentInteractionListener");
        }
    }

    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    /**
     * This interface must be implemented by activities that contain this
     * fragment to allow an interaction in this fragment to be communicated
     * to the activity and potentially other fragments contained in that
     * activity.
     * <p>
     * See the Android Training lesson <a href=
     * "http://developer.android.com/training/basics/fragments/communicating.html"
     * >Communicating with Other Fragments</a> for more information.
     */
    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(String uri);
    }
}
