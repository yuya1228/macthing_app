<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'image',
        'text',
        'age',
        'hobby',
        'gender_id',
    ];

    // ユーザーテーブルとリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($profile) {
            $profile->users()->delete();
        });
    }
}
