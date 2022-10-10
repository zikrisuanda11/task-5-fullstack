<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
