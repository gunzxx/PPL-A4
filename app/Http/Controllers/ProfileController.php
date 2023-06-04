<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index',[
            'css'=>['profile/index', 'profile/form'],
        ]);
    }
    
    public function edit(){
        return view('profile.edit',[
            'css'=>['profile/index','profile/form', 'profile/edit'],
        ]);
    }
    
    public function update(Request $request){
        $validate = $request->validate([
            'fullname' => 'required',
            'id_number' => 'required',
            'address' => 'required',
            'number_phone' => 'required',
        ]);

        $validate['number_phone'] = "+62".$validate['number_phone'];

        if(!$user = User::find(auth()->user()->id)){
            return abort(404);
        }

        $user->update($validate);

        if($request->file("profile_image")){
            $user->addMediaFromRequest('profile_image')->toMediaCollection("profile");
        }
        
        return redirect("/profile")->with("success2","Data berhasil diperbarui.");
    }

    public function password()
    {
        return view('profile.password', [
            'css' => ['profile/index', 'profile/form', 'profile/edit'],
        ]);
    }

    public function change(Request $request)
    {
        $request->validate([
            'old_password'=>"required|min:3",
            'new_password'=> "required|required_with:password_confirmation|same:password_confirmation|min:3",
            'password_confirmation'=>"required|min:3",
        ]);

        $user = User::find(auth()->user()->id);
        $hasher = app('hash');
        if ($hasher->check($request->old_password, $user->password)) {
            $user->update([
                'password'=>bcrypt($request->new_password),
            ]);
            return redirect('/profile')->with("success2","Password berhasil diperbarui.");
        }
        return back()->with("error2","Password salah!")->withInput();
    }
}
