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
                                <h4  class="title text-white">Buyer Post Job</h4>
                                <p class="text-white mb-0">Buyer can offer job for bid freelancer</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-3 ">

                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('clients.buyer-request.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf 

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Choose Category</option>
                                            @forelse($categories as $key => $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @empty 
                                                <option value="">No category found!y</option>
                                            @endforelse
                                        </select>
                                    </div><!--End col -->
    
                                    <div class="col-md-4 mb-3">
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">Choose Subcategory</option>
                                            
                                        </select>
                                    </div><!--End col -->
    
                                    <div class="col-md-4 mb-3">
                                        <select name="subsubcategory_id" id="subsubcategory_id" class="form-control">
                                            <option value="">Choose Sub Subcategory</option>
                                            
                                        </select>
                                    </div><!--End col -->
    
                                </div><!--End row -->

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="description" id="description" ></textarea>
                                    <label for="description">Description</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" name="budget" id="budget" placeholder="0">
                                            <label for="budget">Budget</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" name="estimate_date" id="estimate_date">
                                            <label for="estimate_date">Estimate Date</label>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-grid">
                                            <button type="submit" class="btn primary-bg-color primary-hover text-white">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </form><!--End Form-->


                      

                        </div><!--End card-body-->
                    </div><!--End Card-->

                    </div><!--End col-->
                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection

@section('footer_scripts')
    <script>

    $('#category_id').on('change', function(){
        let category_id = $(this).val()

        $.ajax({
            url: "{{ route('user.fetch.subcategory') }}",
            data: {
                category_id : category_id
            },
            success:function(res){
                var html = '';
                html += '<option value="">Choose Subcategory</option>';
                res.forEach(subcategory => {
                html += '<option value="'+subcategory.id+'">'+subcategory.name+'</option>';
                });

                $('#subcategory_id').html(html)
                console.log(res);
            }, 
            error:function(){
                console.log('Not fetch subcategory')
            }
        })//End ajax
    })//End category

    $('#subcategory_id').on('change', function(){
        let subcategory_id = $(this).val()

        $.ajax({
            url: "{{ route('user.fetch.subsubcategory') }}",
            data: {
                subcategory_id : subcategory_id
            },
            success:function(res){
                var html = '';
                html += '<option value="">Choose Sub Subcategory</option>';
                res.forEach(subsubcategory => {
                html += '<option value="'+subsubcategory.id+'">'+subsubcategory.name+'</option>';
                });

                $('#subsubcategory_id').html(html)
            }, 
            error:function(){
                console.log('Not fetch Subsubcategory')
            }
        })//End ajax
    })//End Subcategory
    </script>
@endsection