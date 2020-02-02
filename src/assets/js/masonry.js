import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import imagesLoaded from '../../../node_modules/imagesloaded';
import Masonry from 'masonry-layout';

// make Masonry a jQuery plugin
jQueryBridget( 'masonry', Masonry, $ );
jQueryBridget( 'imagesLoaded', imagesLoaded, $ );

// now you can use $().masonry()
let $grid = $('.grid').masonry({
	// set itemSelector so .grid-sizer is not used in layout
	itemSelector: '.grid-item',
	// use element for option
	columnWidth: '.grid-sizer',
	percentPosition: true
});

$grid.on( 'layoutComplete', function() {
	// Your settings
});

$grid.imagesLoaded().progress( function() {
 	$grid.masonry('layout');
});
