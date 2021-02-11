/**
 * Utilities
 *
 * Useful functions and pure JS replacements for commonly used jQuery.
 *
 * @package sherwood
 */

export default class u {};

u.camelToKebab = (string) => {
    return string.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
};

/**
 * Apply multiple styles to an element
 * @param {Object} obj Style object, (e.g. {position: 'absolute', height: '100%', lineHeight: 1.5}).
 */
HTMLElement.prototype.css = function(obj) {
	for (const key in obj) {
		this.style[key] = obj[key];
	}
	return this.style;
};

let lastScrollTop = 0;

/**
 * Check if scrolling up or down
 * @param {string} dir Direction to test. Accepts 'up' or 'down'
 */
u.scrollDirection = dir => {
	const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	const down = scrollTop > lastScrollTop;
	lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
	return dir.toLowerCase() === 'up' ? !down : down;
}

/**
 * Get distance from top of Document.
 */
HTMLElement.prototype.offset = function() {
	const rect       = this.getBoundingClientRect();
	const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
	const scrollTop  = window.pageYOffset || document.documentElement.scrollTop;
	return { top: Math.round(rect.top + scrollTop), left: Math.round(rect.left + scrollLeft) }
};

/**
 * Remove multiple styles from an element
 * @param  {(...string|string[])} } args 
 */
CSSStyleDeclaration.prototype.removeProperties = function(...args) {
	if (typeof args[0] !== 'string') args = args[0];
	for (const arg of args) this.removeProperty(u.camelToKebab(arg));
}

/**
 * Get exponent power of number
 * @param {int} exponent Exponent.
 */
Number.prototype.pow = function(exponent) {
	return Math.pow(this, exponent);
}

/**
 * Prevent number from going below or above set limits.
 * @param {int} min Min.
 * @param {int} max Max.
 */
Number.prototype.clamp = function(min, max) {
	return Math.min(Math.max(this, min), max);
};

u.cdn = file => `https://cdn.jsdelivr.net/gh/trvswgnr/cdn@latest/${file.replace(/^\/+|\/+$/g, '')}`;

/**
 * Slide Up
 * @param {HTMLElement} target - HTML element to target.
 * @param {int} duration - Animation duration.
 * @param {string} visibleClass - Class to toggle on target element.
 */
u.slideUp = (target, duration = 500, visibleClass = 'show') => {
	target.css({
		transitionProperty: 'height, margin, padding',
		transitionDuration: duration + 'ms',
		boxSizing: 'border-box',
		height: target.offsetHeight + 'px'
	});
	target.offsetHeight;
	target.css({
		overflow: 'hidden',
		height: 0,
		paddingTop: 0,
		paddingBottom: 0,
		marginTop: 0,
		marginBottom: 0
	});
	target.classList.remove(visibleClass);
	window.setTimeout(() => {
		target.style.display = 'none';
		target.style.removeProperties(
			'height',
			'padding-top',
			'padding-bottom',
			'margin-top',
			'margin-bottom',
			'overflow',
			'transition-duration',
			'transition-property'
		);
	}, duration);
};

/**
 * Slide Down
 * @param {HTMLElement} target - HTML element to target.
 * @param {int} duration - Animation duration.
 * @param {string} visibleClass - Class to toggle on target element.
 */
u.slideDown = (target, duration = 500, visibleClass = 'show') => {
	let display, height;
	target.style.removeProperty('display');
	display = window.getComputedStyle(target).display;

	if (display === 'none') {
		display = 'block';
	}

	target.style.display = display;
	target.classList.add(visibleClass);
	height = target.offsetHeight;
	target.css({
		overflow: 'hidden',
		height: 0,
		paddingTop: 0,
		paddingBottom: 0,
		marginTop: 0,
		marginBottom: 0
	});
	target.offsetHeight;
	target.css({
		boxSizing: 'border-box',
		transitionProperty: "height, margin, padding",
		transitionDuration: duration + 'ms',
		height: height + 'px'
	});
	target.style.removeProperties(
		'padding-top',
		'padding-bottom',
		'margin-top',
		'margin-bottom'
	);
	window.setTimeout(() => {
		target.style.removeProperties(
			'height',
			'overflow',
			'transition-duration',
			'transition-property'
		);
	}, duration);
};

/**
 * Slide Toggle
 * @param {string} target - HTML element to target.
 * @param {int} duration - Animation duration.
 * @param {string} visibleClass - Class to toggle on target element.
 */
u.slideToggle = (target, duration = 500, visibleClass = 'show') => {
	if (window.getComputedStyle(target).display === 'none') {
		return u.slideDown(target, duration, visibleClass);
	} else {
		return u.slideUp(target, duration, visibleClass);
	}
};

/**
 * Get the document height
 */
document.height = (() => {
	let content = document.querySelector('#content');
	content = content ? content.offsetHeight + content.offsetTop : 0;
	return Math.max( 
		document.body.scrollHeight,
		document.body.offsetHeight, 
		document.documentElement.clientHeight,
		document.documentElement.scrollHeight,
		document.documentElement.offsetHeight,
		content
	);
})();

/**
 * Execute function when the document is ready
 * @param {callable} fn - The function to execute.
 */
document.ready = fn => {
	// see if DOM is already available
	if (document.readyState === 'complete' || document.readyState === 'interactive') {
		// call on next available tick
		setTimeout(fn, 1);
	} else {
		document.addEventListener('DOMContentLoaded', fn);
	}
}

/**
 * Classes added to body via PHP
 * 
 * @see classes/class-theme.php Theme::conditional_classes()
 */
u.isDesktop = (() => document.body.classList.contains('is-desktop'))();
u.isMobile = (() => document.body.classList.contains('is-mobile'))();

u.breakpoints = {
	xs: 0,
	sm: 576,
	md: 768,
	lg: 992,
	xl: 1200,
	xxl: 1400
};

/**
 * Check if viewport is wider than specified size
 * @param {string} size Viewport size (specified in Bootstrap).
 */
u.mediaBreakpointUp = size => {
	for (const key in u.breakpoints) {
		if (size === key && document.body.clientWidth > u.breakpoints[key]) {
			return true;
		}
	}
	return false;
}

u.fitText = (targetSelector, containerSelector = false, scale = 0.942) => {
	const target = document.querySelector(targetSelector);
	const container = containerSelector ? document.querySelector(containerSelector) : target.parentElement;

	target.style.setProperty("--length", target.innerText.length);
	target.style.setProperty("--scale", scale);
	target.style.fontSize = "calc(var(--width) / (var(--length, 1) * 0.5) * var(--scale, 1))";

	const ro = new ResizeObserver(entries => {
		for (let entry of entries) {
			const { width } = entry.contentRect;
			window.requestAnimationFrame(() => {
				container.style.setProperty("--width", `${width}px`);
			});
		}
	});

	ro.observe(container);
};

document.head || (document.head = document.getElementsByTagName("head")[0]);

u.changeFavicon = function(src) {
	var link = document.createElement("link"),
		oldLink = document.getElementById("dynamic-favicon");
	src = src + '?=' + Math.random(); // cache bust
	link.id = "dynamic-favicon";
	link.rel = "shortcut icon";
	link.href = src;
	if (oldLink) {
		document.head.removeChild(oldLink);
	}
	document.head.appendChild(link);
	console.log('favicon');
};
