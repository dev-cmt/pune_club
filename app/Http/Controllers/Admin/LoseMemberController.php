<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\LoseMember;
use Illuminate\Support\Facades\File;

class LoseMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =LoseMember::all();
        return view('layouts.pages.lose_member.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.lose_member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request -> validate([
            'name'=> 'required',
            'image'=> 'required',
        ]);

        if($request->hasFile("image")){
            $file=$request->file("image");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("lose_member/"),$imageName);

            $post =new LoseMember([
                "name" =>$request->name,
                "batch"=>$request->batch,
                "image" =>$imageName,
                "date"=>$request->date,
                "location"=>$request->location,
                "description"=>$request->description,
            ]);
           $post->save();
        }
        return redirect()->route('lose_member.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data=LoseMember::findOrFail($id);
        return view('layouts.pages.lose_member.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=LoseMember::findOrFail($id);

        if($request->hasFile("image")){
            if (File::exists("public/lose_member/".$data->image)) {
                File::delete("public/lose_member/".$data->image);
            }
            $file=$request->file("image");
            $data->image=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("/lose_member"),$data->image);
            $request['image']=$data->image;
        }

        $data->update([
            "name" =>$request->name,
            "batch"=>$request->batch,
            "date"=>$request->date,
            "location"=>$request->location,
            "description"=>$request->description,
        ]);

        $notification=array('messege'=>'Category save successfully!','alert-type'=>'success');
        return redirect()->route('lose_member.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data=LoseMember::findOrFail($id);

         if (File::exists("public/lose_member/".$data->image)) {
             File::delete("public/lose_member/".$data->image);
         }
         $data->delete();
         return back();
    }

}
