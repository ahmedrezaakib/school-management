<?php

namespace App\Http\Controllers;
use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\feeHead;
use App\Models\FeeStructure;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Schema\Elements\Structure;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee-structure', $data);
    }

    // public function index(Request $request)
    // {
    //     $query = FeeStructure::with(['student', 'class', 'academicYear', 'feeHead']);

    //     // Filter by academic year
    //     if ($request->filled('academic_year_id')) {
    //         $query->where('academic_year_id', $request->academic_year_id);
    //     }

    //     // Filter by class
    //     if ($request->filled('class_id')) {
    //         $query->where('class_id', $request->class_id);
    //     }

    //     // Filter by student ID - searches in users table via relationship
    //     if ($request->filled('student_id')) {
    //         $query->whereHas('student', function ($q) use ($request) {
    //             $q->where('student_id', 'LIKE', '%' . $request->student_id . '%');
    //         });
    //     }

    //     $fees = $query->get();
    //     $classes = Classes::all();
    //     $academic_years = AcademicYear::all();
    //     $fee_heads = FeeHead::all();

    //     return view('admin.fee-structure.index', compact('fees', 'classes', 'academic_years', 'fee_heads'));
    // }

    public function store(Request $request)
    {
        //$feeStructure = new FeeStructure();
        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'fee_head_id' => 'required',
        ]);

        FeeStructure::create($request->all());
        return redirect()->route('fee-structure.create')->with('success', 'fee successfully added');
    }

    public function read(Request $request)
    {
        $feeStructure = FeeStructure::query()->with(['FeeHead', 'AcademicYear', 'Classes'])->latest();
        if ($request->filled('class_id')) {
            $feeStructure->where('class_id', $request->get('class_id'));
        }
        if ($request->filled('academic_year_id')) {
            $feeStructure->where('academic_year_id', $request->get('academic_year_id'));
        }
        $data['feeStructure'] = $feeStructure->get();
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.fee-structure.fee-structure_list', $data);
    }

    public function delete($id)
    {
        $data = FeeStructure::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Fee structure deleted successfully');
    }
    public function edit($id)
    {
        $data['fee'] = FeeStructure::find($id);
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        // $students = User::where('role', 'student')->get();
        return view('admin.fee-structure.edit', compact('fee', 'classes', 'academic_years', 'fee_heads', 'students'));
    }

    public function update(Request $request, $id)
    {
        $fee = FeeStructure::find($id);

        $request->validate([
            $fee->class_id = $request->class_id,
            $fee->student_id = $request->student_id,
            $fee->academic_year_id = $request->academic_year_id,
            $fee->fee_head_id = $request->fee_head_id,
            $fee->january = $request->january,
            $fee->february = $request->february,
            $fee->march = $request->march,
            $fee->april = $request->april,
            $fee->may = $request->may,
            $fee->june = $request->june,
            $fee->july = $request->july,
            $fee->august = $request->august,
            $fee->september = $request->september,
            $fee->october = $request->october,
            $fee->november = $request->november,
            $fee->december = $request->december,
        ]);
        $fee->update();
        return redirect()->route('fee-structure.read')->with('success', 'Fee structure update successfully');
    }

    // public function getStudentsByClass($classId)
    // {
    //     $students = User::where('role', 'student')
    //         ->where('class_id', $classId)
    //         ->select('id', 'student_id', 'name')
    //         ->get();

    //     return response()->json($students);
    // }
}
