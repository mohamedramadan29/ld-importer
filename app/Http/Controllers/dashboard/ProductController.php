<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Slug_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\dashboard\Product;
use App\Models\dashboard\ProductCategory;
use App\Models\dashboard\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use Message_Trait, Slug_Trait, Upload_Images;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'mainImage')->latest()->get();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('status', 1)->get();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'dimensions' => 'nullable|string|max:255',
            'materials' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'delivery_info' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ];
        $messages = [
            'category_id.required' => 'يجب اختيار القسم',
            'category_id.exists' => 'القسم المختار غير موجود',
            'name.required' => 'يجب إدخال اسم المنتج',
            'price.required' => 'يجب إدخال سعر المنتج',
            'price.numeric' => 'السعر يجب أن يكون رقماً',
            'discount_price.lt' => 'السعر المخفض يجب أن يكون أقل من السعر الأصلي',
            'images.*.image' => 'الملف يجب أن يكون صورة',
            'images.*.mimes' => 'صيغة الصورة غير مقبولة',
            'images.*.max' => 'حجم الصورة لا يجب أن يتجاوز 5MB',
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $this->CustomeSlug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->sku = $request->sku;
        $product->dimensions = $request->dimensions;
        $product->materials = $request->materials;
        $product->color = $request->color;
        $product->delivery_info = $request->delivery_info;
        $product->status = $request->has('status') ? 1 : 0;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        if ($request->hasFile('images')) {
            $first = true;
            foreach ($request->file('images') as $image) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $this->saveImage($image, 'assets/uploads/products');
                $productImage->is_main = $first ? 1 : 0;
                $productImage->sort_order = $first ? 0 : 1;
                $productImage->save();
                $first = false;
            }
        }

        return $this->success_message('تم إضافة المنتج بنجاح');
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
        $product = Product::with('images')->findOrFail($id);
        $categories = ProductCategory::where('status', 1)->get();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->all();
        $rules = [
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'dimensions' => 'nullable|string|max:255',
            'materials' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'delivery_info' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ];
        $messages = [
            'category_id.required' => 'يجب اختيار القسم',
            'category_id.exists' => 'القسم المختار غير موجود',
            'name.required' => 'يجب إدخال اسم المنتج',
            'price.required' => 'يجب إدخال سعر المنتج',
            'price.numeric' => 'السعر يجب أن يكون رقماً',
            'discount_price.lt' => 'السعر المخفض يجب أن يكون أقل من السعر الأصلي',
            'images.*.image' => 'الملف يجب أن يكون صورة',
            'images.*.mimes' => 'صيغة الصورة غير مقبولة',
            'images.*.max' => 'حجم الصورة لا يجب أن يتجاوز 5MB',
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $this->CustomeSlug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->sku = $request->sku;
        $product->dimensions = $request->dimensions;
        $product->materials = $request->materials;
        $product->color = $request->color;
        $product->delivery_info = $request->delivery_info;
        $product->status = $request->has('status') ? 1 : 0;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $this->saveImage($image, 'assets/uploads/products');
                $productImage->is_main = 0;
                $productImage->sort_order = $product->images()->count();
                $productImage->save();
            }
        }

        return $this->success_message('تم تحديث المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->images()->delete();
        $product->delete();
        return $this->success_message('تم حذف المنتج بنجاح');
    }

    /**
     * Delete a single product image.
     */
    public function deleteImage(string $id)
    {
        $image = ProductImage::findOrFail($id);
        $image->delete();
        return $this->success_message('تم حذف الصورة بنجاح');
    }

    /**
     * Set a product image as main.
     */
    public function setMainImage(string $id)
    {
        $image = ProductImage::findOrFail($id);

        ProductImage::where('product_id', $image->product_id)->update(['is_main' => 0]);

        $image->is_main = 1;
        $image->save();

        return $this->success_message('تم تعيين الصورة الرئيسية بنجاح');
    }
}
