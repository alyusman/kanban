<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['title', 'user_id'];
    use HasFactory;

    public function Card()
    {
        return $this->hasMany(Cards::class, 'list_id');
    }
}
