<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AccountSettingController extends Controller
{
    public function index(){
        return view('Admin.account_setting.index');
    }
    public function changepassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'min:6',
            'confirmpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
      if(Hash::check($request->oldpassword, auth()->user()->password)){
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->newpassword);
        $user->update();
        return redirect()->back()->with(['success'=>'successfully changed password']);
      }else{
        return redirect()->back()->with(['error'=>'your older is incorrect']);
      }
    }
}
