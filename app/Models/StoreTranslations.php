<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreTranslations extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'store_id', 'locale'];

    protected $searchableFields = ['*'];

    protected $table = 'store_translations';

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
