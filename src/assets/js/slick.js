(function ($) {

	$(function () {

		$('.js-slick-slider').each(function () {

			var slider = $(this);

			slider.slick({
				// options
				mobileFirst: true,
				prevArrow: '<button class="slick-arrow slick-prev"><svg class="sprite sprite--arrow-left">\n' +
					'\t\t\t<use xlink:href="'+location.protocol+'//'+location.hostname+'/custom/themes/voodookit/dist/assets/svg/sprite-symbol.svg#arrow-left"></use>\n' +
					'\t\t</svg></button>',
				nextArrow: '<button class="slick-arrow slick-next"><svg class="sprite sprite--arrow-right slick-next">\n' +
					'\t\t\t<use xlink:href="'+location.protocol+'//'+location.hostname+'/custom/themes/voodookit/dist/assets/svg/sprite-symbol.svg#arrow-right"></use>\n' +
					'\t\t</svg></button>',
			});

			$('.sprite--arrow-right').on('click', function () {
				slider.slick('slickNext');
			})
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

	});

}(jQuery));
