<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacherToClass;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teacher.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'mother_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mobile' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->mother_name = $request->mother_name;
        $user->birth_date = $request->birth_date;
        $user->father_name = $request->father_name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
        $user->save();
        return redirect()->route('teacher.create')->with('success', 'Teacher added successfully');
    }

    public function read()
    {
        $data['teachers'] = User::where('role', 'teacher')->latest()->get();
        return view('admin.teacher.table', $data);
    }

    public function edit($id)
    {
        $data['teacher'] = User::find($id);
        return view('admin.teacher.edit_form', $data);
    }

    public function update(Request $request, $id)
    {

        $teacher = User::find($id);
        $teacher->name = $request->name;
        $teacher->mother_name = $request->mother_name;
        $teacher->birth_date = $request->birth_date;
        $teacher->father_name = $request->father_name;
        $teacher->mobile = $request->mobile;
        $teacher->email = $request->email;
        $teacher->gender = $request->gender;
        $teacher->update();
        return redirect()->route('teacher.read')->with('success', 'Teacher updated successfully');
    }

    public function delete($id)
    {
        $teacher = User::find($id);
        $teacher->delete();
        return redirect()->route('teacher.read')->with('success', 'Teacher deleted successfully');
    }
    public function login()
    {
        return view('teacher.login');
    }

    public function authenticate(Request $req)
    {
        $req->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );
        if (Auth::guard('teacher')->attempt(['email' => $req->email, 'password' => $req->password])) {
            if (Auth::guard('teacher')->user()->role != 'teacher') {
                Auth::guard('teacher')->logout();
                return redirect()->route('teacher.login')->with('error', 'unautherise user');
            }
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('teacher.login')->with('error', 'something went wrong');
        }
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }
    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success', 'Logout successfully');
    }

    public function myClass(){
        $teacher_id = Auth::guard('teacher')->user()->id;
        $data['assign_class'] = AssignTeacherToClass::where('teacher_id',$teacher_id)->with(['class','subject'])->get();
        return view('teacher.my_class',$data);
    }
}
