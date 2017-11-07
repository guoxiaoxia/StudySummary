package com.android.adapter;

import java.util.List;
import com.android.activity.R;
import com.android.bean.SlideMenu;
import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class SlideMenuAdapter extends ArrayAdapter<SlideMenu>{
	
	private int resourceId;

	//���캯�����������ĺ�ListView�������list_item��id�����ݴ��ݽ���
	public SlideMenuAdapter(Context context, int listItemResourceId,
			List<SlideMenu> objects) {
		super(context, listItemResourceId, objects);
		resourceId = listItemResourceId;		
	}
	
	//��дgetView���������������������Ļ��ʱ����
	@SuppressLint("ViewHolder")
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		SlideMenu slideMenu = getItem(position);//��ȡ��ǰ���SlideMenuʵ��
		//����ListView����֣���Activity�е�setContentView����ͬ��
		View view = LayoutInflater.from(getContext()).inflate(resourceId, null);
		//��ʼ����ͼ
		ImageView menuImage = (ImageView) view.findViewById(R.id.imgv_menu_samllTab);
		TextView menuText = (TextView) view.findViewById(R.id.tv_menu_subject);
		//��ʼ������
		menuImage.setImageResource(slideMenu.getImageId());
		menuText.setText(slideMenu.getSubject());
		return view;
	}

}
