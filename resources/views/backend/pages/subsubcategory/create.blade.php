@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Sub Subcategories > Create</h1>
        <a href="{{ route('admin.subcategories.index') }}" class="d-none d-md-inline-block btn btn-md btn-primary shadow-sm">List</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <form action="{{ route('admin.subsubcategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty 
                                    <option value="">No data found!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="subcategory_id" class="form-control">
                                <option value="">Select Subcategory</option>
                                @forelse($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @empty 
                                    <option value="">No data found!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <input 
                                type="text" 
                                class="form-control"
                                name="name" 
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <input 
                                type="file" 
                                class=""
                                name="image">
                        </div>
                 
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Save
                        </button>
             
                    </form>
                    
                </div><!--End card body-->
            </div><!--End card-->
        </div><!--End Col-->

    </div><!--End row-->

    <!-- Content Row -->

    
@endsection

@section ('footer_scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
@endsection