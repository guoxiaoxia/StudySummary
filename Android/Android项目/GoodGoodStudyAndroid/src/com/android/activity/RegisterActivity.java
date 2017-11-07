package com.android.activity;

import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.WindowManager;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

public class RegisterActivity extends Activity {

	// 初始化控件
	private EditText etEmail;
	private EditText etName;
	private EditText etPassword;
	private ImageView imgvRegister;
	private TextView tvHasRegister;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		initWindow(); // 透明化状态栏
		setContentView(R.layout.activity_register);
		init();
		tvHasRegister.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
				startActivity(intent);			
				
			}
		});
	}

	private void init() {
		etEmail = (EditText) findViewById(R.id.email);
		etName = (EditText) findViewById(R.id.name);
		etPassword = (EditText) findViewById(R.id.password);
		imgvRegister = (ImageView) findViewById(R.id.register);
		tvHasRegister = (TextView) findViewById(R.id.has_register);
	}

	// 用于透明化状态栏
	@TargetApi(19)
	private void initWindow() {
		if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.KITKAT) {
			getWindow().addFlags(
					WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
		}
	}
}
