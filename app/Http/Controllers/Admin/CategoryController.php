<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::orderByDesc('id')->get();
        return view('admin.categories.index', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val_data = $request->validate([
            'name' => 'required|unique:categories'
        ]);
        // generate slug
        $slug = Str::slug($request->name);
        $val_data['slug'] = $slug;

        // salvare

        Category::create($val_data);

        // redirect
        return redirect()->back()->with('message', "Category $slug added successfully");
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $val_data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category)]
        ]);
        // generate slug
        $slug = Str::slug($request->name);
        $val_data['slug'] = $slug;

        $category->update($val_data);
        return redirect()->back()->with('message', "Category $slug updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', "Category $category->name removed successfully");
    }
}
