<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maching extends Model
{
    use HasFactory;

    protected $table = 'machings';

    protected $fillable = [
        'mached_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'maching_user');
    }
}
