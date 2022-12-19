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
                            <button class="nav-link active" id="nav-basic-tab" data-bs-toggle="tab" data-bs-target="#nav-basic" type="button" role="tab" aria-controls="nav-basic" aria-selected="true">Basic</button>                           
                            <button class="nav-link" id="nav-preview-tab" data-bs-toggle="tab" data-bs-target="#nav-preview" type="button" role="tab" aria-controls="nav-preview" aria-selected="false" disabled>Preview & Publish</button>
                            </div>
                        </nav>
    
                        <div class="tab-content" id="nav-tabContent">
                        
                            <div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab" tabindex="0">                       
                                <form action="{{ route('user.gigs.store') }}" method="post" enctype="multipart/form-data" id="gigForm" data-parsley-validate>
                                    @csrf 
        
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Title" data-parsley-maxlength="120" required="">
                                        <small><i>Title should be 100 characters</i></small>
                                    </div>
        
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descriptions</label>
                                        <textarea type="text" class="form-control" name="description" id="description" placeholder="Description" data-parsley-maxlength="600" rows="12" required>{{ old('description') }}</textarea>
                                        <small><i>Descriptions should be 180 characters</i></small>
                                    </div>
        
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

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" placeholder="Price" required step="5" min="100">                                   
                                    </div>

                                    <div class="mb-3">
                                        <select name="estimate_day" id="estimate_day" class="form-control" required>
                                            <option value="">Estimate Day</option>
                                            @for($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}">{{ $i }} Days</option>                                            
                                            @endfor
                                        </select>
                                    </div><!--End col -->

                                    <div class="row">
                                        <div class="col-md-12" id="imageInputBox">
                                            <input type="file" name="image" id="image" onchange="previewFile(this, 'hey');" required>
                                            <br><small><i>Dimension ratio should be (170px X 280px)</i></small>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="img-box my-2 mr-2" id="imgBox">
                                                <img id="previewImg" width="100%" src="{{ asset('placeholder.svg') }}" alt="Placeholder">
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="mb-3">                               
                                        <button type="submit" class="btn primary-bg-color text-white">Save & Preview</button>
                                    </div>
        
                                </form>
                            </div>
                            <!--End Basic-->    
                           
                            <div class="tab-pane fade" id="nav-preview" role="tabpanel" aria-labelledby="nav-preview-tab" tabindex="0">...</div>
                        </div><!--End Tab content-->

                    </div><!--End card-body-->
                  
                </div><!--End card-->
            
            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

</section>

@endsection

@section('footer_scripts')        

    <script>
       $(document).ready(function(){
            $('#gigForm').parsley();
       })
    </script>

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