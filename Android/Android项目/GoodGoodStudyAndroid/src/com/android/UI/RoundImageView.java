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
 * 1.圆形ImageView，可设置最多两个宽度不同且颜色不同的圆形边框 设置颜色 ，在xml布局文件中由自定义属性配置参数指定
 *
 */
public class RoundImageView extends ImageView {
	// 初始化参数
	private Context mContext;
	private int mBorderThickness = 0; // 外边框
	private int defaultColor = 0xFFFFFFFF;
	// 如果只有其中一个有值，则只画一个圆形边框
	private int mBorderOutsideColor = 0;
	private int mBorderInsideColor = 0;
	// 控件默认长、宽
	private int defaultWidth = 0;
	private int defaultHeight = 0;

	// 多个构造函数
	public RoundImageView(Context context, AttributeSet attrs) {
		super(context, attrs);
		mContext = context;
		setCustomAttributes(attrs);
	}

	// 多个构造函数
	public RoundImageView(Context context) {
		super(context);
		mContext = context;
	}

	// 设置自定义属性
	private void setCustomAttributes(AttributeSet attrs) {
		// 获得实例
		TypedArray a = mContext.obtainStyledAttributes(attrs,
				R.styleable.roundedimageview);
		// 从typeArray获取相应值，第二个参数为默认值，如第一个参数在atts.xml中没有定义，返回第二个参数值
		mBorderThickness = a.getDimensionPixelSize(
				R.styleable.roundedimageview_border_thickness, 0);
		mBorderOutsideColor = a
				.getColor(R.styleable.roundedimageview_border_outside_color,
						defaultColor);
		mBorderInsideColor = a.getColor(
				R.styleable.roundedimageview_border_inside_color, defaultColor);
		//回收，资源利用，防止缓存引起的错误 
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
				&& mBorderOutsideColor != defaultColor) {// 定义画两个边框，分别为外圆边框和内圆边框
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2 - 2 * mBorderThickness;
			// 画内圆
			drawCircleBorder(canvas, radius + mBorderThickness / 2,
					mBorderInsideColor);
			// 画外圆
			drawCircleBorder(canvas, radius + mBorderThickness
					+ mBorderThickness / 2, mBorderOutsideColor);
		} else if (mBorderInsideColor != defaultColor
				&& mBorderOutsideColor == defaultColor) {// 定义画一个边框
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2 - mBorderThickness;
			drawCircleBorder(canvas, radius + mBorderThickness / 2,
					mBorderInsideColor);
		} else if (mBorderInsideColor == defaultColor
				&& mBorderOutsideColor != defaultColor) {// 定义画一个边框
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2 - mBorderThickness;
			drawCircleBorder(canvas, radius + mBorderThickness / 2,
					mBorderOutsideColor);
		} else {// 没有边框
			radius = (defaultWidth < defaultHeight ? defaultWidth
					: defaultHeight) / 2;
		}
		Bitmap roundBitmap = getCroppedRoundBitmap(bitmap, radius);
		canvas.drawBitmap(roundBitmap, defaultWidth / 2 - radius, defaultHeight
				/ 2 - radius, null);
	}

	/**
	 * 获取裁剪后的圆形图片
	 * 
	 * @param radius半径
	 */
	public Bitmap getCroppedRoundBitmap(Bitmap bmp, int radius) {
		int diameter = radius * 2; // 最终图片直径大小
		// 为了防止宽高不相等，造成圆形图片变形，因此截取长方形中处于中间位置最大的正方形图片
		int bmpWidth = bmp.getWidth();
		int bmpHeight = bmp.getHeight();
		int squareEdge = 0;
		int x = 0, y = 0;
		Bitmap squareBitmap;
		Bitmap scaledSrcBmp;
		if (bmpHeight > bmpWidth) {
			// 高大于宽，以宽为基准
			squareEdge = bmpWidth;
			x = 0;
			y = (bmpHeight - bmpWidth) / 2;
			// 截取正方形图片
			/**
			 * bmp：资源， x和y决定起始位置 ，x方向的长度 ，y方向的长度
			 */
			squareBitmap = Bitmap.createBitmap(bmp, x, y, squareEdge,
					squareEdge);
		} else if (bmpHeight < bmpWidth) {
			// 宽大于高，以高为基准
			squareEdge = bmpHeight;
			x = (bmpWidth - bmpHeight) / 2;
			y = 0;
			squareBitmap = Bitmap.createBitmap(bmp, x, y, squareEdge,
					squareEdge);
		} else {
			squareBitmap = bmp;
		}

		// 如果图片的大小与设定的圆的直径不相同
		if (squareBitmap.getWidth() != diameter
				|| squareBitmap.getHeight() != diameter) {
			scaledSrcBmp = Bitmap.createScaledBitmap(squareBitmap, diameter,
					diameter, true);
		} else {
			scaledSrcBmp = squareBitmap;
		}
		
		Paint paint = initPaint();

		// 画一个与获得图片同样大小的新位图
		//ARGB_8888 每个8位，代表32位ARGB位图
		Bitmap output = Bitmap.createBitmap(scaledSrcBmp.getWidth(),
				scaledSrcBmp.getHeight(), Config.ARGB_8888);

		// 将得到的第二张正方形图放入画布中
		Canvas canvas = new Canvas(output);
		canvas.drawARGB(0, 0, 0, 0);
		canvas.drawCircle(scaledSrcBmp.getWidth() / 2,
				scaledSrcBmp.getHeight() / 2, scaledSrcBmp.getWidth() / 2,
				paint);
		
		//在已有的图像上绘图将会在其上面添加一层新的形状。
		//如果新的Paint是完全不透明的，那么它将完全遮挡住下面的Paint； 
		//而setXfermode就可以来解决这个问题
		//Mode.SRC_IN：取两层图像交集部门,只显示上层图像 
		paint.setXfermode(new PorterDuffXfermode(Mode.SRC_IN));
		

		// 获得一个和正方形图一样的大小的区域
		Rect rect = new Rect(0, 0, scaledSrcBmp.getWidth(),
				scaledSrcBmp.getHeight());
		//就是在图片output上面绘制图片scaledSrcBmp时 处理两者相交时候显示的问题 
		canvas.drawBitmap(scaledSrcBmp, rect, rect, paint);
		
		bmp = null;
		squareBitmap = null;
		scaledSrcBmp = null;

		return output;
	}

	/**
	 * 边缘画圆
	 */
	private void drawCircleBorder(Canvas canvas, int radius, int color) {
		Paint paint = initPaint();
		paint.setColor(color);
		// 设置paint的　style　为STROKE：空心 ；这样就可以显示成内外两条边框
		paint.setStyle(Paint.Style.STROKE);
		// 设置paint的外框宽度
		paint.setStrokeWidth(mBorderThickness);
		// 参数为：x，y原点坐标；半径，画笔
		canvas.drawCircle(defaultWidth / 2, defaultHeight / 2, radius, paint);
	}

	/**
	 * 初始化画笔
	 */
	private Paint initPaint() {
		Paint paint = new Paint();
		// 设置是否使用抗锯齿功能，会消耗较大资源，绘制图形速度会变慢。
		paint.setAntiAlias(true);
		// 对位图进行滤波处理。
		paint.setFilterBitmap(true);
		// 设定是否使用图像抖动处理，会使绘制出来的图片颜色更加平滑和饱满，图像更加清晰
		paint.setDither(true);
		return paint;
	}
}
