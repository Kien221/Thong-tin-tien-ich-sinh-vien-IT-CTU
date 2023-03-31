<?php

namespace App\Http\Controllers;

use App\Models\Categorys;

use Illuminate\Http\Request;

class CategorysController extends Controller
{

    public function index()
    {
        $categorys = Categorys::get();
        return view('admin.category.categorys',['categorys'=>$categorys]);
    }
    public function addcategoryView(){
        return view('admin.category.addcategory');
    }


    public function store(Request $request)
    {
        $categorys = new Categorys();
        $categorys->CategoryName = $request->categoryName;
        $categorys->save();
        return redirect()->route('admin.category');
    }

    public function show(Categorys $categorys)
    {
        //
    }

    public function edit($id)
    {
        $category = Categorys::find($id);
        return view('admin.category.updatecategory',['category'=>$category]);
    }
   
    public function update(Request $request, Categorys $category)
    {
        $category->CategoryName = $request->categoryName;
        $category->save();
        return redirect()->route('admin.category');
    }

    public function destroy(Categorys $category)
    {
        $category->delete();
        return redirect()->route('admin.category');
    }
}
