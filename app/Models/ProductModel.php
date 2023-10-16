<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'models';

    public function manufacturer ()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
