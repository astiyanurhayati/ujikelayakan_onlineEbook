@extends('components.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
      
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Data all User</h3>
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

                <a href="{{url('dashboard/users/userexport')}}"><button class="btn btn-warning">Downlod Excel</button></a>
                <a href="{{url('dashboard/users/cetakpdf')}}"><button class="btn btn-success">Downlod PDF</button></a>

                <form action="">
                    <div class="input-group mb-3 w-50 float-right">
                        <input type="text" name="keyword" class="form-control" placeholder="Search">
                        <button type="submit" class="btn btn-secondary">search</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>


                                <td>
                                    <form action="{{route('user.delete', $user->id)}}" method="POST">
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
        @endsection