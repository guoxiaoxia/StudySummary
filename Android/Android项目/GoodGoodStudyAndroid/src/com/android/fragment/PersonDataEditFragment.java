package com.android.fragment;

import com.android.activity.R;
import android.app.Activity;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class PersonDataEditFragment extends Fragment {
	// ��ʼ��
	private View view;
	private TextView tv_title;
	private Button finish;
	private EditText et_signature;
	private String inputText;

	public PersonDataEditListener listener;

	// �ڲ��ӿ�
	public interface PersonDataEditListener {
		public void backToPersonDataFragmemt();
	}

	@Override
	public void onAttach(Activity activity) {
		listener = (PersonDataEditListener) activity;
		super.onAttach(activity);
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		view = inflater.inflate(R.layout.fragment_person_data_edit, container, false);
		initView();
		action();
		return view;
	}
	

	private void initView() {
		tv_title = (TextView) view.findViewById(R.id.title_text);
		finish = (Button) view.findViewById(R.id.finish_name);
	}

	private void action() {
		// ���ñ���Ϊ�༭ǩ��
		tv_title.setText("�༭ǩ��");

		// ����һ��ҳ��ش�����----->���浽���ݿ�
		finish.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View arg0) {
				// ��ȡ�û������ǩ��
				et_signature = (EditText) view
						.findViewById(R.id.edit_signature);
				inputText = et_signature.getText().toString();
				int position = (Integer) getArguments().get("position");
				listener.backToPersonDataFragmemt();
			}
		});
	}
}
