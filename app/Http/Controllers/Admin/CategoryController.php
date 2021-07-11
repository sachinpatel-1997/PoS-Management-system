<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
class CategoryController extends Controller
{
     public function view()
    {
        $allData = Category::all();
        return view('admin.category.view-category', compact('allData'));
    }

    public function add()
    {
        return view('admin.category.add-category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = new Category();
        $data->name = $request->name;
        $data->created_by = Auth::guard('admin')->user()->id;
        $data->save();

        return redirect()->route('categories.view')->with('success', 'Category added successful!');
    }

    public function edit($id)
    {
        $editData = Category::find($id);
        return view('admin.category.edit-category', compact('editData'));
    }

    public function update($id, Request $request)
    {
        $data = Category::find($id);
        $data->name = $request->name;
        $data->updated_by = Auth::guard('admin')->user()->id;
        $data->save();
        return redirect()->route('categories.view')->with('success', 'Category info updated!');
    }

    public function delete($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('categories.view')->with('warning', 'Category Deleted!');
    }

}
