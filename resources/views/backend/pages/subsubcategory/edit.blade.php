@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Sub Subcategories > Edit</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <form action="{{ route('admin.subsubcategories.update', $subsubcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}" {{ $subsubcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @empty 
                                    <option value="">No data found!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="subcategory_id" class="form-control">
                                <option value="">Select Subcategory</option>
                                @forelse($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $subsubcategory->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                @empty 
                                    <option value="">No data found!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <input 
                                type="text" 
                                class="form-control form-control-user"
                                name="name" 
                                value="{{ $subsubcategory->name }}">
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input 
                                        type="file" 
                                        class=""
                                        name="image">
                                    <br><small class="text-danger"><i><b>Note: </b>Dimension should be 50px X 50px</i></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <img src="{{ asset('storage/'.$subsubcategory->image) }}" alt="{{ $subsubcategory->name }}">
                            </div>
                        </div>
                 
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Update
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