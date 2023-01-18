@extends('components.user')
@section('content')
<section>
    <div class="container mt-5">
<h4 class="text-center alert alert-warning" style="margin-top:100px">Read Free E-book Here</h4>

</form>
        <div class="row">
            @foreach ($books as $book )
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img  src="{{asset('img/' . $book->coverbook)}}" class="card-img-top " alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="card-body">
                        <h5 class="card-title">{{$book->title}}</h5>
                        <p>Category: {{$book->category->name}}</p>
                        <p>Writer: {{$book->writer}}</p>
                        <a href="{{ route('page.show', $book->id)}}" class="btn" style="background: #FDC800 ">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>
@endsection