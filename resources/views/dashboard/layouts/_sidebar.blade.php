<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Route::is('dashboard.welcome') ? 'active' : '' }}"><a
                    href="{{ route('dashboard.welcome') }}"><i class="la la-home"></i><span class="menu-title"
                        data-i18n="nav.dash.main">الرئيسية</span></a>
            </li>
            <li class="nav-item {{ Route::is('dashboard.users.*') ? 'active' : '' }}"><a href="#"><i
                        class="la la-file-text"></i><span class="menu-title" data-i18n="nav.users.main">
                        ادارة المستخدمين
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Route::is('dashboard.users.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.users.index') }}"
                            data-i18n="nav.users.user_profile"> ادارة المستخدمين
                        </a>
                    </li>


                </ul>
            </li>

            <li class="nav-item {{ Route::is('dashboard.product-categories.*') ? 'active' : '' }}"><a href="#"><i
                        class="la la-tags"></i><span class="menu-title" data-i18n="nav.categories.main">
                        ادارة اقسام المنتجات
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Route::is('dashboard.product-categories.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.product-categories.index') }}"
                            data-i18n="nav.categories.index"> جميع الاقسام
                        </a>
                    </li>
                    <li class="{{ Route::is('dashboard.product-categories.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.product-categories.create') }}"
                            data-i18n="nav.categories.create"> اضافة قسم جديد
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Route::is('dashboard.products.*') ? 'active' : '' }}"><a href="#"><i
                        class="la la-shopping-cart"></i><span class="menu-title" data-i18n="nav.products.main">
                        ادارة المنتجات
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Route::is('dashboard.products.index') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.products.index') }}"
                            data-i18n="nav.products.index"> جميع المنتجات
                        </a>
                    </li>
                    <li class="{{ Route::is('dashboard.products.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.products.create') }}"
                            data-i18n="nav.products.create"> اضافة منتج جديد
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Route::is('dashboard.setting.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.setting.index') }}">
                    <i class="la la-cog"></i>
                    <span class="menu-title" data-i18n="nav.settings.main">الاعدادات</span>
                </a>
            </li>

            <li class="nav-item {{ Route::is('dashboard.page-contents.*') ? 'active' : '' }}"><a href="#"><i
                        class="la la-file-text"></i><span class="menu-title" data-i18n="nav.page-contents.main">
                        محتوى الصفحات
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Route::is('dashboard.page-contents.home') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.home') }}"> الصفحة الرئيسية </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.about') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.about') }}"> من نحن </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.contact') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.contact') }}"> تواصل معنا </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.product') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.product') }}"> تفاصيل المنتج </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.search') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.search') }}"> صفحة البحث </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.favorites') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.favorites') }}"> صفحة المفضلة </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.footer') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.footer') }}"> الفوتر </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.navbar') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.navbar') }}"> النافبار </a>
                    </li>
                    <li class="{{ Route::is('dashboard.page-contents.category-page') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('dashboard.page-contents.category-page') }}"> صفحة المنتجات </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Route::is('dashboard.messages.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.messages.index') }}">
                    <i class="la la-envelope"></i>
                    <span class="menu-title" data-i18n="nav.messages">رسائل الاتصال</span>
                </a>
            </li>

        </ul>
    </div>
</div>
