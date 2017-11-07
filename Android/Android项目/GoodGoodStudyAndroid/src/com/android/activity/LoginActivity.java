package com.android.activity;
import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.view.View.OnClickListener;
import android.view.View;
import android.view.WindowManager;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

public class LoginActivity extends Activity {

	//初始化控件
	private EditText etName;
	private EditText etPassword;
	private CheckBox cbRemeberPsd;
	private ImageView imgvLogin;
	private TextView tvNotRegister;
	private TextView tvForgotPsd;
	
	//记住：对象做动作
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		initWindow(); // 透明化状态栏
		setContentView(R.layout.activity_login);
		initView();
		tvNotRegister.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Intent intent = new Intent(LoginActivity.this, RegisterActivity.class);
				startActivity(intent);			
			}
		});
		
		imgvLogin.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Intent intent = new Intent(LoginActivity.this, HomeActivity.class);
				startActivity(intent);	
				
			}
		});
	}

	private void initView() {
		etName = (EditText) findViewById(R.id.name);
		etPassword = (EditText) findViewById(R.id.password);
		cbRemeberPsd = (CheckBox) findViewById(R.id.remeber_psd);
		imgvLogin = (ImageView) findViewById(R.id.login);
		tvNotRegister = (TextView) findViewById(R.id.no_register);
		tvForgotPsd = (TextView) findViewById(R.id.forgot_psd);	
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
