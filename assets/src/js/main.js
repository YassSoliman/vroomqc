// Import modules
import { Navigation } from './modules/navigation.js';
import { Filters } from './modules/filters.js';
import { Sliders } from './modules/sliders.js';
import { Forms } from './modules/forms.js';

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
	// Initialize all modules
	new Navigation();
	new Filters();
	new Sliders();
	new Forms();
});