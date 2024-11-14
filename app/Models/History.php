<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    
    protected $fillable = [
        'user_id',
        'scan_date',
        'scan_image_path',
        'disease_info_id',
    ];

    // Relasi ke DiseaseInfo (Setiap history berhubungan dengan satu kategori penyakit)
    public function diseaseInfo()
    {
        return $this->belongsTo(Category::class, 'disease_info_id');
    }

    // Relasi ke User (Setiap history dibuat oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke AppleHistory (Setiap history bisa punya banyak appleHistory)
    public function appleHistories()
    {
        return $this->hasMany(AppleHistory::class);
    }
}

