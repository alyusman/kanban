<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'file', 'list_id', 'user_id'];

    public function List()
    {
        return $this->belongsTo(Lists::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class, 'card_id');
    }
}
