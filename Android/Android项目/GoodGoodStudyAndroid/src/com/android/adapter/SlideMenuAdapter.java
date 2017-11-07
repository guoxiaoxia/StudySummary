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

	//构造函数，将上下文和ListView的子项布局list_item的id和数据传递进来
	public SlideMenuAdapter(Context context, int listItemResourceId,
			List<SlideMenu> objects) {
		super(context, listItemResourceId, objects);
		resourceId = listItemResourceId;		
	}
	
	//重写getView（）方法，在子项被滚到屏幕内时调用
	@SuppressLint("ViewHolder")
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		SlideMenu slideMenu = getItem(position);//获取当前项额SlideMenu实例
		//加载ListView子项布局，与Activity中的setContentView（）同理
		View view = LayoutInflater.from(getContext()).inflate(resourceId, null);
		//初始化视图
		ImageView menuImage = (ImageView) view.findViewById(R.id.imgv_menu_samllTab);
		TextView menuText = (TextView) view.findViewById(R.id.tv_menu_subject);
		//初始化数据
		menuImage.setImageResource(slideMenu.getImageId());
		menuText.setText(slideMenu.getSubject());
		return view;
	}

}
