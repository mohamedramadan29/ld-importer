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

    private $pagePrefixes = ['about', 'contact', 'product'];

    private $sectionPrefixes = [
        'showroom_images', 'categories_meta',
        'hero', 'features', 'categories',
        'philosophy', 'featured', 'showroom',
        'brief', 'services', 'stats', 'why_us', 'map',
        'channels', 'help', 'form',
        'specs', 'gallery', 'related', 'whatsapp',
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
            'specs'    => PageContent::getGrouped('product', 'specs'),
            'gallery'  => PageContent::getSectionAsArray('product', 'gallery'),
            'related'  => PageContent::getSectionAsArray('product', 'related'),
            'whatsapp' => PageContent::getSectionAsArray('product', 'whatsapp'),
            'showroom' => PageContent::getSectionAsArray('product', 'showroom'),
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
