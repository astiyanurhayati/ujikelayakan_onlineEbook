@extends('components.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Data All Book</h3>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(Session::get('successdelete'))
                <div class="alert alert-success">
                    {{session('successdelete')}}
                </div>
                @endif
                @if(Session::get('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif  
                
                <a href="{{url('dashboard/books/bookexport')}}"><button class="btn btn-warning">Downlod Excel</button></a>
                <a href="{{url('dashboard/books/cetakpdf')}}"><button class="btn btn-success">Downlod PDF</button></a>
               <form action="">
                <div class="input-group mb-3 w-50 float-right">
                    <input type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-secondary">search</button>
                </div>
               </form>
                  
                <div class="table-responsive mb-5">
                   <a href="{{url('dashboard/books/create')}}"> <button class="btn btn-primary mb-2">+ Book</button></a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Download</th>
                                <th>Title</th>
                                <th>Writer</th>
                                <th>Publisher</th>
                                <th>ISBN</th>
                                <th >Synopsis</th>
                                <th >Book</th>
                                <th>Cover Book</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
           
  
                            @foreach ($books as $book )
                            <div class="modal fade" id="{{str_replace(' ', '' , $book->title) . $book->id}}" tabindex="-1" role="dialog" aria-labelledby="{{str_replace(' ', '' , $book->title) . $book->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="{{str_replace(' ', '' , $book->title) . $book->id}}Label">Modal title</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Synopsis</h2>
                                    <p>{{$book->synopsis}}</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$book->category->name}}</td>
                                <td>{{$book->download}}</td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->writer}}</td>
                                <td>{{$book->publisher}}</td>
                                <td>{{$book->isbn}}</td>
                                <td><button data-toggle="modal" class="btn btn-secondary" data-target="#{{str_replace(' ', '' , $book->title) . $book->id}}">Detail</button></td>
                                <td><a href="{{asset('pdf/'. $book->pdf)}}" download>Download</a></td>
                                <td><img src="{{asset('img/'. $book->coverbook)}}" alt=""></td>


                                <td class="d-flex gap-2">
                                    <a href="{{route('book.edit', $book->id)}}"><button class="btn btn-primary">Edit</button></a>
                                    <form action="{{route('book.delete', $book->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{$books->links('pagination::bootstrap-4')}}
            </div>
        </div>
        @endsection