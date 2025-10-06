<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.student.student', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'student_id' => 'required',
            'academic_year_id' => 'required|exists:academic_years,id',
            'class_id' => 'required|exists:classes,id',
            'admission_date' => 'required|date',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'mother_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mobile' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
        ]);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->academic_year_id = $request->academic_year_id;
            $user->class_id = $request->class_id;
            $user->mother_name = $request->mother_name; 
            $user->student_id = $request->student_id;
            $user->birth_date = $request->birth_date;
            $user->father_name = $request->father_name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->admission_date = $request->admission_date;
            $user->gender = $request->gender;
            $user->password = Hash::make($request->password);
            $user->role = 'student';
            $user->save();

            DB::commit();
            return redirect()->route('student.create')->with('success', 'Student added successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to add student: ' . $e->getMessage())->withInput();
        }
    }

    public function read(Request $request)
    {
        $query = User::with(['academicYear', 'studentClass'])
            ->where('role', 'student')
            ->latest('id');

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->get();

        $data['students'] = $students;
        $data['academic_year'] = AcademicYear::all(); // For filter dropdown
        $data['classes'] = Classes::all(); // For filter dropdown

        return view('admin.student.student_list', $data);
    }

    public function edit($id)
    {
        $student = User::where('id', $id)->where('role', 'student')->firstOrFail();

        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['student'] = $student;

        return view('admin.student.edit_student', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',
            'class_id' => 'required|exists:classes,id',
            'admission_date' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $id,
            'mother_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'mobile' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
        ]);

        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->where('role', 'student')->firstOrFail();

            $user->name = $request->name;
            $user->academic_year_id = $request->academic_year_id;
            $user->class_id = $request->class_id;
            $user->mother_name = $request->mother_name;
            $user->birth_date = $request->birth_date;
            $user->father_name = $request->father_name;
            $user->student_id = $request->father_name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->admission_date = $request->admission_date;
            $user->gender = $request->gender;
            $user->update();

            DB::commit();
            return redirect()->route('student.read')->with('success', 'Student updated successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update student: ' . $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $student = User::where('id', $id)->where('role', 'student')->firstOrFail();
            $student->delete();

            DB::commit();
            return redirect()->route('student.read')->with('success', 'Student deleted successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('student.read')->with('error', 'Failed to delete student: ' . $e->getMessage());
        }
    }
}