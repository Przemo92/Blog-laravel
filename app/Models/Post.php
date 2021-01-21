<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //protected $fillable = ['title', 'body'];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', Carbon::now());
    }
}
