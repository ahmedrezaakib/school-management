<?php

namespace App\Http\Controllers;

use App\Models\feeHead;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.fee-head.fee-head');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $fee = new FeeHead();
        $fee->name = $request->name;
        $fee->save();
        return redirect()->route('fee-head.create')->with('success','Fee added successfully');
    }

    public function read(){
        $data['fee'] = FeeHead::latest()->get();
        return view('admin.fee-head.fee-head-list', $data);
    }

    public function edit($id){
        $data['fee'] = FeeHead::find($id);
        return view('admin.fee-head.edit-fee-head',$data);
    }

    public function update(request $request){
        $fee = FeeHead::find($request->id);
        $fee->name = $request->name;
        $fee->update();
        return redirect()->route('fee-head.read')->with('success','Fee updated successfully');
    }

    public function delete($id){
        $fee = FeeHead::find($id);
        $fee->delete();
        return redirect()->route('fee-head.read')->with('success','Fee deleted successfully');


    }
}
