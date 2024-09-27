<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardarTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Amb index entram sense res amb /tag
     */
    public function index()
    {
        $tags = Tag::paginate(5);
        return view('tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarTagRequest $request)
    {
        
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        // Ens torna allà on erem
        return redirect()->route('tag.index')->with('status', 'Etiqueta creada correctament');     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::findorfail($id);
        return view('tag.show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */

     // Si posam Request se bota ses validacions
     //Si posam GuardarTagRequest ens demana que sigui unique (i ho mira amb el que estam editant)
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());
        return back();
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('status', 'Etiqueta eliminada correctament');
    }
}
