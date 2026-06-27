<div class="form-body">
    <div class="row">
        <!-- اسم القسم -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"> اسم القسم <span class="text-danger">*</span> </label>
                <input required type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="أدخل اسم القسم" name="name"
                    value="{{ old('name', isset($category) ? $category->name : '') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الرابط (Slug) -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="slug"> الرابط </label>
                <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror"
                    placeholder="سيتم توليده تلقائياً" name="slug"
                    value="{{ old('slug', isset($category) ? $category->slug : '') }}" readonly>
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الوصف -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"> الوصف </label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="أدخل وصف القسم" name="description"
                    rows="3">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الصورة -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="image"> صورة القسم </label>
                <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image"
                    accept="image/*">
                <small class="form-text text-muted">الصيغ المقبولة: JPEG, PNG, JPG, GIF (الحد الأقصى: 5MB)</small>
                @if(isset($category) && $category->image)
                <div class="mt-2">
                    <img src="{{ asset('assets/uploads/categories/' . $category->image) }}" alt="{{ $category->name }}"
                        style="max-width: 200px; max-height: 200px; border-radius: 5px;">
                </div>
                @endif
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الحالة -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="status"> الحالة </label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" {{ old('status',
                        isset($category) ? $category->status : true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">
                        مفعّل
                    </label>
                </div>
            </div>
        </div>

        <!-- عنوان SEO -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="meta_title"> عنوان SEO </label>
                <input type="text" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                    placeholder="عنوان SEO للمحركات (اختياري)" name="meta_title"
                    value="{{ old('meta_title', isset($category) ? $category->meta_title : '') }}">
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
                    rows="2">{{ old('meta_description', isset($category) ? $category->meta_description : '') }}</textarea>
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
                    rows="2">{{ old('meta_keywords', isset($category) ? $category->meta_keywords : '') }}</textarea>
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
        {{ isset($category) ? 'تحديث القسم' : 'إضافة القسم' }}
    </button>
    <a href="{{ route('dashboard.product-categories.index') }}" class="btn btn-secondary">
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

    // Auto-fill meta_description from description if empty
    document.getElementById('description').addEventListener('blur', function() {
        if (document.getElementById('meta_description').value === '') {
            document.getElementById('meta_description').value = this.value.substring(0, 160);
        }
    });
</script>
