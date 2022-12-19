<div class="card">
    @php 
        $image_decode = json_decode($gig->image, true);
        $image = $image_decode[0];
    @endphp
    
    <a href="{{ route($link, [$gig->title, encrypt($gig->id)]) }}" >
        <div class="status p-2">
            @if($gig->status == 'active')                                
                <span class="badge text-bg-success">{{ $gig->status }}</span>
            @else 
                <span class="badge text-bg-secondary">{{ $gig->status }}</span>
            @endif
        </div>

        @if($gig->image != NULL)
            <img src="{{ asset('storage/'.$image) }}" class="card-img-top" alt="{{ $gig->title }}">
        @else
            <img src="{{ asset('placeholder.svg') }}" class="card-img-top" alt="Easy Bangladesh">
        @endif                                

        <div class="card-body">
            <div class="rating">
                <span><i class="bi bi-star-fill text-warning"></i></span>
                <span><i class="bi bi-star"></i></span>
                <span><i class="bi bi-star"></i></span>
                <span><i class="bi bi-star"></i></span>
                <span><i class="bi bi-star"></i></span>
            </div>
            <p class="card-title text-truncate">{{ $gig->title }}</p>
        </div>
        <p class="card-title px-1 mt-0 text-truncate">Total Impression: {{ count($gig->count_gig) }}</p>
    </a>
</div><!--End card-->
