<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use SoftDeletes;

    public function parent_category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }
}