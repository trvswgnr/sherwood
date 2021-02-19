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
