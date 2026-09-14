<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin-panel.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin-panel.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:categories',
        ]);
        Category::create([
            'name' => $request->name,
        ]);

        return redirect('admin/categories')->with('successMsg', 'SuccessFul Created..');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('admin-panel.category.edit', compact('category'));

    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);
        return redirect('admin/categories')->with('successMsg', 'SuccessFul Updated..');

    }


    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('successMsg', 'SuccessFull Deleted..');

    }
}
