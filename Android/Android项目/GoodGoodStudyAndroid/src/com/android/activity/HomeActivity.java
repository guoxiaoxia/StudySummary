package com.android.activity;

import java.util.ArrayList;
import java.util.List;

import com.android.adapter.BannerAdapter;
import com.android.adapter.SlideMenuAdapter;
import com.android.base.BaseActivity;
import com.android.bean.SlideMenu;

import android.content.Intent;
import android.os.Bundle;
import android.os.SystemClock;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.support.v4.widget.DrawerLayout;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.LinearLayout.LayoutParams;
import android.widget.ListView;

public class HomeActivity extends BaseActivity implements
		ListView.OnItemClickListener {

	// 声明控件
	private DrawerLayout drawerLayout;
	private ImageView icSlideMenu;
	private ViewPager vpbanner;
	private List<ImageView> imageViewContainer;
	private LinearLayout liSmallCircle;

	private LinearLayout linearSlideMenu;
	private ListView listViewMenu;
	private List<SlideMenu> slideMenuItemContainer;
	
	

	// ViewPager适配器与监听器
	private BannerAdapter bannerAdapter;
	private BannerListener bannerListener;
	// listViewMenu适配器
	private SlideMenuAdapter slideMenuAdapter;

	private int pointIndex = 0;// 圆圈标志位
	private boolean isStop = false;// 线程标志

	// 广告图素材
	private int[] bannerImages = { R.drawable.banner_home,
			R.drawable.banner_note, R.drawable.banner_3, R.drawable.banner_4 };

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_home);
		initView();
		initData();
		action();
	}

	@Override
	protected void onDestroy() {
		// 关闭定时器
		isStop = true;
		super.onDestroy();
	}

	// ----------------------------------初始化View操作----------------------------------------
	private void initView() {
		icSlideMenu = (ImageView) findViewById(R.id.imgv_slidemenu);
		vpbanner = (ViewPager) findViewById(R.id.vp_banner);
		liSmallCircle = (LinearLayout) findViewById(R.id.li_smallcircle);
		drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
		linearSlideMenu = (LinearLayout) findViewById(R.id.linear_slideMenu);
		listViewMenu = (ListView) findViewById(R.id.li_menu);
	}

	// ----------------------------------初始化数据操作----------------------------------------
	/**
	 * 初始化数据 1.将图片资源添加到imageViewContainer中作为数据源 2.每添加一张图片，就在线性布局中添加小圆圈指示的视图
	 * 这样在vpbanner就可以通过Adapter动态的添加和删除imageView了
	 */
	private void initData() {

		imageViewContainer = new ArrayList<ImageView>();
		initBannerData();// 建立广告栏的数据源
		bannerAdapter = new BannerAdapter(imageViewContainer);
		vpbanner.setAdapter(bannerAdapter);

		slideMenuItemContainer = new ArrayList<SlideMenu>();
		initSlideMenuData();// 建立菜单列表的数据源
		slideMenuAdapter = new SlideMenuAdapter(HomeActivity.this,
				R.layout.slide_meun_list_item, slideMenuItemContainer);
		listViewMenu.setAdapter(slideMenuAdapter);

	}

	/**
	 * 建立广告栏的数据源
	 */
	private void initBannerData() {
		View view;
		LayoutParams params;
		for (int i = 0; i < bannerImages.length; i++) {
			// 设置广告图
			ImageView imageView = new ImageView(HomeActivity.this);
			imageView.setLayoutParams(new LayoutParams(
					LayoutParams.MATCH_PARENT, LayoutParams.MATCH_PARENT));
			imageView.setBackgroundResource(bannerImages[i]);
			imageViewContainer.add(imageView);
			// 设置圆圈点
			view = new View(HomeActivity.this);
			params = new LayoutParams(10, 10);
			params.leftMargin = 10;
			view.setBackgroundResource(R.drawable.slt_smallcircle);
			view.setLayoutParams(params);
			view.setEnabled(false);
			liSmallCircle.addView(view);
		}
	}

	/**
	 * 建立菜单列表的数据源
	 */
	private void initSlideMenuData() {
		SlideMenu message = new SlideMenu(R.drawable.ic_menu_message, "我的消息");
		slideMenuItemContainer.add(message);
		SlideMenu score = new SlideMenu(R.drawable.ic_menu_score, "我的积分");
		slideMenuItemContainer.add(score);
		SlideMenu personDate = new SlideMenu(R.drawable.ic_menu_person_date,
				"个人资料");
		slideMenuItemContainer.add(personDate);
		SlideMenu resetPassword = new SlideMenu(
				R.drawable.ic_menu_reset_password, "修改密码");
		slideMenuItemContainer.add(resetPassword);
		SlideMenu setting = new SlideMenu(R.drawable.ic_menu_setting, "设置");
		slideMenuItemContainer.add(setting);
	}

	// ----------------------------------初始化事件----------------------------------------
	private void action() {

		btSlideMenuOpen();// 设置侧滑菜单的按钮监听事件,点击弹出菜单

		changeBanner();// 设置换页的时候的监听事件
		beginThreadChangeBanner();// 通过子线程定时切换Banner的图片

		listViewMenu.setOnItemClickListener(this);// 菜单列表加载监听器

	}

	/********************************** 广告栏 ****************************************/
	private void changeBanner() {
		// 设置换页的时候的监听事件
		bannerListener = new BannerListener();
		vpbanner.setOnPageChangeListener(bannerListener);

		// 取中间数来作为起始位置，因为需要左右滑动，
		// 不直接(Integer.MAX_VALUE / 2，是因为这样可能不是从第一张图片开始，所以中间要往前移到第一张图片
		int index = (Integer.MAX_VALUE / 2)
				- (Integer.MAX_VALUE / 2 % imageViewContainer.size());

		// 初始化当前页面 ,切换小圆圈的样式
		vpbanner.setCurrentItem(index);
		liSmallCircle.getChildAt(pointIndex).setEnabled(true);

	}

	/**
	 * 内部类：实现VierPager监听器接口
	 */
	class BannerListener implements OnPageChangeListener {

		@Override
		public void onPageScrollStateChanged(int arg0) {
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {
		}

		// 更改小圆圈样式
		@Override
		public void onPageSelected(int position) {
			int newPosition = position % bannerImages.length;
			liSmallCircle.getChildAt(newPosition).setEnabled(true);
			liSmallCircle.getChildAt(pointIndex).setEnabled(false);
			// 更新标志位
			pointIndex = newPosition;
		}
	}

	private void beginThreadChangeBanner() {
		// 开启新线程，3秒一次更新Banner
		new Thread(new Runnable() {

			@Override
			public void run() {
				while (!isStop) {
					SystemClock.sleep(3000);
					// 因为子线程不能直接更新UI元素，所以调用runOnUiThread（）API实现
					runOnUiThread(new Runnable() {
						@Override
						public void run() {
							vpbanner.setCurrentItem(vpbanner.getCurrentItem() + 1);
						}
					});
				}
			}
		}).start();
	}

	/********************************** 侧滑菜单 *******************************************/

	// 设置侧滑菜单的按钮监听事件,点击弹出菜单
	private void btSlideMenuOpen() {
		icSlideMenu.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				drawerLayout.openDrawer(linearSlideMenu);
			}
		});
	}

	@Override
	public void onItemClick(AdapterView<?> parent, View view, int position,
			long id) {
		// 根据位置获取对象，position是从0开始
		switch (position) {
		case 0:
			Log.i("0", "success");
			break;
		case 1:
			Log.i("1", "success");
			break;
		case 2: {
			drawerLayout.closeDrawer(linearSlideMenu);
			Intent intent = new Intent(HomeActivity.this,
					PersonDataActivity.class);
			startActivity(intent);
			break;
		}
		case 3:
			Log.i("3", "success");
			break;
		case 4:
			Log.i("4", "success");
			break;
		default:
			Log.i("5", "success");
			break;
		}
	}
	
	/**********************************底部导航栏*******************************************/
	
	
}