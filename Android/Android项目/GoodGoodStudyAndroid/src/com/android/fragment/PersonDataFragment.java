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
	// 初始化
	private View view;
	private TextView tv_title;
	private ListView li_personData;
	private SimpleAdapter adapter_personData;
	private List<Map<String, Object>> dataList_personData;

	public PersonDataListener listener;

	// 内部接口
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
		getPersonData();// 建立个人信息的数据源
		adapter_personData = new SimpleAdapter(getActivity(),
				dataList_personData, R.layout.person_data_list_item,
				new String[] { "smallTitle", "next" }, new int[] {
						R.id.samllTitle, R.id.edit });
		li_personData.setAdapter(adapter_personData);
	}

	// 获取数据源
	private void getPersonData() {
		String[] data = { "头像", "昵称", "性别", "城市", "学校", "签名", "邮箱" };
		for (int i = 0; i < data.length; i++) {
			Map<String, Object> map = new HashMap<String, Object>();
			map.put("smallTitle", data[i]);
			map.put("next", ">");
			dataList_personData.add(map);
		}
	}

	// ----------------------action--------------------------------------
	private void action() {
		// 设置标题为个人资料
		tv_title.setText("个人资料");

		// 个人信息列表加载监听器
		li_personData.setOnItemClickListener(this);
	}

	@Override
	public void onItemClick(AdapterView<?> parent, View view, int position,
			long id) {
		// 根据位置获取对象，position是从0开始
		// intent()参数：1>上下文：访问不到，要用全局对象; 2>目标文件
		switch (position) {
		case 0:
			goEdit(0);
			break;
		case 1:
			goEdit(1);
			break;
		// 通过对话框选择性别，choseDialog（）
		case 2: {
			String[] sex = { "男", "女" };
			String title = "性别";
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

	// 传数据给Activity，通过fragment转换为编辑页面
	private void goEdit(int position) {
		listener.goPersonDataEdit(position);
	}

	// 单项选择对话框
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
		sinChosDia.setPositiveButton("确定",
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
