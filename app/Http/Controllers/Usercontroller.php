<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class Usercontroller extends Controller
{
    public function dashboard()
    {
        $data['catergory'] = Catergory::latest()->get();
        $data['post'] = Post::where('approval_status', 'approved')->get();
        return view('viewer.dashboard',$data);
    }



  public function read_more($id)
  {
    $catergory = Catergory::latest()->get();
    $data = Post::find($id);
    return view('viewer.readmore',compact('data', 'catergory'));
  }


    public function view_post()
    {
       $catergory = Catergory::latest()->get();
       $post = Post::where('approval_status', 'approved')->get();
       return view('viewer.media',compact('post','catergory'));
    }


    public function view_catergoryPost($id)
    {
      $data['catergory'] = Catergory::latest()->get();
     /*   $cat_er_gory = Catergory::find($id); */
       $data['post_catergory'] = Post::where(['catergory_id' => $id, 'approval_status' => 'approved'])->get();
       return view('viewer.postCatergory',$data);
    }

}
