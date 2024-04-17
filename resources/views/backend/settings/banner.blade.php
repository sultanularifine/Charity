@extends('backend.layouts.app')
@section('title', 'Banner Settings')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Banner Setting</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Settings</a></div>
                    <div class="breadcrumb-item">Banner Settings</div>
                </div>
            </div>
            <form action="{{ route('settings.imageStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body card card-primary">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label><b>Hero Image*</b></label>
                            <div>
                                <div class="custom-file ">
                                    <input type="file" class="custom-file-input" id="imageFiles" name="image">
                                    <label class="custom-file-label" for="imageFiles">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Title</b></label>
                            <input type="text" class="form-control"  name="title">
                        </div>

                        <div class="form-group col-md-4">
                            <label><b>Sub Title</b></label>
                            <input type="text" class="form-control" name="sub_title">
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Button Text</b></label>
                            <input type="text" class="form-control" name="button_text">
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Button Link</b></label>
                            <input type="text" class="form-control" name="button_link">
                        </div>
                    </div>
                    <div class="card-left text-left my-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table " id="table">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Hero Images</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($heroimages as $index => $heroimage)
                                                <tr>
                                                    <td> {{ $index + 1 }} </td>
                                                    <td>
                                                        @if ($heroimage->image)
                                                            <img src="{{ asset('backend/' . $heroimage->image) }}" width="120px"
                                                                height="40px">
                                                        @else
                                                            <img src="" height="50px" width="70px">
                                                        @endif
                                                    </td>
                                                    <td> {{ $heroimage->title }}</td>
                                                    <td> {{ $heroimage->sub_title }}</td>
                                                    <td>
                                                        <form action="{{ route('settings.destroy', $heroimage->id) }}"
                                                            method="Post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm btn-action"
                                                                data-toggle="tooltip" title="Delete"
                                                                onclick="return confirm('Are you sure?')"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/page/modules-datatables.js') }}"></script>
    <script>
        $(function() {
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
            })
        });
    </script>
@endpush
