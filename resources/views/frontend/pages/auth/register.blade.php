@extends('frontend.master')

@section('title', 'Register | Easy Bangladesh')

@section('header_css')
@endsection

@section('content')
<section >
    <div class="container" data-aos="fade-up">

        <div class="row gx-lg-0 gy-4">        

            <div class="col-lg-4 offset-lg-4">
                
                <div class="card shadow-lg bg-body rounded">
                    <div class="card-body">  

                        <div class="text-center mb-4">
                            <h3>Sign Up</h3>
                            <p>You are most weblcome!</p>
                        </div>
     

                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>                       
        
                        <form action="{{ route('user.register.action') }}" method="post" >
                            @csrf 

                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
        
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>

                            <div class="form-group mb-3">
                                <select name="user_type" class="form-control">
                                    <option value="">Choose one</option>
                                    <option value="freelancer">Freelancer</option>
                                    <option value="client">Client</option>
                                </select>
                                <small class="text-danger" style="font-size: 12px; margin-left:5px;"><i>You can update it later</i></small>
                            </div>
        
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                    
                        
                            <div class=""><button type="submit" class="btn btn-success btn-block">Sign Up</button></div>
                        </form>
                        

                    </div><!--End card body-->
                </div><!--End Card-->
                
            </div><!-- End -->

        </div>

    </div>
    </section>
@endsection