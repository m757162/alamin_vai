@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Subcategories > Edit</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                value="{{ $subcategory->name }}">
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
                                @if($subcategory->image != NULL)
                                    <img src="{{ asset('storage/'.$subcategory->image) }}" alt="{{ $subcategory->name }}">
                                @else 
                                    <img src="{{ asset('placeholder.svg') }}" width="80" alt="Subcategory icon">
                                @endif
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