<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(){
        return redirect('register');
    }

    public function index()
    {
        return view('home');
    }

    public function profilePage(){
        $userDet = \App\User::where('id',auth()->user()->id)->select('id','name','email','phone','photo')->first();
        //dd($userDet);
        return view('profile', compact('userDet'));
    }

    public function updateProfile(Request $request){
        $id = auth()->user()->id;

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|min:10|numeric|unique:users,phone,'.$id,
            'photo' => 'image|mimes:jpeg,jpg,png,JPG,PNG,JPEG|nullable'
        ]);

        if($request->file('photo') != ""){
          $data = \App\User::where('id','=',$id)->first();
            if(file_exists("public/images/" . $data->photo)){
                if ($data->photo != '') 
                {
                  $unlink_path = "public/images/" . $data->photo;
                  unlink($unlink_path);
                }
            }
            //Unlink code end here
            $ser_image = bcrypt($data['name'].date('dmy').time());
            $res = preg_replace("/[^a-zA-Z0-9\-]/", "", $ser_image).'.'.$request->file('photo')->getClientOriginalExtension();
            //50*50 Photo Uploading
            $post_img = Image::make($request->file('photo')->getRealPath())->resize(50, 50);
            $post_img->save(public_path() . '/images/' . $res);
        }else{
            $res = $request->old_photo;
        }
        $update_data = $request->all();
        $update_data['photo'] = $res;
        //dd($update_data);
        \App\User::find($id)->update($update_data);
        $request->session()->flash('success', 'Profile data updated successfully.');
        return back();
    }

    public function changePassword(){
        return view('change-password');
    }

    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user = \App\User::find(auth()->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill(['password' => Hash::make($request->new_password)])->save();
            $request->session()->flash('success', 'Password changed successfully.');
            return back();
        } else {
            $request->session()->flash('error', 'Please enter your correct old password.');
            return back();
        }
    }

    public function assign(Request $request){
        $value = \App\Course::orderBy('id','DESC')->get();
        return response()->json(['response' => "success", 'data' => $value]);
    }

}
