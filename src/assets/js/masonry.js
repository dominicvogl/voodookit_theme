import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';

// make Masonry a jQuery plugin
jQueryBridget( 'masonry', Masonry, $ );

// now you can use $().masonry()
$('.grid').masonry({
	columnWidth: 200,
});
