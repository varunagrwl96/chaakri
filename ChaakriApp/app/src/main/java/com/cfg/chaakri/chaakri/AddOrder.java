package com.cfg.chaakri.chaakri;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;

import static android.content.Context.MODE_PRIVATE;


/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link AddOrder.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link AddOrder#newInstance} factory method to
 * create an instance of this fragment.
 */
public class AddOrder extends Fragment {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    RadioButton r1,r2,r3,r4,r5,r6,r7,r8,r9;
    RadioGroup type;
    String x;

    EditText FlavInp,Quant,CustNum;

    Button done;

    private OnFragmentInteractionListener mListener;

    public AddOrder() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment AddOrder.
     */
    // TODO: Rename and change types and number of parameters
    public static AddOrder newInstance(String param1, String param2) {
        AddOrder fragment = new AddOrder();
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
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_add_order, container, false);


        // NOTE : We are calling the onFragmentInteraction() declared in the MainActivity
        // ie we are sending "Fragment 1" as title parameter when fragment1 is activated
        if (mListener != null) {
            mListener.onFragmentInteraction("Add Order");
        }

      //  FlavInp = (EditText) view.findViewById(R.id.editFlav);
        Button xyz;

        Quant = (EditText) view.findViewById(R.id.editQ);
        CustNum = (EditText) view.findViewById(R.id.editNum);
        r1=(RadioButton)view.findViewById(R.id.rb1);
        r2=(RadioButton)view.findViewById(R.id.rb2);
        r3=(RadioButton)view.findViewById(R.id.rb3);
        r4=(RadioButton)view.findViewById(R.id.rb4);
        r5=(RadioButton)view.findViewById(R.id.rb5);
        r6=(RadioButton)view.findViewById(R.id.rb6);
        r7=(RadioButton)view.findViewById(R.id.rb7);
        r8=(RadioButton)view.findViewById(R.id.rb8);
        r9=(RadioButton)view.findViewById(R.id.rb9);
        type=(RadioGroup)view.findViewById(R.id.typek);

        SharedPreferences prefs = getContext().getSharedPreferences("LoginPref", MODE_PRIVATE);
        String restoredText = prefs.getString("text", null);
        final String sakhi_id = prefs.getString("Username","No id");

        done = (Button) view.findViewById(R.id.buttonD);

        done.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               // String flv = FlavInp.getText().toString();
                String qnt = Quant.getText().toString();
                String cnum = CustNum.getText().toString();
                int typeid=type.getCheckedRadioButtonId();
                switch(typeid)
                {
                    case (R.id.rb1) :
                        x="1";
                        break;
                    case (R.id.rb2) :
                        x="2";
                        break;
                    case (R.id.rb3) :
                        x="3";
                        break;
                    case (R.id.rb4) :
                        x="4";
                        break;
                    case (R.id.rb5) :
                        x="5";
                        break;
                    case (R.id.rb6) :
                        x="6";
                        break;
                    case (R.id.rb7) :
                        x="7";
                        break;
                    case (R.id.rb8) :
                        x="8";
                        break;
                    case (R.id.rb9) :
                        x="9";
                        break;
                }

                String send = x + "," + qnt + "," +cnum+ "," +sakhi_id+",_" ;

                Log.e("ChkSend:",send);

                new OrderAdd(getContext()).execute(send);

            }
        });

        xyz = (Button) view.findViewById(R.id.buttonrecomm);
        xyz.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(getContext(),RecomActivity.class);
            }
        });

        return view;


    }

    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction("Add Order");
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
