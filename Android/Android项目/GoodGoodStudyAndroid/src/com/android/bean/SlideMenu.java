package com.android.bean;

public class SlideMenu {

	private int imageId;
	private String subject;

	public SlideMenu(int imageId, String subject) {
		this.imageId = imageId;
		this.subject = subject;
	}

	public int getImageId() {
		return imageId;
	}

	public String getSubject() {
		return subject;
	}

}
