<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    // Ens permet modificar-los en massa amb el $post->update($request->all());
    protected $fillable = [
        'title',
        'url_clean',
    ];
    
    // Aquests no es poden modificar mai
    protected $guarded = [
        'id'
    ];
}
