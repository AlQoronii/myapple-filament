<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppleHistory extends Model
{
    use HasFactory;

    protected $table = 'apple_history';

    protected $fillable = [
        'apple_id',
        'history_id',
    ];

    public function apple()
    {
        return $this->belongsTo(Apple::class, 'apple_id');
    }

    public function history()
    {
        return $this->belongsTo(History::class, 'history_id');
    }
}
