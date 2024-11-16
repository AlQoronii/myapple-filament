<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apple extends Model
{
    use HasFactory;

    protected $table = 'table_apple';

    protected $fillable = [
        'user_id',
        'nama_apel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appleHistories()
    {
        return $this->hasMany(AppleHistory::class, 'apple_id');
    }
}
