<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\Categorys;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class PostsController extends Controller
{

    public function AdminIndex()
    {
        $categorys = Categorys::all();
        return view('admin.post.posts',compact('categorys'));
    }
    public function ClientIndex()
    {
        $posts_newer = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->select('posts.*')
                        ->get();
        $posts_study = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->join('categorys','posts.category_id','=','categorys.id')
                        ->where('CategoryName','Học Tập')
                        ->select('posts.*','CategoryName')
                        ->get();

        $posts_profile = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->join('categorys','posts.category_id','=','categorys.id')
                        ->where('CategoryName','Hồ sơ')
                        ->select('posts.*')
                        ->get();
                        
        $posts_role = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->join('categorys','posts.category_id','=','categorys.id')
                        ->where('CategoryName','Nội quy - Quy định')
                        ->select('posts.*','categorys.CategoryName')
                        ->get();

       $posts_activity = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->join('categorys','posts.category_id','=','categorys.id')
                        ->where('CategoryName','Sinh hoạt')
                        ->select('posts.*')
                        ->get();
                                
       $posts_policy = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->join('categorys','posts.category_id','=','categorys.id')
                        ->where('CategoryName','Học phí - Học bổng - Chế độ chính sách')
                        ->select('posts.*')
                        ->get();       
                        
        $posts_form = Posts::take(5)
                        ->orderBy('id','desc')  
                        ->join('categorys','posts.category_id','=','categorys.id')
                        ->where('CategoryName','Biểu mẫu')
                        ->select('posts.*')
                        ->get();                              
        $posts = Posts::all();
        return view('client.index',compact('posts','posts_newer','posts_study','posts_role','posts_profile','posts_activity','posts_policy','posts_form'));
    }
    public function addpostView()
    {
        $categorys = Categorys::all();
        return view('admin.post.addpost', compact('categorys'));
    }
    public function detailPost(Request $request){
        $post_id = $request->post_id;
        $post = Posts::find($post_id);
        return response()->json($post);
    }
    
    public function postIndexApi(){
        $posts = Posts::query()->orderBy('id','desc')->select('posts.*')->get();
        return Datatables::of($posts)
        ->editColumn('category_id',function($posts){
            return $posts->category->CategoryName;
        })
        ->editColumn('created_at',function($posts){
            return Carbon::parse($posts->created_at)->format('d/m/Y');
        })

        ->addColumn('edit',function($posts){
            return route('admin.post.edit',$posts->slug);
        })
        ->addColumn('delete',function($posts){
            return route('admin.post.delete',$posts);
        })
        ->make(true);
    }

    public function store(Request $request)
    {   
        $input = $request->all();
        if($request->hasFile('img')){
            $destination_path = 'public/images/posts';
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $path = $request->file('img')->storeAs($destination_path,$fileName);
            $input['image'] = $fileName;
        }
        if($request->hasFile('file-pdf')){
            $destination_path = 'public/file_doc_upload';
            $file = $request -> file('file-pdf');
            $fileName = $file ->getClientOriginalName();
            $path = $request->file('file-pdf')->storeAs($destination_path,$fileName);
            $input['file'] = $fileName;
        }
        $input['slug'] = Str::slug($request->title);
        Posts::create($input);
        return redirect('admin/post')->with('success', 'Data Added successfully');
    }

    public function edit($slug)
    {
        $post = Posts::where('slug',$slug)->first();
        $categorys = Categorys::all();

        return view('admin.post.editpost', compact('post','categorys'));
    }

    public function update(Request $request,$slug)
    {
        $post = Posts::where('slug',$slug)->first();
        $post->slug = Str::slug($request->title);
        $post->update(
            $request->except([
            '_token',
            '_method'
                ])
        );
        return redirect('admin/post');

    }

    public function destroy(Posts $post)
    {
        if (Storage::exists('public/images/posts/' .$post->image )) {
            Storage::delete('public/images/posts/' .$post->image);
        }
        if (Storage::exists('public/file_doc_upload/' .$post->file )) {
            Storage::delete('public/file_doc_upload/' .$post->file);
        }
        $post->delete();
        return redirect('admin/post');
    }
}
