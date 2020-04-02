var mybutton = document.querySelector(".scroll-top-btn");

window.setTimeout(function() {
	document.querySelector("#navigation").style.visibility = "visible";
}, 400);

function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}

document.addEventListener("touchstart", onTouchStart, { passive: true });
