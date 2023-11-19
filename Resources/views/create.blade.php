@extends('layouts.admin')

@push('stylesheets')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
    @include('course::partial.header')
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">افزودن دوره</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-12">
                                <label for="title" class="form-label">دسته بندی</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">لطفا دسته بندی را انتخاب کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title" required value="{{ old('title') }}">
                                <div class="invalid-feedback">لطفا عنوان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="slug" class="form-label">نامک</label>
                                <input type="text" name="slug" class="form-control" id="slug" required value="{{ old('slug') }}">
                                <div class="invalid-feedback">لطفا نامک را وارد کنید</div>
                            </div>

                            <div class="col-md-12">
                                <label for="editor1" class="form-label">متن</label>
                                <textarea id="editor1" name="description" class="cke_rtl" required>{{ old('description') }}</textarea>
                                <div class="invalid-feedback">لطفا متن را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">تصویر شاخص</label>
                                <input type="file" name="image" class="form-control" aria-label="تصویر شاخص" id="image" accept="image/*" required>
                                <div class="invalid-feedback">لطفا یک تصویر انتخاب کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="alt" class="form-label">متن جایگزین تصویر شاخص</label>
                                <input type="text" name="image_alt" class="form-control" value="{{ old('image_alt') }}">
                                <div class="invalid-feedback">لطفا متن جایگزین تصویر شاخص را وارد کنید</div>
                            </div>

                            <div class="col-md-12">
                                <label for="banner" class="form-label">بنر</label>
                                <input type="file" name="banner" class="form-control" aria-label="بنر" accept="image/*" required>
                                <div class="invalid-feedback">لطفا یک تصویر انتخاب کنید</div>
                            </div>

                            <div class="col-md-6">
                                <label for="duration" class="form-label">مدت زمان دوره</label>
                                <input type="text" name="duration" class="form-control" value="{{ old('duration') }}">
                                <div class="invalid-feedback">لطفا مدت زمان دوره را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="course_count" class="form-label">تعداد دروس</label>
                                <input type="number" name="course_count" class="form-control" value="{{ old('course_count') }}">
                                <div class="invalid-feedback">لطفا تعداد دروس را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="student_count" class="form-label">تعداد زبان آموزان</label>
                                <input type="number" name="student_count" class="form-control" value="{{ old('student_count') }}">
                                <div class="invalid-feedback">لطفا تعداد زبان‌آموزان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="language" class="form-label">زبان دوره</label>
                                <input type="text" name="language" class="form-control" value="{{ old('language') }}">
                                <div class="invalid-feedback">لطفا زبان دوره را وارد کنید</div>
                            </div>
                            <div class="col-md-12">
                                <label for="level" class="form-label">سطح دوره</label>
                                <input type="text" name="level" class="form-control" value="{{ old('level') }}">
                                <div class="invalid-feedback">لطفا سطح دوره را وارد کنید</div>
                            </div>

                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">ارسال فرم</button>
                                @csrf
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

    </div>

    @push('scripts')
        @include('ckfinder::setup')
        <script>
            var editor = CKEDITOR.replace('editor1', {
                // Define the toolbar groups as it is a more accessible solution.
                toolbarGroups: [
                    {
                        "name": "basicstyles",
                        "groups": ["basicstyles"]
                    },
                    {
                        "name": "links",
                        "groups": ["links"]
                    },
                    {
                        "name": "paragraph",
                        "groups": ["list", "blocks"]
                    },
                    {
                        "name": "document",
                        "groups": ["mode"]
                    },
                    {
                        "name": "insert",
                        "groups": ["insert"]
                    },
                    {
                        "name": "styles",
                        "groups": ["styles"]
                    },
                    {
                        "name": "about",
                        "groups": ["about"]
                    },
                    {   "name": 'paragraph',
                        "groups": ['list', 'blocks', 'align', 'bidi']
                    }
                ],
                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
            });
            CKFinder.setupCKEditor( editor );
        </script>
    @endpush
@endsection
