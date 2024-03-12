@extends('backend.layouts.app')

@section('title', 'Blog List')

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Blog List</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Blogs</a></div>
                    <div class="breadcrumb-item">Blog List</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-left text-left my-1">
                                    <a href="{{ route('blog.create') }}" class="btn btn-primary">Add Blog</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> SL</th>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogs as $index => $blog)
                                                <tr>
                                                    <td> {{ $index + 1 }} </td>
                                                    <td>
                                                        @if ($blog->thumbnail)
                                                            <img src="{{ asset('backend/' . $blog->thumbnail) }}" width="60px"
                                                                height="40px">
                                                        @else
                                                            <img src="https://assets-global.website-files.com/636ebb4d131625f3efdea089/64b5a7eecc3f96b2ac19d62b_shutterstock_1840661509.jpg"
                                                                height="50px" width="70px">
                                                        @endif
                                                    </td>
                                                    <td> {{ $blog->title }} </td>
                                                    <td> {{ $blog->sub_title }} </td>
                                                    <td>
                                                        {!! implode(' ', array_slice(explode(' ', $blog->description), 0, 17)) !!}  ...</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('blog.show', $blog->id) }}"
                                                            class="btn btn-info btn-action btn-sm mr-1"
                                                            data-toggle="tooltip" title="View"><i
                                                                class="fa-solid fa-eye"></i></a>
                                                        <a href="{{ route('blog.edit', $blog->id) }}"
                                                            class="btn btn-primary btn-action btn-sm mr-1"
                                                            data-toggle="tooltip" title="Edit"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <form action="{{ route('blog.destroy', $blog->id) }}"
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
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/page/modules-datatables.js') }}"></script>
@endpush
