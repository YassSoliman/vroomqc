/**
 * Filters Module
 * Handles product filtering and mobile filter functionality
 */

export class Filters {
	constructor() {
		this.init();
	}

	init() {
		this.setupMobileFilters();
		this.setupProductFilters();
	}

	setupMobileFilters() {
		const filterOpenButton = document.querySelector('[data-open-filter]');
		const filter = document.querySelector('[data-filter]');
		const filterCloseButton = document.querySelector('[data-close-filter]');

		if (!filterOpenButton || !filter) return;

		filterOpenButton.addEventListener('click', this.openFilter.bind(this));
		window.addEventListener('click', this.closeFilter.bind(this));

		if (filterCloseButton) {
			filterCloseButton.addEventListener('click', this.closeFilter.bind(this));
		}
	}

	openFilter(e) {
		const filter = document.querySelector('[data-filter]');
		filter.classList.add('_active');
		document.body.classList.add('_lock');
	}

	closeFilter(e) {
		const target = e.target;
		const filter = document.querySelector('[data-filter]');
		const filterOpenButton = document.querySelector('[data-open-filter]');
		const filterCloseButton = document.querySelector('[data-close-filter]');

		if (!target.closest('.body-products-aside__wrapper') && target !== filterOpenButton) {
			filter.classList.remove('_active');
			document.body.classList.remove('_lock');
		} else if (target === filterCloseButton) {
			filter.classList.remove('_active');
			document.body.classList.remove('_lock');
		}
	}

	setupProductFilters() {
		const filters = document.querySelectorAll('[data-filter]');

		if (!filters.length) return;

		filters.forEach(filter => {
			const filterButtons = filter.querySelectorAll('[data-filter-category]');
			const filterSections = filter.querySelectorAll('[data-filter-content]');

			filterButtons.forEach(filterButton => {
				filterButton.addEventListener('click', (e) => {
					// Reset all sections
					filterSections.forEach(filterSection => {
						filterSection.classList.remove('_show', '_last-child');
					});

					// Reset all buttons
					filterButtons.forEach(btn => {
						btn.classList.remove('_active');
					});

					const selfButton = e.target;
					const buttonId = selfButton.dataset.filterCategory;

					if (buttonId === 'all') {
						filterSections.forEach((filterSection) => {
							filterSection.classList.add('_show');
						});
					} else {
						filterSections.forEach(filterSection => {
							const contentCategories = filterSection.dataset.filterContent.split(',');
							if (contentCategories.includes(buttonId)) {
								filterSection.classList.add('_show');
							}
						});
					}

					selfButton.classList.add('_active');
				});
			});
		});
	}
}