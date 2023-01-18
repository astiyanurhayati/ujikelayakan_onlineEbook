@extends('components.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Create New Book</h3>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if(Session::get('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <form class="forms-sample" action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Title">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mt-3">
                            <label>Writer</label>
                            <input type="text" value="{{old('writer')}}" class="form-control @error('writer') is-invalid @enderror" name="writer"
                                placeholder="writer">
                            @error('writer')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 d-flex  bd-highlight " style="gap: 10px">
                            <div class=" flex-fill bd-highlight">
                                <label>Publisher</label>
                                <input type="text" value="{{old('publisher')}}" class="form-control @error('publisher') is-invalid @enderror"
                                    name="publisher" placeholder="publisher">
                                @error('publisher')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" flex-fill bd-highlight">
                                <label>No ISBN</label>
                                <input type="number" value="{{old('isbn')}}" class="form-control @error('isbn') is-invalid @enderror"
                                    name="isbn" placeholder="No ISBM ">
                                @error('isbn')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3 d-flex  bd-highlight " style="gap: 10px">
                            <div class="flex-fill bd-highlight">
                                <label>Category Name</label>
                                <select class="form-control @error('cateory_id') is-invalid @enderror"
                                    name="category_id">
                                    <option disabled selected>--select--</option>
                                    @foreach ($categories as $category )

                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" flex-fill bd-highlight">
                                <label>Synopsis</label>
                                <input type="text" value="{{old('synopsis')}}" class="form-control @error('synopsis') is-invalid @enderror"
                                    name="synopsis" placeholder="Synopsis ">
                                @error('synopsis')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 max-w-50">
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input class="form-control  @error('coverbook') is-invalid @enderror" name="coverbook" type="file" id="coverbook"  onchange="previewImage()">
                            @error('coverbook')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <img src=""  class="img-preview img-fluid mt-2" style="max-width: 200px" alt="">
                          </div>

                          <div class="mb-3 max-w-50">
                            <label for="formFile" class="form-label">File PDF</label>
                            <input class="form-control  @error('pdf') is-invalid @enderror" name="pdf" type="file" id="coverbook">
                            @error('pdf')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>      
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                

                </form>

            </div>
        </div>
    </div>

    <script>
          function previewImage(){
            const image = document.getElementById('coverbook');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }

        }
    </script>


    @endsection