<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        
        $request->validate([
        'upload' => 'required|file|image|mimes:jpeg,PNG,JPG,gif,svg|max:2048', // Max 2MB
        ]); 
    
    if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $filename = time() . '_' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/uploads', $filename);

                // Respond with the URL in CKEditor's expected format
                return response()->json([
                    'url' => Storage::url($path),
                ]);
            }
            return response()->json(['error' => 'File not uploaded'], 400);
            }
}


