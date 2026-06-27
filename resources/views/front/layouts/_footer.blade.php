@php
    $setting = \App\Models\dashboard\Setting::getSettings();
    $footerCategories = \App\Models\dashboard\ProductCategory::where('status', 1)->take(4)->get();
@endphp

<!-- Structural Minimal Footer -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-logo-area">L.D <span>IMPORTER</span></div>
                <p class="mt-3 footer-desc-text" style="font-size:12px; line-height:1.8; max-width: 300px;">
                    {{ $setting->site_description ?? 'Providing curated premium contemporary design pieces to elevate architectural domestic spaces.' }}
                </p>
                <div class="footer-social-links mt-4">
                    @if($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    @endif
                    @if($setting->tiktok)
                    <a href="{{ $setting->tiktok }}" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                    @endif
                    @if($setting->youtube)
                    <a href="{{ $setting->youtube }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                    @if($setting->snapchat)
                    <a href="{{ $setting->snapchat }}" target="_blank"><i class="fa-brands fa-snapchat"></i></a>
                    @endif
                    @if($setting->twitter)
                    <a href="{{ $setting->twitter }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    @endif
                    @if($setting->linkedin)
                    <a href="{{ $setting->linkedin }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-md-2">
                <h5>Information</h5>
                <ul>
                    <li><a href="{{ route('front.about') }}">Our Story</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Returns & Exchanges</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Collections</h5>
                <ul>
                    @foreach($footerCategories as $cat)
                    <li><a href="{{ route('front.category.show', $cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                    <li><a href="{{ route('front.category') }}">View All</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Customer Care</h5>
                <ul class="footer-contact-list" style="line-height: 1.8;">
                    @if($setting->phone1)
                    <li><i class="fa-solid fa-phone me-2"></i> {{ $setting->phone1 }}</li>
                    @endif
                    @if($setting->email)
                    <li><i class="fa-regular fa-envelope me-2"></i> {{ $setting->email }}</li>
                    @endif
                    @if($setting->working_hours)
                    <li><i class="fa-regular fa-clock me-2"></i> {{ $setting->working_hours }}</li>
                    @endif
                    @if($setting->address)
                    <li><i class="fa-solid fa-location-dot me-2"></i> {{ $setting->address }}</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row bottom-copyright text-center">
            <div class="col-12">
                <p>All Rights Reserved &copy; {{ $setting->site_name ?? 'L.D Importer' }} {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>

@if($setting->whatsapp)
<!-- WhatsApp Floating Action Button Matrix -->
<a href="https://wa.me/{{ $setting->whatsapp }}" class="whatsapp-floating-btn" target="_blank" aria-label="Chat via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>
@endif

<!-- Bootstrap 5 JS Engine -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- AOS Animation Library Core JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    // Initialize Premium Scroll Animation Module
    AOS.init({
        duration: 800,
        once: true,
        offset: 120
    });

    // Smart Sticky Navbar Logic Engine
    const mainNavbar = document.getElementById('mainNavbar');
    const isProductPage = mainNavbar.classList.contains('scrolled') && window.location.pathname.startsWith('/product/');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50 || isProductPage) {
            mainNavbar.classList.add('scrolled');
        } else {
            mainNavbar.classList.remove('scrolled');
        }
    });

    // Search Interface Logic Engine
    const searchTriggerBtn = document.getElementById('searchTriggerBtn');
    const searchDropdownField = document.getElementById('searchDropdownField');
    const searchCloseBtn = document.getElementById('searchCloseBtn');

    searchTriggerBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        searchDropdownField.classList.toggle('show');
        if (searchDropdownField.classList.contains('show')) {
            searchDropdownField.querySelector('input').focus();
        }
    });

    searchCloseBtn.addEventListener('click', function() {
        searchDropdownField.classList.remove('show');
    });

    document.addEventListener('click', function(e) {
        if (!searchDropdownField.contains(e.target) && e.target !== searchTriggerBtn && !searchTriggerBtn
            .contains(e.target)) {
            searchDropdownField.classList.remove('show');
        }
    });

    // Favorite Toggle Function
    function toggleFavorite(btn) {
        const productId = btn.dataset.id;
        btn.classList.add('animating');

        fetch('/favorites/toggle/' + productId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.added) {
                btn.classList.add('active');
                btn.innerHTML = '<i class="fas fa-heart"></i>';
            } else {
                btn.classList.remove('active');
                btn.innerHTML = '<i class="far fa-heart"></i>';
                // If on favorites page, remove the card
                if (window.location.pathname === '/favorites') {
                    btn.closest('.product-catalog-item').remove();
                    // Check if empty
                    const wrapper = document.querySelector('.row.g-3.g-md-4');
                    if (wrapper && wrapper.children.length === 0) {
                        location.reload();
                    }
                }
            }
            // Update navbar badge
            updateFavBadge(data.count);
            setTimeout(() => btn.classList.remove('animating'), 400);
        })
        .catch(err => {
            btn.classList.remove('animating');
            console.error('Favorite error:', err);
        });
    }

    function updateFavBadge(count) {
        let badge = document.querySelector('.fav-count-badge');
        const navIcon = document.querySelector('.nav-favorite-btn');
        const navIconI = navIcon ? navIcon.querySelector('i') : null;

        if (count > 0) {
            if (navIconI) navIconI.className = 'fas fa-heart';
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'fav-count-badge';
                navIcon.appendChild(badge);
            }
            badge.textContent = count;
        } else {
            if (navIconI) navIconI.className = 'far fa-heart';
            if (badge) badge.remove();
        }
    }
</script>
@yield('js')

</body>

</html>
