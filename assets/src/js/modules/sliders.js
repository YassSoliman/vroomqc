/**
 * Sliders Module
 * Handles all slider functionality including reviews and product galleries
 */

import { Swiper } from 'swiper';
import { Navigation, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/autoplay';

export class Sliders {
	constructor() {
		this.swipers = new Map();
		this.init();
	}

	init() {
		this.setupReviewsSwiper();
		this.setupProductGallery();
		this.setupTopPicksSlider();
	}

	setupReviewsSwiper() {
		const swiperWrapper = document.querySelector('.content-reviews__swiper');
		
		if (!swiperWrapper) return;

		try {
			const swiper = new Swiper(swiperWrapper, {
				modules: [Navigation, Autoplay],
				slidesPerView: 'auto',
				spaceBetween: 20,
				loop: true,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.reviews__arrow-next',
					prevEl: '.reviews__arrow-prev'
				},
				breakpoints: {
					768: {
						spaceBetween: 30,
					},
					1024: {
						spaceBetween: 40,
					}
				}
			});

			this.swipers.set('reviews', swiper);
		} catch (error) {
			console.warn('Swiper not available:', error);
		}
	}

	setupTopPicksSlider() {
		const topPicksSwiper = document.querySelector('.top-picks-swiper');
		
		if (!topPicksSwiper) return;

		try {
			const swiper = new Swiper(topPicksSwiper, {
				modules: [Navigation, Autoplay],
				slidesPerView: 1,
				spaceBetween: 20,
				loop: true,
				autoplay: {
					delay: 4000,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.top-picks__arrow-next',
					prevEl: '.top-picks__arrow-prev'
				},
				breakpoints: {
					576: {
						slidesPerView: 2,
						spaceBetween: 20,
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					1024: {
						slidesPerView: 3,
						spaceBetween: 30,
					}
				}
			});

			this.swipers.set('topPicks', swiper);
		} catch (error) {
			console.warn('Top picks swiper not available:', error);
		}
	}

	setupProductGallery() {
		const galleryWrapper = document.getElementById('product-gallery');
		
		if (!galleryWrapper) {
			return;
		}

		// Use the original lightGallery implementation from vroom-main
		try {
			if (typeof lightGallery !== 'undefined') {
				lightGallery(galleryWrapper, {
					speed: 500,
					download: false,
					getCaptionFromTitleOrAlt: false,
					hideScrollbar: true,
					selector: '[data-gallery-wrapper]',
					mobileSettings: {
						controls: false,
						showCloseIcon: true,
						download: false,
					},
					preload: 4,
				});
			}
		} catch (error) {
			console.error('Failed to initialize lightGallery:', error);
		}
	}

	/**
	 * Destroy all swipers and lightbox (useful for cleanup)
	 */
	destroy() {
		this.swipers.forEach(swiper => {
			if (swiper && typeof swiper.destroy === 'function') {
				swiper.destroy(true, true);
			}
		});
		this.swipers.clear();
		
		// Note: lightGallery instances are handled globally
	}

	/**
	 * Get specific swiper instance
	 * @param {string} name - Swiper name
	 * @returns {Swiper|null} - Swiper instance or null
	 */
	getSwiper(name) {
		return this.swipers.get(name) || null;
	}
}