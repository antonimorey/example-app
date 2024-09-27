<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    public function post()
    {
    return $this->belongsToMany(Post::class);
    }

    // Ens permet modificar-los en massa amb el $post->update($request->all());
    protected $fillable = [
        'name'
    ];
    
    // Aquests no es poden modificar mai
    protected $guarded = [
        'id'
    ];
}
