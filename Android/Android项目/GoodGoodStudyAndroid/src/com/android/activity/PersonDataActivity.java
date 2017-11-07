package com.android.activity;

import com.android.base.BaseActivity;
import com.android.fragment.PersonDataEditFragment;
import com.android.fragment.PersonDataEditFragment.PersonDataEditListener;
import com.android.fragment.PersonDataFragment;
import com.android.fragment.PersonDataFragment.PersonDataListener;

import android.os.Bundle;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;

//ÿһ��������������һ���ӿڣ�ʵ�ּ������ӿ�
public class PersonDataActivity extends BaseActivity implements PersonDataEditListener,
		PersonDataListener {

	private FragmentManager fragmentManager = getSupportFragmentManager();

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_person_data);

		addPersonDataFragment();// ���PersonDataFragment��activity��
		
	}

	// ���PersonDataFragment��activity��
	private void addPersonDataFragment() {
		
		FragmentTransaction fragmentTransaction = fragmentManager
				.beginTransaction();
		PersonDataFragment personDataFragment = new PersonDataFragment();
		fragmentTransaction.add(R.id.frame_layout_person_data,
				personDataFragment, "personDataFragment");
		fragmentTransaction.commit();
	}

	/**
	 * ʵ��PersonDataFragment�Ļص�������ͨ�����ݹ�����position��������ת����Ӧ�ı༭ҳ��
	 * @param position :personData��ListView���õ��±�
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
	 * ʵ��PersonDataEditFragment�Ļص���������ת��PersonDataFragmentҳ��
	 */
	@Override
	public void backToPersonDataFragmemt() {

		// ��һ��ʼ��������ʱ������Ӧ��λ����Ϊ������
		FragmentTransaction fragmentTransaction = fragmentManager
				.beginTransaction();
		PersonDataFragment personDataFragment = new PersonDataFragment();
		fragmentTransaction.replace(R.id.frame_layout_person_data,
				personDataFragment);
		fragmentTransaction.commit();
	}
}
