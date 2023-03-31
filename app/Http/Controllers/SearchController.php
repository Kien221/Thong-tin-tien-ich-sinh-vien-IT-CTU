<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = Posts::where('title','like','%'.$search.'%')->get();
        $post_html = view('client.search.index',compact('posts'))->render();
        return response()->json(['html'=>$post_html]);
    }
}
