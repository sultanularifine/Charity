@extends('backend.layouts.app')
@section('title', 'basic')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Basic Settings</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Settings</a></div>
                    <div class="breadcrumb-item">Basic Settings</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body card card-primary">
                            <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Site Title*</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->site_title : '' }}" name="site_title">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label><b>Site Tagline</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->site_tagline : '' }}" name="site_tagline">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label><b>logo</b></label>
                                        <div>
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input" id="imageFiles"
                                                    name="image">
                                                <label class="custom-file-label" for="imageFiles">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1 mt-4">
                                        @if ($basics && $basics->image)
                                        <img src="{{ asset( 'backend/' . $basics->image) }}" alt="" width="90px"
                                            height="35px" class="row">
                                    @else
                                        <span>logo</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Footer Text*</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->footer_text : '' }}" name="footer_text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Contact Phone No</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->phone : '' }}" name="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Contact Email</b></label>
                                        <input type="email" class="form-control"
                                            value="{{ !empty($basics) ? $basics->email : '' }}" name="email">
                                    </div>
                                </div>
                                <label><b>Social Link</b></label>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><b>Facebook Link</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->facebook : '' }}" name="facebook">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Instagram Link</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->instagram : '' }}" name="instagram">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Twitter Link</b></label>
                                        <input type="text" class="form-control"
                                            value="{{ !empty($basics) ? $basics->twitter : '' }}" name="twitter">
                                    </div>
                                </div>
                                <div class=" card-left text-left my-1">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
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
    <script src="{{ asset('backend/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('backend/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('backend/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/js/page/index-0.js') }}"></script>
@endpush
