@extends('layouts.app')

@section('content')
    <div class="container ">

        <div class="row justify-content-center ">
        
            <div class="col-md-12 shadow p-3 mb-5 bg-body rounded">
                <p class="fs-2">All Blogs</p>
                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session()->get('message')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <table class="table table-bordered table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>S.no</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @if(!empty($data))
                   @foreach($data as $key=>$value)
                   <tr>
                   <td>{{$key+1}}</td>
                   <td>{{$value->title}}</td>
                   <td>{{$value->description}}</td>
                   <td><img src='{{asset("images/blog_images/$value->image")}}' alt="image" width="100px" height="100px"></td>
                   <td><a href="{{route('Blog.edit' , $value->id)}}" class="btn btn-primary">Edit</a></td>
                   <td>
                    <form action="{{route('Blog.destroy' , $value->id)}}" method="POST"> 
                        @csrf
                        @method('delete')
                    <button class="btn btn-danger" type="submit">Delete</button> 
                   </form>
                </td>
                </tr>
                   @endforeach
                   @endif
                </tbody>
            </table>
            </div>
        </div>


    </div>
@endsection                