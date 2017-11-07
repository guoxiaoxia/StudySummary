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

	// �����ؼ�
	private DrawerLayout drawerLayout;
	private ImageView icSlideMenu;
	private ViewPager vpbanner;
	private List<ImageView> imageViewContainer;
	private LinearLayout liSmallCircle;

	private LinearLayout linearSlideMenu;
	private ListView listViewMenu;
	private List<SlideMenu> slideMenuItemContainer;
	
	

	// ViewPager�������������
	private BannerAdapter bannerAdapter;
	private BannerListener bannerListener;
	// listViewMenu������
	private SlideMenuAdapter slideMenuAdapter;

	private int pointIndex = 0;// ԲȦ��־λ
	private boolean isStop = false;// �̱߳�־

	// ���ͼ�ز�
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
		// �رն�ʱ��
		isStop = true;
		super.onDestroy();
	}

	// ----------------------------------��ʼ��View����----------------------------------------
	private void initView() {
		icSlideMenu = (ImageView) findViewById(R.id.imgv_slidemenu);
		vpbanner = (ViewPager) findViewById(R.id.vp_banner);
		liSmallCircle = (LinearLayout) findViewById(R.id.li_smallcircle);
		drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
		linearSlideMenu = (LinearLayout) findViewById(R.id.linear_slideMenu);
		listViewMenu = (ListView) findViewById(R.id.li_menu);
	}

	// ----------------------------------��ʼ�����ݲ���----------------------------------------
	/**
	 * ��ʼ������ 1.��ͼƬ��Դ��ӵ�imageViewContainer����Ϊ����Դ 2.ÿ���һ��ͼƬ���������Բ��������СԲȦָʾ����ͼ
	 * ������vpbanner�Ϳ���ͨ��Adapter��̬����Ӻ�ɾ��imageView��
	 */
	private void initData() {

		imageViewContainer = new ArrayList<ImageView>();
		initBannerData();// ���������������Դ
		bannerAdapter = new BannerAdapter(imageViewContainer);
		vpbanner.setAdapter(bannerAdapter);

		slideMenuItemContainer = new ArrayList<SlideMenu>();
		initSlideMenuData();// �����˵��б������Դ
		slideMenuAdapter = new SlideMenuAdapter(HomeActivity.this,
				R.layout.slide_meun_list_item, slideMenuItemContainer);
		listViewMenu.setAdapter(slideMenuAdapter);

	}

	/**
	 * ���������������Դ
	 */
	private void initBannerData() {
		View view;
		LayoutParams params;
		for (int i = 0; i < bannerImages.length; i++) {
			// ���ù��ͼ
			ImageView imageView = new ImageView(HomeActivity.this);
			imageView.setLayoutParams(new LayoutParams(
					LayoutParams.MATCH_PARENT, LayoutParams.MATCH_PARENT));
			imageView.setBackgroundResource(bannerImages[i]);
			imageViewContainer.add(imageView);
			// ����ԲȦ��
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
	 * �����˵��б������Դ
	 */
	private void initSlideMenuData() {
		SlideMenu message = new SlideMenu(R.drawable.ic_menu_message, "�ҵ���Ϣ");
		slideMenuItemContainer.add(message);
		SlideMenu score = new SlideMenu(R.drawable.ic_menu_score, "�ҵĻ���");
		slideMenuItemContainer.add(score);
		SlideMenu personDate = new SlideMenu(R.drawable.ic_menu_person_date,
				"��������");
		slideMenuItemContainer.add(personDate);
		SlideMenu resetPassword = new SlideMenu(
				R.drawable.ic_menu_reset_password, "�޸�����");
		slideMenuItemContainer.add(resetPassword);
		SlideMenu setting = new SlideMenu(R.drawable.ic_menu_setting, "����");
		slideMenuItemContainer.add(setting);
	}

	// ----------------------------------��ʼ���¼�----------------------------------------
	private void action() {

		btSlideMenuOpen();// ���ò໬�˵��İ�ť�����¼�,��������˵�

		changeBanner();// ���û�ҳ��ʱ��ļ����¼�
		beginThreadChangeBanner();// ͨ�����̶߳�ʱ�л�Banner��ͼƬ

		listViewMenu.setOnItemClickListener(this);// �˵��б���ؼ�����

	}

	/********************************** ����� ****************************************/
	private void changeBanner() {
		// ���û�ҳ��ʱ��ļ����¼�
		bannerListener = new BannerListener();
		vpbanner.setOnPageChangeListener(bannerListener);

		// ȡ�м�������Ϊ��ʼλ�ã���Ϊ��Ҫ���һ�����
		// ��ֱ��(Integer.MAX_VALUE / 2������Ϊ�������ܲ��Ǵӵ�һ��ͼƬ��ʼ�������м�Ҫ��ǰ�Ƶ���һ��ͼƬ
		int index = (Integer.MAX_VALUE / 2)
				- (Integer.MAX_VALUE / 2 % imageViewContainer.size());

		// ��ʼ����ǰҳ�� ,�л�СԲȦ����ʽ
		vpbanner.setCurrentItem(index);
		liSmallCircle.getChildAt(pointIndex).setEnabled(true);

	}

	/**
	 * �ڲ��ࣺʵ��VierPager�������ӿ�
	 */
	class BannerListener implements OnPageChangeListener {

		@Override
		public void onPageScrollStateChanged(int arg0) {
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {
		}

		// ����СԲȦ��ʽ
		@Override
		public void onPageSelected(int position) {
			int newPosition = position % bannerImages.length;
			liSmallCircle.getChildAt(newPosition).setEnabled(true);
			liSmallCircle.getChildAt(pointIndex).setEnabled(false);
			// ���±�־λ
			pointIndex = newPosition;
		}
	}

	private void beginThreadChangeBanner() {
		// �������̣߳�3��һ�θ���Banner
		new Thread(new Runnable() {

			@Override
			public void run() {
				while (!isStop) {
					SystemClock.sleep(3000);
					// ��Ϊ���̲߳���ֱ�Ӹ���UIԪ�أ����Ե���runOnUiThread����APIʵ��
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

	/********************************** �໬�˵� *******************************************/

	// ���ò໬�˵��İ�ť�����¼�,��������˵�
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
		// ����λ�û�ȡ����position�Ǵ�0��ʼ
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
	
	/**********************************�ײ�������*******************************************/
	
	
}