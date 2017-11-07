package com.android.UI;

import com.android.activity.R;
import android.content.Context;
import android.content.res.TypedArray;
import android.graphics.Bitmap;
import android.graphics.Bitmap.Config;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.graphics.PorterDuff.Mode;
import android.graphics.PorterDuffXfermode;
import android.graphics.Rect;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.graphics.drawable.NinePatchDrawable;
import android.util.AttributeSet;
import android.widget.ImageView;

/**
 * 1.Բ��ImageView�����������������Ȳ�ͬ����ɫ��ͬ��Բ�α߿� ������ɫ ����xml�����ļ������Զ����������ò���ָ��
 *
 */
public class RoundImageView extends ImageView {
	// ��ʼ������
	private Context mContext;
	private int mBorderThickness = 0; // ��߿�
	private int defaultColor = 0xFFFFFFFF;
	// ���ֻ������һ����ֵ����ֻ��һ��Բ�α߿�
	private int mBorderOutsideColor = 0;
	private int mBorderInsideColor = 0;
	// �ؼ�Ĭ�ϳ�����
	private int defaultWidth = 0;
	private int defaultHeight = 0;

	// ������캯��
	public RoundImageView(Context context, AttributeSet attrs) {
		super(context, attrs);
		mContext = context;
		setCustomAttributes(attrs);
	}

	// ������캯��
	public RoundImageView(Context context) {
		super(context);
		mContext = context;
	}

	// �����Զ�������
	private void setCustomAttributes(AttributeSet attrs) {
		// ���ʵ��
		TypedArray a = mContext.obtainStyledAttributes(attrs,
				R.styleable.roundedimageview);
		// ��typeArray��ȡ��Ӧֵ���ڶ�������ΪĬ��ֵ�����һ��������atts.xml��û�ж��壬���صڶ�������ֵ
		mBorderThickness = a.getDimensionPixelSize(
				R.styleable.roundedimageview_border_thickness, 0);
		mBorderOutsideColor = a
				.getColor(R.styleable.roundedimageview_border_outside_color,
						defaultColor);
		mBorderInsideColor = a.getColor(
				R.styleable.roundedimageview_border_inside_color, defaultColor);
		//���գ���Դ���ã���ֹ��������Ĵ��� 
		a.recycle();
	}

	@Override
	protected void onDraw(Canvas canvas) {
		Drawable drawable = getDrawable();
		if (drawable == null) {
			return;
		}
		if (getWidth() == 0 || getHeight() == 0) {
			return;
		}
		this.measure(0, 0);
		if (drawable.getClass() == NinePatchDrawable.class)
			return;
		
		Bitmap b = ((BitmapDrawable) drawable).getBitmap();
		Bitmap bitmap = b.copy(Bitmap.Config.ARGB_8888, true);
		if (defaultWidth == 0) {
			defaultWidth = getWidth();
		}
		if (defaultHeight == 0) {
			defaultHeight = getHeight();
		}
		
		int radius = 0;
		if (mBorderInsideColor != defaultColor
				&& mBorderOutsideColor != defaultColor) {// ���廭�����߿򣬷ֱ�Ϊ��Բ�߿����Բ�߿�
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2 - 2 * mBorderThickness;
			// ����Բ
			drawCircleBorder(canvas, radius + mBorderThickness / 2,
					mBorderInsideColor);
			// ����Բ
			drawCircleBorder(canvas, radius + mBorderThickness
					+ mBorderThickness / 2, mBorderOutsideColor);
		} else if (mBorderInsideColor != defaultColor
				&& mBorderOutsideColor == defaultColor) {// ���廭һ���߿�
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2 - mBorderThickness;
			drawCircleBorder(canvas, radius + mBorderThickness / 2,
					mBorderInsideColor);
		} else if (mBorderInsideColor == defaultColor
				&& mBorderOutsideColor != defaultColor) {// ���廭һ���߿�
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2 - mBorderThickness;
			drawCircleBorder(canvas, radius + mBorderThickness / 2,
					mBorderOutsideColor);
		} else {// û�б߿�
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2;
		}
		Bitmap roundBitmap = getCroppedRoundBitmap(bitmap, radius);
		canvas.drawBitmap(roundBitmap, defaultWidth / 2 - radius, defaultHeight
				/ 2 - radius, null);
	}

	/**
	 * ��ȡ�ü����Բ��ͼƬ
	 * 
	 * @param radius�뾶
	 */
	public Bitmap getCroppedRoundBitmap(Bitmap bmp, int radius) {
		int diameter = radius * 2; // ����ͼƬֱ����С
		// Ϊ�˷�ֹ��߲���ȣ����Բ��ͼƬ���Σ���˽�ȡ�������д����м�λ������������ͼƬ
		int bmpWidth = bmp.getWidth();
		int bmpHeight = bmp.getHeight();
		int squareEdge = 0;
		int x = 0, y = 0;
		Bitmap squareBitmap;
		Bitmap scaledSrcBmp;
		if (bmpHeight > bmpWidth) {
			// �ߴ��ڿ��Կ�Ϊ��׼
			squareEdge = bmpWidth;
			x = 0;
			y = (bmpHeight - bmpWidth) / 2;
			// ��ȡ������ͼƬ
			/**
			 * bmp����Դ�� x��y������ʼλ�� ��x����ĳ��� ��y����ĳ���
			 */
			squareBitmap = Bitmap.createBitmap(bmp, x, y, squareEdge,
					squareEdge);
		} else if (bmpHeight < bmpWidth) {
			// ����ڸߣ��Ը�Ϊ��׼
			squareEdge = bmpHeight;
			x = (bmpWidth - bmpHeight) / 2;
			y = 0;
			squareBitmap = Bitmap.createBitmap(bmp, x, y, squareEdge,
					squareEdge);
		} else {
			squareBitmap = bmp;
		}

		// ���ͼƬ�Ĵ�С���趨��Բ��ֱ������ͬ
		if (squareBitmap.getWidth() != diameter
				|| squareBitmap.getHeight() != diameter) {
			scaledSrcBmp = Bitmap.createScaledBitmap(squareBitmap, diameter,
					diameter, true);
		} else {
			scaledSrcBmp = squareBitmap;
		}
		
		Paint paint = initPaint();

		// ��һ������ͼƬͬ����С����λͼ
		//ARGB_8888 ÿ��8λ������32λARGBλͼ
		Bitmap output = Bitmap.createBitmap(scaledSrcBmp.getWidth(),
				scaledSrcBmp.getHeight(), Config.ARGB_8888);

		// ���õ��ĵڶ���������ͼ���뻭����
		Canvas canvas = new Canvas(output);
		canvas.drawARGB(0, 0, 0, 0);
		canvas.drawCircle(scaledSrcBmp.getWidth() / 2,
				scaledSrcBmp.getHeight() / 2, scaledSrcBmp.getWidth() / 2,
				paint);
		
		//�����е�ͼ���ϻ�ͼ���������������һ���µ���״��
		//����µ�Paint����ȫ��͸���ģ���ô������ȫ�ڵ�ס�����Paint�� 
		//��setXfermode�Ϳ���������������
		//Mode.SRC_IN��ȡ����ͼ�񽻼�����,ֻ��ʾ�ϲ�ͼ�� 
		paint.setXfermode(new PorterDuffXfermode(Mode.SRC_IN));
		

		// ���һ����������ͼһ���Ĵ�С������
		Rect rect = new Rect(0, 0, scaledSrcBmp.getWidth(),
				scaledSrcBmp.getHeight());
		//������ͼƬoutput�������ͼƬscaledSrcBmpʱ ���������ཻʱ����ʾ������ 
		canvas.drawBitmap(scaledSrcBmp, rect, rect, paint);
		
		bmp = null;
		squareBitmap = null;
		scaledSrcBmp = null;

		return output;
	}

	/**
	 * ��Ե��Բ
	 */
	private void drawCircleBorder(Canvas canvas, int radius, int color) {
		Paint paint = initPaint();
		paint.setColor(color);
		// ����paint�ġ�style��ΪSTROKE������ �������Ϳ�����ʾ�����������߿�
		paint.setStyle(Paint.Style.STROKE);
		// ����paint�������
		paint.setStrokeWidth(mBorderThickness);
		// ����Ϊ��x��yԭ�����ꣻ�뾶������
		canvas.drawCircle(defaultWidth / 2, defaultHeight / 2, radius, paint);
	}

	/**
	 * ��ʼ������
	 */
	private Paint initPaint() {
		Paint paint = new Paint();
		// �����Ƿ�ʹ�ÿ���ݹ��ܣ������Ľϴ���Դ������ͼ���ٶȻ������
		paint.setAntiAlias(true);
		// ��λͼ�����˲�����
		paint.setFilterBitmap(true);
		// �趨�Ƿ�ʹ��ͼ�񶶶�������ʹ���Ƴ�����ͼƬ��ɫ����ƽ���ͱ�����ͼ���������
		paint.setDither(true);
		return paint;
	}
}
