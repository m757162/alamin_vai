<div class="card shadow">
    <div class="card-body p-0"> 
       
        <div class="user-heading round">
            <div class="profile-area">
                <div class="profile-sidebar primary-bg-color d-flex justify-content-center">
                    <div class="profile-img-content text-center">
                        @if($gig->freelancer->image != NULL)
                            <img src="{{ asset('storage/'.$gig->freelancer->image) }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="{{ $gig->freelancer->name }}">
                        @else 
                            <img src="{{ asset('placeholder.jpg') }}" class="img-round img-border primary-border-color mt-3" width="120" height="120" alt="Gig Title">
                        @endif

                        <div class="title py-3">
                            <a href="{{ route('user.profile') }}" class="text-white"><strong>{{ $gig->freelancer->name }}</strong></a>
                            <p class="text-white">{{ $gig->freelancer->moto }}</p>
                        </div>
                    </div>             
                    
                </div>
                
                @auth
                    @if(auth()->check() && auth()->user()->user_type == 'client')                    
                        <div class="hire-me d-grid my-2">
                            <!--Hire-->
                            @include('frontend.components.hire-btn', ['link' => 'user.hire.view', 'freelancer_id' => encrypt($gig->user_id), 'gig_id' => encrypt($gig->id)])
                            <!--Hire End-->

                            <!--Chat-->
                            @include('frontend.components.clients.chat-btn', ['link' => 'clients.chat', 'client_id' => encrypt(auth()->user()->id) ])
                            <!--Chat End-->
                        </div>
                    @endif
                @endauth

                <div class="fb-follower">
                    <div class="fb-page" data-href="https://www.facebook.com/sumonrahman3600/" data-tabs="timeline" data-width="" data-height="70" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/sumonrahman3600/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/sumonrahman3600/">Computer Tips - Shortcut</a></blockquote></div>
                </div>
                

                

                <div class="user-description p-3">
                    <div class="description-header d-flex justify-content-between">
                        <p class="title"><b>Descriptions</b></p>
                    </div>
                    <p>{{ $gig->freelancer->description }} </p>
                    
                </div>

                <div class="user-skills p-3">
                    <div class="skills-header d-flex justify-content-between">
                        <p class="title"><b>Skills</b></p>                        
                    </div>
                    
                    <div class="skills">
                        @php 
                            $user = \App\Models\User::with(['skill', 'social', 'certificates'])->find($gig->user_id);

                            if($user->skill != NULL){
                                $skills = explode(',', $user->skill->skills);
                            }else{
                                $skills = [];
                            }
                            
                        @endphp 

                        @forelse($skills as $key => $skill)
                            <span class="badge text-bg-light">{{$skill}}</span>
                        @empty 
                            <span class="">Add Skill</span>
                        @endforelse 
                    </div>
                    
                </div>

                <div class="user-socials p-3">
                    <div class="socials-header d-flex justify-content-between">
                        <p class="title"><b>Social Media Links</b></p>                       
                    </div>
                    
                    <div class="socials p-3">
                        <div class="social-links d-flex justify-content-around align-items-center">                        
                            <a href="{{ $user->social != NULL ? $user->social->twitter : '#' }}" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $user->social != NULL ? $user->social->facebook : '#' }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="{{ $user->social != NULL ? $user->social->instagram : '#' }}" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="{{ $user->social != NULL ? $user->social->linkedin : '#' }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="user-certificate p-3">
                    <div class="certificate-header d-flex justify-content-between">
                        <p class="title"><b>Certification</b></p>                        
                    </div>
                    
                    <div class="certificates p-3">
                        @forelse($user->certificates as $key => $certificate)
                            <div class="certificateItem d-flex flex-wrap">
                                <p>{{ $key+1 }}.</p>
                                <p class="mx-2">{{ $certificate->name }}</p>          
                            </div>
                        @empty 
                            <p>Add Certificate</p>
                        @endforelse
                    </div>
                    
                </div>
                
            </div><!--End profile-area -->
        </div><!--End user-heading -->

    </div><!--End card body-->
</div><!--End Card-->