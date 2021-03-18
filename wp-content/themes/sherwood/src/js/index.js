/**
 * Main entry file
 *
 * @package sherwood
 */

// import "regenerator-runtime/runtime";
import u from './utilities';
import Vue from 'vue';

// vue components.
import navigation from './components/navigation.vue';
import background from './components/background.vue';

new Vue({
	el: '#main',
	components: {
		navigation,
		background
	}
});


const vh = window.innerHeight * 0.01;
const nav = document.getElementById('primaryNav');
document.documentElement.style.setProperty('--vh', `${vh}px`);
document.documentElement.style.setProperty('--nav-height', nav.offsetHeight + 'px');

addEventListener('scroll', e => nav.classList[pageYOffset > nav.offsetHeight ? 'add' : 'remove']('scrolled'));

const checkBackdropFilterSupport = () => {
	// add no-backdrop-filter class to if CSS.support isnt supported or if backdrop-filter isnt supported
	if (
		('CSS' in window && 'supports' in window.CSS)
		&& (window.CSS.supports('backdrop-filter', 'blur(10px)') || window.CSS.supports('-webkit-backdrop-filter', 'blur(10px)'))
	) {
		return true;
	} else {
		document.documentElement.classList.add('no-backdrop-filter');
		console.log("browser doesn't support backdrop-filter");
		return false;
	}
};
checkBackdropFilterSupport();

(function($) {
	$('.wp-block-gallery:not(.reversed) .blocks-gallery-grid').each(function() {
		let $gallery = $(this);
		let $items = $gallery.find('.blocks-gallery-item');
		$items.on('click', function() {
			$(this).prependTo($gallery);
		});
	});
	$('.wp-block-gallery.reversed .blocks-gallery-grid').each(function() {
		let $gallery = $(this);
		let $items = $gallery.find('.blocks-gallery-item');
		$items.on('click', function() {
			$(this)[$(window).width() > 768 ? 'appendTo' : 'prependTo']($gallery);
		});
	});
}(jQuery));
