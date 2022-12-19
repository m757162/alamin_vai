@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}">
@endsection

@section('content')
<section class="profile-section">
    <div class="container" data-aos="fade-up">

        <div class="row">        

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
       
               <!--User profile sidebar -->
                @include('frontend.components.users.dashboard-sidebar')
               <!--EndUser profile sidebar -->
                
            </div><!-- End Col-->

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Orders</h4>
                                <p class="text-white mb-0">Your orders will be found there</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 my-3">
                        <div class="table-responsive">
                            <table class="table">                               
                               
    
                                <tbody>
                                    <tr>
                                        <th>Client</th>
                                        <td>{{$hire->client->name}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Gig</th>
                                        <td>{{ $hire->gig->title }}</td>
                                    </tr>

                                    <tr>
                                        <th>Accept</th>
                                        <td>
                                            @if($hire->order->is_accept == 1)
                                                <span class="badge text-bg-success">Accepted</span>                                                
                                            @else 
                                                <span class="badge text-bg-danger">Pending</span>
                                            @endif
                                        </td>
                                    </tr>

                                    @if($hire->order->is_accept == 1)   
                                        <tr>
                                            <th>Delivery Status</th>
                                            <td>
                                                @if($hire->order->delivery_status == 'pending') 
                                                    <span class="badge text-bg-secondary">Pending</span>                                                
                                                @elseif($hire->order->delivery_status == 'inprogress')  
                                                    <span class="badge text-bg-info text-white">In Progress</span>
                                                @elseif($hire->order->delivery_status == 'completed')  
                                                    <span class="badge text-bg-success">Completed</span>
                                                @elseif($hire->order->delivery_status == 'cancel')  
                                                    <span class="badge text-bg-danger">Cancel</span>                                                
                                                @endif
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Delivery Date</th>
                                        <td>{{ date('M d'.','. ' Y', strtotime($hire->order->estimate_date)) }}</td>
                                    </tr>

                                    <tr>
                                        <th>Total</th>
                                        <td>{{ currency_symbol().$hire->order->total_amount }}</td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn primary-bg-color primary-hover text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  Action
                                                </a>
                                              
                                                <ul class="dropdown-menu">
                                                  <li><a class="dropdown-item" href="{{ route('user.order.status.update', ['order_id' => $hire->order->id, 'status' => 'accept', 'type' => 'order_status']) }}">Accept</a></li>
                                                  <li><a class="dropdown-item" href="{{ route('user.order.status.update', ['order_id' => $hire->order->id, 'status' => 'decline', 'type' => 'order_status']) }}">Decline</a></li>
                                                </ul>
                                              </div>
                                        </td>                                       
                                    </tr>

                                    @if($hire->order->is_accept == 1) 
                                        <tr>
                                            <th>Delivery Status</th>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn primary-bg-color primary-hover text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                    </a>
                                                
                                                    <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ route('user.order.status.update', ['order_id' => $hire->order->id, 'status' => 'pending', 'type' => 'delivery_status']) }}">Pending</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('user.order.status.update', ['order_id' => $hire->order->id, 'status' => 'inprogress', 'type' => 'delivery_status']) }}">Inprogress</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('user.order.status.update', ['order_id' => $hire->order->id, 'status' => 'completed', 'type' => 'delivery_status']) }}">Completed</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('user.order.status.update', ['order_id' => $hire->order->id, 'status' => 'cancel', 'type' => 'delivery_status']) }}">Cancel</a></li>
                                                    </ul>
                                                </div>
                                            </td>                                       
                                        </tr>                                        

                                    @endif 
                                    
                                    @if($hire->order->is_delivered != NULL) 
                                        <tr>
                                            <th>Client Order Accept</th>
                                            <td>
                                                @if($hire->order->is_delivered == 'delivered')
                                                    <span class="secondary-text-color">Waiting for accept by Client</span>                                                
                                                @elseif($hire->order->is_delivered == 'accept_delivery')
                                                    <span class="badge text-bg-success">Accepted</span>
                                                @elseif($hire->order->is_delivered == 'not_accept')
                                                    <span class="badge text-bg-warning">Not Accepted</span>
                                                @endif
                                            </td>                                       
                                        </tr>
                                    @endif

                                    @if($hire->order->is_delivered == 'accept_delivery')
                                    <tr>
                                        <th>Rate</th>
                                        <td>
                                            @if($hire->order->rate == null)
                                                <span class="text-danger">Waiting for client rate it.</span>
                                            @elseif($hire->order->rate->client_feedback == null)
                                                <a href="#" class="btn btn-sm secondary-bg-color secondary-hover text-white" data-bs-toggle="modal" data-bs-target="#rateNow">Rate Now</a>
                                            @elseif($hire->order->rate->freelancer_feedback != null && $hire->order->rate->client_feedback != null)
                                                <p>
                                                    @for($j = 1; $j <= $hire->order->rate->freelancer_rate; $j++) 
                                                        <span><i class="rate_1 bi bi-star-fill text-warning"></i></span>
                                                    @endfor   
                                                </p>      
                                            <span class="">{{ $hire->order->rate->freelancer_feedback }}</span>                                            
                                            @endif 
                                        </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td colspan="2">                                            
                                            <a href="{{ url()->previous() }}" class="btn secondary-bg-color secondary-hover text-white">Back</a>
                                        </td>
                                    </tr>          
                                  
                                </tbody>
                            </table>
                            
                        </div><!--End responsive-->

                    </div><!--End col-->

                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    <!--Rate Modal-->

    <form action="#" method="POST">
        @csrf 
        <div class="modal fade" id="rateNow" tabindex="-1" aria-labelledby="rateArea" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="rateArea">Rate Now</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"> 
                    
                    <input type="hidden" id="rateId" value="{{ $hire->order->rate != null ? $hire->order->rate->id : '' }}">
                    <input type="hidden" id="rate">
 
                    <div class="rating my-3">
                        <span><i onclick="rate('1')" class="rate_1 bi bi-star"></i></span>
                        <span><i onclick="rate('2')" class="rate_2 bi bi-star"></i></span>
                        <span><i onclick="rate('3')" class="rate_3 bi bi-star"></i></span>
                        <span><i onclick="rate('4')" class="rate_4 bi bi-star"></i></span>
                        <span><i onclick="rate('5')" class="rate_5 bi bi-star"></i></span>
                    </div>
                    
                    <textarea class="form-control" id="feedback" rows="5" cols="" placeholder="Feedback"></textarea>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn primary-bg-color primary-hover text-white" data-bs-dismiss="modal" onclick="rate_submit()">Submit</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    </section>
@endsection

@section('footer_scripts')
<script>
    function remove_fill(rate){
        for(i = rate; i >= 1; i--){
            var count = 6-i;
            $('.rate_'+count).removeClass('bi-star-fill text-warning')
            $('.rate_'+count).addClass('bi-star')
            
        }
    }

    function add_fill(rate){
        for(i = 1; i <= rate; i++){
            $('.rate_'+i).addClass('bi-star-fill text-warning')
            $('.rate_'+i).removeClass('bi-star')
        } 

        remove_fill(5 - rate);
    }

    function rate(rate){             
        add_fill(rate)   
        $('#rate').val(rate)      
    };

    function rate_submit(){
        let feedback = $('#feedback').val()
        let rate = $('#rate').val()  
        let rateId = $('#rateId').val()

        $.ajax({
            url: '{{ route("clients.rate") }}',
            data: {
                type: 'freelancer',
                rate_id : rateId,
                rate : rate,
                feedback: feedback                    
            },
            success:function(res){
                console.log(res.data);
            }, 
            error:function(){
                console.log('Rate not store')
            }
        });//End Ajax
    }//End function
</script>
@endsection