@extends('layouts.app')

@section('content')
    <div class="container ">

        <div class="row justify-content-center ">

            <div class="col-md-8 shadow p-3 mb-5 bg-body rounded">
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('Blog.update' , $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <p class="fs-4">Update Blog</p>
                    </div>
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" value="{{$data->title}}" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="title">Description</label>
                        <textarea name="description" class="form-control" required>{{$data->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" class="form-control" >
                        
                        <p>Previous Uploaded Image : <img src='{{asset("images/blog_images/$data->image")}}' alt="" width="200px" ></p>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
