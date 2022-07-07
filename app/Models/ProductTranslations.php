<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTranslations extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'product_id',
        'locale',
        'title',
        'info',
        'title_key',
        'description_key',
        'keywords',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'product_translations';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
