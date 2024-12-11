<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    // Daftar kolom yang bisa diisi
    protected $fillable = [
        'title',
        'content',
        'image_path',
        'source',
        'publication_date'
        ];
}
