function image_rect(div, rect_width, rect_height, imgx, imgy) {
	var x = rect_width * imgx;
	var y = rect_height * imgy;
	var offsets = '-' + x + 'px -' + y + 'px';
    div.style.backgroundPosition = offsets;
}