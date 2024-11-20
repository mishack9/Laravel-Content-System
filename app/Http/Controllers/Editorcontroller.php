<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Editorcontroller extends Controller
{
    public function dashboard()
    {
        return view('editor.dashboard');
    }

    public function index()
    {
        $data = Catergory::all();
        return view('editor.post.create_post',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view($id)
    {
        $data = Post::find($id);
        return view('editor.post.userpost',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
               'title' => ['required', 'string', 'max:255'],
               'catergory_id' => ['required'],
               'content' => ['required', 'string'],
               'name' => ['nullable', 'string']
        ]);

       $post =  Post::create([
          'title' => $request->title,
          'catergory_id' => $request->catergory_id,
          'content' => $request->content,
          'user_id' => Auth::id(),
          'status' => $request->status == true ? 'published' : 'draft',
        ]);

          if($request->name)
          {
            $tagName = explode(',', $request->name);
            $tagIds = [];
            foreach($tagName as $name)
            {
                $tag = Tag::firstOrCreate(['name' => ($name)]);
                $tagIds[] = $tag->id;
            }
            $post->tag()->sync($tagIds);
          }

         toastr()
        ->closeButton(true)
        ->success('Post Content Created Successfully.....');

        return redirect()->route('editor.createPost');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       $data = Post::latest()->get();
       return view('editor.post.viewPost',compact('data'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edith($id)
    {
        $data = Post::find($id);
        $data_tag = Tag::where('id', $data->id)->get();
        $cat = Catergory::all();
        return view('admin.post.edithPost',['data' => $data, 'cat' => $cat, 'data_tag' => $data_tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'name' => ['nullable', 'string']
        ]);

         $data = Post::find($id);
         $data->title = $request->title;
         $data->catergory_id = $request->catergory_id;
         $data->content = $request->content;
         $data->status = $request->status == true ? 'published' : 'draft';

         $data->update();

         if($request->name)
         {
           $tagName = explode(',', $request->name);
           $tagIds = [];
           foreach($tagName as $name)
           {
               $tag = Tag::firstOrCreate(['name' => ($name)]);
               $tagIds[] = $tag->id;
           }
           $data->tag()->sync($tagIds);
         } 

         toastr()
         ->closeButton(true)
         ->success('Post Content Updated Successfully.....');

         return redirect()->route('editor.viewPost');
         

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Post::destroy($id);
        if($data)
        {
            toastr()
            ->closeButton(true)
            ->success('Post Content Deleted Successfully.....');
   
            return redirect()->back();
        }
    }

}
