<div class="form-body">
    <div class="row">
        <!-- القسم -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id"> القسم <span class="text-danger">*</span> </label>
                <select required id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                    name="category_id">
                    <option value="">اختر القسم</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', isset($product) ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- اسم المنتج -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"> اسم المنتج <span class="text-danger">*</span> </label>
                <input required type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="أدخل اسم المنتج" name="name"
                    value="{{ old('name', isset($product) ? $product->name : '') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الرابط (Slug) -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="slug"> الرابط </label>
                <input type="text" id="slug" class="form-control" placeholder="سيتم توليده تلقائياً" name="slug"
                    value="{{ old('slug', isset($product) ? $product->slug : '') }}" readonly>
            </div>
        </div>

        <!-- SKU -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="sku"> كود المنتج (SKU) </label>
                <input type="text" id="sku" class="form-control @error('sku') is-invalid @enderror"
                    placeholder="أدخل كود المنتج (اختياري)" name="sku"
                    value="{{ old('sku', isset($product) ? $product->sku : '') }}">
                @error('sku')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- السعر -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="price"> السعر <span class="text-danger">*</span> </label>
                <input required type="number" step="0.01" id="price"
                    class="form-control @error('price') is-invalid @enderror" placeholder="أدخل السعر" name="price"
                    value="{{ old('price', isset($product) ? $product->price : '') }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- السعر المخفض -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="discount_price"> السعر المخفض (اختياري) </label>
                <input type="number" step="0.01" id="discount_price"
                    class="form-control @error('discount_price') is-invalid @enderror"
                    placeholder="أدخل السعر المخفض" name="discount_price"
                    value="{{ old('discount_price', isset($product) ? $product->discount_price : '') }}">
                @error('discount_price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الوصف -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"> الوصف </label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="أدخل وصف المنتج" name="description"
                    rows="4">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الأبعاد -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="dimensions"> الأبعاد </label>
                <textarea id="dimensions" class="form-control @error('dimensions') is-invalid @enderror"
                    placeholder="مثال: 140 × 88 × 39 cm" name="dimensions"
                    rows="3">{{ old('dimensions', isset($product) ? $product->dimensions : '') }}</textarea>
                @error('dimensions')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الخامات -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="materials"> الخامات </label>
                <textarea id="materials" class="form-control @error('materials') is-invalid @enderror"
                    placeholder="مثال: Natural Wood + Stone" name="materials"
                    rows="3">{{ old('materials', isset($product) ? $product->materials : '') }}</textarea>
                @error('materials')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- اللون -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="color"> اللون </label>
                <textarea id="color" class="form-control @error('color') is-invalid @enderror"
                    placeholder="مثال: Walnut + Black" name="color"
                    rows="3">{{ old('color', isset($product) ? $product->color : '') }}</textarea>
                @error('color')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- معلومات الشحن -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="delivery_info"> معلومات الشحن </label>
                <input type="text" id="delivery_info"
                    class="form-control @error('delivery_info') is-invalid @enderror"
                    placeholder="مثال: Across Country" name="delivery_info"
                    value="{{ old('delivery_info', isset($product) ? $product->delivery_info : '') }}">
                @error('delivery_info')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- حالة التوفر -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="availability"> حالة التوفر </label>
                <select id="availability" class="form-control" name="availability">
                    <option value="1" {{ old('availability', isset($product) ? $product->availability : 1) ? 'selected' : '' }}>متوفر</option>
                    <option value="0" {{ old('availability', isset($product) ? $product->availability : 1) == 0 ? 'selected' : '' }}>غير متوفر</option>
                </select>
            </div>
        </div>

        <!-- الحالة -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="status"> حالة العرض </label>
                <select id="status" class="form-control" name="status">
                    <option value="1" {{ old('status', isset($product) ? $product->status : 1) ? 'selected' : '' }}>مفعّل</option>
                    <option value="0" {{ old('status', isset($product) ? $product->status : 1) == 0 ? 'selected' : '' }}>غير مفعّل</option>
                </select>
            </div>
        </div>

        <!-- صور المنتج -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="images"> صور المنتج </label>
                <input type="file" id="images" class="form-control @error('images') is-invalid @enderror"
                    name="images[]" multiple accept="image/*">
                <small class="form-text text-muted">يمكنك اختيار أكثر من صورة (الحد الأقصى: 5MB لكل صورة)</small>
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('images.*')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الصور الحالية (في حالة التعديل) -->
        @if(isset($product) && $product->images->count() > 0)
        <div class="col-md-12">
            <div class="form-group">
                <label> الصور الحالية </label>
                <div class="row">
                    @foreach($product->images as $image)
                    <div class="col-md-3 col-6 mb-3" id="image-{{ $image->id }}">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/products/' . $image->image) }}"
                                class="card-img-top" alt=""
                                style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2 text-center">
                                @if($image->is_main)
                                <span class="badge badge-success">صورة رئيسية</span>
                                @else
                                <button type="button" class="btn btn-sm btn-outline-primary mb-1"
                                    onclick="setMainImage({{ $image->id }})">
                                    تعيين كرئيسية
                                </button>
                                @endif
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="deleteImage({{ $image->id }})">
                                    <i class="la la-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- عنوان SEO -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="meta_title"> عنوان SEO </label>
                <input type="text" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                    placeholder="عنوان SEO للمحركات (اختياري)" name="meta_title"
                    value="{{ old('meta_title', isset($product) ? $product->meta_title : '') }}">
                @error('meta_title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- وصف SEO -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="meta_description"> وصف SEO </label>
                <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                    placeholder="وصف SEO للمحركات (اختياري)" name="meta_description"
                    rows="2">{{ old('meta_description', isset($product) ? $product->meta_description : '') }}</textarea>
                @error('meta_description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الكلمات المفتاحية SEO -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_keywords"> الكلمات المفتاحية (SEO) </label>
                <textarea id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror"
                    placeholder="أدخل الكلمات المفتاحية مفصولة بفواصل (اختياري)" name="meta_keywords"
                    rows="2">{{ old('meta_keywords', isset($product) ? $product->meta_keywords : '') }}</textarea>
                @error('meta_keywords')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="la la-save"></i>
        {{ isset($product) ? 'تحديث المنتج' : 'إضافة المنتج' }}
    </button>
    <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">
        <i class="la la-times"></i> إلغاء
    </a>
</div>

<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('keyup', function() {
        let name = this.value;
        let slug = name
            .toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]/g, '');

        if (document.getElementById('slug').value === '') {
            document.getElementById('slug').value = slug;
        }
    });

    // Auto-fill meta_title from name if empty
    document.getElementById('name').addEventListener('blur', function() {
        if (document.getElementById('meta_title').value === '') {
            document.getElementById('meta_title').value = this.value;
        }
    });

    // Image preview
    document.getElementById('images').addEventListener('change', function(e) {
        // Preview is optional - just for UX
    });

    function deleteImage(id) {
        if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
            fetch(`{{ route('dashboard.products.delete-image', ':id') }}`.replace(':id', id), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('image-' + id).remove();
            });
        }
    }

    function setMainImage(id) {
        fetch(`{{ route('dashboard.products.set-main-image', ':id') }}`.replace(':id', id), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        });
    }
</script>
