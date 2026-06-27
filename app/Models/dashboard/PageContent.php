<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'page',
        'section',
        'key',
        'value',
        'sort_order',
    ];

    /**
     * Get a single value by page, section, and key
     */
    public static function getValue($page, $section, $key, $default = null)
    {
        $content = self::where('page', $page)
            ->where('section', $section)
            ->where('key', $key)
            ->first();

        return $content ? $content->value : $default;
    }

    /**
     * Get all values for a specific section
     */
    public static function getSection($page, $section)
    {
        return self::where('page', $page)
            ->where('section', $section)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get all values for a section as key => value array
     */
    public static function getSectionAsArray($page, $section)
    {
        $items = self::getSection($page, $section);
        $result = [];
        foreach ($items as $item) {
            $result[$item->key] = $item->value;
        }
        return $result;
    }

    /**
     * Set a value (create or update)
     */
    public static function setValue($page, $section, $key, $value, $sortOrder = 0)
    {
        return self::updateOrCreate(
            ['page' => $page, 'section' => $section, 'key' => $key],
            ['value' => $value, 'sort_order' => $sortOrder]
        );
    }

    /**
     * Get multiple items for a section (e.g., features, categories)
     */
    public static function getGrouped($page, $section)
    {
        $items = self::where('page', $page)
            ->where('section', $section)
            ->orderBy('sort_order')
            ->get();

        $grouped = [];
        foreach ($items as $item) {
            $parts = explode('_', $item->key);
            $index = $parts[0]; // e.g., "1", "2", "3"
            $field = implode('_', array_slice($parts, 1)); // e.g., "title", "icon", "image"
            $grouped[$index][$field] = $item->value;
        }

        return $grouped;
    }
}
