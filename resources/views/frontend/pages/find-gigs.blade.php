@extends('frontend.master')

@section('title', $page_title.' | Easy Bangladesh')

@section('header_css')
    <style>
        .budget-dropdown {
            width: 400px !important;
            padding: 10px;
        }
    </style>
@endsection

@section('content')

      <!-- ======= Gig Section ======= -->
    <section id="recent-posts" class="recent-posts sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="d-flex flex-wrap flex-xxl-row flex-xl-row flex-lg-row flex-md-row flex-sm-column justify-content-center mb-5">

                <div class="item m-2">
                    <div class="dropdown-center">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                        </a>
                    
                        <ul class="dropdown-menu">                            
                            @forelse($categories as $key => $category)  
                                <li><a class="dropdown-item" href="{{ route('find.gigs', ['category_name' => $category->name ]) }}">{{ $category->name }}</a></li>
                            @empty
                                <li><a class="dropdown-item" href="#">No category found!</a></li> 
                            @endforelse                                                 
                            
                        </ul>
                    </div>
                    
                </div><!-- End Filtering Item -->

                <div class="item m-2">
                    <div class="dropdown-center">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Subcategory
                        </a>
                    
                        <ul class="dropdown-menu">                                                   
                            @forelse($subcategories as $key => $subcategory)  
                                <li><a class="dropdown-item" href="{{ route('find.gigs', ['subcategory_name' => $subcategory->name ]) }}">{{ $subcategory->name }}</a></li>
                            @empty
                                <li><a class="dropdown-item" href="#">No subcategory found!</a></li> 
                            @endforelse
                        </ul>
                    </div>
                    
                </div><!-- End Filtering Item -->


                <div class="item m-2">
                    <div class="dropdown-center">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sub Subcategory
                        </a>
                    
                        <ul class="dropdown-menu">                                                   
                            @forelse($subsubcategories as $key => $subsubcategory)  
                                <li><a class="dropdown-item" href="{{ route('find.gigs', ['subsubcategory_name' => $subsubcategory->name ]) }}">{{ $subsubcategory->name }}</a></li>
                            @empty
                                <li><a class="dropdown-item" href="#">No Sub subcategory found!</a></li> 
                            @endforelse
                        </ul>
                    </div>
                    
                </div><!-- End Filtering Item -->
{{-- 

                <div class="item m-2">
                    <div class="dropdown-center">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Area
                        </a>
                    
                        <ul class="dropdown-menu">                                                   
                            <li><a class="dropdown-item" href="#">Cancel</a></li>
                            <li><a class="dropdown-item" href="#">Cancel</a></li>
                            <li><a class="dropdown-item" href="#">Cancel</a></li>
                        </ul>
                    </div>
                    
                </div><!-- End Filtering Item --> --}}

                <div class="item m-2">
                    <div class="dropdown-center">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Budget
                        </a>
                    
                        <ul class="dropdown-menu budget-dropdown">                                                   
                            <form action="{{ route('find.gigs') }}" method="get">

                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="min_budget">{{ currency_symbol() }}</span>
                                            <input type="number" class="form-control" name="min_budget" step="10" min="100" value="100" placeholder="100.00" aria-label="min_budget" aria-describedby="min_budget">
                                        </div>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <div class="mt-1">
                                            <span><b>To</b></span>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="max_budget">{{ currency_symbol() }}</span>
                                            <input type="number" class="form-control" name="max_budget" step="10" min="100" value="200" placeholder="0.00" aria-label="max_budget" aria-describedby="max_budget">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row gy-3">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </ul>
                    </div>
                    
                </div><!-- End Filtering Item -->
                

            </div><!-- End Row Filtering -->

            <div class="section-header">
                <h2>Gigs</h2>
                <p>Build awesome by find your desired gigs.</p>
            </div>

            <div class="row gy-4">

                @forelse($gigs as $key => $gig)
                
                    <div class="col-md-3 my-2">
                        @include('frontend.components.gig-card',['gig' => $gig, 'gig_favourite'=>$gig->fav_gig, 'link' => 'gig.view'])
                    </div><!--End col-->                      

                @empty 
                    <div class="my-2">
                        <p>No gig found!</p>
                    </div>
                @endforelse
               
                <!-- End gig item -->        

            </div><!-- End Gig list -->

        </div>
    </section>
    <!-- End Gig Section -->

@endsection