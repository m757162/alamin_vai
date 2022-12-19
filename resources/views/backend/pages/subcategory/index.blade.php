@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Sub Categories</h1>
        <a href="{{ route('admin.subcategories.create') }}" class="d-none d-md-inline-block btn btn-md btn-primary shadow-sm">Add New</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Category</th>
                                    <th width="30%">Name</th>
                                    <th width="10%">Image</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse($subcategories as $key => $subcategory)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $subcategory->category->name }}</td>  
                                    <td>{{ $subcategory->name }}</td>  
                                    <td>
                                        @if($subcategory->image != null)
                                            <img src="{{ asset('storage/'.$subcategory->image) }}" width="80" alt="{{ $subcategory->name }}">
                                        @else 
                                            <img src="{{ asset('placeholder.svg') }}" width="80" alt="Subcategory img">
                                        @endif 
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" class="btn btn-primary btn-circle m-1"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="post">
                                                @csrf 
                                                @method('DELETE')
                                                
                                                <button type="submit" class="btn btn-danger btn-circle m-1"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @empty 
                                    <tr>
                                        <td colspan="5" class="text-center">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>

                    <div>
                        {{ $subcategories->links() }}
                    </div>
                
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