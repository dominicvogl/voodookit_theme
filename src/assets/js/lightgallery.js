'use strict';
const lightGallery = require('lightgallery/dist/js/lightgallery.min');
const Thumbnail = require('lightgallery/modules/lg-thumbnail');

$(document).ready(function() {
	$(".js-lightgallery").each( function() {
		$(this).lightGallery( {
			// options
			thumbnail: true,
			download: false
		})
	} );
});
