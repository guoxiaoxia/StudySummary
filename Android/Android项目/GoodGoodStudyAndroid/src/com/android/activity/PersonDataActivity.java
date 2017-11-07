package com.android.activity;

import com.android.base.BaseActivity;
import com.android.fragment.PersonDataEditFragment;
import com.android.fragment.PersonDataEditFragment.PersonDataEditListener;
import com.android.fragment.PersonDataFragment;
import com.android.fragment.PersonDataFragment.PersonDataListener;

import android.os.Bundle;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;

//每一个监听器都是是一个接口，实现监听器接口
public class PersonDataActivity extends BaseActivity implements PersonDataEditListener,
		PersonDataListener {

	private FragmentManager fragmentManager = getSupportFragmentManager();

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_person_data);

		addPersonDataFragment();// 添加PersonDataFragment到activity中
		
	}

	// 添加PersonDataFragment到activity中
	private void addPersonDataFragment() {
		
		FragmentTransaction fragmentTransaction = fragmentManager
				.beginTransaction();
		PersonDataFragment personDataFragment = new PersonDataFragment();
		fragmentTransaction.add(R.id.frame_layout_person_data,
				personDataFragment, "personDataFragment");
		fragmentTransaction.commit();
	}

	/**
	 * 实现PersonDataFragment的回调方法，通过传递过来的position参数，跳转到对应的编辑页面
	 * @param position :personData的ListView对用的下标
	 */
	@Override
	public void goPersonDataEdit(int position) {

		FragmentTransaction fragmentTransaction = fragmentManager
				.beginTransaction();
		PersonDataEditFragment personDataEditFragment = new PersonDataEditFragment();
		Bundle bundle = new Bundle();
		bundle.putInt("position", position);
		personDataEditFragment.setArguments(bundle);
		fragmentTransaction.replace(R.id.frame_layout_person_data,
				personDataEditFragment);
		fragmentTransaction.addToBackStack(null);
		fragmentTransaction.commit();
	}

	/**
	 * 实现PersonDataEditFragment的回调方法，跳转到PersonDataFragment页面
	 */
	@Override
	public void backToPersonDataFragmemt() {

		// 在一开始传送数据时，将对应的位置作为请求码
		FragmentTransaction fragmentTransaction = fragmentManager
				.beginTransaction();
		PersonDataFragment personDataFragment = new PersonDataFragment();
		fragmentTransaction.replace(R.id.frame_layout_person_data,
				personDataFragment);
		fragmentTransaction.commit();
	}
}
