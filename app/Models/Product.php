<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;
    use Translatable;

    public $translationModel = ProductTranslations::class;

    public $translatedAttributes = [
        'title',
        'info',
        'title_key',
        'description_key',
        'keywords'
    ];

    protected $fillable = ['user_id', 'category_id', 'image', 'price'];

    protected $searchableFields = ['*'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allProductTranslations()
    {
        return $this->hasMany(ProductTranslations::class);
    }
}
