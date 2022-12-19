@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Settings</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xsl-12 col-xl-12 col-lg-12 col-md-12 mb-4">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.settings') }}" method="POST">
                        @csrf 
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-3">
                                @php 
                                    $admin_commission = App\Models\BusinessSetting::where('key', 'admin_commission')->first()->value;
                                @endphp
                                <div class="form-group">
                                    <label for="admin_commission">Admin Commision (%)</label>
                                    <input type="number" class="form-control" name="admin_commission" id="admin_commission" value="{{ $admin_commission }}" >                                    
                                </div> 
                            </div><!--End Col-->

                            <div class="col-md-3">
                                @php 
                                    $max_gig = App\Models\BusinessSetting::where('key', 'max_gig')->first()->value;
                                @endphp
                                <div class="form-group">
                                    <label for="max_gig">Max Gig</label>
                                    <input type="number" class="form-control" name="max_gig" id="max_gig" value="{{ $max_gig }}" >
                                </div> 
                            </div><!--End Col-->

                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>

                        </div><!--End Row-->

                    </form>

                </div><!--End Card body-->
            </div><!--End Card-->

            
        </div><!--End Col-->

    </div><!--End row-->

    <!-- Content Row -->

    
@endsection