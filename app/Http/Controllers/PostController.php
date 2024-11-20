<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catergory::where('status', 'published')->get();
        return view('admin.post.create_post',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view($id)
    {
        $data = Post::find($id);
        return view('admin.post.userpost',compact('data'));
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
          'approval_status' => Post::STATUS_PENDING
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

        return redirect()->route('admin.createPost');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       $data = Post::where('user_id', Auth::id())->get();
       return view('admin.post.viewPost',compact('data'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edith($id)
    {
        $data = Post::find($id);
        $cat = Catergory::all();
        return view('admin.post.edithPost',['data' => $data, 'cat' => $cat]);
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

        /*  if($request->name)
         {
           $tagName = explode(',', $request->name);
           $tagIds = [];
           foreach($tagName as $name)
           {
               $tag = Tag::firstOrCreate(['name' => ($name)]);
               $tagIds[] = $tag->id;
           }
           $data->tag()->sync($tagIds);
         } */

         toastr()
         ->closeButton(true)
         ->success('Post Content Updated Successfully.....');

         return redirect()->route('admin.viewPost');
         

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


  public function approval_request($id)
  {
    $post = Post::find($id);
    Gate::authorize('update');
    $post->update(['approval_status' => Post::STATUS_PENDING]);

    toastr()
    ->closeButton(true)
    ->success('Your post has been sent for approval..... Please wait while Admin approve your post');

    return redirect()->back();
   
  }


}
