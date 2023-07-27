<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Models\Admin\InfoOther;

class ProfileController extends Controller
{

    /**________________________________________________________________________
     * Member Profile
     * ________________________________________________________________________
     */
    function profile_show($id){
        $user = User::findOrFail($id);
        $infoPersonal = $user->infoPersonal;
        $infoFamily = $user->infoFamily;
        $infoAcademic = $user->infoAcademic;
        $infoOther = $user->infoOther;

        return view('profile.show', compact('user','infoPersonal','infoFamily','infoAcademic','infoOther'));
    }
    public function infoOtherUpdate(Request $request, InfoOther $id)
    {
        $id->update([
            // 'designation'=> $request->designation,
            // 'company_name'=> $request->company_name,
            'about_me'=> $request->about_me,
            // 'nick_name'=> $request->nick_name,
            // 'phone_number'=> $request->phone_number,
            // 'cover_photo'=> $request->cover_photo,
            // 'favorite'=> $request->favorite,

            'facebook_url'=> $request->facebook_url,
            'youtube_url'=> $request->youtube_url,
            'instagram_url'=> $request->instagram_url,
            'twitter_url'=> $request->twitter_url,
            'linkedin_url'=> $request->linkedin_url,
        ]);

        $notification = array('info_update' => 'User update successfully!', 'alert-type' => 'update');
        return redirect()->back()->with($notification);
    }

    public function profileUpdate(Request $request, $id)
    {
        //----------User Update
        $user = User::findorfail($id);

        if ($request->hasFile("profile_photo_path")) {
            if (File::exists("public/images/profile/".$user->profile_photo_path)) {
                File::delete("public/images/profile/".$user->profile_photo_path);
            }
            //get filename with extension
            $filenamewithextension = $request->file('profile_photo_path')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('profile_photo_path')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File
            $request->file('profile_photo_path')->move('public/images/profile/', $filenametostore); //--Upload Location
            // $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);
            //Resize image here
            $thumbnailpath = public_path('images/profile/'.$filenametostore); //--Get File Location
            // $thumbnailpath = public_path('storage/images/profile/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(1200, 850, function($constraint) {
                $constraint->aspectRatio();
            }); 
            $img->save($thumbnailpath);

            //---Data Save
            $user->profile_photo_path = $filenametostore;
        }

        if ($request->has('password') && $request->filled('password')) {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                $notification = array('messege' => 'The validator failed.', 'alert-type' => 'fail');
                return back()->with($notification)->withErrors($validator)->withInput();
            }

            if (Hash::check($request->current_password, $user->password)) {
                $user->name = $request->name;
                $user->contact_number = $request->contact_number;
                $user->password = Hash::make($request->password);
                $user->save();

                $notification = array('messege' => 'User update successfully!', 'alert-type' => 'update');
                return redirect()->back()->with($notification);
            } else {
                $notification = array('messege' => 'The current password is incorrect.', 'alert-type' => 'fail');
                $current_password = array('current_password' => 'The current password is incorrect.');
                return back()->with($notification)->withErrors($current_password)->withInput();
            }
        } else {
            $user->name = $request->name;
            $user->contact_number = $request->contact_number;
            $user->save();

            $notification = array('messege' => 'User update successfully!', 'alert-type' => 'update');
            return redirect()->back()->with($notification);
        }
    }




    /**________________________________________________________________________
     * Member Edit
     * ________________________________________________________________________
     */
    function member_edit($id){
        $user = User::findOrFail($id);
        $infoPersonal = $user->infoPersonal;
        $infoFamily = $user->infoFamily;
        $infoAcademic = $user->infoAcademic;
        $infoOther = $user->infoOther;

        return view('profile.edit', compact('user','infoPersonal','infoFamily','infoAcademic','infoOther'));
    }
















    public function profile($id)
    {
        $user = User::findOrFail($id);
        $infoPersonal = $user->infoPersonal;
        $infoFamily = $user->infoFamily;
        $infoAcademic = $user->infoAcademic;
        $infoOther = $user->infoOther;

        return view('profile.show', compact('user','infoPersonal','infoFamily','infoAcademic','infoOther'));
    }
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'batch' => $request->batch,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
        ]);

        // if($request->has('password')){
        //     $user->update(['password' => bcrypt('password')]);
        // }

        $notification=array('messege'=>'User data updated!','alert-type'=>'success');
        return back()->with($notification);
    }
    /*________________________________________ */
    
    
}
