<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTranslations extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'title_key',
        'description_key',
        'keywords',
        'category_id',
        'locale',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'category_translations';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
