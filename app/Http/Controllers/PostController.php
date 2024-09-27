<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardarPostRequest;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\PostImage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//recordar afergir /create o lo que sigui a la url darrera de /post
//http://example-app.test/post/create 

class PostController extends Controller
{
    /**
     * Amb index entram sense res amb /post
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('id', 'title');
        $tag = Tag::pluck('id', 'name');
        return view('post.create', ['category' => $category], ['tag' => $tag]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarPostRequest $request)
    {
        
        $post = new Post;
        $post->title = $request->title;
        $post->url_clean = $request->url_clean;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->posted = $request->posted;
        $post->user_id = Auth::user()->id;
        $post->save();

        // Ens torna allà on erem
        return redirect()->route('post.index')->with('status', 'Post creat correctament');        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findorfail($id);
        $category = Category::pluck('id', 'title');
        $tag = Tag::pluck('id', 'name');
        return view('post.show', ['post' => $post], ['category' => $category], ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $category = Category::pluck('id', 'title');
        $tag = Tag::pluck('id', 'name');
        return view('post.edit', ['post' => $post], ['category' => $category], ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */

     // Si posam Request se bota ses validacions
     //Si posam GuardarPostRequest ens demana que sigui unique (i ho mira amb el que estam editant)
    public function update(Request $request, Post $post)
    {
        /* Es lo mateix que all, però manual */
        $post->title = $request->title;
        $post->url_clean = $request->url_clean;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->posted = $request->posted;
        $post->user_id = Auth::user()->id;
        $post->update();
    
        /*  $post->update($request->all());    */

        return back();
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('status', 'Post eliminat correctament');
    }


    public function image(Request $request, Post $post){
        $request->validate([
          'image' => 'required|max:10240',
        ]);
      
        $filename = time().".".$request->image->extension();
      
        $request->image->move(public_path('images'), $filename);
      
        PostImage::create(['image' => $filename, 'post_id' => $post->id]);

        return redirect('post')->with('status', 'Imatge carregada correctament');
    }

    
}
