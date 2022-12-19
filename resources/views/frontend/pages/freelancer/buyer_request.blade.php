@extends('frontend.master')

@section('title', 'Buyer Requests | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/dashboard.css') }}">
@endsection

@section('content')
<section class="profile-section">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Buyer Requests</h3>
                <hr>
            </div>
        </div><!--End Row--->  


        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="buyer-requests">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-active-tab" data-bs-toggle="tab" data-bs-target="#nav-active" type="button" role="tab" aria-controls="nav-active" aria-selected="true">Active({{ $buyer_requests->total() }})</button>
                            <button class="nav-link" id="nav-sent-offer-tab" data-bs-toggle="tab" data-bs-target="#nav-sent-offer" type="button" role="tab" aria-controls="nav-sent-offer" aria-selected="false">Sent Offer({{ $bids->total() }})</button>
                        
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab" tabindex="0">
                            <div class="row">                  
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">       
                                    
                                    <table class="table">
                                
                                        <thead>
                                            <tr>
                                                <th width="5%" scope="col">#</th>
                                                <th width="60%" class="text-center">Description</th>
                                                <th width="10%" class="text-center">Budget</th>
                                                <th width="15%" class="text-center">Estimate Date</th>
                                                <th width="10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                
                                            @forelse($buyer_requests as $key => $buyer_request)
                                                
                                                <tr>
                                                    <th scope="row">{{ $key+1 }}</th>
                                                    <td>{{ $buyer_request->description }}</td>
                                                    <td class="text-center fs-bold"> {{ currency_symbol().$buyer_request->budget }}</td>                                        
                                                    <td class="text-center">{{ date('M d'.','. ' Y', strtotime($buyer_request->estimate_date)) }}</td>
                                                    <td class="text-center">
                                                        @php 
                                                            $bid = \App\Models\Bid::where(['freelancer_id' => Auth::guard('web')->user()->id, 'buyer_request_id' => $buyer_request->id])->first();
                                                        @endphp

                                                        @if($bid != null)
                                                            <span class="text-decoration-none text-muted">Offer Sent</span>
                                                        @else
                                                            <a href="{{ route('freelancer.send-offer', $buyer_request->id) }}" class="btn primary-bg-color primary-hover text-white">Send Offer</a>
                                                        @endif 
                                                    </td>
                                                </tr>
                                                                                
                                            @empty 
                                                <tr>
                                                    <td colspan="7" class="text-center">No requests found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div><!--End Col-->
                            </div><!--End Row-->
                        </div><!--End Active-->

                        <div class="tab-pane fade" id="nav-sent-offer" role="tabpanel" aria-labelledby="nav-sent-offer-tab" tabindex="0">
                            <table class="table">
                                
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">#</th>
                                        <th width="60%" class="text-center">Offer Letter</th>
                                        <th width="10%" class="text-center">Budget</th>
                                        <th width="15%" class="text-center">Estimate Date</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                        
                                    @forelse($bids as $key => $bid)
                                        
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $bid->offer_letter }}</td>
                                            <td class="text-center fs-bold"> {{ currency_symbol().$bid->budget }}</td>                                        
                                            <td class="text-center">{{ date('M d'.','. ' Y', strtotime($bid->estimate_date)) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('freelancer.bid.delete', $bid->id) }}" class="btn btn-danger text-white"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                                                        
                                    @empty 
                                        <tr>
                                            <td colspan="7" class="text-center">No requests found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div><!--End sent offer-->
                        
                    </div><!--End Tab pane -->

                
                </div><!--End Buyer header-->
            </div><!--End Col-->
        </div><!--End Row--> 
            
    </div><!--End Container-->

</section>
@endsection

@section('footer_scripts')
   
@endsection 