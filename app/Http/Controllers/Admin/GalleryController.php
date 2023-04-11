<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Image;
use App\Models\Admin\Gallery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Gallery::all();
        return view('layouts.pages.gallery.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.gallery.create');
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
            'title'=> 'required',
            'date'=> 'required',
        ]);

        if($request->hasFile("cover")){
            $file=$request->file("cover");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("cover/"),$imageName);

            $post =new Gallery([
                "title" =>$request->title,
                "description"=>$request->description,
                "date"=>$request->date,
                "cover" =>$imageName,
                "drive_url"=>$request->drive_url,
                "public"=>$request->public,
                "user_id"=>Auth::user()->id,
            ]);
           $post->save();
        }


        if($request->hasFile("images")){
            $files=$request->file("images");
            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request['gallery_id']=$post->id;
                $request['image']=$imageName;
                $file->move(\public_path("/images"),$imageName);
                Image::create($request->all());
            }
        }

        $notification=array('messege'=>'Gallery save successfully!','alert-type'=>'success');
        return redirect()->route('gallery.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return view('layouts.pages.gallery.show')->with('posts',$gallery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $posts=Gallery::findOrFail($id);
        return view('layouts.pages.gallery.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
     $post=Gallery::findOrFail($id);
     if($request->hasFile("cover")){
         if (File::exists("cover/".$post->cover)) {
             File::delete("cover/".$post->cover);
         }
         $file=$request->file("cover");
         $post->cover=time()."_".$file->getClientOriginalName();
         $file->move(\public_path("/cover"),$post->cover);
         $request['cover']=$post->cover;
     }

    $post->update([
        "title" =>$request->title,
        "description"=>$request->description,
        "date"=>$request->date,
        "cover"=>$post->cover,
        "drive_url"=>$request->drive_url,
        "public"=>$request->public,
        "user_id"=>Auth::user()->id,
    ]);

        if($request->hasFile("images")){
            $files=$request->file("images");
            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request["gallery_id"]=$id;
                $request["image"]=$imageName;
                $file->move(\public_path("images"),$imageName);
                Image::create($request->all());

            }
        }

        $notification=array('messege'=>'Gallery update successfully!','alert-type'=>'success');
        return redirect()->route('gallery.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $posts=Gallery::findOrFail($id);

         if (File::exists("cover/".$posts->cover)) {
             File::delete("cover/".$posts->cover);
         }
         $images=Image::where("gallery_id",$posts->id)->get();
         foreach($images as $image){
         if (File::exists("images/".$image->image)) {
            File::delete("images/".$image->image);
        }
         }
         $posts->delete();
         return back();
    }

    public function deleteimage($id){
        $images=Image::findOrFail($id);
        if (File::exists("images/".$images->image)) {
           File::delete("images/".$images->image);
       }

       Image::find($id)->delete();
       return back();
   }

    public function deletecover($id){
            $cover=Gallery::findOrFail($id)->cover;
            if (File::exists("cover/".$cover)) {
            File::delete("cover/".$cover);
        }
        return back();
    }

    public function fv_gallery_image()
    {
        $posts=Gallery::where('public','=','1')->with('user')->get();
        return view('frontend.pages.gallery_album',compact('posts'));
    }
    public function fv_gallery_show($id)
    {
        $posts=Gallery::findOrFail($id);
        return view('frontend.pages.gallery_image')->with('posts',$posts);
    }
    public function bv_gallery_image()
    {
        $posts=Gallery::all();
        return view('layouts.pages.gallery.bv_gallary_album')->with('posts',$posts);
    }
    public function bv_gallery_show($id)
    {
        $posts=Gallery::findOrFail($id);
        return view('layouts.pages.gallery.bv_gallary_images')->with('posts',$posts);
    }


    function downloadFile($id){
        $images=Image::findOrFail($id);

        $filepath = public_path("images/".$images->image);
        return Response::download($filepath);
    }
    public function dowloads(){
        $files = [
            0 => ('images/icon/01.png'),
            1 => ('images/icon/02.png')
        ];

        $zip = new \ZipArchive;
        $zipFile = 'zip-file.zip';

        if ($zip->open(public_path($zipFile), ZipArchive::CREATE) === TRUE){
            foreach ($files as $file) {
                $pathToFile = public_path($file);
                
                $name = basename($pathToFile);

                $zip->addFile($pathToFile, $name);
            }
            $zip->close();
        }
        return response()->download(public_path($zipFile));
    }
    

}
