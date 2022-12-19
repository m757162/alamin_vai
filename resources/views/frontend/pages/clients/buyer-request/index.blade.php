@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-tagsinput.css') }}" />
    <style>

        .bootstrap-tagsinput .tag {
            background: #959595;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')
<section class="profile-section">
    <div class="container" data-aos="fade-up">

        <div class="row">        

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
       
               <!--User profile sidebar -->
                @include('frontend.components.clients.dashboard-sidebar')
               <!--EndUser profile sidebar -->
                
            </div><!-- End Col-->

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Post Job</h4>
                                <p class="text-white mb-0">All job post will be here</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-3 ">
                        <table class="table">
                            @if(!empty($buyer_requests))
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">#</th>
                                        <th width="10%">Category</th>
                                        <th width="50%" class="text-center">Description</th>
                                        <th width="10%" class="text-center">Budget</th>
                                        <th width="15%" class="text-center">Estimate Date</th>
                                        <th width="5%" class="text-center">Status</th>
                                        <th width="5%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                            @endif 

                            <tbody>
                    
                                @forelse($buyer_requests as $key => $buyer_request)
                                    
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $buyer_request->category->name }}</td>
                                        <td>{{ $buyer_request->description }}</td>
                                        <td class="text-center fs-bold"> {{ currency_symbol().$buyer_request->budget }}</td>                                        
                                        <td class="text-center">{{ date('M d'.','. ' Y', strtotime($buyer_request->estimate_date)) }}</td>
                                        <td class="text-center"> 
                                            @if($buyer_request->status == 'active')
                                                <span class="badge text-bg-success">Active</span>
                                            @elseif($buyer_request->status == 'inactive')
                                                <span class="badge text-bg-success">Inactive</span>
                                            @elseif($buyer_request->status == 'hired')
                                                <span class="badge text-bg-danger">Hired</span>
                                            @else
                                                ---
                                            @endif 
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="#" class="btn primary-bg-color primary-hover text-white"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                                                    
                                @empty 
                                    <tr>
                                        <td colspan="7" class="text-center">No post found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>                    

                    </div><!--End col-->

                    <div class="col-md-12">
                        <div class="pagin my-3">
                            {{ $buyer_requests->links() }}
                        </div>
                    </div>

                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection

@section('footer_scripts')
 
@endsection