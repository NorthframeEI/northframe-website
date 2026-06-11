<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateGallery extends Model
{
    protected $fillable = [
        'template_id',
        'image_url',
        'alt_text',
        'position',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
