<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Media;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catergory::all();
        return view('admin.media.manage_media', compact('data'));
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
                       'title' => ['required', 'string', 'max:255'],
                       'catergory_id' => ['required'],
                       'name' => ['required', 'string'],
                       'content' => ['required'],
                       'file_path.*' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048', 
        ]);

             $post = Post::create([
            'title' => $request->title,
            'catergory_id' => $request->catergory_id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'status' => $request->status == true ? 'published' : 'draft',
               ]);

      
    if($request->hasFile('file_path'))
    {
        foreach($request->file('file_path') as $file)
        {
            $path = $file->store('media', 'public');

            $file_path = Media::create([
                        'file_path' => $path,
                        'post_id' => $post->id,
                        'user_id' => Auth::id()
            ]);

        }
    }

   
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

        return redirect()->Back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        $data = Post::with(['media', 'tag', 'user'])->where('user_id', Auth::id())->get();
        return view('admin.media.view_post',compact('data'));
    }


    public function showUser($id)
    {
        $data = Post::find($id);
        return view('admin.media.userViewmedia',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edith($id)
    {
        $data = Post::find($id);
        $data_cat = Catergory::all();
        $data_tag = Tag::all();
        return view('admin.media.updateUserViewMedia',compact('data', 'data_cat', 'data_tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'catergory_id' => ['required'], 'name' => ['required'],
            'name' => ['required'],
            'content' => ['required'],
            'file_path.*' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048', 
        ]);

        $post = Post::find($id);

        $post->update([
               'title' => $request->title,
               'catergory_id' => $request->catergory_id,
               'content' => $request->content,
               'status' => $request->status == true ? 'published' : 'draft',
        ]);


        if($request->hasFile('file_path'))
        {
            foreach($request->file('file_path') as $file)
            {
                 $path = $file->store('media', 'public');

                 Media::create([
                        'file_path' => $path,
                         'user_id' => Auth::id(),
                         'post_id' => $post->id
                 ]);
            }
        }

        if($request->name){
             $tagName = explode(',', $request->name);
             $tagIds = [];
             foreach($tagName as $name)
             {
                $tag = Tag::firstOrCreate(['name' => trim($name)]);
                $tagIds[] = $tag->id;
             }

             $post->tag()->sync($tagIds);
        }

        toastr()
        ->closeButton(true)
        ->success('Post Content Updated Successfully.....');

        return redirect()->route('admin.viewMediaPost');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $post_delete = Post::find($id);

         foreach($post_delete->media as $media)
         {
            Storage::disk('public')->delete($media->file_path);
            if(file_exists($media)){
                unlink($media);
            }
            $media->delete();
         }
        $post_delete->tag()->detach();
        $post_delete->delete();

        toastr()
        ->closeButton(true)
        ->success('Post Content Updated Successfully.....');

        return redirect()->route('admin.viewMediaPost');
        
    }
}
