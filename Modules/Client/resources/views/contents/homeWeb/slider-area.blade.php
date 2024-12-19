<!-- Begin Slider Area -->
<div class="slider-area">

    <div class="kenne-element-carousel home-slider arrow-style"
        data-slick-options='{
        "slidesToShow": 1,
        "slidesToScroll": 1,
        "infinite": true,
        "arrows": true,
        "dots": false,
        "autoplay" : true,
        "fade" : true,
        "autoplaySpeed" : 7000,
        "pauseOnHover" : false,
        "pauseOnFocus" : false
        }'
        data-slick-responsive='[
        {"breakpoint":768, "settings": {
        "slidesToShow": 1
        }},
        {"breakpoint":575, "settings": {
        "slidesToShow": 1
        }}
    ]'>
        <div class="slide-item bg-1 animation-style-01">
            <div class="slider-progress"></div>
            <div class="container">
                <div class="slide-content">
                    <span>Exclusive Offer -20% Off This Week</span>
                    <h2>Accessories <br> Explore Trending</h2>
                    <p class="short-desc">Aliquam error eos cumque aut repellat quasi accusantium inventore
                        necessitatibus. Vel quisquam distinctio in inventore dolorum.</p>
                    <div class="slide-btn">
                        <a class="kenne-btn" href="{{ route('shop.shopIndex') }}">Mua sắm ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item bg-2 animation-style-01">
            <div class="slider-progress"></div>
            <div class="container">
                <div class="slide-content">
                    <span>Exclusive Offer -10% Off This Week</span>
                    <h2>Stylist <br> Female Clothes</h2>
                    <p class="short-desc-2">Made from Soft, Durable, US-grown Supima cotton.</p>
                    <div class="slide-btn">
                        <a class="kenne-btn" href="{{ route('shop.shopIndex') }}">Mua sắm ngay</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- Slider Area End Here -->
