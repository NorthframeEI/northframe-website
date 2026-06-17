<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'template_category_id',
        'short_description',
        'long_description',
        'thumbnail_url',
        'hero_image_url',
        'is_featured',
        'is_active',
        'position',
        'html_path',
        'css_path',
        'js_path',
    ];

    public function benefits()
    {
        return $this->hasMany(TemplateBenefit::class)
            ->orderBy('position');
    }

    public function sections()
    {
        return $this->hasMany(TemplateSection::class)
            ->orderBy('position');
    }

    public function category()
{
    return $this->belongsTo(TemplatesCategories::class, 'template_category_id');
}

}
