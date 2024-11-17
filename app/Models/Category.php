<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category',
        'treatment',
        'description',
    ];

    public function histories()
    {
        return $this->hasMany(History::class, 'disease_info_id');
    }
}
