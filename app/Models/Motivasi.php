<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivasi extends Model
{
    use HasFactory;

    protected $table = 'motivasi';

    protected $fillable = [
        'isi_motivasi',
        'id_user'
    ];


    public function hasUser()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
