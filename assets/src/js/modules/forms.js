/**
 * Forms Module
 * Handles form functionality, select menus, and input validation
 */

import { slideUp, slideDown, slideToggle } from '../utils/animations.js';

export class Forms {
	constructor() {
		this.init();
	}

	init() {
		this.setupSelectMenus();
		this.setupSpollers();
		
		// Only setup price slider if we're not on inventory page (to avoid conflicts)
		if (!document.getElementById('vehicles-grid')) {
			this.setupPriceSlider();
		}
		
		this.setupNumberInputs();
		this.setupShowMore();
		this.setupCopyButtons();
	}

	setupSelectMenus() {
		const selects = document.querySelectorAll('[data-select-menu]');

		if (!selects.length) return;

		document.documentElement.addEventListener('click', this.collapseSelects.bind(this));

		selects.forEach(select => {
			const selectButton = select.querySelector('[data-select-menu-button]');
			const selectOptions = select.querySelectorAll('[data-select-menu-option]');

			if (selectButton) {
				selectButton.addEventListener('click', this.selectToggle.bind(this));
			}

			selectOptions.forEach(el => {
				el.addEventListener('click', this.selectChoose.bind(this));
			});
		});
	}

	selectToggle(e) {
		const parent = e.target.closest('[data-select-menu]');
		const selectBody = parent.querySelector('[data-select-menu-drop-down]');
		parent.classList.toggle('_active');
		this.slideToggle(selectBody, 300);
	}

	selectChoose(e) {
		const parent = e.target.closest('[data-select-menu]');
		const selectValue = parent.querySelector('[data-select-menu-value]');
		const selectBody = parent.querySelector('[data-select-menu-drop-down]');
		
		if (parent.classList.contains('_first-choice')) {
			parent.classList.remove('_first-choice');
		}
		
		const valueItem = e.target.closest('[data-select-menu-option]').innerText;
		selectValue.innerHTML = valueItem;
		parent.classList.remove('_active');
		this.slideUp(selectBody, 300);
	}

	collapseSelects(e) {
		const targetClick = e.target.closest('[data-select-menu]');
		const selects = document.querySelectorAll('[data-select-menu]');
		
		selects.forEach(select => {
			if (!targetClick || targetClick !== select) {
				select.classList.remove('_active');
				const selectBody = select.querySelector('[data-select-menu-drop-down]');
				this.slideUp(selectBody, 300);
			}
		});
	}

	setupSpollers() {
		const spollersArray = document.querySelectorAll('[data-spollers]');
		if (!spollersArray.length) return;

		const spollersRegular = Array.from(spollersArray).filter(function (item) {
			return !item.dataset.spollers.split(',')[0];
		});

		if (spollersRegular.length > 0) {
			this.initSpollers(spollersRegular);
		}

		const spollersMedia = Array.from(spollersArray).filter(function (item) {
			return item.dataset.spollers.split(',')[0];
		});

		if (spollersMedia.length > 0) {
			const breakpointsArray = [];
			spollersMedia.forEach((item) => {
				const params = item.dataset.spollers;
				const breakpoint = {};
				const paramsArray = params.split(',');
				breakpoint.value = paramsArray[0];
				breakpoint.type = paramsArray[1] ? paramsArray[1].trim() : 'max';
				breakpoint.item = item;
				breakpointsArray.push(breakpoint);
			});

			let mediaQueries = breakpointsArray.map((item) => {
				return '(' + item.type + "-width: " + item.value + 'px),' + item.value + ',' + item.type;
			});

			mediaQueries = mediaQueries.filter((item, index, self) => {
				return self.indexOf(item) === index;
			});

			mediaQueries.forEach((breakpoint) => {
				const paramsArray = breakpoint.split(',');
				const mediaBreakpoint = paramsArray[1];
				const mediaType = paramsArray[2];
				const matchMedia = window.matchMedia(paramsArray[0]);

				const spollersArray = breakpointsArray.filter((item) => {
					return item.value === mediaBreakpoint && item.type === mediaType;
				});

				matchMedia.addEventListener("change", () => {
					this.initSpollers(spollersArray, matchMedia);
				});
				this.initSpollers(spollersArray, matchMedia);
			});
		}
	}

	initSpollers(spollersArray, matchMedia = false) {
		spollersArray.forEach((spollersBlock) => {
			spollersBlock = matchMedia ? spollersBlock.item : spollersBlock;
			if (matchMedia.matches || !matchMedia) {
				spollersBlock.classList.add('_init');
				this.initSpollerBody(spollersBlock);
				spollersBlock.addEventListener('click', this.setSpollerAction.bind(this));
			} else {
				spollersBlock.classList.remove('_init');
				this.initSpollerBody(spollersBlock, false);
				spollersBlock.removeEventListener('click', this.setSpollerAction.bind(this));
			}
		});
	}

	initSpollerBody(spollersBlock, hideSpollerBody = true) {
		const spollerTitles = spollersBlock.querySelectorAll('[data-spoller]');
		if (spollerTitles.length > 0) {
			spollerTitles.forEach(spollerTitle => {
				// Find the body element - it could be nextElementSibling of button or container
				let spollerBody = spollerTitle.nextElementSibling;
				const headerContainer = spollerTitle.closest('.body-products-aside__header-container');
				if (headerContainer) {
					spollerBody = headerContainer.nextElementSibling;
				}
				
				if (spollerBody) {
					if (hideSpollerBody) {
						spollerTitle.removeAttribute('tabindex');
						if (!spollerTitle.classList.contains('_active')) {
							spollerBody.hidden = true;
						}
					} else {
						spollerTitle.setAttribute('tabindex', '-1');
						spollerBody.hidden = false;
					}
				}
			});
		}
	}

	setSpollerAction(e) {
		const el = e.target;
		if (el.hasAttribute('data-spoller') || el.closest('[data-spoller]')) {
			const spollerTitle = el.hasAttribute('data-spoller') ? el : el.closest('[data-spoller]');
			const spollersBlock = spollerTitle.closest('[data-spollers]');
			const oneSpoller = spollersBlock.hasAttribute('data-one-spoller');
			
			if (!spollersBlock.querySelectorAll('._slide').length) {
				if (oneSpoller && !spollerTitle.classList.contains('_active')) {
					this.hideSpollerBody(spollersBlock);
				}
				spollerTitle.classList.toggle('_active');
				
				// Find the body element - it could be nextElementSibling of button or container
				let spollerBody = spollerTitle.nextElementSibling;
				const headerContainer = spollerTitle.closest('.body-products-aside__header-container');
				if (headerContainer) {
					spollerBody = headerContainer.nextElementSibling;
				}
				
				if (spollerBody) {
					this.slideToggle(spollerBody, 500);
				}
			}
			e.preventDefault();
		}
	}

	hideSpollerBody(spollersBlock) {
		const spollerActiveTitle = spollersBlock.querySelector('[data-spoller]._active');
		if (spollerActiveTitle) {
			spollerActiveTitle.classList.remove('_active');
			this.slideUp(spollerActiveTitle.nextElementSibling, 500);
		}
	}

	async setupPriceSlider() {
		const productsSlider = document.getElementById('products-range-slider');

		if (!productsSlider) return;

		try {
			// Import noUiSlider dynamically with proper error handling
			const { default: noUiSlider } = await import('nouislider');

			const minInput = document.querySelector('#producs-price-min-input');
			const maxInput = document.querySelector('#producs-price-max-input');
			const maxValue = +(productsSlider.dataset.maxValue || 60000);
			const minValue = +(productsSlider.dataset.minValue || 10000);

			noUiSlider.create(productsSlider, {
				start: [13200, 32000],
				connect: true,
				range: {
					min: minValue,
					max: maxValue
				},
				format: {
					to: (value) => Math.round(value),
					from: (value) => Number(value)
				}
			});

			productsSlider.noUiSlider.on('update', (values, handle) => {
				const value = +values[handle];
				const formattedValue = `$${value.toLocaleString('en-US')}`;

				if (handle === 1 && maxInput) {
					maxInput.value = formattedValue;
				} else if (handle === 0 && minInput) {
					minInput.value = formattedValue;
				}
			});

			// Handle input changes
			if (minInput) {
				minInput.addEventListener('change', function () {
					const value = parseInt(this.value.replace(/[$,]/g, ''), 10);
					if (!isNaN(value)) {
						productsSlider.noUiSlider.set([value, null]);
					}
				});
			}

			if (maxInput) {
				maxInput.addEventListener('change', function () {
					const value = parseInt(this.value.replace(/[$,]/g, ''), 10);
					if (!isNaN(value)) {
						productsSlider.noUiSlider.set([null, value]);
					}
				});
			}
		} catch (error) {
			console.warn('NoUISlider not available:', error);
		}
	}

	setupNumberInputs() {
		const inputs = document.querySelectorAll('[data-input-numb]');
		if (!inputs.length) return;

		inputs.forEach(input => {
			input.setAttribute('inputmode', 'numeric');
			input.addEventListener('input', (e) => {
				const value = e.target.value;
				e.target.value = value.replace(/\D/g, '');
			});
		});
	}

	setupShowMore() {
		const showMoreWrappers = document.querySelectorAll('[data-show-more]');

		if (!showMoreWrappers.length) return;

		showMoreWrappers.forEach(showMoreWrapper => {
			const showMoreContent = showMoreWrapper.querySelector('[data-show-more-content]');
			const showMoreButton = showMoreWrapper.querySelector('[data-show-more-button]');

			if (showMoreButton) {
				showMoreButton.addEventListener('click', () => {
					showMoreContent.classList.add('_show-all');
					showMoreButton.classList.add('_hide');
				});
			}
		});
	}

	setupCopyButtons() {
		const copyWrappers = document.querySelectorAll('[data-copy]');

		if (!copyWrappers.length) return;

		copyWrappers.forEach(copyWrapper => {
			const copyText = copyWrapper.querySelector('[data-copy-text]');
			const copyButton = copyWrapper.querySelector('[data-copy-button]');
			const copyMessage = copyWrapper.querySelector('[data-copy-message]');

			if (copyButton) {
				copyButton.addEventListener('click', () => {
					const copiedText = copyText.innerHTML;
					navigator.clipboard.writeText(copiedText);

					copyMessage.classList.add('_show');

					setTimeout(() => {
						copyMessage.classList.remove('_show');
					}, 3000);
				});
			}
		});
	}

	// Import utility functions from animations module
	slideUp(target, duration = 500) {
		return slideUp(target, duration);
	}

	slideDown(target, duration = 500) {
		return slideDown(target, duration);
	}

	slideToggle(target, duration = 500) {
		return slideToggle(target, duration);
	}
}