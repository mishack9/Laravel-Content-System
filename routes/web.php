<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CatergoryController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\Editorcontroller;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\ViewerController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/', [ViewerController::class, 'index'])->name('home');



Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('admin/dashboard', [Admincontroller::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/index/approve_post/{id}', [Admincontroller::class, 'approve'])->name('admin.approvePost');
    Route::get('admin/index/reject_post/{id}', [Admincontroller::class, 'reject'])->name('admin.rejectPost');

    Route::get('admin/index/viewEditor', [Admincontroller::class, 'view_editor_post'])->name('admin.viewEditorPost');

    Route::get('admin/index/create/user', [Admincontroller::class, 'add_user'])->name('admin.addUser');
    Route::post('admin/index/store/user', [Admincontroller::class, 'add_store'])->name('admin.storeUser');
    Route::get('admin/index/view/user', [Admincontroller::class, 'view_user'])->name('admin.viewUser');
});


Route::middleware(['auth', 'role:editor,admin'])->group(function(){

    Route::get('admin/index/create_post', [PostController::class, 'index'])->name('admin.createPost');
    Route::post('admin/index/store_post', [PostController::class, 'store'])->name('admin.storePost');
    Route::get('admin/index/view_post', [PostController::class, 'show'])->name('admin.viewPost');
    Route::get('admin/index/edith_post/{id}', [PostController::class, 'edith'])->name('admin.edithPost');
    Route::put('admin/index/update_post/{id}', [PostController::class, 'update'])->name('admin.updatePost');
    Route::get('admin/index/delete_post/{id}', [PostController::class, 'destroy'])->name('admin.deletePost');
    Route::get('admin/index/user_post/{id}', [PostController::class, 'view'])->name('admin.viewUserPost');
    Route::patch('admin/index/approval_request/{id}', [PostController::class, 'approval_request'])->name('posts.submitApproval');    
   

    Route::get('admin/index/manage_catergory', [CatergoryController::class, 'index'])->name('admin.manageCatergory');
    Route::post('admin/index/manage_catergory/store', [CatergoryController::class, 'store'])->name('admin.storeCatergory');
    Route::get('admin/index/manage_catergory/edith/{id}', [CatergoryController::class, 'edith'])->name('admin.edithCatergory');
    Route::put('admin/index/manage_catergory/update/{id}', [CatergoryController::class, 'update'])->name('admin.updateCatergory');
    Route::get('admin/index/manage_catergory/delete/{id}', [CatergoryController::class, 'destroy'])->name('admin.deleteCatergory');


    Route::get('admin/index/manage_tag', [TagController::class, 'index'])->name('admin.manageTag');
    Route::post('admin/index/manage_tag/store', [TagController::class, 'store'])->name('admin.storeTag');
    Route::get('admin/index/manage_tag/edith/{id}', [TagController::class, 'edith'])->name('admin.edithTag');
    Route::put('admin/index/manage_tag/update/{id}', [TagController::class, 'update'])->name('admin.updateTag'); 
    Route::get('admin/index/manage_tag/delete/{id}', [TagController::class, 'destroy'])->name('admin.deleteTag');


    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');


    Route::get('admin/index/media_post/create', [MediaController::class, 'index'])->name('admin.mediaPost');
    Route::post('admin/index/media_post/store', [MediaController::class, 'store'])->name('admin.storeMediaPost');
    Route::get('admin/index/media_post/view', [MediaController::class, 'show'])->name('admin.viewMediaPost');
    Route::get('admin/index/media_post/Userview{id}', [MediaController::class, 'showUser'])->name('admin.viewUserMediaPost');
    Route::get('admin/index/media_post/edith/{id}', [MediaController::class, 'edith'])->name('admin.edithMediaPost');
    Route::put('admin/index/media_post/update/{id}', [MediaController::class, 'update'])->name('admin.updateMediaPost');
    Route::get('admin/index/media_post/delete/{id}', [MediaController::class, 'destroy'])->name('admin.deleteMediaPost');
 
});



Route::middleware(['auth', 'role:user,editor,admin'])->group(function(){

     Route::get('viewer/index', [Usercontroller::class, 'dashboard'])->name('viewer.dashboard');
     Route::get('viewer/index/post', [Usercontroller::class, 'view_post'])->name('viewer.viewPost');
    /*  Route::patch('viewer/index/reviwer/{id}', [PostController::class, 'review'])->name('reviewer.review'); */
     Route::get('viewer/index/more/{id}', [Usercontroller::class, 'read_more'])->name('viewer.readmore');
     Route::get('viewer/index/catergory/{id}', [Usercontroller::class, 'view_catergoryPost'])->name('viewer.viewCatergory');
     

});  





Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
