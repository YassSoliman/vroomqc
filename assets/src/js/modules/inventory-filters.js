/**
 * Inventory Filters Module
 * Handles vehicle filtering, sorting, pagination, and state management
 */

export class InventoryFilters {
    constructor() {
        this.currentFilters = {};
        this.currentSort = 'newest';
        this.currentPage = 1;
        this.currentSearch = '';
        this.isLoading = false;
        
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadInitialFilterData();
        this.restoreStateFromURL();
    }

    setupEventListeners() {
        // Search input
        const searchInput = document.getElementById('vehicle-search');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.currentSearch = e.target.value;
                    this.currentPage = 1;
                    this.applyFilters();
                }, 500);
            });
        }

        // Sort dropdown
        this.setupSortDropdown();

        // Filter checkboxes and range sliders
        this.setupFilterControls();

        // Clear filters buttons
        this.setupClearButtons();

        // Pagination clicks
        this.setupPagination();

        // See more buttons

        // Taxonomy search inputs
        this.setupTaxonomySearch();

        // Search toggle buttons
        this.setupSearchToggle();
    }

    setupSortDropdown() {
        const sortOptions = document.querySelectorAll('[data-sort-value]');
        sortOptions.forEach(option => {
            option.addEventListener('click', () => {
                const sortValue = option.dataset.sortValue;
                if (sortValue && sortValue !== this.currentSort) {
                    this.currentSort = sortValue;
                    this.currentPage = 1;
                    this.applyFilters();
                }
            });
        });
    }

    setupFilterControls() {
        // Checkbox filters
        document.addEventListener('change', (e) => {
            if (e.target.matches('[data-filter-taxonomy]')) {
                // If unchecking a make, clean up its models from filters FIRST
                if (e.target.dataset.filterTaxonomy === 'make' && !e.target.checked) {
                    const makeSlug = e.target.value;
                    this.removeModelsFromFilters(makeSlug);
                }
                
                // Then handle the filter change (which calls applyFilters)
                this.handleTaxonomyFilter(e.target);
                
                // Then handle UI updates for make/model interactions
                if (e.target.dataset.filterTaxonomy === 'make') {
                    this.handleMakeCheckboxChange(e.target);
                }
            }
        });

        // Range sliders (will be initialized separately)
        this.setupRangeSliders();
    }

    async setupRangeSliders() {
        try {
            // Import noUiSlider dynamically
            const { default: noUiSlider } = await import('nouislider');
            
            // Setup price range slider
            await this.setupPriceSlider(noUiSlider);
            
            // Setup mileage range slider
            await this.setupMileageSlider(noUiSlider);
            
            // Setup year range slider
            await this.setupYearSlider(noUiSlider);
            
        } catch (error) {
            console.warn('Could not load noUiSlider:', error);
        }
    }

    async setupPriceSlider(noUiSlider) {
        const priceSlider = document.getElementById('products-range-slider');
        if (!priceSlider) return;

        console.log('🎚️ Setting up price slider');

        const minInput = document.getElementById('producs-price-min-input');
        const maxInput = document.getElementById('producs-price-max-input');
        
        // Get dynamic min/max values
        let minValue = parseInt(priceSlider.dataset.minValue) || 0;
        let maxValue = parseInt(priceSlider.dataset.maxValue) || 100000;
        
        console.log('💰 Price range:', { min: minValue, max: maxValue });
        
        // Initialize with current values from URL parameters, input values, or defaults
        let startMin = minValue;
        let startMax = maxValue;
        
        // Check URL parameters first
        if (this.currentFilters.price_min !== undefined) {
            startMin = this.currentFilters.price_min;
        } else if (minInput && minInput.value) {
            const currentMin = parseInt(minInput.value.replace(/[^0-9]/g, ''));
            if (!isNaN(currentMin)) startMin = currentMin;
        }
        
        if (this.currentFilters.price_max !== undefined) {
            startMax = this.currentFilters.price_max;
        } else if (maxInput && maxInput.value) {
            const currentMax = parseInt(maxInput.value.replace(/[^0-9]/g, ''));
            if (!isNaN(currentMax)) startMax = currentMax;
        }

        // Destroy existing slider if it exists
        if (priceSlider.noUiSlider) {
            console.log('🔄 Destroying existing price slider');
            priceSlider.noUiSlider.destroy();
        }

        console.log('🎯 Price slider start values:', { startMin, startMax });

        try {
            noUiSlider.create(priceSlider, {
                start: [startMin, startMax],
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

            console.log('✅ Price slider created successfully');

            priceSlider.noUiSlider.on('update', (values, handle) => {
                const value = Math.round(values[handle]);
                const formattedValue = `$${value.toLocaleString()}`;
                
                if (handle === 0 && minInput) {
                    minInput.value = formattedValue;
                } else if (handle === 1 && maxInput) {
                    maxInput.value = formattedValue;
                }
            });

            priceSlider.noUiSlider.on('change', (values) => {
                const minPrice = Math.round(values[0]);
                const maxPrice = Math.round(values[1]);
                
                console.log('💰 Price slider changed:', { min: minPrice, max: maxPrice });
                
                this.currentFilters.price_min = minPrice;
                this.currentFilters.price_max = maxPrice;
                this.currentPage = 1;
                this.applyFilters();
            });

            // Handle manual input changes
            if (minInput) {
                minInput.addEventListener('blur', () => {
                    const value = parseInt(minInput.value.replace(/[^0-9]/g, ''));
                    if (!isNaN(value) && value >= minValue && value <= maxValue) {
                        priceSlider.noUiSlider.set([value, null]);
                        
                        // Manually trigger filter update
                        const currentValues = priceSlider.noUiSlider.get();
                        this.currentFilters.price_min = Math.round(currentValues[0]);
                        this.currentFilters.price_max = Math.round(currentValues[1]);
                        this.currentPage = 1;
                        this.applyFilters();
                    } else {
                        // Reset to current slider value if invalid
                        minInput.value = `$${Math.round(priceSlider.noUiSlider.get()[0]).toLocaleString()}`;
                    }
                });
                
                minInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        minInput.blur();
                    }
                });
            }

            if (maxInput) {
                maxInput.addEventListener('blur', () => {
                    const value = parseInt(maxInput.value.replace(/[^0-9]/g, ''));
                    if (!isNaN(value) && value >= minValue && value <= maxValue) {
                        priceSlider.noUiSlider.set([null, value]);
                        
                        // Manually trigger filter update
                        const currentValues = priceSlider.noUiSlider.get();
                        this.currentFilters.price_min = Math.round(currentValues[0]);
                        this.currentFilters.price_max = Math.round(currentValues[1]);
                        this.currentPage = 1;
                        this.applyFilters();
                    } else {
                        // Reset to current slider value if invalid
                        maxInput.value = `$${Math.round(priceSlider.noUiSlider.get()[1]).toLocaleString()}`;
                    }
                });
                
                maxInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        maxInput.blur();
                    }
                });
            }
        } catch (error) {
            console.error('❌ Error creating price slider:', error);
        }
    }

    async setupMileageSlider(noUiSlider) {
        const mileageSlider = document.getElementById('mileage-range-slider');
        if (!mileageSlider) return;

        console.log('🛣️ Setting up mileage slider');

        const minInput = document.getElementById('mileage-min-input');
        const maxInput = document.getElementById('mileage-max-input');
        
        // Get dynamic min/max values
        let minValue = parseInt(mileageSlider.dataset.minValue) || 0;
        let maxValue = parseInt(mileageSlider.dataset.maxValue) || 300000;
        
        console.log('📏 Mileage range:', { min: minValue, max: maxValue });

        // Initialize with current values from URL parameters or defaults
        let startMin = minValue;
        let startMax = maxValue;
        
        // Check URL parameters first
        if (this.currentFilters.mileage_min !== undefined) {
            startMin = this.currentFilters.mileage_min;
        }
        
        if (this.currentFilters.mileage_max !== undefined) {
            startMax = this.currentFilters.mileage_max;
        }

        console.log('🎯 Mileage slider start values:', { startMin, startMax });

        // Destroy existing slider if it exists
        if (mileageSlider.noUiSlider) {
            console.log('🔄 Destroying existing mileage slider');
            mileageSlider.noUiSlider.destroy();
        }

        try {
            noUiSlider.create(mileageSlider, {
                start: [startMin, startMax],
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

            console.log('✅ Mileage slider created successfully');

            mileageSlider.noUiSlider.on('update', (values, handle) => {
                const value = Math.round(values[handle]);
                const formattedValue = `${value.toLocaleString()} km`;
                
                if (handle === 0 && minInput) {
                    minInput.value = formattedValue;
                } else if (handle === 1 && maxInput) {
                    maxInput.value = formattedValue;
                }
            });

            mileageSlider.noUiSlider.on('change', (values) => {
                const minMileage = Math.round(values[0]);
                const maxMileage = Math.round(values[1]);
                
                console.log('📏 Mileage slider changed:', { min: minMileage, max: maxMileage });
                
                this.currentFilters.mileage_min = minMileage;
                this.currentFilters.mileage_max = maxMileage;
                this.currentPage = 1;
                this.applyFilters();
            });

            // Handle manual input changes
            if (minInput) {
                minInput.addEventListener('blur', () => {
                    const value = parseInt(minInput.value.replace(/[^0-9]/g, ''));
                    if (!isNaN(value) && value >= minValue && value <= maxValue) {
                        mileageSlider.noUiSlider.set([value, null]);
                        
                        // Manually trigger filter update
                        const currentValues = mileageSlider.noUiSlider.get();
                        this.currentFilters.mileage_min = Math.round(currentValues[0]);
                        this.currentFilters.mileage_max = Math.round(currentValues[1]);
                        this.currentPage = 1;
                        this.applyFilters();
                    } else {
                        // Reset to current slider value if invalid
                        minInput.value = `${Math.round(mileageSlider.noUiSlider.get()[0]).toLocaleString()} km`;
                    }
                });
                
                minInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        minInput.blur();
                    }
                });
            }

            if (maxInput) {
                maxInput.addEventListener('blur', () => {
                    const value = parseInt(maxInput.value.replace(/[^0-9]/g, ''));
                    if (!isNaN(value) && value >= minValue && value <= maxValue) {
                        mileageSlider.noUiSlider.set([null, value]);
                        
                        // Manually trigger filter update
                        const currentValues = mileageSlider.noUiSlider.get();
                        this.currentFilters.mileage_min = Math.round(currentValues[0]);
                        this.currentFilters.mileage_max = Math.round(currentValues[1]);
                        this.currentPage = 1;
                        this.applyFilters();
                    } else {
                        // Reset to current slider value if invalid
                        maxInput.value = `${Math.round(mileageSlider.noUiSlider.get()[1]).toLocaleString()} km`;
                    }
                });
                
                maxInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        maxInput.blur();
                    }
                });
            }
        } catch (error) {
            console.error('❌ Error creating mileage slider:', error);
        }
    }

    async setupYearSlider(noUiSlider) {
        const yearSlider = document.getElementById('year-range-slider');
        if (!yearSlider) return;

        console.log('📅 Setting up year slider');

        const minInput = document.getElementById('year-min-input');
        const maxInput = document.getElementById('year-max-input');
        
        // Get dynamic min/max values
        let minValue = parseInt(yearSlider.dataset.minValue) || 2000;
        let maxValue = parseInt(yearSlider.dataset.maxValue) || new Date().getFullYear();
        
        console.log('📅 Year range:', { min: minValue, max: maxValue });

        // Initialize with current values from URL parameters or defaults
        let startMin = minValue;
        let startMax = maxValue;
        
        // Check URL parameters first
        if (this.currentFilters.year_min !== undefined) {
            startMin = this.currentFilters.year_min;
        }
        
        if (this.currentFilters.year_max !== undefined) {
            startMax = this.currentFilters.year_max;
        }

        console.log('🎯 Year slider start values:', { startMin, startMax });

        // Destroy existing slider if it exists
        if (yearSlider.noUiSlider) {
            console.log('🔄 Destroying existing year slider');
            yearSlider.noUiSlider.destroy();
        }

        try {
            noUiSlider.create(yearSlider, {
                start: [startMin, startMax],
                connect: true,
                step: 1,
                range: {
                    min: minValue,
                    max: maxValue
                },
                format: {
                    to: (value) => Math.round(value),
                    from: (value) => Number(value)
                }
            });

            console.log('✅ Year slider created successfully');

            yearSlider.noUiSlider.on('update', (values, handle) => {
                const value = Math.round(values[handle]);
                
                if (handle === 0 && minInput) {
                    minInput.value = value;
                } else if (handle === 1 && maxInput) {
                    maxInput.value = value;
                }
            });

            yearSlider.noUiSlider.on('change', (values) => {
                const minYear = Math.round(values[0]);
                const maxYear = Math.round(values[1]);
                
                console.log('📅 Year slider changed:', { min: minYear, max: maxYear });
                
                this.currentFilters.year_min = minYear;
                this.currentFilters.year_max = maxYear;
                this.currentPage = 1;
                this.applyFilters();
            });

            // Handle manual input changes
            if (minInput) {
                minInput.addEventListener('blur', () => {
                    const value = parseInt(minInput.value);
                    if (!isNaN(value) && value >= minValue && value <= maxValue) {
                        yearSlider.noUiSlider.set([value, null]);
                        
                        // Manually trigger filter update
                        const currentValues = yearSlider.noUiSlider.get();
                        this.currentFilters.year_min = Math.round(currentValues[0]);
                        this.currentFilters.year_max = Math.round(currentValues[1]);
                        this.currentPage = 1;
                        this.applyFilters();
                    } else {
                        // Reset to current slider value if invalid
                        minInput.value = Math.round(yearSlider.noUiSlider.get()[0]);
                    }
                });
                
                minInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        minInput.blur();
                    }
                });
            }

            if (maxInput) {
                maxInput.addEventListener('blur', () => {
                    const value = parseInt(maxInput.value);
                    if (!isNaN(value) && value >= minValue && value <= maxValue) {
                        yearSlider.noUiSlider.set([null, value]);
                        
                        // Manually trigger filter update
                        const currentValues = yearSlider.noUiSlider.get();
                        this.currentFilters.year_min = Math.round(currentValues[0]);
                        this.currentFilters.year_max = Math.round(currentValues[1]);
                        this.currentPage = 1;
                        this.applyFilters();
                    } else {
                        // Reset to current slider value if invalid
                        maxInput.value = Math.round(yearSlider.noUiSlider.get()[1]);
                    }
                });
                
                maxInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        maxInput.blur();
                    }
                });
            }
        } catch (error) {
            console.error('❌ Error creating year slider:', error);
        }
    }

    setupClearButtons() {
        // Clear all filters
        const clearAllBtn = document.getElementById('clear-all-filters');
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', () => {
                this.clearAllFilters();
            });
        }

        // Individual filter clears
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-clear-filter]')) {
                const filterType = e.target.dataset.clearFilter;
                this.clearFilter(filterType);
            }
        });

        // Filter pill removals
        document.addEventListener('click', (e) => {
            // Handle pill remove button clicks
            if (e.target.matches('.filter-pill__remove')) {
                e.stopPropagation();
                const pill = e.target.closest('.filter-pill');
                if (pill) {
                    this.removeFilterPill(pill);
                }
            }
            // Handle clear all button clicks
            else if (e.target.matches('[data-clear-all]') || e.target.closest('[data-clear-all]')) {
                this.clearAllFilters();
            }
            // Handle pill clicks (anywhere on the pill removes it)
            else if (e.target.matches('.filter-pill') || e.target.closest('.filter-pill')) {
                const pill = e.target.closest('.filter-pill');
                if (pill && !pill.matches('.filter-pill--clear-all')) {
                    this.removeFilterPill(pill);
                }
            }
        });
    }

    setupPagination() {
        document.addEventListener('click', (e) => {
            const paginationButton = e.target.closest('.pagination__button[data-page]');
            if (paginationButton) {
                e.preventDefault();
                const page = parseInt(paginationButton.dataset.page);
                if (page && page !== this.currentPage) {
                    this.currentPage = page;
                    this.applyFilters();
                }
            }
        });
    }


    setupTaxonomySearch() {
        const searchInputs = document.querySelectorAll('[data-filter-search]');
        
        searchInputs.forEach(input => {
            input.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const taxonomy = e.target.dataset.filterSearch;
                const rowsContainer = document.querySelector(`[data-filter-rows="${taxonomy}"]`);
                
                console.log('🔎 Searching in', taxonomy, 'for:', searchTerm);
                
                if (rowsContainer) {
                    const allRows = rowsContainer.querySelectorAll('.body-products-aside__row');
                    let visibleCount = 0;
                    
                    allRows.forEach(row => {
                        const label = row.querySelector('.body-products-aside__caption');
                        if (label) {
                            const labelText = label.textContent.toLowerCase();
                            const matches = labelText.includes(searchTerm);
                            
                            // Check if this row should be hidden due to zero count (Model taxonomy only)
                            const checkbox = row.querySelector('input[type="checkbox"]');
                            const isModelTaxonomy = taxonomy === 'model';
                            const countSpan = label.querySelector('.filter-count');
                            const count = countSpan ? parseInt(countSpan.textContent.match(/\d+/)?.[0] || '0') : 0;
                            
                            const shouldShowForSearch = matches || searchTerm === '';
                            const shouldShowForCount = !isModelTaxonomy || count > 0;
                            
                            if (shouldShowForSearch && shouldShowForCount) {
                                row.style.display = '';
                                visibleCount++;
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    });
                    
                    // No longer needed - old make group logic removed
                    
                    console.log('👁️ Showing', visibleCount, 'items');
                }
            });
        });
    }

    setupSearchToggle() {
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-search-toggle]') || e.target.closest('[data-search-toggle]')) {
                e.stopPropagation(); // Prevent spoller from toggling
                
                const button = e.target.matches('[data-search-toggle]') ? e.target : e.target.closest('[data-search-toggle]');
                const taxonomy = button.dataset.searchToggle;
                const searchContainer = document.querySelector(`[data-search-container="${taxonomy}"]`);
                
                console.log('🔍 Search toggle clicked for:', taxonomy);
                
                if (searchContainer) {
                    const isVisible = searchContainer.style.display !== 'none';
                    
                    if (isVisible) {
                        // Hide search
                        searchContainer.style.display = 'none';
                        button.classList.remove('_active');
                        
                        // Clear search and reset filters
                        const searchInput = searchContainer.querySelector('[data-filter-search]');
                        if (searchInput && searchInput.value) {
                            searchInput.value = '';
                            // Trigger input event to clear search results
                            searchInput.dispatchEvent(new Event('input'));
                        }
                    } else {
                        // Show search
                        searchContainer.style.display = 'block';
                        button.classList.add('_active');
                        
                        // Focus on search input
                        const searchInput = searchContainer.querySelector('[data-filter-search]');
                        if (searchInput) {
                            setTimeout(() => searchInput.focus(), 100);
                        }
                    }
                }
            }
        });
    }

    handleTaxonomyFilter(checkbox) {
        const taxonomy = checkbox.dataset.filterTaxonomy;
        const value = checkbox.value;
        
        console.log('☑️ Checkbox filter changed:', {
            taxonomy,
            value,
            checked: checkbox.checked
        });
        
        if (!this.currentFilters[taxonomy]) {
            this.currentFilters[taxonomy] = [];
        }

        if (checkbox.checked) {
            if (!this.currentFilters[taxonomy].includes(value)) {
                this.currentFilters[taxonomy].push(value);
            }
        } else {
            this.currentFilters[taxonomy] = this.currentFilters[taxonomy].filter(v => v !== value);
            if (this.currentFilters[taxonomy].length === 0) {
                delete this.currentFilters[taxonomy];
            }
        }

        console.log('📋 Updated filters:', this.currentFilters);

        this.currentPage = 1;
        this.applyFilters();
    }

    handleMakeCheckboxChange(makeCheckbox) {
        const makeSlug = makeCheckbox.dataset.makeParent || makeCheckbox.value;
        const isChecked = makeCheckbox.checked;
        
        console.log('🏭 Make checkbox changed:', { makeSlug, isChecked });
        
        // Find the models container for this make
        const modelsContainer = document.querySelector(`[data-make-models="${makeSlug}"]`);
        
        if (modelsContainer) {
            if (isChecked) {
                // Show models with animation
                this.expandModelsContainer(modelsContainer);
            } else {
                // Hide models and uncheck all model checkboxes for this make
                this.collapseModelsContainer(modelsContainer);
                this.uncheckMakeModels(makeSlug);
            }
        }
    }

    expandModelsContainer(container) {
        // Show the container
        container.style.display = 'block';
        
        // Force reflow to ensure display change is applied
        container.offsetHeight;
        
        // Add expanded class for animation
        container.classList.add('expanded');
        
        console.log('📈 Expanded models container');
    }

    collapseModelsContainer(container) {
        // Remove expanded class for animation
        container.classList.remove('expanded');
        
        // Hide after animation completes
        setTimeout(() => {
            if (!container.classList.contains('expanded')) {
                container.style.display = 'none';
            }
        }, 300); // Match CSS transition duration
        
        console.log('📉 Collapsed models container');
    }

    uncheckMakeModels(makeSlug) {
        // Find all model checkboxes for this make and uncheck them
        const modelCheckboxes = document.querySelectorAll(`[data-filter-taxonomy="model"][data-model-parent="${makeSlug}"]`);
        
        modelCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                checkbox.checked = false;
                
                // Remove from filters
                if (this.currentFilters.model) {
                    this.currentFilters.model = this.currentFilters.model.filter(v => v !== checkbox.value);
                    if (this.currentFilters.model.length === 0) {
                        delete this.currentFilters.model;
                    }
                }
            }
        });
        
        console.log('🚗 Unchecked models for make:', makeSlug);
    }

    removeModelsFromFilters(makeSlug) {
        // Remove all models for this make from currentFilters
        if (this.currentFilters.model) {
            // Find all model checkboxes for this make to get their values
            const modelCheckboxes = document.querySelectorAll(`[data-filter-taxonomy="model"][data-model-parent="${makeSlug}"]`);
            const modelSlugsToRemove = Array.from(modelCheckboxes).map(cb => cb.value);
            
            // Remove these model slugs from current filters
            this.currentFilters.model = this.currentFilters.model.filter(modelSlug => 
                !modelSlugsToRemove.includes(modelSlug)
            );
            
            // Clean up empty model filter array
            if (this.currentFilters.model.length === 0) {
                delete this.currentFilters.model;
            }
            
            console.log('🧹 Removed models from filters for make:', makeSlug, 'Models removed:', modelSlugsToRemove);
        }
    }

    removeMakeAndModels(makeSlug) {
        console.log('🗑️ Removing make and its models:', makeSlug);
        
        // Collapse the models container
        const modelsContainer = document.querySelector(`[data-make-models="${makeSlug}"]`);
        if (modelsContainer) {
            this.collapseModelsContainer(modelsContainer);
        }
        
        // Remove all model filters for this make
        if (this.currentFilters.model) {
            // Get all model checkboxes for this make
            const modelCheckboxes = document.querySelectorAll(`[data-filter-taxonomy="model"][data-model-parent="${makeSlug}"]`);
            const modelSlugsToRemove = Array.from(modelCheckboxes).map(cb => cb.value);
            
            // Remove these model slugs from current filters
            this.currentFilters.model = this.currentFilters.model.filter(modelSlug => 
                !modelSlugsToRemove.includes(modelSlug)
            );
            
            // Clean up empty model filter array
            if (this.currentFilters.model.length === 0) {
                delete this.currentFilters.model;
            }
            
            // Uncheck all model checkboxes for this make
            modelCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
        
        console.log('🧹 Cleaned up make and models:', makeSlug);
    }

    applyFilters() {
        if (this.isLoading) return;

        this.isLoading = true;
        this.showLoadingState();

        const data = {
            action: 'filter_vehicles',
            nonce: vroomqc_ajax.nonce,
            page: this.currentPage,
            search: this.currentSearch,
            sort: this.currentSort,
            filters: this.currentFilters
        };

        // Log filter data being sent
        console.log('🔍 Applying filters:', {
            page: this.currentPage,
            search: this.currentSearch,
            sort: this.currentSort,
            filters: this.currentFilters
        });

        fetch(vroomqc_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: this.serializeFormData(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log('📥 Server response:', result);
            if (result.success) {
                console.log('✅ Filter applied successfully');
                this.updateResults(result.data);
                this.updateURL();
                this.updateFilterPills();
                this.saveStateToStorage();
            } else {
                console.error('❌ Filter error:', result);
            }
        })
        .catch(error => {
            console.error('❌ AJAX error:', error);
        })
        .finally(() => {
            this.isLoading = false;
            this.hideLoadingState();
        });
    }

    /**
     * Serialize form data properly for PHP to handle nested arrays
     */
    serializeFormData(data) {
        const params = new URLSearchParams();
        
        for (const [key, value] of Object.entries(data)) {
            if (key === 'filters' && typeof value === 'object') {
                // Handle filters object with nested arrays
                for (const [filterKey, filterValue] of Object.entries(value)) {
                    if (Array.isArray(filterValue)) {
                        filterValue.forEach(item => {
                            params.append(`filters[${filterKey}][]`, item);
                        });
                    } else {
                        params.append(`filters[${filterKey}]`, filterValue);
                    }
                }
            } else {
                params.append(key, value);
            }
        }
        
        console.log('📤 Serialized data:', params.toString());
        return params;
    }

    updateResults(data) {
        // Update vehicle grid
        const vehiclesGrid = document.getElementById('vehicles-grid');
        if (vehiclesGrid) {
            vehiclesGrid.innerHTML = data.vehicles || '<p class="no-vehicles-message">No vehicles found.</p>';
        }

        // Update pagination
        const paginationContainer = document.getElementById('pagination-container');
        if (paginationContainer) {
            paginationContainer.innerHTML = data.pagination || '';
        }

        // Update vehicle count
        this.updateVehicleCount(data);
        
        // Update taxonomy counts
        if (data.taxonomy_counts) {
            this.updateTaxonomyCounts(data.taxonomy_counts);
        }
        
        // No longer needed - old make group logic removed
    }

    updateVehicleCount(data) {
        const vehicleCount = document.getElementById('vehicle-count');
        if (vehicleCount && data.total_vehicles !== undefined) {
            const showingCount = data.showing_to - data.showing_from + 1;
            const totalCount = data.total_vehicles;
            
            if (totalCount > 0) {
                vehicleCount.innerHTML = `<span class="showing-count">${data.showing_from}-${data.showing_to}</span> of <span class="total-count">${totalCount}</span> ${totalCount === 1 ? 'vehicle' : 'vehicles'}`;
            } else {
                vehicleCount.innerHTML = 'No vehicles available';
            }
        }
    }

    updateTaxonomyCounts(taxonomyCounts) {
        console.log('📊 Updating counts. Current filters:', this.currentFilters);
        
        Object.entries(taxonomyCounts).forEach(([taxonomy, counts]) => {
            // ALWAYS skip updating make/model counts - they should never change after initial load
            if (taxonomy === 'make' || taxonomy === 'model') {
                console.log(`⏭️ Skipping ${taxonomy} count update - preserving initial counts`);
                return;
            }
            
            console.log(`✅ Updating ${taxonomy} counts:`, counts);
            
            Object.entries(counts).forEach(([slug, count]) => {
                // Find the checkbox for this taxonomy term
                const checkbox = document.querySelector(`input[data-filter-taxonomy="${taxonomy}"][value="${slug}"]`);
                if (checkbox) {
                    const label = checkbox.closest('.body-products-aside__row')?.querySelector('.body-products-aside__caption');
                    if (label) {
                        // Update or add the count span
                        let countSpan = label.querySelector('.filter-count');
                        if (!countSpan) {
                            countSpan = document.createElement('span');
                            countSpan.className = 'filter-count';
                            label.appendChild(countSpan);
                        }
                        
                        const oldCount = countSpan.textContent;
                        countSpan.textContent = ` (${count})`;
                        console.log(`📈 Updated ${taxonomy} ${slug}: ${oldCount} → (${count})`);
                        
                        // Hide/show row based on count and taxonomy type
                        const row = checkbox.closest('.body-products-aside__row');
                        
                        if (taxonomy === 'model') {
                            // For model taxonomy - hide zero-count models
                            if (count === 0) {
                                row.style.display = 'none';
                            } else {
                                // Check search filter and make group visibility
                                const rowsContainer = document.querySelector(`[data-filter-rows="${taxonomy}"]`);
                                const searchInput = rowsContainer?.closest('.body-products-aside__item')?.querySelector(`[data-filter-search="${taxonomy}"]`);
                                const currentSearchTerm = searchInput?.value?.toLowerCase() || '';
                                
                                let shouldShow = true;
                                
                                // Check search filter
                                if (currentSearchTerm !== '') {
                                    const labelText = label.textContent.toLowerCase();
                                    shouldShow = labelText.includes(currentSearchTerm);
                                }
                                
                                // No longer checking old make group structure
                                
                                row.style.display = shouldShow ? '' : 'none';
                            }
                        } else {
                            // For other taxonomies - show all but disable zero-count (except for make)
                            const rowsContainer = document.querySelector(`[data-filter-rows="${taxonomy}"]`);
                            const searchInput = rowsContainer?.closest('.body-products-aside__item')?.querySelector(`[data-filter-search="${taxonomy}"]`);
                            const currentSearchTerm = searchInput?.value?.toLowerCase() || '';
                            
                            // Enable/disable checkbox based on count (but never disable make checkboxes)
                            const isDisabled = count === 0 && taxonomy !== 'make';
                            checkbox.disabled = isDisabled;
                            if (isDisabled) {
                                row.classList.add('body-products-aside__row--disabled');
                            } else {
                                row.classList.remove('body-products-aside__row--disabled');
                            }
                            
                            // Check search filter
                            if (currentSearchTerm !== '') {
                                const labelText = label.textContent.toLowerCase();
                                const matches = labelText.includes(currentSearchTerm);
                                row.style.display = matches ? '' : 'none';
                            } else {
                                row.style.display = '';
                            }
                        }
                    }
                }
            });
        });
        
        // No longer needed - old make group logic removed
    }

    updateFilterPills() {
        const pillsContainer = document.querySelector('#filter-pills .filter-pills__container');
        const filterPillsSection = document.getElementById('filter-pills');
        
        if (!pillsContainer) return;

        let pillsHTML = '';
        let hasActiveFilters = false;

        // Check if we have any active filters or search
        const hasFilters = Object.keys(this.currentFilters).length > 0;
        const hasSearch = this.currentSearch && this.currentSearch.trim() !== '';
        hasActiveFilters = hasFilters || hasSearch;

        // Only show pills if we have active filters
        if (hasActiveFilters) {
            // Add clear all pill first
            pillsHTML += `
                <button type="button" class="filter-pill filter-pill--clear-all" data-clear-all>
                    <span class="filter-pill__text">Clear all filters</span>
                </button>
            `;

            // Add search pill
            if (hasSearch) {
                pillsHTML += `
                    <button type="button" class="filter-pill" data-filter-type="search">
                        <span class="filter-pill__text">Search: "${this.currentSearch}"</span>
                        <span class="filter-pill__remove">×</span>
                    </button>
                `;
            }

            // Add taxonomy and range filter pills
            Object.entries(this.currentFilters).forEach(([filterKey, values]) => {
                if (Array.isArray(values) && values.length > 0) {
                    // Taxonomy filters
                    values.forEach(value => {
                        pillsHTML += `
                            <button type="button" class="filter-pill" data-filter-type="${filterKey}" data-filter-value="${value}">
                                <span class="filter-pill__text">${this.formatFilterLabel(filterKey, value)}</span>
                                <span class="filter-pill__remove">×</span>
                            </button>
                        `;
                    });
                } else if (!Array.isArray(values) && values !== undefined) {
                    // Range filters (price_min, price_max, etc.)
                    const rangeLabel = this.formatRangeFilterLabel(filterKey, values);
                    if (rangeLabel) {
                        pillsHTML += `
                            <button type="button" class="filter-pill" data-filter-type="${filterKey}">
                                <span class="filter-pill__text">${rangeLabel}</span>
                                <span class="filter-pill__remove">×</span>
                            </button>
                        `;
                    }
                }
            });

            // Add combined range filter pills
            this.addRangeFilterPills().forEach(pill => {
                pillsHTML += pill;
            });
        }

        pillsContainer.innerHTML = pillsHTML;
        
        // Show/hide filter pills section
        if (filterPillsSection) {
            filterPillsSection.style.display = hasActiveFilters ? 'block' : 'none';
        }
    }

    formatFilterLabel(taxonomy, value) {
        // Convert taxonomy and value to readable format
        const taxonomyLabels = {
            'make': 'Make',
            'model': 'Model',
            'body-style': 'Body Style',
            'transmission': 'Transmission',
            'drivetrain': 'Drivetrain',
            'fuel-type': 'Fuel Type',
            'trim': 'Trim',
            'cylinder': 'Cylinders',
            'exterior-color': 'Exterior Color',
            'interior-color': 'Interior Color'
        };

        const label = taxonomyLabels[taxonomy] || taxonomy;
        return `${label}: ${value.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}`;
    }

    addRangeFilterPills() {
        const pills = [];
        
        // Price range pill
        if (this.currentFilters.price_min || this.currentFilters.price_max) {
            const min = this.currentFilters.price_min || 0;
            const max = this.currentFilters.price_max || 999999;
            pills.push(`
                <button type="button" class="filter-pill" data-filter-type="price-range">
                    <span class="filter-pill__text">Price: $${min.toLocaleString()} - $${max.toLocaleString()}</span>
                    <span class="filter-pill__remove">×</span>
                </button>
            `);
        }
        
        // Mileage range pill
        if (this.currentFilters.mileage_min || this.currentFilters.mileage_max) {
            const min = this.currentFilters.mileage_min || 0;
            const max = this.currentFilters.mileage_max || 999999;
            pills.push(`
                <button type="button" class="filter-pill" data-filter-type="mileage-range">
                    <span class="filter-pill__text">Mileage: ${min.toLocaleString()} - ${max.toLocaleString()} km</span>
                    <span class="filter-pill__remove">×</span>
                </button>
            `);
        }
        
        // Year range pill
        if (this.currentFilters.year_min || this.currentFilters.year_max) {
            const min = this.currentFilters.year_min || new Date().getFullYear() - 20;
            const max = this.currentFilters.year_max || new Date().getFullYear();
            pills.push(`
                <button type="button" class="filter-pill" data-filter-type="year-range">
                    <span class="filter-pill__text">Year: ${min} - ${max}</span>
                    <span class="filter-pill__remove">×</span>
                </button>
            `);
        }
        
        return pills;
    }

    formatRangeFilterLabel(filterKey, value) {
        // This method is for individual range filters (not used in current implementation)
        return null;
    }

    removeFilterPill(pill) {
        const filterType = pill.dataset.filterType;
        const filterValue = pill.dataset.filterValue;

        if (filterType === 'search') {
            this.currentSearch = '';
            const searchInput = document.getElementById('vehicle-search');
            if (searchInput) searchInput.value = '';
        } else if (filterType === 'price-range') {
            // Clear price range
            delete this.currentFilters.price_min;
            delete this.currentFilters.price_max;
            this.resetPriceSlider();
        } else if (filterType === 'mileage-range') {
            // Clear mileage range
            delete this.currentFilters.mileage_min;
            delete this.currentFilters.mileage_max;
            this.resetMileageSlider();
        } else if (filterType === 'year-range') {
            // Clear year range
            delete this.currentFilters.year_min;
            delete this.currentFilters.year_max;
            this.resetYearSlider();
        } else if (filterValue) {
            // Taxonomy filters
            if (this.currentFilters[filterType]) {
                this.currentFilters[filterType] = this.currentFilters[filterType].filter(v => v !== filterValue);
                if (this.currentFilters[filterType].length === 0) {
                    delete this.currentFilters[filterType];
                }
            }
            
            // Uncheck corresponding checkbox
            const checkbox = document.querySelector(`[data-filter-taxonomy="${filterType}"][value="${filterValue}"]`);
            if (checkbox) {
                checkbox.checked = false;
                
                // Special handling for make removal - also remove associated models
                if (filterType === 'make') {
                    this.removeMakeAndModels(filterValue);
                }
            }
        }

        this.currentPage = 1;
        this.applyFilters();
    }

    clearAllFilters() {
        this.currentFilters = {};
        this.currentSearch = '';
        this.currentPage = 1;

        // Clear search input
        const searchInput = document.getElementById('vehicle-search');
        if (searchInput) searchInput.value = '';

        // Uncheck all checkboxes
        document.querySelectorAll('[data-filter-taxonomy]:checked').forEach(checkbox => {
            checkbox.checked = false;
        });

        // Collapse all model containers
        const modelContainers = document.querySelectorAll('.body-products-aside__models-container');
        modelContainers.forEach(container => {
            container.classList.remove('expanded');
            container.style.display = 'none';
        });

        // Reset range sliders
        this.resetRangeSliders();

        this.applyFilters();
    }

    clearFilter(filterType) {
        if (this.currentFilters[filterType]) {
            delete this.currentFilters[filterType];
            
            // Uncheck corresponding checkboxes
            document.querySelectorAll(`[data-filter-taxonomy="${filterType}"]:checked`).forEach(checkbox => {
                checkbox.checked = false;
            });

            this.currentPage = 1;
            this.applyFilters();
        }
    }

    resetRangeSliders() {
        this.resetPriceSlider();
        this.resetMileageSlider();
        this.resetYearSlider();
    }

    resetPriceSlider() {
        const priceSlider = document.getElementById('products-range-slider');
        if (priceSlider && priceSlider.noUiSlider) {
            const minValue = parseInt(priceSlider.dataset.minValue) || 0;
            const maxValue = parseInt(priceSlider.dataset.maxValue) || 100000;
            priceSlider.noUiSlider.set([minValue, maxValue]);
        }
    }

    resetMileageSlider() {
        const mileageSlider = document.getElementById('mileage-range-slider');
        if (mileageSlider && mileageSlider.noUiSlider) {
            const minValue = parseInt(mileageSlider.dataset.minValue) || 0;
            const maxValue = parseInt(mileageSlider.dataset.maxValue) || 300000;
            mileageSlider.noUiSlider.set([minValue, maxValue]);
        }
    }

    resetYearSlider() {
        const yearSlider = document.getElementById('year-range-slider');
        if (yearSlider && yearSlider.noUiSlider) {
            const minValue = parseInt(yearSlider.dataset.minValue) || new Date().getFullYear() - 20;
            const maxValue = parseInt(yearSlider.dataset.maxValue) || new Date().getFullYear();
            yearSlider.noUiSlider.set([minValue, maxValue]);
        }
    }

    showLoadingState() {
        const vehiclesGrid = document.getElementById('vehicles-grid');
        if (vehiclesGrid) {
            vehiclesGrid.style.opacity = '0.5';
            vehiclesGrid.style.pointerEvents = 'none';
        }
    }

    hideLoadingState() {
        const vehiclesGrid = document.getElementById('vehicles-grid');
        if (vehiclesGrid) {
            vehiclesGrid.style.opacity = '1';
            vehiclesGrid.style.pointerEvents = 'auto';
        }
    }

    updateURL() {
        const url = new URL(window.location);
        
        // Clear existing filter params
        const filterParams = ['search', 'sort', 'page', 'make', 'model', 'body-style', 'transmission', 'drivetrain', 'fuel-type', 'trim', 'cylinder', 'exterior-color', 'interior-color', 'price_min', 'price_max', 'mileage_min', 'mileage_max', 'year_min', 'year_max'];
        filterParams.forEach(param => url.searchParams.delete(param));

        // Add current filters
        if (this.currentSearch) {
            url.searchParams.set('search', this.currentSearch);
        }
        
        if (this.currentSort !== 'newest') {
            url.searchParams.set('sort', this.currentSort);
        }
        
        if (this.currentPage > 1) {
            url.searchParams.set('page', this.currentPage);
        }

        Object.entries(this.currentFilters).forEach(([key, values]) => {
            if (Array.isArray(values) && values.length > 0) {
                // Taxonomy filters
                url.searchParams.set(key, values.join(','));
            } else if (!Array.isArray(values) && values !== undefined && values !== null) {
                // Range filters (price_min, price_max, etc.)
                const rangeFilters = ['price_min', 'price_max', 'mileage_min', 'mileage_max', 'year_min', 'year_max'];
                if (rangeFilters.includes(key)) {
                    // Only add range filters if they differ from defaults
                    const shouldAddToURL = this.shouldAddRangeFilterToURL(key, values);
                    if (shouldAddToURL) {
                        url.searchParams.set(key, values);
                    }
                }
            }
        });

        console.log('🔗 Updated URL:', url.toString());
        window.history.replaceState({}, '', url);
    }

    shouldAddRangeFilterToURL(key, value) {
        // Get default values for range filters
        const priceSlider = document.getElementById('products-range-slider');
        const mileageSlider = document.getElementById('mileage-range-slider');
        const yearSlider = document.getElementById('year-range-slider');
        
        switch (key) {
            case 'price_min':
                const priceMin = priceSlider ? parseInt(priceSlider.dataset.minValue) || 0 : 0;
                return value !== priceMin;
            case 'price_max':
                const priceMax = priceSlider ? parseInt(priceSlider.dataset.maxValue) || 100000 : 100000;
                return value !== priceMax;
            case 'mileage_min':
                const mileageMin = mileageSlider ? parseInt(mileageSlider.dataset.minValue) || 0 : 0;
                return value !== mileageMin;
            case 'mileage_max':
                const mileageMax = mileageSlider ? parseInt(mileageSlider.dataset.maxValue) || 300000 : 300000;
                return value !== mileageMax;
            case 'year_min':
                const yearMin = yearSlider ? parseInt(yearSlider.dataset.minValue) || (new Date().getFullYear() - 20) : (new Date().getFullYear() - 20);
                return value !== yearMin;
            case 'year_max':
                const yearMax = yearSlider ? parseInt(yearSlider.dataset.maxValue) || new Date().getFullYear() : new Date().getFullYear();
                return value !== yearMax;
            default:
                return false;
        }
    }

    restoreStateFromURL() {
        const url = new URL(window.location);
        
        // Restore search
        const search = url.searchParams.get('search');
        if (search) {
            this.currentSearch = search;
            const searchInput = document.getElementById('vehicle-search');
            if (searchInput) searchInput.value = search;
        }

        // Restore sort
        const sort = url.searchParams.get('sort');
        if (sort) {
            this.currentSort = sort;
        }

        // Restore page
        const page = url.searchParams.get('page');
        if (page) {
            this.currentPage = parseInt(page);
        }

        // Restore taxonomy filters
        const taxonomies = ['make', 'model', 'body-style', 'transmission', 'drivetrain', 'fuel-type', 'trim', 'cylinder', 'exterior-color', 'interior-color'];
        taxonomies.forEach(taxonomy => {
            const values = url.searchParams.get(taxonomy);
            if (values) {
                this.currentFilters[taxonomy] = values.split(',');
                
                // Check corresponding checkboxes
                values.split(',').forEach(value => {
                    const checkbox = document.querySelector(`[data-filter-taxonomy="${taxonomy}"][value="${value}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                        
                        // Special handling for make checkboxes - expand their models
                        if (taxonomy === 'make') {
                            const modelsContainer = document.querySelector(`[data-make-models="${value}"]`);
                            if (modelsContainer) {
                                this.expandModelsContainer(modelsContainer);
                            }
                        }
                    }
                });
            }
        });

        // Restore range filters
        const rangeFilters = ['price_min', 'price_max', 'mileage_min', 'mileage_max', 'year_min', 'year_max'];
        rangeFilters.forEach(filter => {
            const value = url.searchParams.get(filter);
            if (value) {
                this.currentFilters[filter] = parseInt(value);
            }
        });

        console.log('🔄 Restored filters from URL:', this.currentFilters);

        // If we have any filters from URL, apply them
        if (this.currentSearch || Object.keys(this.currentFilters).length > 0 || this.currentSort !== 'newest' || this.currentPage > 1) {
            this.applyFilters();
        }
    }

    saveStateToStorage() {
        const state = {
            filters: this.currentFilters,
            search: this.currentSearch,
            sort: this.currentSort,
            page: this.currentPage
        };
        
        try {
            localStorage.setItem('vroomqc_inventory_state', JSON.stringify(state));
        } catch (e) {
            console.warn('Could not save to localStorage:', e);
        }
    }

    loadInitialFilterData() {
        // Load dynamic filter data from server
        fetch(vroomqc_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'get_filter_data',
                nonce: vroomqc_ajax.nonce
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                this.initializeDynamicFilters(result.data);
            }
        })
        .catch(error => {
            console.error('Error loading filter data:', error);
        });
    }

    initializeDynamicFilters(data) {
        console.log('🔄 Initializing dynamic filters with data:', data);
        
        // Initialize price range
        if (data.price_range) {
            console.log('💰 Setting price range:', data.price_range);
            this.initializePriceRange(data.price_range.min, data.price_range.max);
        }

        // Initialize mileage range
        if (data.mileage_range) {
            console.log('📏 Setting mileage range:', data.mileage_range);
            this.initializeMileageRange(data.mileage_range.min, data.mileage_range.max);
        }

        // Initialize year range
        if (data.year_range) {
            console.log('📅 Setting year range:', data.year_range);
            this.initializeYearRange(data.year_range.min, data.year_range.max);
        }

        // Initialize taxonomy filters
        if (data.taxonomies) {
            console.log('📑 Setting taxonomy filters:', data.taxonomies);
            this.initializeTaxonomyFilters(data.taxonomies);
        }
        
        // DON'T re-setup sliders here as they are already set up in the initial load
        // this.setupRangeSliders();
    }

    initializePriceRange(min, max) {
        const priceSlider = document.getElementById('products-range-slider');
        const priceMinInput = document.getElementById('producs-price-min-input');
        const priceMaxInput = document.getElementById('producs-price-max-input');
        
        if (priceSlider) {
            priceSlider.dataset.minValue = min;
            priceSlider.dataset.maxValue = max;
        }
        
        if (priceMinInput && priceMaxInput) {
            priceMinInput.value = `$${min.toLocaleString()}`;
            priceMaxInput.value = `$${max.toLocaleString()}`;
        }
    }

    initializeMileageRange(min, max) {
        const mileageSlider = document.getElementById('mileage-range-slider');
        const mileageMinInput = document.getElementById('mileage-min-input');
        const mileageMaxInput = document.getElementById('mileage-max-input');
        
        if (mileageSlider) {
            mileageSlider.dataset.minValue = min;
            mileageSlider.dataset.maxValue = max;
        }
        
        if (mileageMinInput && mileageMaxInput) {
            mileageMinInput.value = `${min.toLocaleString()} km`;
            mileageMaxInput.value = `${max.toLocaleString()} km`;
        }
    }

    initializeYearRange(min, max) {
        const yearSlider = document.getElementById('year-range-slider');
        const yearMinInput = document.getElementById('year-min-input');
        const yearMaxInput = document.getElementById('year-max-input');
        
        if (yearSlider) {
            yearSlider.dataset.minValue = min;
            yearSlider.dataset.maxValue = max;
        }
        
        if (yearMinInput && yearMaxInput) {
            yearMinInput.value = min;
            yearMaxInput.value = max;
        }
    }

    initializeTaxonomyFilters(taxonomies) {
        // Will be implemented to populate dynamic taxonomy filters
        console.log('Taxonomy data:', taxonomies);
    }
}