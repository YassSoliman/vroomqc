/**
 * Homepage Filters Module
 * Handles filtering functionality for the top picks section on homepage
 */

export class HomepageFilters {
    constructor() {
        this.currentCategory = 'all';
        this.init();
    }

    init() {
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Top picks filter buttons
        const filterButtons = document.querySelectorAll('.nav-top-picks__button[data-filter-category]');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const category = button.dataset.filterCategory;
                
                if (category === 'more') {
                    // Redirect to inventory page
                    window.location.href = document.querySelector('#explore-more-link').href.replace(/\?.*$/, '');
                    return;
                }
                
                this.filterVehicles(category, button);
            });
        });
    }

    async filterVehicles(category, activeButton) {
        // Update button states
        const allButtons = document.querySelectorAll('.nav-top-picks__button');
        allButtons.forEach(btn => btn.classList.remove('_active'));
        activeButton.classList.add('_active');

        // Show loading state
        const vehiclesGrid = document.getElementById('homepage-vehicles-grid');
        if (vehiclesGrid) {
            vehiclesGrid.style.opacity = '0.6';
            vehiclesGrid.style.pointerEvents = 'none';
        }

        try {
            const response = await fetch(window.vroomqc_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'filter_homepage_vehicles',
                    nonce: window.vroomqc_ajax.nonce,
                    category: category
                })
            });

            const data = await response.json();

            if (data.success) {
                // Handle redirect for "+ More" option
                if (data.data.redirect) {
                    window.location.href = data.data.redirect;
                    return;
                }

                // Update vehicles grid
                this.updateVehiclesGrid(data.data.vehicles);
                
                // Update explore more link
                this.updateExploreMoreLink(data.data.explore_more);
                
                // Update current category
                this.currentCategory = category;
                
                console.log(`✅ Homepage filter applied: ${category} (${data.data.count} vehicles)`);
            } else {
                console.error('❌ Homepage filter failed:', data.data);
                this.showErrorMessage();
            }
        } catch (error) {
            console.error('❌ Homepage filter request failed:', error);
            this.showErrorMessage();
        } finally {
            // Remove loading state
            if (vehiclesGrid) {
                vehiclesGrid.style.opacity = '';
                vehiclesGrid.style.pointerEvents = '';
            }
        }
    }

    updateVehiclesGrid(vehicles) {
        const vehiclesGrid = document.getElementById('homepage-vehicles-grid');
        if (!vehiclesGrid) return;

        if (vehicles && vehicles.length > 0) {
            // Update with new vehicles
            vehiclesGrid.innerHTML = vehicles.map(vehicle => vehicle.html).join('');
        } else {
            // Show no vehicles message
            vehiclesGrid.innerHTML = '<p class="no-vehicles-message">No vehicles available for this filter.</p>';
        }
    }

    updateExploreMoreLink(exploreMoreData) {
        const exploreMoreLink = document.getElementById('explore-more-link');
        if (!exploreMoreLink || !exploreMoreData) return;

        exploreMoreLink.textContent = exploreMoreData.text;
        exploreMoreLink.href = exploreMoreData.url;
    }

    showErrorMessage() {
        const vehiclesGrid = document.getElementById('homepage-vehicles-grid');
        if (vehiclesGrid) {
            vehiclesGrid.innerHTML = '<p class="error-message">Sorry, there was an error loading vehicles. Please try again.</p>';
        }
    }
}