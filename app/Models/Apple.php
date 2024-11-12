<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apple extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_apel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appleHistories()
    {
        return $this->hasMany(AppleHistory::class);
    }
}
