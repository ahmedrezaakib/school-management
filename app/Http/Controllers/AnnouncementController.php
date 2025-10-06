<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.announcement.form');
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
            'notice'=>'required',
            'type'=>'required',
        ]);
        $announcement = new Announcement();
        $announcement->notice = $request->notice;
        $announcement->type = $request->type;
        $announcement->save();
        return redirect()->route('announcement.create')->with('success','Notice sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function read()
    {
        $data['announcements']= Announcement::latest()->get();
        return view('admin.announcement.list',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $data['announcement'] = Announcement::find($id);
        return view('admin.announcement.edit_form',$data);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $announcement->notice = $request->notice;
        $announcement->type = $request->type;
        $announcement->update();
        return redirect()->route('announcement.read')->with('success','Notice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();
        return redirect()->route('announcement.read')->with('success','Notice delted successfully');

    }
}
