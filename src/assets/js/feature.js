// import 'feature.js';

/**
 * Feature Detection Script
 *
 * @version 1.0.0
 * @var feature
 */

// Check if Javascript is active, overwrite no-js class
document.documentElement.className = "js";

// add message
console.info("%cThis site was build with love " + "%c(https://dominicvogl.de)", "", "color: #2199e8");

// check if svg is available in this browser
if(feature.svg){
	// ... or hust ad ".svg" to <html>
	document.documentElement.className += " svg";

} else {

	// when no svg is supportet change ".svg" to ".png"
	var imgs = document.getElementsByTagName('img');
	var endsWithDotSvg = /.*\.svg$/
	var i = 0;
	var l = imgs.length;
	for(; i != l; ++i) {
		if(imgs[i].src.match(endsWithDotSvg)) {
			imgs[i].src = imgs[i].src.slice(0, -3) + 'png';
		}
	}
}

// check touch support and render class to <html>
if(feature.touch) {
	document.documentElement.className += " touch";
}
else {
	document.documentElement.className += " no-touch";
}
