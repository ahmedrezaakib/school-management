<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subject.form');
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
            'name'=>'required',
            'type'=>'required',
        ]);
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->save();
        return redirect()->route('subject.read')->with('success', 'Subject added successfully');
    }

    public function read(){
        $data['subjects'] = Subject::latest()->get();
        return view('admin.subject.table',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['subject'] = Subject::find($id);
        return view('admin.subject.edit_form' , $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->update();
        return redirect()->route('subject.read')->with('success', 'Subject updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }

    public function delete($id){
        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->route('subject.read')->with('success', 'Subject deleted successfully');


    }
}
