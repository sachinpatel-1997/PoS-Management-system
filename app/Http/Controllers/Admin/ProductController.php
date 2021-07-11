<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\Unit;
use App\Category;
use Auth;

class ProductController extends Controller
{
        public function view()
    {
        $allData = Product::all();
        return view('admin.product.view-product', compact('allData'));
    }

    public function add()
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $units = Unit::select('id', 'name')->get();
        return view('admin.product.add-product', compact('suppliers', 'categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'supplier_id' => 'required'
        ]);

        $data = new Product();
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->created_by = Auth::guard('admin')->user()->id;
        $data->save();

        return redirect()->route('products.view')->with('success', 'Product added successful!');
    }

    public function edit($id)
    {
        $editData = Product::find($id);
        $suppliers = Supplier::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $units = Unit::select('id', 'name')->get();
        return view('admin.product.edit-product', compact('editData', 'suppliers', 'categories', 'units'));
    }

    public function update($id, Request $request)
    {
        $data = Product::find($id);
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->updated_by = Auth::guard('admin')->user()->id;
        $data->save();
        return redirect()->route('products.view')->with('success', 'Product info updated!');
    }

    public function delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('products.view')->with('warning', 'Product Deleted!');
    }

}
