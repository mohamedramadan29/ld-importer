<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Slug_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\dashboard\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    use Message_Trait, Slug_Trait, Upload_Images;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::latest()->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ];
        $messages = [
            'name.required' => 'يجب إدخال اسم القسم',
            'name.string' => 'اسم القسم يجب أن يكون نصاً',
            'name.max' => 'اسم القسم لا يجب أن يتجاوز 255 حرف',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'صيغة الصورة غير مقبولة (JPEG, PNG, JPG, GIF)',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 5MB',
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = new ProductCategory();
        $category->name = $request->name;
        $category->slug = $this->CustomeSlug($request->name);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $category->image = $this->saveImage($request->file('image'), 'assets/uploads/categories');
        }

        $category->save();

        return $this->success_message('تم إضافة القسم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = ProductCategory::findOrFail($id);

        $data = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ];
        $messages = [
            'name.required' => 'يجب إدخال اسم القسم',
            'name.string' => 'اسم القسم يجب أن يكون نصاً',
            'name.max' => 'اسم القسم لا يجب أن يتجاوز 255 حرف',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'صيغة الصورة غير مقبولة (JPEG, PNG, JPG, GIF)',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 5MB',
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category->name = $request->name;
        $category->slug = $this->CustomeSlug($request->name);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $category->image = $this->saveImage($request->file('image'), 'assets/uploads/categories');
        }

        $category->save();

        return $this->success_message('تم تحديث القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return $this->success_message('تم حذف القسم بنجاح');
    }
}
