@php
    $navCategories = \App\Models\dashboard\ProductCategory::where('status', 1)->get();
    $navTitles = \App\Models\dashboard\PageContent::getSectionAsArray('navbar', 'titles');
@endphp
    <!-- Unified Fixed Navigation Hub Layout -->
    <nav class="navbar-custom {{ request()->routeIs('front.product') ? 'scrolled' : '' }}" id="mainNavbar">
        <div class="container d-flex flex-column">
            <div class="navbar-top-wrapper">
                <!-- Menu Toggle (RIGHT in RTL) -->
                <div class="nav-icons nav-icons-right">
                    <button class="menu-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
                        aria-controls="mobileSidebar">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                </div>

                <!-- Logo (CENTER) -->
                <a class="navbar-brand-custom" href="{{ route('front.index') }}">
                    L.D
                    <span>IMPORTER</span>
                </a>


                 <!-- Search & Favorites (LEFT in RTL) -->
                <div class="nav-icons nav-icons-left">
                    <button id="searchTriggerBtn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="{{ route('front.favorites') }}" class="nav-favorite-btn">
                        <i class="fa{{ session()->get('favorites', []) ? 's' : 'r' }} fa-heart"></i>
                        @if(count(session()->get('favorites', [])) > 0)
                        <span class="fav-count-badge">{{ count(session()->get('favorites', [])) }}</span>
                        @endif
                    </a>
                </div>


                <!-- Dropdown Search Bar Matrix -->
                <div id="searchDropdownField" class="search-dropdown-wrapper">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-magnifying-glass text-white opacity-50"></i>
                        <input type="text" class="form-control search-form-control" id="liveSearchInput"
                            placeholder="{{ $navTitles['search_placeholder'] ?? 'Search premium furniture, tables, mirrors...' }}" autocomplete="off">
                        <button id="searchCloseBtn" type="button" class="search-close-btn"><i
                                class="fa-solid fa-xmark"></i></button>
                    </div>
                    <!-- Live Search Results -->
                    <div id="liveSearchResults" class="live-search-results"></div>
                </div>
            </div>

            <!-- Desktop Layout Inline Navigation -->
            <div class="nav-links-row">
                <a class="nav-link-custom {{ request()->routeIs('front.contact') ? 'active' : '' }}" href="{{ route('front.contact') }}">{{ $navTitles['contact'] ?? 'Contact' }}</a>
                <a class="nav-link-custom {{ request()->routeIs('front.category') && !request()->routeIs('front.category.show') ? 'active' : '' }}" href="{{ route('front.category') }}">{{ $navTitles['all_products'] ?? 'All Products' }}</a>
                @foreach($navCategories as $cat)
                <a class="nav-link-custom {{ request()->is('category/'.$cat->slug) ? 'active' : '' }}" href="{{ route('front.category.show', $cat->slug) }}">{{ $cat->name }}</a>
                @endforeach
                <a class="nav-link-custom {{ request()->routeIs('front.about') ? 'active' : '' }}" href="{{ route('front.about') }}">{{ $navTitles['about'] ?? 'About' }}</a>
                <a class="nav-link-custom {{ request()->routeIs('front.index') ? 'active' : '' }}" href="{{ route('front.index') }}">{{ $navTitles['home'] ?? 'Home' }}</a>
            </div>
        </div>
    </nav>


    <!-- Slideout Responsive Drawer Compartment -->
    <div class="offcanvas offcanvas-end offcanvas-custom" tabindex="-1" id="mobileSidebar"
        aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header pt-4 px-3">
            <div class="footer-logo-area">L.D <span>IMPORTER</span></div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pt-4">
            <!-- Mobile Search -->
            <form action="{{ route('front.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="{{ $navTitles['search_products'] ?? 'Search products...' }}">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
            <div class="offcanvas-menu-links pt-2">
                <a href="{{ route('front.index') }}">{{ $navTitles['home'] ?? 'Home' }}</a>
                <a href="{{ route('front.about') }}">{{ $navTitles['about'] ?? 'About' }}</a>
                @foreach($navCategories as $cat)
                <a href="{{ route('front.category.show', $cat->slug) }}">{{ $cat->name }}</a>
                @endforeach
                <a href="{{ route('front.category') }}">{{ $navTitles['all_products'] ?? 'All Products' }}</a>
                <a href="{{ route('front.contact') }}">{{ $navTitles['contact'] ?? 'Contact' }}</a>
            </div>
        </div>
    </div>

    <!-- Live Search JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('liveSearchInput');
        const searchResults = document.getElementById('liveSearchResults');
        let searchTimeout;

        if (searchInput && searchResults) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();

                if (query.length < 2) {
                    searchResults.innerHTML = '';
                    searchResults.style.display = 'none';
                    return;
                }

                searchTimeout = setTimeout(function() {
                    fetch('{{ route("front.search.live") }}?q=' + encodeURIComponent(query))
                        .then(response => response.json())
                        .then(data => {
                            if (data.length === 0) {
                                searchResults.innerHTML = '<div class="live-search-empty"> לא נמצאו דגמים תואמים </div>';
                            } else {
                                let html = '';
                                data.forEach(function(product) {
                                    html += '<a href="' + product.url + '" class="live-search-item">';
                                    html += '<img src="' + product.image + '" alt="' + product.name + '">';
                                    html += '<div class="live-search-info">';
                                    html += '<div class="live-search-name">' + product.name + '</div>';
                                    html += '<div class="live-search-category">' + product.category + '</div>';
                                    html += '<div class="live-search-price">';
                                    if (product.has_discount) {
                                        html += '<span class="original">₪' + product.original_price + '</span> ';
                                        html += '<span class="discount">₪' + product.price + '</span>';
                                    } else {
                                        html += '₪' + product.price;
                                    }
                                    html += '</div>';
                                    html += '</div>';
                                    html += '</a>';
                                });
                                html += '<a href="{{ route("front.search") }}?q=' + encodeURIComponent(query) + '" class="live-search-view-all"> הצג את כל התוצאות  ←</a>';
                                searchResults.innerHTML = html;
                            }
                            searchResults.style.display = 'block';
                        })
                        .catch(function() {
                            searchResults.style.display = 'none';
                        });
                }, 300);
            });

            // Close on click outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.style.display = 'none';
                }
            });

            // Close on Escape
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    searchResults.style.display = 'none';
                }
            });

            // Show results when focusing input if has value
            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length >= 2 && searchResults.innerHTML) {
                    searchResults.style.display = 'block';
                }
            });
        }
    });
    </script>
