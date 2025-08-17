/**
 * Animation utilities for smooth transitions and effects
 */

/**
 * Slide up animation
 * @param {HTMLElement} target - Element to slide up
 * @param {number} duration - Animation duration in ms
 * @returns {Promise} - Promise that resolves when animation completes
 */
export const slideUp = (target, duration = 500) => {
	return new Promise(resolve => {
		if (target.classList.contains('_slide')) {
			resolve();
			return;
		}

		target.classList.add('_slide');
		target.style.transitionProperty = 'height, margin, padding';
		target.style.transitionDuration = `${duration}ms`;
		target.style.height = `${target.offsetHeight}px`;
		target.offsetHeight; // Force reflow
		target.style.overflow = 'hidden';
		target.style.height = '0';
		target.style.paddingTop = '0';
		target.style.paddingBottom = '0';
		target.style.marginTop = '0';
		target.style.marginBottom = '0';

		setTimeout(() => {
			target.hidden = true;
			target.style.removeProperty('height');
			target.style.removeProperty('padding-top');
			target.style.removeProperty('padding-bottom');
			target.style.removeProperty('margin-top');
			target.style.removeProperty('margin-bottom');
			target.style.removeProperty('overflow');
			target.style.removeProperty('transition-duration');
			target.style.removeProperty('transition-property');
			target.classList.remove('_slide');
			resolve();
		}, duration);
	});
};

/**
 * Slide down animation
 * @param {HTMLElement} target - Element to slide down
 * @param {number} duration - Animation duration in ms
 * @returns {Promise} - Promise that resolves when animation completes
 */
export const slideDown = (target, duration = 500) => {
	return new Promise(resolve => {
		if (target.classList.contains('_slide')) {
			resolve();
			return;
		}

		target.classList.add('_slide');
		
		if (target.hidden) {
			target.hidden = false;
		}

		const height = target.offsetHeight;
		target.style.overflow = 'hidden';
		target.style.height = '0';
		target.style.paddingTop = '0';
		target.style.paddingBottom = '0';
		target.style.marginTop = '0';
		target.style.marginBottom = '0';
		target.offsetHeight; // Force reflow
		target.style.transitionProperty = 'height, margin, padding';
		target.style.transitionDuration = `${duration}ms`;
		target.style.height = `${height}px`;
		target.style.removeProperty('padding-top');
		target.style.removeProperty('padding-bottom');
		target.style.removeProperty('margin-top');
		target.style.removeProperty('margin-bottom');

		setTimeout(() => {
			target.style.removeProperty('height');
			target.style.removeProperty('overflow');
			target.style.removeProperty('transition-duration');
			target.style.removeProperty('transition-property');
			target.classList.remove('_slide');
			resolve();
		}, duration);
	});
};

/**
 * Toggle slide animation
 * @param {HTMLElement} target - Element to toggle
 * @param {number} duration - Animation duration in ms
 * @returns {Promise} - Promise that resolves when animation completes
 */
export const slideToggle = (target, duration = 500) => {
	if (target.hidden || window.getComputedStyle(target).display === 'none') {
		return slideDown(target, duration);
	} else {
		return slideUp(target, duration);
	}
};

/**
 * Debounce function to limit rapid function calls
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in ms
 * @returns {Function} - Debounced function
 */
export const debounce = (func, wait) => {
	let timeout;
	return function executedFunction(...args) {
		const later = () => {
			clearTimeout(timeout);
			func(...args);
		};
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
	};
};

/**
 * Throttle function to limit function execution frequency
 * @param {Function} func - Function to throttle
 * @param {number} limit - Time limit in ms
 * @returns {Function} - Throttled function
 */
export const throttle = (func, limit) => {
	let inThrottle;
	return function(...args) {
		if (!inThrottle) {
			func.apply(this, args);
			inThrottle = true;
			setTimeout(() => inThrottle = false, limit);
		}
	};
};