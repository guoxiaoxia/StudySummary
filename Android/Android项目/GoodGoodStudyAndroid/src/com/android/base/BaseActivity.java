package com.android.base;

import com.readystatesoftware.systembartint.SystemBarTintManager;
import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.os.Build;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.view.WindowManager;

public class BaseActivity extends FragmentActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		initWindow(); // 透明化状态栏

	}

	// 透明化状态栏
	@SuppressLint("ResourceAsColor")
	@TargetApi(19)
	private void initWindow() {
		if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.KITKAT) {
			getWindow().addFlags(
					WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
			// 使标题栏不会上升，并且为状态栏上颜色
			// SystemBarTintManager tintManager = new
			// SystemBarTintManager(this);
			// tintManager.setStatusBarTintEnabled(true);
			// //
			// tintManager.setStatusBarTintColor(Color.parseColor("#049ff1"));
			// tintManager.setStatusBarTintResource(R.color.col_main_blue);
		}
	}
}
