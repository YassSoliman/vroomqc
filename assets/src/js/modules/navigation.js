/**
 * Navigation Module
 * Handles burger menu, mobile navigation, and dropdown menus
 */

import { slideUp, slideDown, slideToggle } from '../utils/animations.js';

export class Navigation {
	constructor() {
		this.init();
	}

	init() {
		this.setupBurgerMenu();
		this.setupMobileDropdowns();
		this.setupMobileMode();
		this.setupDynamicAdaptive();
	}

	setupBurgerMenu() {
		const burgerMenu = document.querySelector('.burger-menu');
		if (!burgerMenu) return;

		burgerMenu.addEventListener('click', (e) => {
			burgerMenu.classList.toggle('_active');
			document.querySelector('.header-menu').classList.toggle('_active');
			document.body.classList.toggle('_lock');
		});
	}

	setupMobileDropdowns() {
		const menuLinks = document.querySelectorAll('[data-with-submenu]');
		
		if (!menuLinks.length) return;

		menuLinks.forEach(menuLink => {
			menuLink.addEventListener('click', (e) => {
				e.preventDefault();
				if (document.documentElement.dataset.mobileMode === 'true') {
					const menuContent = menuLink.nextElementSibling;
					menuLink.classList.toggle('_active');
					this.slideToggle(menuContent);
				}
			});
		});
	}

	setupMobileMode() {
		const mql = window.matchMedia("(max-width: 991.98px)");
		window.addEventListener('resize', this.mobileModeFunction.bind(this));
		this.mobileModeFunction();
	}

	mobileModeFunction() {
		const mql = window.matchMedia("(max-width: 991.98px)");
		if (mql.matches) {
			document.documentElement.dataset.mobileMode = true;
		} else {
			document.documentElement.dataset.mobileMode = false;
		}
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

	setupDynamicAdaptive() {
		class DynamicAdapt {
			constructor(type) {
				this.type = type;
			}

			init() {
				this.objects = [];
				this.daClassname = '_dynamic_adapt_';
				this.nodes = [...document.querySelectorAll('[data-da]')];

				this.nodes.forEach((node) => {
					const data = node.dataset.da.trim();
					const dataArray = data.split(',');
					const object = {};
					object.element = node;
					object.parent = node.parentNode;
					object.destination = document.querySelector(`${dataArray[0].trim()}`);
					object.breakpoint = dataArray[1] ? dataArray[1].trim() : '767';
					object.place = dataArray[2] ? dataArray[2].trim() : 'last';
					object.index = this.indexInParent(object.parent, object.element);
					this.objects.push(object);
				});

				this.arraySort(this.objects);

				this.mediaQueries = this.objects
					.map(({ breakpoint }) => `(${this.type}-width: ${breakpoint}px),${breakpoint}`)
					.filter((item, index, self) => self.indexOf(item) === index);

				this.mediaQueries.forEach((media) => {
					const mediaSplit = media.split(',');
					const matchMedia = window.matchMedia(mediaSplit[0]);
					const mediaBreakpoint = mediaSplit[1];
					const objectsFilter = this.objects.filter(({ breakpoint }) => breakpoint === mediaBreakpoint);
					
					matchMedia.addEventListener('change', () => {
						this.mediaHandler(matchMedia, objectsFilter);
					});
					this.mediaHandler(matchMedia, objectsFilter);
				});
			}

			mediaHandler(matchMedia, objects) {
				if (matchMedia.matches) {
					objects.forEach((object) => {
						this.moveTo(object.place, object.element, object.destination);
					});
				} else {
					objects.forEach(({ parent, element, index }) => {
						if (element.classList.contains(this.daClassname)) {
							this.moveBack(parent, element, index);
						}
					});
				}
			}

			moveTo(place, element, destination) {
				element.classList.add(this.daClassname);
				if (place === 'last' || place >= destination.children.length) {
					destination.append(element);
					return;
				}
				if (place === 'first') {
					destination.prepend(element);
					return;
				}
				destination.children[place].before(element);
			}

			moveBack(parent, element, index) {
				element.classList.remove(this.daClassname);
				if (parent.children[index] !== undefined) {
					parent.children[index].before(element);
				} else {
					parent.append(element);
				}
			}

			indexInParent(parent, element) {
				return [...parent.children].indexOf(element);
			}

			arraySort(arr) {
				if (this.type === 'min') {
					arr.sort((a, b) => {
						if (a.breakpoint === b.breakpoint) {
							if (a.place === b.place) return 0;
							if (a.place === 'first' || b.place === 'last') return -1;
							if (a.place === 'last' || b.place === 'first') return 1;
							return 0;
						}
						return a.breakpoint - b.breakpoint;
					});
				} else {
					arr.sort((a, b) => {
						if (a.breakpoint === b.breakpoint) {
							if (a.place === b.place) return 0;
							if (a.place === 'first' || b.place === 'last') return 1;
							if (a.place === 'last' || b.place === 'first') return -1;
							return 0;
						}
						return b.breakpoint - a.breakpoint;
					});
				}
			}
		}

		const da = new DynamicAdapt('max');
		da.init();
	}
}