'use strict';
const slick = require('slick-carousel');


$('.js-slick-slider').each(function () {

	var slider = $(this);

	slider.slick({
		// options
		mobileFirst: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		prevArrow: '<button class="slick-arrow slick-prev"><span class="icon-keyboard_arrow_left"></span></button>',
		nextArrow: '<button class="slick-arrow slick-next"><span class="icon-keyboard_arrow_right"></span></button>',
	});

	$('.sprite--arrow-right').on('click', function () {
		slider.slick('slickNext');
	})
});

$('.js-pageloop-carousel').each(function () {

	$(this).slick(
		{
			mobileFirst: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			centerMode: true,
			variableWidth: true,
			prevArrow: '<button class="slick-arrow slick-prev"><span class="icon-keyboard_arrow_left"></span></button>',
			nextArrow: '<button class="slick-arrow slick-next"><span class="icon-keyboard_arrow_right"></span></button>',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				}
			]
		}
	)

});


$('.js-postloop-carousel').each(function () {

	$(this).slick(
		{
			// options
			slidesToScroll: 1,
			slidesToShow: 1,
			mobileFirst: true,
			variableWidth: true,
			infinite: false,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1
					}
				}
			]
		}
	)

});

// (function ($) {
//
// 	$(function () {
//
//
//
//
// 	});
//
// }(jQuery));


