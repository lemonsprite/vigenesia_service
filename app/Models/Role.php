<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $fillable = ['role'];
    
    public $timestamps = false;


    public function hasUsers()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
