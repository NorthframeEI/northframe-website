<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioTag extends Model
{
    protected $fillable = [
        'portfolio_project_id',
        'name',
    ];

    // PortfolioTag
    public function project()
    {
        return $this->belongsTo(PortfolioProject::class);
    }
}
