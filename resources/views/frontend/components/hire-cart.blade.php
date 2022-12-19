

    <input type="hidden" name="gig_id" value="{{ encrypt($gig->id) }}">
    <input type="hidden" name="freelancer_id" value="{{ encrypt($gig->freelancer->id) }}">

    <div class="card">
        <div class="card-body p-0"> 
            
            <div class="user-heading round">
                <div class="profile-area">
                   
                    <div class="carts p-3">
                        <div class="description-header d-flex justify-content-between">
                            <p class="title"><b>Cart Details</b></p>                        
                        </div>
                        <hr>
    
                        <div class="gig-content mt-1">
                            <div class="d-flex justify-content-between mt-2">
                                <p><b>Budget</b> </p>
                                <span><input type="number" name="budget" class="form-control" placeholder="100.00"></span>
                            </div>
    
                            <div class="d-flex justify-content-between mt-2">
                                <p><b>Estimate Date</b> </p>
                                <span><input type="date" name="estimate_date" class="form-control"></span>
                            </div>

                            <div class="d-flex mt-4 mb-2">
                                <button type="button" class="btn primary-bg-color primary-hover text-white mx-1" onclick="submitForm()">Order</button>
                                <a href="#" class="btn secondary-bg-color secondary-hover text-white mx-1">Cancel</a>
                                
                            </div>
                           
                       </div>
                        
                    </div>              
                    
                </div><!--End profile-area -->
            </div><!--End user-heading -->
    
        </div><!--End card body-->
    </div><!--End Card-->
