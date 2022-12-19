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

                <div class="clients p-3">                   

                    <div class="gig-content mt-5 ">
                        <div class="d-flex justify-content-between">
                            <p><b>Total order</b> </p>
                            <p>{{ $order_count }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p><b>Total Hire</b> </p>
                            <p>{{ $hire_count }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p><b>Payment</b> </p>
                            <p>Verified</p>
                        </div>

                       
                        <div class="d-flex justify-content-between ">
                            <p><b>Rating</b> </p>
                            <div class="rating">
                                <span><i class="bi bi-star-fill text-warning"></i></span>
                                <span><i class="bi bi-star"></i></span>
                                <span><i class="bi bi-star"></i></span>
                                <span><i class="bi bi-star"></i></span>
                                <span><i class="bi bi-star"></i></span>
                            </div>
                        </div>
                       
                   </div>
                    
                </div>              
                
            </div><!--End profile-area -->
        </div><!--End user-heading -->

    </div><!--End card body-->
</div><!--End Card-->