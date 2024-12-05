@extends('backend.layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/all.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="vh-100 ">

            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow-lg" id="list1"
                            style="border-radius: 20px; background: linear-gradient(120deg, #1f3b73, #3d80b4);">
                            <div class="card-body py-4 px-4 px-md-5">
                                <div class="text-center mt-3 mb-4 pb-3">
                                    <p class="h4 text-light position-relative d-inline-block"
                                        style="font-weight: 700; font-family: 'Poppins', sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
                                        <i class="fas fa-tasks me-2 " style="color: #FFC107;"></i>
                                        <span
                                            style="background: linear-gradient(90deg, #ff6b6b, #f7b42c); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">To-Do
                                            List</span>
                                        <span class="underline"></span>
                                    </p>
                                </div>


                                <!-- Task Form -->
                                <div class="">
                                    <div class="card border-0 shadow-sm"
                                        style="background-color: rgba(255, 255, 255, 0.1); border-radius: 15px;">
                                        <div class="card-body">
                                            <form action="{{ route('todo.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row g-1">
                                                    <div class="col-md-4">
                                                        <input type="text" name="name"
                                                            class="form-control form-control-lg bg-light text-dark"
                                                            value="{{ !empty($data) ? $data->name : '' }}"
                                                            placeholder="Task name..." />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="time" name="time"
                                                            class="form-control form-control-lg bg-light text-dark"
                                                            value="{{ !empty($data) ? $data->time : '' }}" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="date" name="date"
                                                            class="form-control form-control-lg bg-light text-dark"
                                                            value="{{ !empty($data) ? $data->date : '' }}" />
                                                    </div>
                                                    <div class="col-md-2 d-grid">
                                                        <button type="submit"
                                                            class="btn btn-success btn-lg">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @if ($errors->any())
                                                <ul class="mt-3 text-danger">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4 text-light">




                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#all').change(function(e) {
            if (e.currentTarget.checked) {
                $('.rows').find('input[type="checkbox"]').prop('checked', true);
            } else {
                $('.rows').find('input[type="checkbox"]').prop('checked', false);
            }
        });
    </script>
    </body>

    </html>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('backend/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('backend/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/js/page/index-0.js') }}"></script>
@endpush
