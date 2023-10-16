<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer ()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function model ()
    {
        return $this->belongsTo(ProductModel::class);
    }
}
