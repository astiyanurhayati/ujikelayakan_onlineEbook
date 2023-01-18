@extends('components.user')
@section('content')
<section>
    <div class="container mt-5">

        <h2 class="alert alert-warning" style="margin-top: 100px">Welcome {{Auth::user()->name}}</h2>

        <h3 class="text-center mt-5 mb-5">Top 3 Books</h3>
        <div class="container">
            <div class="row">

                @foreach ($booktop as  $book)
                    
                <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset('img/'.$book->coverbook)}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">Category: {{$book->category->name}}</p>
                                <a href="{{url('page', $book->id)}}" class="btn" style="background: #FDC800 ">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
            </div>
        </div>
    </div>

</section>
@endsection