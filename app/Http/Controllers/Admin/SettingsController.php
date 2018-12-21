<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function index(){

        return view('admin.settings');
    }

    public function updateProfile(Request $request){

        $this->validate($request, [
           'name'   => 'required',
            'email' => 'required|email',
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();

            if(!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            $fullName = $image->getClientOriginalName();

            //Suppression du fichier
            if(Storage::disk('public')->exists('profile/'.$user->image)){
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            $name = pathinfo($fullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$extension;
            $nameStore = $slug.'_'.time().'.'.$extension;
            $path = $image->storeAs('public/profile', $image_name);

        }else{
            $image_name = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $image_name;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Le profile a bien été modifier', 'Success');
        return redirect()->back();

    }

    public function updatePassword(Request $request){

        $this->validate($request, [
            'old_password'    => 'required',
            'password'        => 'required|confirmed'
        ]);

        $ashPassword = Auth::user()->password;

        if(Hash::check($request->old_password, $ashPassword)){

           if(!Hash::check($request->password, $ashPassword)){

               $user = User::find(Auth::id());
               $user->password = Hash::make($request->password);
               $user->save();
               Toastr::success('Mot de passe a été modifié', 'Success');
               Auth::logout();
               return redirect()->back();
           }else{
               Toastr::error('Votre mot de passe nest pas valide', 'Error');
               return redirect()->back();
           }

        }else{
            Toastr::error('mot de passe courant nest pas valide', 'Error');
            return redirect()->back();
        }

    }
}
