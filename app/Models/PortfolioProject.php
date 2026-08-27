<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'url',
        'is_visible',
        'authorization_pending',
    ];
    // PortfolioProject
    public function tags()
    {
        return $this->hasMany(PortfolioTag::class);
    }
}
