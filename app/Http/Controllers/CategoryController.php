<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardarCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Amb index entram sense res amb /category
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarCategoryRequest $request)
    {
        
        $category = new Category;
        $category->title = $request->title;
        $category->url_clean = $request->url_clean;
        $category->save();

        // Ens torna allà on erem
        return redirect()->route('tag.index')->with('status', 'Categoria creada correctament');     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findorfail($id);
        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */

     // Si posam Request se bota ses validacions
     //Si posam GuardarCategoryRequest ens demana que sigui unique (i ho mira amb el que estam editant)
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return back();
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('status', 'Categoria eliminada correctament');
    }
}
