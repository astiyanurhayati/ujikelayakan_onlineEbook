@extends('components.master')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Category Books</h3>
                    </div>
                    
                </div>
            </div>
        </div>

         
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                
                    <h4 class="card-title">Create Category</h4>

                    <form class="forms-sample" action="{{route('categories.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex mb-3" style="flex-direction: row-reverse;">
            <div></div>
            <form action="" class="w-50" method="GET">
                <div class="input-group">
                    <input name="keyword" type="text" class="form-control" placeholder="category name">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
            
    
        </div>
        <div class="card mb-3">
            <div class="card-body">
                @if(Session::get('successdelete'))
                <div class="alert alert-success">
                    {{session('successdelete')}}
                </div>
                @endif
                <h4 class="card-title">Data All Category</h4>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    action
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($categories as $category )
                                
                            <tr>
                             <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <form action="{{route('categories.destroy', $category->id)}}" method="POST">
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
            </div>
        </div>
        {!! $categories->links('pagination::bootstrap-4') !!}
    </div>


</div>

@endsection