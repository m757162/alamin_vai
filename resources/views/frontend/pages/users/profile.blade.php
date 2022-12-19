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
                @include('frontend.partials._user_profile_sidebar')
               <!--EndUser profile sidebar -->
                
            </div><!-- End Col-->

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Profile</h4>
                                <p class="text-white mb-0">Profile information update</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12 my-3 ">

                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('freelancer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf 
 
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
                                    <label for="name">Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}">
                                    <label for="email">Email</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-12" id="imageInputBox">
                                        <input type="file" name="image" id="image" onchange="filePreview(this)">
                                        <br><small class="fs-lighter"><i>Dimension ratio should be (1:1)</i></small>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="img-box my-2 mr-2" id="imgBox">
                                            <img id="profileImg" width="100%" src="{{ asset('placeholder.svg') }}" alt="Profile Image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                </div>
                            </form><!--End Form-->


                            <form action="{{ route('freelancer.password.update') }}" method="POST" enctype="multipart/form-data" class="my-3">
                                @csrf 

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter old password">
                                    <label for="old_password">Old Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Enter new password">
                                    <label for="password">Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  placeholder="Confirm password">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>


                                <div class="d-grid">
                                    <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
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
  
    <script src="{{ asset('frontend/assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script>

        $("#skills").tagsinput()

        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgBox').html('<img src="'+e.target.result+'" width="100%"/>');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        //Moto Update
        $('#motoEdit').on('click', function(){
            $('.moto').addClass('d-none')
            $('.motoForm').removeClass('d-none')
        })

        function updateMoto(id){

            let moto = $('#moto').val()

            $.ajax({
                url: "{{ route('user.update.moto') }}",
                data: {
                    id: id,
                    moto : moto
                },
                success:function(res){
                    $('.motoText').text(res.data.moto)
                    console.log(res.data.moto)
                    $('.moto').removeClass('d-none')
                    $('.motoForm').addClass('d-none')
                }, 
                error:function(){
                    console.log('Not update')
                }
            })//End ajax
        }
        //End Moto

        //Description Update
        $('#descriptionEdit').on('click', function(){
            $('.description').addClass('d-none')
            $('.formDescription').removeClass('d-none')
        })

        function updateDescription(id){

            let description = $('#description').val()

            $.ajax({
                url: "{{ route('user.update.description') }}",
                data: {
                    id: id,
                    description : description
                },
                success:function(res){
                    $('.descriptionText').text(res.data.description)           
                    $('.description').removeClass('d-none')
                    $('.formDescription').addClass('d-none')
                }, 
                error:function(){
                    console.log('Not update')
                }
            })//End ajax
        }
        //End Description


        //Skill Update
        $('#skillEdit').on('click', function(){
            $('.skills').addClass('d-none')
            $('.formSkills').removeClass('d-none')
        })

        function updateSkills(id){

            let skills = $('#skills').val()

            $.ajax({
                url: "{{ route('user.update.skills') }}",
                data: {
                    id: id,
                    skills : skills
                },
                success:function(res){   
                    html = '';  
                    var skill_str = res.data.skills;

                    var skills = skill_str.split(",")

                    skills.forEach(skill => {
                        html += '<span class="badge text-bg-light">'+ skill +'</span>'
                    });

                    $('.skills').html(html)
                    
                    $('.skills').removeClass('d-none')
                    $('.formSkills').addClass('d-none')

                }, 
                error:function(){
                    console.log('Not update')
                }
            })//End ajax
        }
        //End Skill

        //Social Update
        $('#socialEdit').on('click', function(){
            $('.socials').addClass('d-none')
            $('.socialForm').removeClass('d-none')
        })

        function updateSocial(id){

            let twitter = $('#twitter').val()
            let facebook = $('#facebook').val()
            let instagram = $('#instagram').val()
            let linkedin = $('#linkedin').val()
            
            $.ajax({
                url: "{{ route('user.update.socials') }}",
                data: {
                    id: id,
                    twitter : twitter,
                    facebook : facebook,
                    instagram : instagram,
                    linkedin : linkedin,
                },
                success:function(res){
                    console.log(res.twitter)

                    var html = '';
                    html += '<a href="'+ res.twitter +'" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>'
                    html += '<a href="'+res.facebook +'" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>'
                    html += '<a href="'+res.instagram +'" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>'
                    html += '<a href="'+res.linkedin +'" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>'
                    $('.social-links').html(html)
                           
                    $('.socials').removeClass('d-none')
                    $('.socialForm').addClass('d-none')
                }, 
                error:function(){
                    console.log('Not update')
                }
            })//End ajax
        }
        //End Social

        //Certificate Update
        $('#certificateEdit').on('click', function(){
            $('.certificatesShow').addClass('d-none')
            $('.formCertificate').removeClass('d-none')
        });

        function updateCertificate(id){

            $('.certificatesShow').addClass('d-none')
            $('.formCertificate').removeClass('d-none')

            $.ajax({
                url: "{{ route('user.update.get_certificate') }}",
                data: {
                    id: id,
                },
                success:function(res){   
                   
                    $('#certificateForm').attr('action', '{{ route('user.update.certificate') }}')
                    inputId = '<input type="hidden" name="id" value="'+id+'">';
                    $('#certificateForm').append(inputId)

                    $('#name').val(res.name)
                    $('#year').val(res.year)

                    htmlFile = '<img src="{{ asset("storage/'+res.file+'") }}>'
                    $('#certificateFile').html(htmlFile)

                    $('#certificateBtn').text('Update')                      

                }, 
                error:function(){
                    console.log('Not update')
                }
            })//End ajax            
        }
        
        //End Certificate


    </script>
@endsection