@extends('components.user')
@section('content')

<div class="container pt-5">
    <div class="card mt-5 mb-5">
        <div class="d-flex gap-5">
            <img src="{{asset('img/'. $detailbook->coverbook)}}" style="width: 300px" alt="">
            <div class="mt-5">
                <ul>
                    <li> <b>Title: </b> {{ $detailbook->title}}</li>
                    <li> <b>Writer: </b> {{ $detailbook->title}}</li>
                    <li> <b>Publisher: </b> {{ $detailbook->title}}</li>
                    <li> <b>ISBN: </b> {{ $detailbook->title}}</li>
                    <li> <b>Synopsis: </b> <br>
                        <p> {{ $detailbook->synopsis}}</p>
                    </li>
                </ul>

                {{-- @if($difference)
                @endif --}}
                <a href="{{route('plus', $detailbook->id)}}"> <button class="btn btn-warning">Download PDF</button></a>
              

                </form>
            </div>
        </div>

    </div>

    <script>
        function astiya(){
            console.log('ini bisa')
        }
    </script>

</div>
@endsection