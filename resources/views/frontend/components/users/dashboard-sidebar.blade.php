<div class="card shadow">
    <div class="card-body p-0"> 
        
        <div class="user-heading round">
            <div class="profile-area">
                <div class="profile-sidebar primary-bg-color d-flex justify-content-center">
                    <div class="profile-img-content text-center">
                                                
                            @if(auth()->user()->image != NULL)
                                <img src="{{ asset('storage/'.auth()->user()->image) }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="{{ auth()->user()->name }}">
                            @else 
                                <img src="{{ asset('placeholder.jpg') }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="User">
                            @endif

                        <div class="title py-3">
                            <a href="#" class="text-white"><strong>{{ auth()->user()->name }}</strong></a>
                            <p class="text-white">{{ auth()->user()->moto }} &nbsp; <a href="#" class="text-white"></a></p>
                        </div>                        
                    </div>             
                    
                </div>   

                <div class="user-dashboard-menu p-3">

                    <ul class="list-group list-group-flush">
                       <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action">Overview</a>
                       <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">Profile</a>
                       <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">Orders</a>
                       <a href="{{ route('freelancer.gigs') }}" class="list-group-item list-group-item-action">Gigs</a>
                       <a href="{{ route('user.gigs.create') }}" class="list-group-item list-group-item-action">Create Gig</a>
                       <a href="{{ route('freelancer.withdraw.request.form') }}" class="list-group-item list-group-item-action">Withdraw Request</a>
                       <a href="{{ route('freelancer.withdraw') }}" class="list-group-item list-group-item-action">Withdraw</a>
                       <a href="{{ route('freelancer.payment.methods') }}" class="list-group-item list-group-item-action">Payment Methods</a>  
                       <a href="{{ route('freelancer.transaction') }}" class="list-group-item list-group-item-action">Transaction</a>
                      </ul>
                    
                </div><!--End menu-->


                
            </div><!--End profile-area -->
        </div><!--End user-heading -->

    </div><!--End card body-->
</div><!--End Card-->