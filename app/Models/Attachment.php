<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'card_id', 'file', 'name'];
    public function card()
    {
        return $this->belongsTo(Cards::class,);
    }
}
