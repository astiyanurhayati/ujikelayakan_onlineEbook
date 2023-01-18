@extends('components.main')
@section('main')
<main class="main" id="top">


  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-primary py-2 d-none d-sm-block">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-auto ms-md-auto order-md-2 d-none d-sm-block">
          <ul class="list-unstyled list-inline my-2">
            <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i
                  class="fab fa-facebook-f text-900"></i></a></li>
            <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i
                  class="fab fa-pinterest text-900"></i></a></li>
            <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i
                  class="fab fa-twitter text-900"></i></a></li>
            <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-instagram text-900">
                </i></a></li>
          </ul>
        </div>
        <div class="col-auto">
          <p class="my-2 fs--1"><i class="fas fa-envelope me-3"></i><a class="text-900"
              href="">astiyanurhayati18@gmail.com </a></p>
        </div>
      </div>
    </div>
    <!-- end of .container-->

  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->


  <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3 d-block"
    data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="index.html" style="font-weight: bold">We<span style="color: yellow">b</span>ook</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"> </span></button>
      <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
          <li class="nav-item px-2"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
          <li class="nav-item px-2"><a class="nav-link" aria-current="page" href="pricing.html">About</a></li>
        </ul>
        @if(Auth::check())
        <a class="btn btn-primary order-1 order-lg-0" href="{{url('/dashboard')}}">Dashboard</a>

        @else
        <a class="btn btn-primary order-1 order-lg-0" href="{{url('/login')}}">Login</a>
        @endif

        <form class="d-flex my-3 d-block d-lg-none">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
        <div class="dropdown d-none d-lg-block">
          <button class="btn btn-outline-light ms-2" id="dropdownMenuButton1" type="submit" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fas fa-search text-800"></i></button>
          <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton1" style="top:55px">
            <form>
              <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
            </form>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <section class="pt-6 bg-600" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100"
            src="assets/img/gallery/hero-header.png" width="470" alt="hero-header" /></div>
        <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
          <h4 class="fw-bold font-sans-serif">Welcome to webook</h4>
          <h1 class="fs-6 fs-xl-7 mb-5">
            Read books, share reading collections anywhere and anytime</h1><a class="btn btn-primary me-2" href="#!"
            role="button">Learn More</a><a class="btn btn-outline-secondary" href="#!" role="button">Read more</a>
        </div>
      </div>
    </div>
  </section>


 



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section>

    <!-- Modal -->
  
    <div class="container">
      <div class="row">
        <h1 class="text-center mb-5"> Top 3 Recomended Books</h1>
        @foreach ($top3 as $item )
        <div class="modal fade" id="{{str_replace(' ', '', $item->title)}}" tabindex="-1" aria-labelledby="{{str_replace(' ', '', $item->title)}}Label" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="{{str_replace(' ', '', $item->title)}}Label">{{$item->title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{$item->synopsis}}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100" data-bs-toggle="modal" data-bs-target="#{{str_replace(' ', '', $item->title)}}"><img class="card-img-top w-100"
            src="{{asset('img/'.$item->coverbook)}}" alt="courses" />
            <div class="card-body">
              <h5 class="font-sans-serif fw-bold fs-md-0 fs-lg-1">{{$item->title}}</h5><a
              class="text-muted fs--1 stretched-link text-decoration-none" href="#!">{{$item->writer}}</a>
            </div>
          </div>
        </div>
        @endforeach
     

      </div>
    </div>
    <!-- end of .container-->

  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->




  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="pt-0">

    <div class="container">
      <div class="row h-100 align-items-center">
        <div class="col-md-12 col-lg-6 h-100">
          <div class="card card-span text-white h-100"><img class="w-100" src="assets/img/gallery/student-feedback.png"
              alt="..." />
            <div class="card-body px-xl-5 px-md-3 pt-0">
              <div class="d-flex flex-column align-items-center bg-200" style="margin-top:-2.4rem;">
                <h5 class="mt-3 mb-0">Kimmie Vo</h5>
                <p class="text-muted">Junior Designer</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-6 h-100">
          <h1 class="my-4">About<br /><span class="text-primary">Webook</span></h1>
          <p>Take courses from the world’s best instructors and universities. Courses include recorded auto-graded and
            peer-reviewed assignments, video lectures, and community discussion forums. When you complete a course,
            you’ll be eligible to receive a shareable electronic Course Certificate for a small fee.</p>
          <div class="mt-6">
            <h5 class="font-sans-serif fw-bold mb-3">The courses that Kimmie has taken</h5>
            <div class="card card-span bg-600">
              <div class="card-body">
                <div class="row flex-center gx-0">
                  <div class="col-lg-4 col-xl-3 text-center text-xl-start"><img src="assets/img/gallery/art-design.png"
                      width="120" alt="courses" /></div>
                  <div class="col-lg-8 col-xl-9">
                    <h5 class="font-sans-serif fw-bold">Modern and Contemporary Art and Design</h5>
                    <p class="text-muted fs--1">The Museum of Modern Art</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end of .container-->

  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->



  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 col-lg-4 mb-5"><img src="assets/img/gallery/cta.png" width="280" alt="cta" /></div>
        <div class="col-md-6 col-lg-5">
          <h5 class="text-primary font-sans-serif fw-bold">Subscrible now</h5>
          <h1 class="mb-5">Get every single<br />update you will get</h1>
          <form class="row g-0 align-items-center">
            <div class="col">
              <div class="input-group-icon">
                <input class="form-control form-little-squirrel-control" type="email" placeholder="Enter email "
                  aria-label="email" /><i class="fas fa-envelope input-box-icon"></i>
              </div>
            </div>
            <div class="col-auto">
              <button class="btn btn-primary rounded-0" type="submit">Subscribe now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end of .container-->

  </section>
  <!-- <section> close ============================-->
  <!-- ============================================-->




  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="bg-secondary">

    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-6 mb-4 order-0 order-sm-0"><a class="text-decoration-none" href="#">
          <h1 class="my-4">About<br /><span class="text-primary">Webook</span></h1>

        
          <p class="text-light"> <i class="fas fa-envelope me-3"> </i><a class="text-light"
              href="mailto:vctung@outlook.com">asitya@gmail.com </a></p>
          <p class="text-light"> <i class="fas fa-phone-alt me-3"></i><a class="text-light"
              href="tel:1-800-800-2299">1-800-800-2299 (Support)</a></p>
        </div>
        <div class="col-6 col-sm-4 col-lg-2 mb-3 order-2 order-sm-1">
          <h5 class="lh-lg fw-bold mb-4 text-light font-sans-serif">Community </h5>
          <ul class="list-unstyled mb-md-4 mb-lg-0">
            <li class="lh-lg"><a class="text-200" href="#!">Home</a></li>
            <li class="lh-lg"><a class="text-200" href="#!">About</a></li>
      

          </ul>
        </div>


      </div>
      <!-- end of .container-->

  </section>
  </section>
</main>

@endsection