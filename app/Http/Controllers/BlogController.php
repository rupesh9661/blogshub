<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::all();
        return view('Blog.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image')){
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $img_final_name =  $img_name.date("YmdHis");
            $path = 'images/blog_images';
            $image->move($path, $img_final_name);
        }
       $result= Blog::insert([
           'title'=>$request->title,
           'description'=>$request->description,
           'image'=>$img_final_name
        ]);
       
        if($result){

            return redirect('Blog')->with('message' ,'Blog Added Successfully');
        }
        else{
            return redirect('Blog/create')->with('message', 'Blog Not Added');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Blog::find($id);
        return view('Blog.edit' ,compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->file('image')){
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $img_final_name =  $img_name.date("YmdHis");
            $path = 'images/blog_images';
            $image->move($path, $img_final_name);
       
       $result= Blog::where('id' ,$id)->update([
           'title'=>$request->title,
           'description'=>$request->description,
           'image'=>$img_final_name
        ]);
    }else{
        $result= Blog::where('id' ,$id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
           
         ]);
    }
       
        if($result){

            return redirect('Blog')->with('message' ,'Blog Updated Successfully');
        }
        else{
            return redirect('Blog/edit')->with('message', 'Blog Not Updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result= Blog::where('id' ,$id)->delete();
         if($result){
 
             return redirect('Blog')->with('message' ,'Blog Deleted Successfully');
         }
         else{
             return redirect('Blog')->with('message', 'Blog Not deleted');
 
         }
    }
}
