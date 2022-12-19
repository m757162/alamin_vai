@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Categories > Create</h1>
        <a href="{{ route('admin.categories.index') }}" class="d-none d-md-inline-block btn btn-md btn-primary shadow-sm">List</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="form-group">
                            <input 
                                type="text" 
                                class="form-control"
                                name="name" 
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <input 
                                type="text" 
                                class="form-control"
                                name="commission" 
                                placeholder="Commission (%)">
                        </div>

                        <div class="form-group">
                            <input 
                                type="file" 
                                class=""
                                name="image">
                            <br><small class="text-danger"><i><b>Note: </b>Dimension should be 50px X 50px</i></small>
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
