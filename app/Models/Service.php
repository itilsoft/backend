<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class, 'service_id', 'id');
    }

    public function averageStar()
    {
        return round($this->comments()->average('star'), 2);
    }
}
