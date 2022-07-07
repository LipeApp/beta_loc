<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;
    use Searchable;
    use Translatable;

    public $translationModel = StoreTranslations::class;
    public $translatedAttributes = ['title', 'store_id', 'locale'];
    protected $fillable = ['phone', 'maps'];

    protected $searchableFields = ['*'];

    public function allStoreTranslations()
    {
        return $this->hasMany(StoreTranslations::class);
    }
}
