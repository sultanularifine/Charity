@extends('backend.layouts.app')

@section('title', 'Carousel')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog View</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Blogs</a></div>
                    <div class="breadcrumb-item"><a href="#">Blog List</a></div>
                    <div class="breadcrumb-item">View</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-right">
                                <h6>{{ date('d F, Y', strtotime($blogs->blog_date)) }}</h6>
                            </div>
                            <div class="">
                                <h3>
                                    {{ $blogs->title }}
                                </h3>
                            </div>
                            <div class="carousel-inner mt-4">
                                <div class="carousel-item active">
                                    @if ($blogs->thumbnail)
                                        <img src="{{ asset('backend/' . $blogs->thumbnail) }}" width="650px">
                                    @else
                                        <img src="https://assets-global.website-files.com/636ebb4d131625f3efdea089/64b5a7eecc3f96b2ac19d62b_shutterstock_1840661509.jpg"
                                            height="50px" width="70px">
                                    @endif
                                </div>
                            </div>
                            <div class="mt-5">
                                <h5>
                                    {{ $blogs->sub_title }}
                                </h5>
                            </div>
                            <div class="mt-3">
                                <p>
                                    {!! $blogs->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <h4>Images</h4>
                            </div>
                            <div class="gallery gallery-fw" data-item-height="150">
                                @foreach ($blogs->blogImage as $blogimage)
                                    <div class="gallery-item gallery-md"
                                        data-image="{{ asset('backend/' . $blogimage->image) }}" data-title="Image"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <!-- Page Specific JS File -->
@endpush
