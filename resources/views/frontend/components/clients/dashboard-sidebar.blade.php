<div class="card shadow">
    <div class="card-body p-0"> 
        
        <div class="user-heading round">
            <div class="profile-area">
                <div class="profile-sidebar primary-bg-color d-flex justify-content-center">
                    <div class="profile-img-content text-center">
                        <img src="{{ asset('placeholder.jpg') }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="{{ auth()->user()->name }}">
                        <div class="title py-3">
                            <a href="#" class="text-white"><strong>{{ auth()->user()->name }}</strong></a>
                            <p class="text-white">{{ auth()->user()->moto }} &nbsp; <a href="#" class="text-white"><i class="bi bi-pencil user-moto" title="Edit"></i></a></p>
                        </div>
                    </div>             
                    
                </div>   

                <div class="user-dashboard-menu p-3">

                    <ul class="list-group list-group-flush">
                       <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action">Overview</a>
                       <a href="{{ route('clients.buyer-request.index') }}" class="list-group-item list-group-item-action">Job Posts</a>
                       <a href="{{ route('clients.buyer-request.create') }}" class="list-group-item list-group-item-action">Create Job Post</a>
                       <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">Orders</a>
                       <a href="{{ route('clients.transaction') }}" class="list-group-item list-group-item-action">Transaction</a>    
                       <a href="{{ route('clients.favourite') }}" class="list-group-item list-group-item-action">Favourite Gig </a>                       
                    </ul>
                    
                </div><!--End menu-->


                
            </div><!--End profile-area -->
        </div><!--End user-heading -->

    </div><!--End card body-->
</div><!--End Card-->