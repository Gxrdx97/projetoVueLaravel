<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{

    use HasFactory;

    protected $fillable = ['nome', 'marca', 'preco'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'produtos_acessorios');
    }
}
