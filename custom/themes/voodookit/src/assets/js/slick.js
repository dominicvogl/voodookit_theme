import $ from 'jquery';
import 'slick-slider';

const testval = $('body p');

console.log( testval );
console.log( 'TEST' );

$('.slick-slider').slick({
	'slidesToShow': 1,
	infinite: true,
});
