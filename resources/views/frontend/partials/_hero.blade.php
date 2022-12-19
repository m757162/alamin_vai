 <!-- Serach bar -->
<div class="container-fluid searchMain">
  <div class="row  d-flex align-items-center justify-content-center text-center">
    <form action="{{ route('find.gigs', [request()->search ]) }}" method="get">
      <center>
        <div class="col-md-7 pb-0 mb-0  my-5 d-flex align-items-center justify-content-center text-center">
          
            <div class="input-group shadow search bg-info">
              <i class="input-group-text bi bi-search  border-none" style="background-color: #fff"></i>
              <input type="search" name="search" class="form-control search_bar  border-start-0" placeholder="Search anything" style="font-weight:bold">
              <button class="btn btn-primary  d-flex flex-column justify-content-center align-items-center text-center">Search</button>
            </div> 
        </div>
        <div class="col-md-7 mt-0 pt-1 ">
          <div class="suggetions rounded circle  bg-white">
             
          </div>
        </div>
      <center>
    </form>  
  </div>
</div>

<!-- search bar script -->
<head>
<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/axios.min.js') }}"></script>
</head>
<script>
getdata();
function getdata(){

$('.search_bar').val('')
  $('.search_bar').keyup(function(){
    $('.suggetions').html('<div class="spinner sug-spner spinner-border spinner-border-sm"></div>'); 
    $('.suggetions').removeClass('d-none')
    const search_val=$(this).val();
console.log(search_val)
    axios.get('/find-gigs-end?search='+search_val)
    .then(function (res) {
      if(res.status == 200){
        $('li').remove('.search_val')
        $('div').remove('.sug-spner')
        
        console.log(res);
        const data=res.data
        if(data.length >= 1){
          $.each(data,function (i){
            $("<li class='search_val rounded circle'>").html(data[i].title).appendTo('.suggetions');                  
          })
          $('.search_val').click(function(){
            const inner_search_val=$(this).html(); 
            $('.search_bar').val(inner_search_val)
          })

        }else{
          $("<li class='search_val rounded circle'>").html("data not found").appendTo('.suggetions');    
        }
      }else{
        $('div').remove('.sug-spner')
        $("<li class='search_val  rounded circle'>").html("something wrong!").appendTo('.suggetions');
      }   


    })
    .catch(function (error) {
      $('div').remove('.sug-spner')
      $("<li class='search_val  rounded circle'>").html("something wrong!").appendTo('.suggetions');    
    }) 
  });
}
  
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- end search bar -->



<section id="hero" class="hero">
    <div class="container position-relative">
     
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Welcome to <span>Easy Bangladesh<i class="fa fa-search"></i></span></h2>
          <p>Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
        
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="{{ asset('frontend/assets/img/hero-img.svg')}}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>
  </div>
</section>