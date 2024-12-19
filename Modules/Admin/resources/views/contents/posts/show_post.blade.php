@extends('admin::layout.master')
@section('title')
    Admin | DANH SÁCH BÀI VIẾT-TIN TỨC
@endsection
@section('contents')
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Chi tiết Bài viết-Tin tức</h5>
                    </div>
                    <div class="col-md-auto text-end">
                        <a class="btn btn-danger" href="{{route('admin.posts.list')}}">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-9 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Mô tả ngắn</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                            id="short_description" readonly>
                            {{ old('short_description', $listPost->short_description) }}
                        </textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Nội dung bài viết</h6>
                    </div>
                    <div class="card-body">
                        <textarea name="content" id="content" cols="30" rows="10" readonly>{{ old('content', $listPost->content) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Các thông tin khác</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="title">Tiêu đề</label>
                                    <input class="form-control @error('title') is-invalid @enderror" id="title"
                                        type="text" name="title" value="{{ old('title', $listPost->title) }} "
                                        readonly />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="slug_post">Slug</label>
                                    <input class="form-control @error('slug_post') is-invalid @enderror" id="slug_post"
                                        type="text" name="slug_post" value="{{ old('slug_post', $listPost->slug_post) }}"
                                        readonly />
                                    @error('slug_post')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="image_post">Ảnh đại diện</label>
                                    <input class="form-control @error('image_post') is-invalid @enderror" id="image_post"
                                        type="file" name="image_post" value="{{ old('image_post') }}" readonly />
                                    @error('image_post')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12" id="preview-container"></div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="autoSizingSelect">Trạng thái</label>
                                    <input class="form-control" id="published_id" type="text"
                                        value="{{ $listPost->published_id == 1 ? 'Đã xuất bản' : 'Chưa xuất bản' }}"
                                        readonly />
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="created_at">Ngày tạo</label>
                                    <input class="form-control @error('created_at') is-invalid @enderror" id="created_at"
                                        type="date" value="{{ now()->format('Y-m-d') }}" name="created_at"
                                        value="{{ old('created_at') }}" readonly />
                                    @error('created_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/vendors/dropzone/dropzone.css') }}">
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css') }}"></script>
    <script src="{{ asset('theme/admin/vendors/dropzone/dropzone-min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        //Slug name
        function createSlug(value) {
            return value
                .toLowerCase()
                .replace(/đ/g, 'd')
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
        document.getElementById('title').addEventListener('input', function() {
            const nameInput = this.value;
            const slug = createSlug(nameInput);
            document.getElementById('slug_post').value = slug;
        });
    </script>
    <script>
        //CHi tiết bài viết
        // const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

        tinymce.init({
            selector: 'textarea#content',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            height: 1000,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            skin: 'oxide',
            content_css: 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            language: 'vi_VN',
            // language_url: '{{ asset('tinymce/langs/vi_VN.js') }}',
        });

        document.getElementById('image_post').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('preview-container');
            // Xóa ảnh hiện tại nếu có
            previewContainer.innerHTML = '';
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100%'; // Set chiều rộng ảnh là 100%
                    img.style.height = 'auto'; // Đảm bảo ảnh giữ tỉ lệ
                    img.alt = 'Ảnh xem trước';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = 'File không phải là hình ảnh!';
            }
        });
    </script>
@endsection
