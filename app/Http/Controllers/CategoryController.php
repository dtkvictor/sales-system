<?php

namespace App\Http\Controllers;

use App\Http\Filters\CategoryFilter;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = new CategoryFilter(new Category());
        $categories = $categories->apply(request()->query())
                                 ->paginate(6);

        $categories->each(function($category) {
            $category->thumb = Storage::url($category->thumb);
        });

        return view('components.pages.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = new Category();
            $category->thumb = $request->file('thumb')->store('/category/thumb');
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->description = $request->description;
            $category->save();
            $request->session()->put('success', "Category $category->name created successfully.");    

        }catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('category.create');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category->thumb = Storage::url($category->thumb);

        return view('components.pages.category.update', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            if($request->hasFile('thumb')) {
                $oldThumb = $category->thumb;
                $category->thumb = $request->file('thumb')->store('/category/thumb');
            }
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->description = $request->description;
            $category->save();    

            if(isset($oldThumb) && Storage::has($oldThumb)) {
                Storage::delete($oldThumb);
            }

            $request->session()->put('success', "Category $category->name updated successfully.");

        }catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('category.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $thumb = $category->thumb;
            $category->delete();
            if(Storage::has($thumb)) {
                Storage::delete($thumb);
            }
            request()->session()->put('success', "Category $category->name delete successfully.");
            
        }catch(QueryException $e) {
            request()->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }catch(Exception $e) {
            request()->session()->put('fails', "{$e->getMessage()}: {$e->getCode()}");
        }

        return redirect()->route('category.index');
    }
}
