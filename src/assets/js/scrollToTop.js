'use strict';

const btnScrollToTop = document.querySelector('.js-scroll-to-top');
console.log(btnScrollToTop);

checkForScrolling(btnScrollToTop);

function checkForScrolling(elem) {
	fadeBtnScrollToTop(elem, window.scrollY);

	document.addEventListener('scroll', function(e) {
		fadeBtnScrollToTop(elem, window.scrollY);
	})
}

function fadeBtnScrollToTop(elem, offset) {

	console.log(elem);
	console.log(offset);

	if(offset >= 500) {
		elem.classList.add('fade-in');
	}
	else {
		elem.classList.remove('fade-in');
		// elem.classList.add('fade-out');
		// setTimeout(function() {
		// 	elem.classList.remove('fade-out');
		// }, 500 )
	}

}

btnScrollToTop.addEventListener('click', function() {

	window.scrollTo({
		top: 0,
		left: 0,
		behavior: "smooth"
	})

} )
