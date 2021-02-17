// add event listener
document.addEventListener('DOMContentLoaded', function () {

	generateLinkList( $('.js--table_of_contents') );
	// generateLinkList( $('.navigation.mobile') );
	onepageScroll();

	/**
	 * Generate Linklist for NavigationT
	 * @param $this
	 */

	function generateLinkList($this) {
		var linklist = '';

		$('body').find('[data-anchor]').each(function (index) {
			var $elm = $(this)
				, nr = index + 1
			;

			$elm.attr('data-scroll-index', nr);
			var elemContent = $(this).find('h2').html();
			// console.info(elemContent);
			if (elemContent !== undefined) {
				elemContent = elemContent.replace('-', ' ');
				linklist += '<li><a data-scroll-nav="' + nr + '">' + elemContent + '</a></li>';
			}

		});

		$this.html(linklist);
	}


	/**
	 * Function for Scrolling down on click
	 */

	function onepageScroll() {
		var $root = $('html, body');
		// var $btn_down = $('.btn-go-down');

		$('a[data-scroll-nav]').on('click', function (e) {
			var indexTarget = $(this).attr('data-scroll-nav');
			var offset = $root.find('[data-scroll-index="' + indexTarget + '"]').offset();

			$('html, body').animate({
				scrollTop: offset.top - 50
			}, 'slow');

			e.preventDefault();

		});
	}
});
