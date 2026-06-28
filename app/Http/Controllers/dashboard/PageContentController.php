<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\dashboard\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    use Message_Trait, Upload_Images;

    private $pagePrefixes = ['about', 'contact', 'product', 'footer', 'category_page'];

    private $sectionPrefixes = [
        'showroom_images', 'categories_meta',
        'hero', 'features', 'categories',
        'philosophy', 'featured', 'showroom',
        'brief', 'services', 'stats', 'why_us', 'map',
        'channels', 'help', 'form',
        'specs', 'gallery', 'related', 'whatsapp', 'empty',
        'info_bar', 'labels', 'titles', 'items',
    ];

    public function index()
    {
        return view('dashboard.page-contents.index');
    }

    public function home()
    {
        $sections = [
            'hero'             => PageContent::getSectionAsArray('home', 'hero'),
            'features'         => PageContent::getGrouped('home', 'features'),
            'categories'       => PageContent::getGrouped('home', 'categories'),
            'categories_meta'  => PageContent::getSectionAsArray('home', 'categories_meta'),
            'philosophy'       => PageContent::getSectionAsArray('home', 'philosophy'),
            'featured'         => PageContent::getSectionAsArray('home', 'featured'),
            'showroom'         => PageContent::getSectionAsArray('home', 'showroom'),
            'showroom_images'  => PageContent::getGrouped('home', 'showroom_images'),
        ];
        return view('dashboard.page-contents.home', compact('sections'));
    }

    public function updateHome(Request $request)
    {
        $this->savePageContents('home', $request);
        return $this->success_message('تم حفظ محتوى الصفحة الرئيسية بنجاح');
    }

    public function about()
    {
        $sections = [
            'hero'        => PageContent::getSectionAsArray('about', 'hero'),
            'info_bar'    => PageContent::getGrouped('about', 'info_bar'),
            'brief'       => PageContent::getSectionAsArray('about', 'brief'),
            'services'    => PageContent::getGrouped('about', 'services'),
            'services_title' => PageContent::getValue('about', 'titles', 'services_title', ''),
            'stats'       => PageContent::getGrouped('about', 'stats'),
            'why_us'      => PageContent::getGrouped('about', 'why_us'),
            'why_us_title' => PageContent::getValue('about', 'titles', 'why_us_title', ''),
            'map'         => PageContent::getSectionAsArray('about', 'map'),
            'contact'     => PageContent::getSectionAsArray('about', 'contact'),
            'contact_title' => PageContent::getValue('about', 'titles', 'contact_title', ''),
        ];
        return view('dashboard.page-contents.about', compact('sections'));
    }

    public function updateAbout(Request $request)
    {
        $this->savePageContents('about', $request);
        return $this->success_message('تم حفظ محتوى صفحة من نحن بنجاح');
    }

    public function contact()
    {
        $sections = [
            'hero'     => PageContent::getSectionAsArray('contact', 'hero'),
            'channels' => PageContent::getGrouped('contact', 'channels'),
            'help'     => PageContent::getGrouped('contact', 'help'),
            'help_title' => PageContent::getValue('contact', 'titles', 'help_title', ''),
            'form'     => PageContent::getSectionAsArray('contact', 'form'),
            'features' => PageContent::getGrouped('contact', 'features'),
        ];
        return view('dashboard.page-contents.contact', compact('sections'));
    }

    public function updateContact(Request $request)
    {
        $this->savePageContents('contact', $request);
        return $this->success_message('تم حفظ محتوى صفحة تواصل معنا بنجاح');
    }

    public function product()
    {
        $sections = [
            'specs'    => PageContent::getSectionAsArray('product', 'specs'),
            'gallery'  => PageContent::getSectionAsArray('product', 'gallery'),
            'related'  => PageContent::getSectionAsArray('product', 'related'),
            'whatsapp' => PageContent::getSectionAsArray('product', 'whatsapp'),
            'showroom' => PageContent::getSectionAsArray('product', 'showroom'),
            'labels'   => PageContent::getSectionAsArray('product', 'labels'),
        ];
        return view('dashboard.page-contents.product', compact('sections'));
    }

    public function updateProduct(Request $request)
    {
        $this->savePageContents('product', $request);
        return $this->success_message('تم حفظ إعدادات صفحة المنتج بنجاح');
    }

    public function search()
    {
        $sections = [
            'hero' => PageContent::getSectionAsArray('search', 'hero'),
            'empty' => PageContent::getSectionAsArray('search', 'empty'),
        ];
        return view('dashboard.page-contents.search', compact('sections'));
    }

    public function updateSearch(Request $request)
    {
        $this->savePageContents('search', $request);
        return $this->success_message('تم حفظ محتوى صفحة البحث بنجاح');
    }

    public function favorites()
    {
        $sections = [
            'hero' => PageContent::getSectionAsArray('favorites', 'hero'),
            'empty' => PageContent::getSectionAsArray('favorites', 'empty'),
        ];
        return view('dashboard.page-contents.favorites', compact('sections'));
    }

    public function updateFavorites(Request $request)
    {
        $this->savePageContents('favorites', $request);
        return $this->success_message('تم حفظ محتوى صفحة المفضلة بنجاح');
    }

    public function footer()
    {
        $sections = [
            'titles' => PageContent::getSectionAsArray('footer', 'titles'),
            'items'  => PageContent::getGrouped('footer', 'items'),
        ];
        return view('dashboard.page-contents.footer', compact('sections'));
    }

    public function navbar()
    {
        $sections = [
            'titles' => PageContent::getSectionAsArray('navbar', 'titles'),
        ];
        return view('dashboard.page-contents.navbar', compact('sections'));
    }

    public function updateNavbar(Request $request)
    {
        $titleMap = [
            'home' => $request->input('titles_home', ''),
            'about' => $request->input('titles_about', ''),
            'all_products' => $request->input('titles_all_products', ''),
            'contact' => $request->input('titles_contact', ''),
            'search_placeholder' => $request->input('titles_search_placeholder', ''),
            'search_products' => $request->input('titles_search_products', ''),
        ];
        foreach ($titleMap as $key => $value) {
            PageContent::setValue('navbar', 'titles', $key, $value);
        }
        return $this->success_message('تم حفظ عناوين النافبار بنجاح');
    }

    public function updateFooter(Request $request)
    {
        // Save column titles directly to titles section
        $titleMap = [
            'info_title' => $request->input('titles_info_title', ''),
            'collections_title' => $request->input('titles_collections_title', ''),
            'customer_care_title' => $request->input('titles_customer_care_title', ''),
            'view_all' => $request->input('titles_view_all', ''),
            'copyright' => $request->input('titles_copyright', ''),
        ];
        foreach ($titleMap as $key => $value) {
            PageContent::setValue('footer', 'titles', $key, $value);
        }

        // Save items
        foreach ([1, 2, 3, 4] as $i) {
            PageContent::setValue('footer', 'items', $i . '_title', $request->input("items_{$i}_title", ''));
            PageContent::setValue('footer', 'items', $i . '_link', $request->input("items_{$i}_link", ''));
        }

        return $this->success_message('تم حفظ محتوى الفوتر بنجاح');
    }

    public function categoryPage()
    {
        $sections = [
            'hero'      => PageContent::getSectionAsArray('category_page', 'hero'),
            'filter'    => PageContent::getSectionAsArray('category_page', 'filter'),
            'products'  => PageContent::getSectionAsArray('category_page', 'products'),
            'features'  => PageContent::getGrouped('category_page', 'features'),
        ];
        return view('dashboard.page-contents.category-page', compact('sections'));
    }

    public function updateCategoryPage(Request $request)
    {
        // Hero
        PageContent::setValue('category_page', 'hero', 'title', $request->input('hero_title', ''));
        PageContent::setValue('category_page', 'hero', 'description', $request->input('hero_description', ''));

        // Filter & Products toolbar
        PageContent::setValue('category_page', 'filter', 'all_text', $request->input('filter_all_text', ''));
        PageContent::setValue('category_page', 'products', 'show_text', $request->input('products_show_text', ''));
        PageContent::setValue('category_page', 'products', 'word_text', $request->input('products_word_text', ''));

        // Features / Trust Pillars
        foreach ([1, 2, 3, 4] as $i) {
            PageContent::setValue('category_page', 'features', $i . '_icon', $request->input("features_{$i}_icon", ''));
            PageContent::setValue('category_page', 'features', $i . '_title', $request->input("features_{$i}_title", ''));
            PageContent::setValue('category_page', 'features', $i . '_description', $request->input("features_{$i}_description", ''));
        }

        return $this->success_message('تم حفظ محتوى صفحة المنتجات بنجاح');
    }

    private function savePageContents($page, Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if (is_array($value)) continue;

            // Handle section titles (e.g., services_section_title, why_us_section_title)
            if (str_ends_with($key, '_section_title')) {
                $titleKey = str_replace('_section_title', '_title', $key);
                if (trim($value) !== '') {
                    PageContent::setValue($page, 'titles', $titleKey, $value);
                }
                continue;
            }

            $parsed = $this->parseFieldKey($key, $page);
            $section = $parsed['section'];
            $dbKey = $parsed['dbKey'];

            if ($request->hasFile($key)) {
                $file = $request->file($key);
                if ($file->isValid()) {
                    $fileName = $this->saveImage($file, 'assets/uploads/page-contents');
                    PageContent::setValue($page, $section, $dbKey, $fileName);
                }
            } else {
                if (str_ends_with($key, '_image') && trim($value) === '') continue;
                PageContent::setValue($page, $section, $dbKey, $value);
            }
        }
    }

    /**
     * Parse form field key into section and database key
     * Examples:
     *   hero_title           → section: hero,      dbKey: title
     *   about_brief_title    → section: brief,     dbKey: title
     *   features_1_icon      → section: features,  dbKey: 1_icon
     *   about_services_1_image → section: services, dbKey: 1_image
     */
    private function parseFieldKey($key, $page)
    {
        $working = $key;

        // Step 1: Strip page prefix if present (e.g., 'about_brief_title' → 'brief_title')
        foreach ($this->pagePrefixes as $prefix) {
            if (str_starts_with($working, $prefix . '_')) {
                $working = substr($working, strlen($prefix) + 1);
                break;
            }
        }

        // Step 2: Match section prefix and extract dbKey
        foreach ($this->sectionPrefixes as $section) {
            if (str_starts_with($working, $section . '_')) {
                $dbKey = substr($working, strlen($section) + 1);
                return ['section' => $section, 'dbKey' => $dbKey ?: $key];
            }
            if ($working === $section) {
                return ['section' => $section, 'dbKey' => $section];
            }
        }

        // Fallback
        $parts = explode('_', $working);
        return ['section' => $parts[0], 'dbKey' => $working];
    }
}
