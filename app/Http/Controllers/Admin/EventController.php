<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Admin\Event;
use App\Models\Admin\EventRegister;
use App\Models\Admin\EventPayment;
use App\Models\User;
use Auth;

class EventController extends Controller
{
    public function index()
    {
        $data =Event::all();
        return view('layouts.pages.event.index',compact('data'));
    }

    public function create()
    {
        return view('layouts.pages.event.create');
    }

    public function store(Request $request)
    {
        $validated=$request -> validate([
            'title'=> 'required',
            'image'=> 'required',
        ]);

        if($request->hasFile("image")){
            $file=$request->file("image");
            $imageName=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("event/"),$imageName);

            $post =new Event([
                "title" =>$request->title,
                "caption"=>$request->caption,
                "event_date"=>$request->event_date,
                "self"=>$request->self,
                "spouse"=>$request->spouse,
                "child_above"=>$request->child_above,
                "child_bellow"=>$request->child_bellow,
                "guest"=>$request->guest,
                "driver"=>$request->driver,
                "description"=>$request->description,
                "location"=>$request->location,
                "status"=>$request->status,
                "image" =>$imageName,
            ]);
           $post->save();
        }
        return redirect()->route('event.index');

    }
    
    public function show(Gallery $post)
    {
        //
    }

    public function edit($id)
    {
        $data=Event::findOrFail($id);
        return view('layouts.pages.event.edit')->with('data',$data);
    }

    public function update(Request $request, $id)
    {
        $data=Event::findOrFail($id);

        if($request->hasFile("image")){
            if (File::exists("public/event/".$data->image)) {
                File::delete("public/event/".$data->image);
            }
            $file=$request->file("image");
            $data->image=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("/event"),$data->image);
            $request['image']=$data->image;
        }

        $data->update([
            "title" =>$request->title,
            "caption"=>$request->caption,
            "event_date"=>$request->event_date,
            "self"=>$request->self,
            "spouse"=>$request->spouse,
            "child_above"=>$request->child_above,
            "child_bellow"=>$request->child_bellow,
            "guest"=>$request->guest,
            "driver"=>$request->driver,
            "description"=>$request->description,
            "location"=>$request->location,
            "status"=>$request->status,
            "image" =>$data->image,
        ]);

        $notification=array('messege'=>'Category save successfully!','alert-type'=>'success');
        return redirect()->route('event.index')->with($notification);

    }

    public function destroy($id)
    {
         $data=Event::findOrFail($id);

         if (File::exists("public/event/".$data->image)) {
             File::delete("public/event/".$data->image);
         }
         $data->delete();
         return back();
    }
    /*______________________________________________________________________*/
    /*____________________________REGISTER__________________________________*/
    public function register_create($id)
    {
        $data =Event::findOrFail($id);

        $bkash=EventPayment::with('user','event')->where('event_id','=', $id)->where('payment_type','=', '1')->get();
        $nagad=EventPayment::with('user','event')->where('event_id','=', $id)->where('payment_type','=', '2')->get();
        $rocket=EventPayment::with('user','event')->where('event_id','=', $id)->where('payment_type','=', '3')->get();

        return view('frontend.pages.events_register',compact('data','bkash','nagad','rocket'));
    }
    public function event_register(Request $request, $id)
    {
        $validated=$request -> validate([
            'payment_type' => ['required', 'in:0,1,2,3'],
            'payment_number'=> 'required',
            'transaction_no'=> 'required',
        ]);

        $contact= new EventRegister();
        $contact->person_no=$request->person_no;
        $contact->total_amount=$request->total_amount;
        $contact->payment_number=$request->payment_number;
        $contact->transaction_no=$request->transaction_no;
        $contact->payment_type=$request->payment_type;
        $contact->status='0';
        $contact->event_id=$id;
        $contact->user_id=Auth::user()->id;
        $contact->save();

        return redirect()->route('event_registation_list');
    }
    public function event_registation_list()
    {
        $user = User::findOrFail(Auth::user()->id);
        $data = $user->eventRegister;

        // $data = EventRegister::get();   
        return view('layouts.pages.event_registation_list',compact('data'));
    }
    public function event_approve_list()
    {
        $data = EventRegister::get(); 
        return view('layouts.pages.event.approve_list',compact('data'));
    }
    
    public function approve_event_fee($id)
    {
        $events = EventRegister::findorfail($id);
        $events->receive_by = Auth::user()->id;
        $events->status = 1;
        $events->save();

        return back();
    }
    public function cancel_event_fee($id)
    {
        $events = EventRegister::findorfail($id);
        $events->receive_by = Auth::user()->id;
        $events->status = 2;
        $events->save();

        return back();
    }
    /*______________________________________________________________________*/
    /*_____________________________ VIEW ___________________________________*/
    public function fv_event()
    {
        $events =Event::all();
        return view('frontend.pages.events',compact('events'));
    }
    public function fv_event_show($id)
    {
        $events =Event::latest()->orderByDesc('id')->take(10)->orderBy('id')->get();
        $data =Event::findOrFail($id);
        return view('frontend.pages.events_details',compact('events','data'));
    }
}
