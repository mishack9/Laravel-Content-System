<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use Illuminate\Http\Request;

class CatergoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catergory::latest()->get();
        return view('admin.catergory.manage_catergory',compact('data'));
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
                  'name' => ['required', 'max:225'],
        ]);

        Catergory::create([
            'name' => $request->name,
            'status' => $request->status == true ? 'published' : 'draft',
        ]);

        toastr()
        ->closeButton(true)
        ->success('Catergory Data Created Successfully.....');

        return redirect()->route('admin.manageCatergory');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catergory $catergory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edith($id)
    {
        $data['data_cat'] = Catergory::find($id);
        return view('admin.catergory.edith_catergory',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:225']
        ]);

        $data = Catergory::find($id);

        $data->name = $request->name;
        $data->status = $request->status == true ? 'publised' : 'draft';

        $data->update();
        if($data)
        {
            toastr()
            ->closeButton(true)
            ->success('Catergory Data Updated Successfully.....');
    
            return redirect()->route('admin.manageCatergory');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Catergory::destroy($id);
        if($data)
        {
            toastr()
            ->closeButton(true)
            ->success('Catergory Data Deleted Successfully.....');
    
            return redirect()->back();
        }
    }
}
