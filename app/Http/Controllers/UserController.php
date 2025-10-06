<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('student.login');
    }
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role != 'student') {
                Auth::logout();
                return redirect()->route('student.login')->with('error', 'Unautherize user. Access denied');
            }
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('student.login')->with('error', 'something went wrong');
        }
    }

    public function dashboard(){
        $data['announcement'] = Announcement::where('type', 'student')->latest()->limit(1)->get();
        return view('student.dashboard',$data);

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('student.login')->with('success', 'Logout successfully');
    }
}
