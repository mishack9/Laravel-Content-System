<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::latest()->get();
        return view('admin.tag.manageTag',compact('data'));
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
            'name' => ['required', 'max:100', 'string'],
        ]);

           Tag::create([
                'name' => $request->name,
          
           ]);

           toastr()
           ->closeButton(true)
           ->success('Tag Added Successfully.....');
   
           return redirect()->route('admin.manageTag');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edith($id)
    {
        $data = Tag::find($id);
        return view('admin.tag.updateTag',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:225']
        ]);

        $data = Tag::find($id);

        $data->name = $request->name;

        $data->update();
        if($data)
        {
            toastr()
            ->closeButton(true)
            ->success('Tag Data Updated Successfully.....');
    
            return redirect()->route('admin.manageTag');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Tag::destroy($id);
        if($data)
        {
            toastr()
            ->closeButton(true)
            ->success('Tag Successfully Deleted.....');
    
            return redirect()->back();
        }
    }
}
