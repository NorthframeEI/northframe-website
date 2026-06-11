<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSection extends Model
{
    protected $fillable = [
        'template_id',
        'title',
        'description',
        'image_url',
        'position',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
