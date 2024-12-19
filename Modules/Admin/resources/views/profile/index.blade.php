@extends('admin::layout.master')
@section('title')
    Falcon | Trang cá nhân
@endsection
@section('script')
    <script>
        var navbarPosition = localStorage.getItem('navbarPosition');
        var navbarVertical = document.querySelector('.navbar-vertical');
        var navbarTopVertical = document.querySelector('.content .navbar-top');
        var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
        var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
        var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

        if (localStorage.getItem('navbarPosition') === 'double-top') {
        document.documentElement.classList.toggle('double-top-nav-layout');
        }

        if (navbarPosition === 'top') {
        navbarTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTopCombo.remove(navbarTopCombo);
        navbarDoubleTop.remove(navbarDoubleTop);
        } else if (navbarPosition === 'combo') {
        navbarVertical.removeAttribute('style');
        navbarTopCombo.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarTopVertical.remove(navbarTopVertical);
        navbarDoubleTop.remove(navbarDoubleTop);
        } else if (navbarPosition === 'double-top') {
        navbarDoubleTop.removeAttribute('style');
        navbarTopVertical.remove(navbarTopVertical);
        navbarVertical.remove(navbarVertical);
        navbarTop.remove(navbarTop);
        navbarTopCombo.remove(navbarTopCombo);
        } else {
        navbarVertical.removeAttribute('style');
        navbarTopVertical.removeAttribute('style');
        navbarTop.remove(navbarTop);
        navbarDoubleTop.remove(navbarDoubleTop);
        navbarTopCombo.remove(navbarTopCombo);
        }
    </script>
@endsection
@section('contents')

<div class="card mb-3">
    <div class="card-header position-relative min-vh-25 mb-7">
      <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url({{ asset('theme/admin/img/generic/4.jpg') }});"></div>
      <div class="avatar avatar-5xl avatar-profile"><img class="rounded-circle img-thumbnail shadow-sm" src="{{ Storage::url($user->user_image) }}" width="200" alt="" /></div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-8">
          <h4 class="mb-1">{{ $user->full_name }}<span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h4>
          <h5 class="fs-9 fw-normal mt-3">
            <p> Quyền hạn:</p>
            <ul>
            @foreach($userRoleIds as $role)
            <li>
                @switch($role)
                    @case('1')
                        Quản trị viên
                        @break
                    @case('2')
                        Quản lý bình luận.
                        @break
                    @case('3')
                        Quản lý mã giảm giá.
                        @break
                    @case('4')
                        Quản lý danh mục sản phẩm hoặc bài viết.
                        @break
                    @case('5')
                        Quản lý bài viết.
                        @break
                    @case('6')
                        Quản lý sản phẩm.
                        @break
                    @case('7')
                        Quản lý thuộc tính sản phẩm.
                        @break
                    @case('8')
                        Quản lý tags.
                        @break
                    @case('9')
                        Quản lý ticket hỗ trợ khách hàng.
                        @break
                    @case('10')
                        Quản lý banner.
                        @break
                    @case('11')
                        Quản lý đơn hàng.
                        @break
                    @case('12')
                        Quản lý ví và giao dịch.
                        @break
                    @case('13')
                        Quản lý khách hàng.
                        @break
                    @case('14')
                        Chỉ xem báo cáo và thống kê.
                        @break
                    @default
                        {{ $role }}
                @endswitch
            </strong>
        </li>
        @endforeach
            </ul>
          </h5>
          <h6 class="mb-2 ">{{ $user->user_name }}</h6>
          <a href="{{ route('admin.profile.edit', ['id' => $user->id]) }}" class="btn btn-falcon-primary btn-sm">Sửa thông tin</a>
          {{-- <button class="btn btn-falcon-default btn-sm px-3 ms-2" type="button">Message</button> --}}
          <div class="border-bottom border-dashed my-4 d-lg-none"></div>
        </div>
        <div class="col ps-2 ps-lg-3">
            {{-- <a class="d-flex align-items-center mb-2" href="{{ route('admin.accounts.index') }}"><span class="fas fa-user-circle fs-6 me-2 text-700" data-fa-transform="grow-2"></span>
                <div class="flex-1">
                <h6 class="mb-0">danh sách nhân viên</h6>
                </div>
            </a> --}}
            <a class="d-flex align-items-center mb-2" href="#">
                <i class="fas fa-phone align-self-center me-2"></i>
                <div class="flex-1">
                    <h6 class="mb-0">{{ $user->phone }}</h6>
                </div>
            </a>

            <a class="d-flex align-items-center mb-2" href="#">
                <i class="fas fa-envelope align-self-center me-2"></i>
                <div class="flex-1">
                    <h6 class="mb-0">{{ $user->email }}</h6>
                </div>
            </a>

            <a class="d-flex align-items-center mb-2" href="#">
                <i class="fas fa-map-marker-alt align-self-center me-2"></i>
                <div class="flex-1">
                    <h6 class="mb-0">{{ $user->address }}</h6>
                </div>
            </a>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="row g-0">
    <div class="col-lg-8 pe-lg-2">
      <div class="card mb-3">
        <div class="card-header bg-body-tertiary">
          <h5 class="mb-0">Danh sách nhân viên</h5>
        </div>
        <div class="card-body text-justify">
          <p class="mb-0 text-1000">Dedicated, passionate, and accomplished Full Stack Developer with 9+ years of progressive experience working as an Independent Contractor for Google and developing and growing my educational social network that helps others learn programming, web design, game development, networking.</p>
          <div class="collapse show" id="profile-intro">
            <p class="mt-3 text-1000">I’ve acquired a wide depth of knowledge and expertise in using my technical skills in programming, computer science, software development, and mobile app development to developing solutions to help organizations increase productivity, and accelerate business performance. </p>
            <p class="text-1000">It’s great that we live in an age where we can share so much with technology but I’m but I’m ready for the next phase of my career, with a healthy balance between the virtual world and a workplace where I help others face-to-face.</p>
            <p class="text-1000 mb-0">There’s always something new to learn, especially in IT-related fields. People like working with me because I can explain technology to everyone, from staff to executives who need me to tie together the details and the big picture. I can also implement the technologies that successful projects need.</p>
          </div>
        </div>
        <div class="card-footer bg-body-tertiary p-0 border-top"><button class="btn btn-link d-block w-100 btn-intro-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#profile-intro" aria-expanded="true" aria-controls="profile-intro">Show <span class="less">less<span class="fas fa-chevron-up ms-2 fs-11"></span></span><span class="full">full<span class="fas fa-chevron-down ms-2 fs-11"></span></span></button></div>
      </div>
    </div>
    <div class="col-lg-4 ps-lg-2">
      <div class="sticky-sidebar">
        <div class="card mb-3">
          <div class="card-header bg-body-tertiary">
            <h5 class="mb-0">Experience</h5>
          </div>
          <div class="card-body fs-10">
            <div class="d-flex"><a href="#!"> <img class="img-fluid" src="../../assets/img/logos/g.png" alt="" width="56" /></a>
              <div class="flex-1 position-relative ps-3">
                <h6 class="fs-9 mb-0">Big Data Engineer<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h6>
                <p class="mb-1"> <a href="#!">Google</a></p>
                <p class="text-1000 mb-0">Apr 2012 - Present &bull; 6 yrs 9 mos</p>
                <p class="text-1000 mb-0">California, USA</p>
                <div class="border-bottom border-dashed my-3"></div>
              </div>
            </div>
            <div class="d-flex"><a href="#!"> <img class="img-fluid" src="../../assets/img/logos/apple.png" alt="" width="56" /></a>
              <div class="flex-1 position-relative ps-3">
                <h6 class="fs-9 mb-0">Software Engineer<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h6>
                <p class="mb-1"> <a href="#!">Apple</a></p>
                <p class="text-1000 mb-0">Jan 2012 - Apr 2012 &bull; 4 mos</p>
                <p class="text-1000 mb-0">California, USA</p>
                <div class="border-bottom border-dashed my-3"></div>
              </div>
            </div>
            <div class="d-flex"><a href="#!"> <img class="img-fluid" src="../../assets/img/logos/nike.png" alt="" width="56" /></a>
              <div class="flex-1 position-relative ps-3">
                <h6 class="fs-9 mb-0">Mobile App Developer<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h6>
                <p class="mb-1"> <a href="#!">Nike</a></p>
                <p class="text-1000 mb-0">Jan 2011 - Apr 2012 &bull; 1 yr 4 mos</p>
                <p class="text-1000 mb-0">Beaverton, USA</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
@section('js-setting')
    <script src="{{ asset('theme/admin/vendors/echarts/echarts.min.js') }}"></script>
@endsection
