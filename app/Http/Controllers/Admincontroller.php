<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\PostStatusHistory;
use App\Notifications\ContentStatusNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Admincontroller extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function add_user()
    {
        return view('admin.user.addUser');
    }

    public function add_store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required',  Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'phone' => ['required'],
            'address' => ['required'],
            'role' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role
        ]);

        event(new Registered($user));

        toastr()
        ->closeButton(true)
        ->success('User Successfully Created...');
  
        return redirect()->route('admin.viewUser');
        
    }



    public function view_user()
    {
        $data = User::where('role', 'editor', 'user');
        return view('admin.user.userView', compact('data'));
    }


    public function view_editor_post()
    {
        $data = Post::all();
        return view('admin.post.viewEditorPost',compact('data'));
    }


    public function approve($id)
    {
        $data = Post::find($id);
        Gate::authorize('approve');
        $data->update(['approval_status' => Post::STATUS_APPROVED]);

         // Record the history
    PostStatusHistory::create([
        'post_id' => $data->id,
        'status' => Post::STATUS_APPROVED,
        'user_id' => Auth::id(),
    ]);

        $data->user->notify(new ContentStatusNotification($data, 'approved'));
      
      toastr()
      ->closeButton(true)
      ->success('Approved.....');

      return redirect()->back(); 
    }


    public function reject($id)
    {
        $data = Post::find($id);
        Gate::authorize('reject');
        $data->update(['approval_status' => Post::STATUS_REJECTED]);

         // Record the history
    PostStatusHistory::create([
        'post_id' => $data->id,
        'status' => Post::STATUS_APPROVED,
        'user_id' => Auth::id(),
    ]);

        $data->user->notify(new ContentStatusNotification($data, 'reject'));
      
      toastr()
      ->closeButton(true)
      ->success('Rejected.....');

      return redirect()->back();
    }
}
