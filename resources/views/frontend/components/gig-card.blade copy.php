<div class="card shadow">
    @php 
        $image_decode = json_decode($gig->image, true);
        $image = $image_decode[0];
    @endphp
    
    <a href="{{ route($link, [$gig->title, encrypt($gig->id)]) }}" >      

        @if($gig->image != NULL)
            <img src="{{ asset('storage/'.$image) }}" class="card-img-top" alt="{{ $gig->title }}">
        @else
            <img src="{{ asset('placeholder.svg') }}" class="card-img-top" alt="Easy Bangladesh">
        @endif                                

        <div class="card-body pb-0">
            @if($gig->rate != null)
                @if($gig->rate->freelancer_rate == 1)
                    <div class="rating">
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star"></i></span>
                        <span><i class="bi bi-star"></i></span>
                        <span><i class="bi bi-star"></i></span>
                        <span><i class="bi bi-star"></i></span>
                    </div>
                @elseif($gig->rate->freelancer_rate == 2)
                    <div class="rating">
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star"></i></span>
                        <span><i class="bi bi-star"></i></span>
                        <span><i class="bi bi-star"></i></span>
                    </div>
                @elseif($gig->rate->freelancer_rate == 3)
                    <div class="rating">
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star"></i></span>
                        <span><i class="bi bi-star"></i></span>
                    </div>
                @elseif($gig->rate->freelancer_rate == 4)
                    <div class="rating">
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star"></i></span>
                    </div>
                @elseif($gig->rate->freelancer_rate == 5)
                    <div class="rating">
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                        <span><i class="bi bi-star-fill text-warning"></i></span>
                    </div>
                @endif 
           
                <div class="rating">
                    <span><i class="bi bi-star"></i></span>
                    <span><i class="bi bi-star"></i></span>
                    <span><i class="bi bi-star"></i></span>
                    <span><i class="bi bi-star"></i></span>
                    <span><i class="bi bi-star"></i></span>
                </div> 
            @endif 
            <p class="card-title text-truncate">{{ $gig->title }}</p>
            
        </div>
        
    </a>
    <a>
    
            
   
    <div class="card-body pt-1 m-0">
   
        @if ($gig_favourite->gig_id == $gig->id)
        <form action="{{ route('gig.favourite.remove',['gig'=> $gig->id]) }}" method="POST">
        @csrf
            <button type="submit" class="btn"><i class="bi bi-star-fill"></i></button>
        </form>
        @else
        <form action="{{ route('gig.favourite',['gig'=> $gig->id]) }}" method="POST">
        @csrf
            <button type="submit" class="btn "><i class="bi bi-star"></i></button>
        </form>
        @endif
       
    </div>
</div><!--End card-->