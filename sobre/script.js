window.onscroll = function() {
	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		mybutton.style.opacity = "1";
		mybutton.style.visibility = "visible";
		mybutton.style.display = "flex";
	} else {
		mybutton.style.opacity = "0";
		mybutton.style.visibility = "hidden";
		mybutton.style.display = "hidden";
	}
};
