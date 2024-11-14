<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppleHistory extends Model
{
    use HasFactory;

    protected $table = 'apple_history';


    public function apple()
    {
        return $this->belongsTo(Apple::class);
    }

    public function history()
    {
        return $this->belongsTo(History::class);
    }
}
