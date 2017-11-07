package com.android.fragment;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.android.activity.R;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class PersonDataFragment extends Fragment implements OnItemClickListener {
	// ��ʼ��
	private View view;
	private TextView tv_title;
	private ListView li_personData;
	private SimpleAdapter adapter_personData;
	private List<Map<String, Object>> dataList_personData;

	public PersonDataListener listener;

	// �ڲ��ӿ�
	public interface PersonDataListener {
		public void goPersonDataEdit(int position);
	}

	@Override
	public void onAttach(Activity activity) {
		listener = (PersonDataListener) activity;
		super.onAttach(activity);
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		view = inflater.inflate(R.layout.fragment_person_data_main, container, false);
		initView();
		initData();
		action();
		return view;
	}

	private void initView() {
		tv_title = (TextView) view.findViewById(R.id.title_text);
		li_personData = (ListView) view
				.findViewById(R.id.list_view_person_data);
	}

	// ----------------------initData--------------------------------------
	private void initData() {

		dataList_personData = new ArrayList<Map<String, Object>>();
		getPersonData();// ����������Ϣ������Դ
		adapter_personData = new SimpleAdapter(getActivity(),
				dataList_personData, R.layout.person_data_list_item,
				new String[] { "smallTitle", "next" }, new int[] {
						R.id.samllTitle, R.id.edit });
		li_personData.setAdapter(adapter_personData);
	}

	// ��ȡ����Դ
	private void getPersonData() {
		String[] data = { "ͷ��", "�ǳ�", "�Ա�", "����", "ѧУ", "ǩ��", "����" };
		for (int i = 0; i < data.length; i++) {
			Map<String, Object> map = new HashMap<String, Object>();
			map.put("smallTitle", data[i]);
			map.put("next", ">");
			dataList_personData.add(map);
		}
	}

	// ----------------------action--------------------------------------
	private void action() {
		// ���ñ���Ϊ��������
		tv_title.setText("��������");

		// ������Ϣ�б���ؼ�����
		li_personData.setOnItemClickListener(this);
	}

	@Override
	public void onItemClick(AdapterView<?> parent, View view, int position,
			long id) {
		// ����λ�û�ȡ����position�Ǵ�0��ʼ
		// intent()������1>�����ģ����ʲ�����Ҫ��ȫ�ֶ���; 2>Ŀ���ļ�
		switch (position) {
		case 0:
			goEdit(0);
			break;
		case 1:
			goEdit(1);
			break;
		// ͨ���Ի���ѡ���Ա�choseDialog����
		case 2: {
			String[] sex = { "��", "Ů" };
			String title = "�Ա�";
			choseDialog(2, sex, title);
			break;
		}
		case 3:
			goEdit(3);
			break;
		case 4:
			goEdit(4);
			break;
		case 5:
			goEdit(5);
			break;
		case 6:
			goEdit(6);
			break;
		default:
			break;
		}
	}

	// �����ݸ�Activity��ͨ��fragmentת��Ϊ�༭ҳ��
	private void goEdit(int position) {
		listener.goPersonDataEdit(position);
	}

	// ����ѡ��Ի���
	int yourChose = -1;

	private void choseDialog(final int position, final String[] choseItem,
			String title) {
		yourChose = -1;
		AlertDialog.Builder sinChosDia = new AlertDialog.Builder(getActivity());
		sinChosDia.setTitle(title);
		sinChosDia.setSingleChoiceItems(choseItem, 0,
				new DialogInterface.OnClickListener() {
					@Override
					public void onClick(DialogInterface dialog, int which) {
						yourChose = which;
					}
				});
		sinChosDia.setPositiveButton("ȷ��",
				new DialogInterface.OnClickListener() {

					@Override
					public void onClick(DialogInterface dialog, int which) {
						if (yourChose != -1) {
							View item = li_personData.getChildAt(position);
							TextView value = (TextView) item
									.findViewById(R.id.value);
							String new_data = choseItem[yourChose];
							value.setText(new_data);
						}
					}
				});
		sinChosDia.create().show();
	}
}
