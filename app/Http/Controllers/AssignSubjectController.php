<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Models\classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.form', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|array',
            'subject_id.*' => 'integer'
        ]);

        $class_id = $request->class_id;
        $subject_ids = $request->subject_id;

        foreach ($subject_ids as $sub_id) {
            AssignSubject::updateOrCreate(
                [
                    'class_id' => $class_id,
                    'subject_id' => $sub_id
                ],
                [
                    'class_id' => $class_id,
                    'subject_id' => $sub_id
                ]
            );
        }
        return redirect()->route('assign-subject.read')->with('success', 'Subjects assigned added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function read(Request $request)
    {
        $query = AssignSubject::with(['class','subject']);
        if($request->filled('class_id')){
            $query->where('class_id', $request->get('class_id'));
        }
        $data['assign_subjects'] = $query->get();
        $data['classes'] = classes::all();
        return view ('admin.assign_subject.table', $data);
    }

    
    public function edit($id)
    {
        $data['assign_subject'] = AssignSubject::find($id);
        $data['classes'] = classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign_subject.edit_form',$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $res = AssignSubject::find($id);
        $res->delete();
        return redirect()->back()->with('success', 'Subjects deleted successfully!');
    }

    public function update(Request $request, $id){
        $data = AssignSubject::find($id);
        $data->class_id = $request->class_id;
        $data->subject_id = $request->subject_id;
        $data->update();
        return redirect()->back()->with('success', 'Subjects updated successfully!');
        
    }
}
