<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'descricao', 'preco'];

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class, 'produtos_acessorios');

    }
}
