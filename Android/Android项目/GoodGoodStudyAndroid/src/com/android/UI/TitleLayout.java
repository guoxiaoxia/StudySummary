package com.android.UI;

import com.android.activity.R;

import android.app.Activity;
import android.content.Context;
import android.util.AttributeSet;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
//import android.widget.Toast;

public class TitleLayout extends LinearLayout {
	public TitleLayout(Context context , AttributeSet attrs){
		super(context,attrs);
		LayoutInflater.from(context).inflate(R.layout.person_data_titlebar, this);
		Button titleBack = (Button)findViewById(R.id.title_back);
		titleBack.setOnClickListener(new OnClickListener(){
			@Override
			public void onClick(View v){
				((Activity) getContext()).finish();
			}
		});
	}
}
