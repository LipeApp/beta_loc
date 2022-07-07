<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Searchable;

    use Translatable;

    public $translationModel = CategoryTranslations::class;

    public $translatedAttributes = [
        'title',
        'title_key',
        'description_key',
        'keywords'];
    protected $fillable = ['image', 'user_id'];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allCategoryTranslations()
    {
        return $this->hasMany(CategoryTranslations::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
