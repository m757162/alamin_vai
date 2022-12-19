<div class="card shadow">
    <div class="card-body p-0"> 
        
        <div class="user-heading round">
            <div class="profile-area">
                <div class="profile-sidebar primary-bg-color d-flex justify-content-center">
                    <div class="profile-img-content text-center">
                        @if(auth()->user()->image != NULL)
                            <img src="{{ asset('storage/'.auth()->user()->image) }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="{{ auth()->user()->name }}">
                        @else 
                            <img src="{{ asset('placeholder.jpg') }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="{{ auth()->user()->name }}">
                        @endif
                        
                        
                        <div class="moto py-3">
                            <a href="#" class="text-white"><strong>{{ auth()->user()->name }}</strong></a>
                            <p class="text-white"><span class="motoText">{{ auth()->user()->moto }}</span> &nbsp; <a href="#" class="text-white"><i class="bi bi-pencil user-moto" title="Edit" id="motoEdit"></i></a></p>
                        </div>           
                        
                        <div class="motoForm my-2 d-none">
                            <div class="input-group">
                                <div class="row gy-2">
                                    <div class="col-md-12">
                                        <input type="text" name="moto" id="moto" value="{{ auth()->user()->moto }}" class="form-control">
                                    </div>
                                    <div class="d-grid col-md-12">
                                        <button class="btn secondary-bg-color secondary-hover text-white" onclick="updateMoto({{ auth()->user()->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>             
                
                </div>   

                <div class="user-description p-3">
                    <div class="description-header d-flex justify-content-between">
                        <p class="title"><b>Descriptions</b></p>
                        <i class="bi bi-pencil" title="Edit" id="descriptionEdit"></i>
                    </div>
                    
                    <div class="description">
                        <p class="descriptionText">{{ auth()->user()->description }} </p>                        
                    </div>

                    <div class="formDescription d-none">
                            <div class="input-group">
                                <div class="row gy-2">
                                    <div class="col-md-12">
                                        <textarea type="text" id="description" class="form-control" rows="10" cols="10">{{ auth()->user()->description }}</textarea>
                                    </div>
                                    <div class="d-grid col-md-12">
                                        <button class="btn secondary-bg-color secondary-hover text-white" onclick="updateDescription({{ auth()->user()->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>

                <div class="user-skills p-3">
                    <div class="skills-header d-flex justify-content-between">
                        <p class="title"><b>Skills</b></p>
                        <i class="bi bi-pencil edit-icon-pointer primary-hover" title="Edit" id="skillEdit"></i>
                    </div>
                    
                    <div class="skills">
                        @forelse($skills as $key => $skill)
                            <span class="badge text-bg-light">{{$skill}}</span>
                        @empty 
                            <span class="">Add Skill</span>
                        @endforelse 

                    </div>

                    <div class="formSkills d-none">
                            <div class="input-group">
                                <div class="row gy-2">
                                    <div class="col-md-12">
                                        <input type="text" id="skills" class="form-control" rows="10" cols="10" />
                                    </div>
                                    <div class="d-grid col-md-12">
                                        <button class="btn secondary-bg-color secondary-hover text-white" onclick="updateSkills({{ auth()->user()->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>

                <div class="user-socials p-3">
                    <div class="socials-header d-flex justify-content-between">
                        <p class="title"><b>Social Media Links</b></p>
                        <i class="bi bi-pencil edit-icon-pointer primary-hover" title="Edit" id="socialEdit"></i>
                    </div>
                    
                    <div class="socials p-3">
                        <div class="social-links d-flex justify-content-around align-items-center">
                
                            <a @if($socials != NULL && $socials->twitter != NULL) href="{{ $socials->twitter }}" @else href="#" @endif target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a @if($socials != NULL && $socials->facebook != NULL) href="{{ $socials->facebook }}" @else href="#" @endif target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a @if($socials != NULL && $socials->instagram != NULL) href="{{ $socials->instagram }}" @else href="#" @endif target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a @if($socials != NULL && $socials->linkedin != NULL) href="{{ $socials->linkedin }}" @else href="#" @endif target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="socialForm my-2 d-none">
                            <div class="input-group">
                                <div class="row gy-2">

                                    <div class="col-md-12">
                                        <input type="text" id="twitter" @if($socials != NULL && $socials->twitter != NULL) value="{{ $socials->twitter }}" @else placeholder="Twitter" @endif class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" id="facebook" @if($socials != NULL && $socials->facebook != NULL) value="{{ $socials->facebook }}" @else placeholder="Facebook" @endif class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" id="instagram" @if($socials != NULL && $socials->instagram != NULL) value="{{ $socials->instagram }}" @else placeholder="Instagram" @endif class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" id="linkedin" @if($socials != NULL && $socials->linkedin != NULL) value="{{ $socials->linkedin }}" @else placeholder="Linkedin" @endif class="form-control">
                                    </div>


                                    <div class="d-grid col-md-12">
                                        <button class="btn secondary-bg-color secondary-hover text-white" onclick="updateSocial({{ auth()->user()->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                    
                </div>

                <div class="user-certificate p-3">
                    <div class="certificate-header d-flex justify-content-between">
                        <p class="title"><b>Certification</b></p>
                        <i class="bi bi-pencil edit-icon-pointer primary-hover" title="Edit" id="certificateEdit"></i>
                    </div>
                    
                    <div class="certificatesShow p-3">
                        
                        @forelse($certificates as $key => $certificate)
                            <div class="certificateItem d-flex justify-content-between flex-wrap">
                                <p>{{ $key+1 }}</p>
                                <p>{{ $certificate->name }}</p>                                
                                <i class="bi bi-pencil edit-icon-pointer primary-hover" title="Edit" onclick="updateCertificate({{ $certificate->id }})"></i>
                            </div>
                        @empty 
                            <p>Add Certificate</p>
                        @endforelse

                    </div>

                    <div class="formCertificate d-none">
                            <div class="input-group">
                                
                                <div id="certificates">
                                    <form action="{{ route('user.store.certificate') }}" id="certificateForm" method="POST" enctype="multipart/form-data">
                                        @csrf 
                                        
                                        <div class="row gy-2 my-2" id="certficateRow">
                                            <div class="col-md-12">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name"/>
                                            </div>

                                            
                                            <div class="col-md-12">
                                                <input type="number" name="year" id="year" class="form-control" id="passingYear" min="1970" step="1" placeholder="Year"/>
                                            </div>                                           

                                            <div class="col-md-12 mb-3">
                                                <input type="file" class="form-control"  name="file">
                                                <small class="text-danger fw-lighter">Max 100KB </small>
                                            </div>

                                            <div class="col-md-12 mb-3 certificateFile">
                                                
                                            </div>
                                        
                                        </div> <!--End Row--> 

                                        <div class=" my-2">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn secondary-bg-color secondary-hover text-white" id="certificateBtn">Add</button>                                        
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                

                            </div><!--End input--> 
                    </div><!--End formCertificate--> 
                    
                </div>
                
            </div><!--End profile-area -->
        </div><!--End user-heading -->

    </div><!--End card body-->
</div><!--End Card-->