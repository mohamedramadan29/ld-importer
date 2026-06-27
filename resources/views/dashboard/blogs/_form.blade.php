<div class="form-body">
    <div class="row">
        <!-- العنوان -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> العنوان <span class="text-danger">*</span> </label>
                <input required type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="أدخل عنوان التدوينة" name="title"
                    value="{{ old('title', isset($blog) ? $blog->title : '') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الرابط (Slug) -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="slug"> الرابط </label>
                <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror"
                    placeholder="سيتم توليده تلقائياً إن لم يتم إدخاله" name="slug"
                    value="{{ old('slug', isset($blog) ? $blog->slug : '') }}">
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الوصف -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"> الوصف <span class="text-danger">*</span> </label>
                <textarea required id="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="أدخل وصف التدوينة" name="description"
                    rows="3">{{ old('description', isset($blog) ? $blog->description : '') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- محتوى التدوينة -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="content"> محتوى التدوينة <span class="text-danger">*</span> </label>
                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content"
                    rows="12">{{ old('content', isset($blog) ? $blog->content : '') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- الصورة -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="image"> الصورة </label>
                <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image"
                    accept="image/*">
                <small class="form-text text-muted">الصيغ المقبولة: JPEG, PNG, JPG, GIF (الحد الأقصى: 2MB)</small>
                @if(isset($blog) && $blog->image)
                <div class="mt-2">
                    <img src="{{ asset('assets/uploads/blogs/' . $blog->image) }}" alt="{{ $blog->title }}"
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
                        isset($blog) ? $blog->status : true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="status">
                        مفعّل (منشور)
                    </label>
                </div>
            </div>
        </div>

        <!-- تاريخ النشر -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="published_at"> تاريخ النشر </label>
                <input type="datetime-local" id="published_at"
                    class="form-control @error('published_at') is-invalid @enderror" name="published_at"
                    value="{{ old('published_at', isset($blog) && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- عنوان SEO -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="meta_title"> عنوان SEO </label>
                <input type="text" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                    placeholder="عنوان SEO للمحركات (اختياري)" name="meta_title"
                    value="{{ old('meta_title', isset($blog) ? $blog->meta_title : '') }}">
                @error('meta_title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- وصف SEO -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_description"> وصف SEO </label>
                <textarea id="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                    placeholder="وصف SEO للمحركات (اختياري)" name="meta_description"
                    rows="2">{{ old('meta_description', isset($blog) ? $blog->meta_description : '') }}</textarea>
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
                    rows="2">{{ old('meta_keywords', isset($blog) ? $blog->meta_keywords : '') }}</textarea>
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
        {{ isset($blog) ? 'تحديث التدوينة' : 'إضافة التدوينة' }}
    </button>
    <a href="{{ route('dashboard.blogs.index') }}" class="btn btn-secondary">
        <i class="la la-times"></i> إلغاء
    </a>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script>
    let editor; // متغير عام للمحرر

    // Initialize CKEditor for content
    ClassicEditor
        .create(document.querySelector('#content'), {
            language: 'ar',
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletList',
                'numberedList',
                '|',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                '|',
                'undo',
                'redo',
                '|',
                'removeFormat'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'فقرة', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'عنوان 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'عنوان 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'عنوان 3', class: 'ck-heading_heading3' }
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            mediaEmbed: {
                previewsInData: true
            }
        })
        .then(editorInstance => {
            editor = editorInstance; // حفظ نسخة من المحرر

            // تحديث الـ textarea عند إرسال الفورم
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // تحديث textarea بمحتوى CKEditor قبل الإرسال
                    document.querySelector('#content').value = editor.getData();
                });
            }
        })
        .catch(error => {
            console.error('خطأ في تحميل CKEditor:', error);
        });

    // Auto-generate slug from title
    document.getElementById('title').addEventListener('keyup', function() {
        let title = this.value;
        let slug = title
            .toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]/g, '');

        // Only auto-fill slug if it's empty
        if (document.getElementById('slug').value === '') {
            document.getElementById('slug').value = slug;
        }
    });

    // Auto-fill meta_title from title if empty
    document.getElementById('title').addEventListener('blur', function() {
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
