<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateBenefit extends Model
{
    protected $fillable = [
        'template_id',
        'icon',
        'title',
        'description',
        'position',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
