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
                <div class="card p-3">
                    <div class="card-body">

                        <nav class="">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-basic-tab" data-bs-toggle="tab" data-bs-target="#nav-basic" type="button" role="tab" aria-controls="nav-basic" aria-selected="true" disabled>Basic</button>                           
                            <button class="nav-link" id="nav-preview-tab" data-bs-toggle="tab" data-bs-target="#nav-preview" type="button" role="tab" aria-controls="nav-preview" aria-selected="false" >Preview & Publish</button>
                            </div>
                        </nav>
    
                        <div class="tab-content" id="nav-tabContent">                       
                          
                            <div class="tab-pane fade show active" id="nav-preview" role="tabpanel" aria-labelledby="nav-preview-tab" tabindex="0">
                                <form action="{{ route('user.gigs.update', $gig->id) }}" method="post">
                                    @csrf 
                                    @method('PUT')
                                    
                                    <div class="row my-4">
                                        <div class="col-md-3">
                                            @php 
                                                $image_decode = json_decode($gig->image, true);
                                                $image = $image_decode[0];
                                            @endphp

                                            <img src="{{ asset('storage/'.$image) }}" width="100%" alt="{{ $gig->title }}">
                                        </div>

                                        <div class="col-md-6">
                                            <h4>{{ $gig->title }}</h4>
                                            <p>{{ $gig->description }}</p>
                                        </div>

                                        <div class="col-md-3">
                                            <p><b>Price</b> : BDT {{ $gig->price }}</p>
                                            <p>Estimate Day : {{ $gig->estimate_day }} Days</p>
                                        </div>
                                    </div>
        
                                    <div class="d-grid d-md-flex justify-content-md-end mb-3">                               
                                        <button type="submit" class="btn primary-bg-color text-white" name="publish" value="publish">Publish</button>
                                    </div>
        
                                </form>
                            </div><!--End preview-->

                        </div><!--End Tab content-->

                    </div><!--End card-body-->
                  
                </div><!--End card-->
            
            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

</section>

@endsection

@section('footer_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        function previewFile(input, id){
            var file = $("input[type=file]").get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }    
                reader.readAsDataURL(file);
            }

            console.log(id)
        }


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