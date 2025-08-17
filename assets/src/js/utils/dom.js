/**
 * DOM utility functions
 */

/**
 * Check if element is in viewport
 * @param {HTMLElement} element - Element to check
 * @returns {boolean} - True if element is in viewport
 */
export const isInViewport = (element) => {
	const rect = element.getBoundingClientRect();
	return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
		rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
};

/**
 * Check if device is mobile
 * @returns {boolean} - True if mobile device
 */
export const isMobile = () => {
	return window.matchMedia('(max-width: 991.98px)').matches;
};

/**
 * Get data attribute value
 * @param {HTMLElement} element - Element to get data from
 * @param {string} attribute - Data attribute name (without 'data-')
 * @returns {string|null} - Attribute value or null
 */
export const getData = (element, attribute) => {
	return element?.dataset?.[attribute] || null;
};

/**
 * Set data attribute value
 * @param {HTMLElement} element - Element to set data on
 * @param {string} attribute - Data attribute name (without 'data-')
 * @param {string} value - Value to set
 */
export const setData = (element, attribute, value) => {
	if (element?.dataset) {
		element.dataset[attribute] = value;
	}
};

/**
 * Safely query selector
 * @param {string} selector - CSS selector
 * @param {HTMLElement} context - Context element (default: document)
 * @returns {HTMLElement|null} - Found element or null
 */
export const qs = (selector, context = document) => {
	try {
		return context.querySelector(selector);
	} catch (e) {
		console.warn(`Invalid selector: ${selector}`);
		return null;
	}
};

/**
 * Safely query all selectors
 * @param {string} selector - CSS selector
 * @param {HTMLElement} context - Context element (default: document)
 * @returns {NodeList} - Found elements
 */
export const qsa = (selector, context = document) => {
	try {
		return context.querySelectorAll(selector);
	} catch (e) {
		console.warn(`Invalid selector: ${selector}`);
		return [];
	}
};

/**
 * Add event listener with optional delegation
 * @param {HTMLElement|string} target - Target element or selector
 * @param {string} event - Event type
 * @param {Function} handler - Event handler
 * @param {string} delegate - Delegation selector (optional)
 * @param {object} options - Event listener options
 */
export const on = (target, event, handler, delegate = null, options = {}) => {
	const element = typeof target === 'string' ? qs(target) : target;
	
	if (!element) return;

	if (delegate) {
		element.addEventListener(event, (e) => {
			const delegateTarget = e.target.closest(delegate);
			if (delegateTarget) {
				handler.call(delegateTarget, e);
			}
		}, options);
	} else {
		element.addEventListener(event, handler, options);
	}
};

/**
 * Create and dispatch custom event
 * @param {HTMLElement} element - Element to dispatch from
 * @param {string} eventName - Event name
 * @param {object} detail - Event detail data
 */
export const trigger = (element, eventName, detail = {}) => {
	const event = new CustomEvent(eventName, {
		detail,
		bubbles: true,
		cancelable: true
	});
	element.dispatchEvent(event);
};