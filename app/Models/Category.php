<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'kategori_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'kategori_id');
    }
}
