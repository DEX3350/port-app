<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['text', 'hashtags'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getFormattedTextAttribute()
    {
        return preg_replace('/#(\w+)/', '<span class="text-blue-500 font-bold">#$1</span>', $this->text);
    }
}
