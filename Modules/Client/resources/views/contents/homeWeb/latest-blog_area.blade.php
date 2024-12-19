<div class="latest-blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>Bài viết <span>mới nhất</span></h3>
                    <div class="latest-blog_arrow"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="kenne-element-carousel latest-blog_slider slider-nav"
                    data-slick-options='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "infinite": true,
                "arrows": true,
                "dots": false,
                "spaceBetween": 30,
                "appendArrows": ".latest-blog_arrow"
                }'
                    data-slick-responsive='[
                {"breakpoint":992, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint":768, "settings": {
                "slidesToShow": 1
                }}
            ]'>
                    @foreach ($posts as $item)
                        <div class="blog-item">
                            <div class="blog-img img-hover_effect">
                                <a href="{{ route('other.postDetail', $item->slug_post) }}">
                                    <img src="{{ Storage::url($item->image_post) }}" alt="{{ $item->title }}">
                                </a>
                            </div>
                            <div class="blog-content">
                                <h3 class="heading">
                                    <a href="{{ route('other.postDetail', $item->slug_post) }}">{{ $item->title }}</a>
                                </h3>
                                <p class="short-desc">
                                    {!! Str::limit($item->short_description, 250) !!}
                                </p>
                                <div class="blog-meta">
                                    <ul>
                                        <li>{{ $item->created_at->format('d/m/Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
